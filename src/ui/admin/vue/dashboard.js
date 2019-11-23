Vue.component('apexchart', VueApexCharts)

var client = new dsteem.Client('https://api.steemit.com')

var app = new Vue({
  el: '#app',
  data: function() {
    return {
      ready: false,
      vpChartSeries: [],
      vpChartOptions: {
        plotOptions: {
          radialBar: {
            hollow: {
              size: '70%',
            }
          },
        },
        labels: ['Voting power']
      },
      manaChartSeries: [],
      manaChartOptions: {
        plotOptions: {
          radialBar: {
            hollow: {
              size: '70%',
            }
          },
        },
        labels: ['Available mana']
      },
      spChartSeries: [],
      spChartOptions: {
        plotOptions: {
          radialBar: {
            hollow: {
              size: '70%',
            }
          },
        },
        labels: ['SP retainment']
      },
      dashboardData: window._dashboardData,
      account: null,
      accountData: {
        account: null,
        reputation: null,
        steem: null,
        sbd: null,
        currentMana: null,
        maxMana: null,
        currentManaPerc: null,
        votingPower: null,
        estimate: null,
        steemPower: null,
        delegatedSteemPower: null
      },

      feedChartOptions: {
        chart: {
          // id: 'dashboard-chart',
          zoom: {
            enabled: false
          },
          width: "100%",
          height: 380,
        },
        stroke: {
          curve: 'straight'
        },
        /*
        subtitle: {
          text: 'Price Movements',
          align: 'left'
        },
        */
        series: this.feedChartSeries,
        yaxis: {
          opposite: true
        },
        legend: {
          horizontalAlign: 'left'
        },
        xaxis: {
            labels: {
                show: false,
            }
        },
        dataLabels: {
          enabled: false
        },
        title: {
            text: 'Steem to Steem Dollars price history',
            align: 'left',
            margin: 10,
            offsetX: 0,
            offsetY: 0,
            floating: false,
            style: {
              fontSize:  '16px',
              color:  '#263238'
            },
        }
      },
      feedChartSeries: [],
      
      quoteChartSeries: [],
      quoteChartOptions: {
        title: {
            text: 'Current quote to max quote',
            align: 'left',
            margin: 10,
            offsetX: 0,
            offsetY: 0,
            floating: false,
            style: {
              fontSize:  '16px',
              color:  '#263238'
            },
        },
        plotOptions: {
          radialBar: {
            startAngle: -135,
            endAngle: 135,
            dataLabels: {
              name: {
                fontSize: '16px',
                color: undefined,
                offsetY: 120
              },
              value: {
                offsetY: 76,
                fontSize: '22px',
                color: undefined,
                formatter: function (val) {
                  return Math.round(val) + "%";
                }
              }
            }
          }
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'dark',
            shadeIntensity: 0.15,
            inverseColors: false,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 50, 65, 91]
          },
        },
        stroke: {
          dashArray: 4
        },
        labels: []
      },
      
      steemQuote: null,
      maxQuote: null
    }
  },
  async mounted () {
    await this.getData()
    this.setCharts()
    this.ready = true
  },
  methods: {
    async getData () {
      let account = await client.database.call('get_accounts', [[this.dashboardData.account]])
      account = account[0]
      this.account = account
      this.accountData.name = account.name
      this.accountData.reputation = this.reputation(account.reputation)
      this.accountData.steem = +account.balance.split(' ')[0]
      this.accountData.sbd = +account.sbd_balance.split(' ')[0]
      
      let priceFeedData = await client.database.call('get_feed_history', [])
      let priceHistory = priceFeedData.price_history
      
      let sdbBids = priceHistory.map((bid) => parseFloat(bid.base))

      let minSbd = Math.min(...sdbBids)
      let maxSbd = Math.max(...sdbBids)

      this.quoteChartSeries.push((minSbd / maxSbd) * 100)
      this.quoteChartOptions.labels.push(minSbd + ' SBD / ' + maxSbd + ' SBD' )

      this.feedChartSeries.push({
        name: 'Steem to Steem Dollars quote',
        data: priceHistory.map(sbd => +sbd.base.split(' ')[0])
      })
      
      var globals = await client.database.getDynamicGlobalProperties()
      var CURRENT_UNIX_TIMESTAMP = parseInt((new Date(globals.time).getTime() / 1000).toFixed(0))
      // calculate available SP
      var totalShares = parseFloat(account.vesting_shares) + parseFloat(account.received_vesting_shares) - parseFloat(account.delegated_vesting_shares)
      // determine elapsed time since last RC update
      var elapsed = CURRENT_UNIX_TIMESTAMP - account.voting_manabar.last_update_time
      var maxMana = totalShares * 1000000
      // calculate current mana for the 5 day period (432000 sec = 5 days)
      var currentMana = parseFloat(account.voting_manabar.current_mana) + elapsed * maxMana / 432000

      if (currentMana > maxMana) {
        currentMana = maxMana
      }
      // determine percentage of available mana(RC)
      var currentManaPerc = (currentMana * 100 / maxMana).toFixed(2)
      // console.log(currentManaPerc)

      // calculate voting power
      var secondsago = (new Date() - new Date(account.last_vote_time + 'Z')) / 1000
      var votingPower = account.voting_power + (10000 * secondsago / 432000)
      votingPower = Math.min(votingPower / 100, 100).toFixed(2)

      var rewardFund = await client.database.call('get_reward_fund', ['post'])
      var priceFeed = await client.database.call('get_current_median_history_price', [])
      let totalVests = +account.vesting_shares.split(' ')[0] + +account.received_vesting_shares.split(' ')[0] - +account.delegated_vesting_shares.split(' ')[0]
      let finalVest = totalVests * 1e6
      let power = (account.voting_power * 10000 / 10000) / 50
      let rshares = power * finalVest / 10000
      let sbdMedianPrice = +priceFeed.base.split(' ')[0]
      let voteWorth = (rshares / +rewardFund.recent_claims.split(' ')[0] * +rewardFund.reward_balance.split(' ')[0] * sbdMedianPrice).toFixed(2)
      // console.log(voteWorth)

      let totalGlobalSteem = +globals.total_vesting_fund_steem.split(' ')[0]
      let totalGlobalVests = +globals.total_vesting_shares.split(' ')[0]
      let userVests = +account.vesting_shares.split(' ')[0]
      let otherVests = +account.received_vesting_shares.split(' ')[0] - +account.delegated_vesting_shares.split(' ')[0]
      let steemPower = Number((totalGlobalSteem * (userVests / totalGlobalVests)).toFixed(2))
      let delegatedSteemPower = Number((totalGlobalSteem * (otherVests / totalGlobalVests)).toFixed())
      // console.log(steemPower, delegatedSteemPower)

      this.accountData.currentMana = +currentMana
      this.accountData.maxMana = +maxMana
      this.accountData.currentManaPerc = +currentManaPerc
      this.accountData.votingPower = +votingPower
      this.accountData.voteWorth = +voteWorth
      this.accountData.steemPower = +steemPower
      this.accountData.delegatedSteemPower = delegatedSteemPower
      
    },
    setCharts () {
      this.manaChartSeries.push(+this.accountData.currentManaPerc)
      this.vpChartSeries.push(+this.accountData.votingPower)
      let inout = (this.accountData.delegatedSteemPower < 0) ? Math.abs(this.accountData.delegatedSteemPower) : (this.accountData.delegatedSteemPower === 0) ? this.accountData.steemPower : this.accountData.delegatedSteemPower
      this.spChartSeries.push(Math.round((inout/this.accountData.steemPower) * 100))
    },
    reputation (reputation) {
      if (reputation == null) return reputation;
      reputation = parseInt(reputation);
      let rep = String(reputation);
      const neg = rep.charAt(0) === "-";
      rep = neg ? rep.substring(1) : rep;
      const str = rep;
      const leadingDigits = parseInt(str.substring(0, 4));
      const log = Math.log(leadingDigits) / Math.log(10);
      const n = str.length - 1;
      let out = n + (log - parseInt(log));
      if (isNaN(out)) out = 0;
      out = Math.max(out - 9, 0);
      out = (neg ? -1 : 1) * out;
      out = out * 9 + 25;
      out = parseInt(out);
      return out;
    },
    formatNumber (number) {
      var SI_SYMBOL = ["", "k", "M", "G", "T", "P", "E"];
      
      // what tier? (determines SI symbol)
      var tier = Math.log10(number) / 3 | 0;

      // if zero, we don't need a suffix
      if(tier == 0) return number;

      // get suffix and determine scale
      var suffix = SI_SYMBOL[tier];
      var scale = Math.pow(10, tier * 3);

      // scale the number
      var scaled = number / scale;

      // format number and add suffix
      return scaled.toFixed(1) + suffix;
    }
  },
  computed: {
  },
  template: `
    <div>
        
        <div v-if="this.ready">
        
            <div class="row steemwp-row">
            
                <div class="three columns steemwp-columns" style="text-align: center; border-right: 1px solid #fafafa; padding-right: 2rem; padding-top: 2rem">
                
                    <img :src="'https://steemitimages.com/u/' + this.accountData.name + '/avatar'" width="150" height="150" style="border-radius: 50%; border: 8px solid #fafafa" />
                
                    <a class="steemwp-button no-border" style="margin-top: 2rem" href="#"> @{{this.accountData.name}} ({{this.accountData.reputation}})</a>
                
                </div>
            
                <div class="three columns steemwp-columns" style="margin-top: 2rem; text-align: left;">
            
                    <apexchart type="radialBar" height="300" :options="vpChartOptions" :series="vpChartSeries"></apexchart>
            
                </div>
                
                <div class="three columns steemwp-columns" style="margin-top: 2rem; text-align: left;">
            
                    <apexchart type="radialBar" height="300" :options="manaChartOptions" :series="manaChartSeries"></apexchart>
            
                </div>
                
                <div class="three columns steemwp-columns" style="margin-top: 2rem; text-align: left;">
            
                    <apexchart type="radialBar" height="300" :options="spChartOptions" :series="spChartSeries"></apexchart>
            
                </div>
                
            </div>
                
            <div class="row steemwp-row">
            
                <div class="four columns steemwp-columns" style="text-align: center; padding-top: 2rem">
                
                    <div class="steemwp-card fluid">
                        <div class="header">
                            {{this.formatNumber(this.accountData.currentMana)}}
                        </div>
                        <div class="footer">
                            Available Mana
                        </div>
                    </div>
            
                    <div class="steemwp-card fluid">
                        <div class="header">
                            {{this.formatNumber(this.accountData.maxMana)}}
                        </div>
                        <div class="footer">
                            Max Mana
                        </div>
                    </div>
            
                </div>
        
                <div class="four columns steemwp-columns" style="text-align: center; padding-top: 2rem">
                
                    <div class="steemwp-card fluid">
                        <div class="header">
                            {{this.formatNumber(this.accountData.steemPower.toLocaleString())}}
                        </div>
                        <div class="footer">
                            Steem Power
                        </div>
                    </div>
            
                    <div class="steemwp-card fluid">
                        <div class="header">
                            {{this.formatNumber(this.accountData.delegatedSteemPower.toLocaleString())}}
                        </div>
                        <div class="footer">
                            Delegated Steem Power
                        </div>
                    </div>
            
                </div>
        
                <div class="four columns steemwp-columns" style="text-align: center; padding-top: 2rem">
                
                    <div class="steemwp-card fluid">
                        <div class="header">
                            {{this.formatNumber(this.accountData.steem)}}
                        </div>
                        <div class="footer">
                            Steem Balance
                        </div>
                    </div>
            
                    <div class="steemwp-card fluid">
                        <div class="header">
                            {{this.formatNumber(this.accountData.sbd)}}
                        </div>
                        <div class="footer">
                            Steem Dollars
                        </div>
                    </div>
            
                </div>
        
            </div>
                
            <div class="row steemwp-row">
            
                <div class="four columns steemwp-columns" style="text-align: center; padding-top: 2rem">
                
                </div>
        
                <div class="four columns steemwp-columns" style="text-align: center; padding-top: 2rem">
                
                </div>
        
                <div class="four columns steemwp-columns" style="text-align: center; padding-top: 2rem">
                
                </div>
        
            </div>
            
            <div class="steemwp-row row" style="padding-top: 4rem">
                
                <div class="four columns steemwp-columns" style="text-align: center; padding-top: 2rem">
                
                    <apexchart type="radialBar" height="300" :options="quoteChartOptions" :series="quoteChartSeries"></apexchart>
                
                </div>
            
                <div class="eight columns steemwp-columns" style="text-align: center; padding-top: 2rem">
                
                    <apexchart type="area" :options="feedChartOptions" :series="feedChartSeries"></apexchart>
                
                </div>
            
            </div>
    
        </div>
        
        <div v-else class="steemwp-loader"></div>
    
    </div>
  `
});