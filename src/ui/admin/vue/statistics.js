Vue.component('apexchart', VueApexCharts)

var client = new dsteem.Client('https://api.steemit.com')

var app = new Vue({
  el: '#app',
  data: function() {
    return {
      
      ready: false,
      
      postsCount: 10,
      postsVotes: 0,
      postsComments: 0,
      
      statisticsData: window._statisticsData,
      account: window._statisticsData.account,
      
      earningOptions: {
          /*
        stroke: {
          width: 1,
          colors: ['#fff']
        },
        */
        chart: {
          stacked: true,
          // id: 'dashboard-chart',
          width: "100%",
          height: 380,
        },
        xaxis: {
          categories: []
        },
        title: {
            text: 'Posting activity to Steem',
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
      earningSeries: [],
      
      engagementSeries: [],
      engagementOptions: {
        plotOptions: {
          bar: {
            horizontal: false,
            endingShape: 'rounded',
            columnWidth: '55%',
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: [],
        },
        yaxis: {
          title: {
            text: 'Count'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val
            }
          }
        }
      },
    }
  },
  async mounted () {
    await this.getData()
    this.ready = true
  },
  methods: {
      
    async getData () {
        
        const filter = 'blog';
        const query = { tag: this.account, limit: this.postsCount};
        const blogPosts = await client.database.getDiscussions(filter, query)
        
        // console.log(blogPosts)
        
        this.postsComments = blogPosts.reduce((prev, cur) => prev + (+cur.children || 0), 0)
        this.postsVotes = blogPosts.reduce((prev, cur) => prev + (+cur.active_votes.length || 0), 0)
        
        this.earningOptions.xaxis.categories = blogPosts.map(post => post.title)
        
        this.earningSeries.push({
            name: 'Earnings',
            data: blogPosts.map(post => +post.total_payout_value.split(' ')[0] || +post.pending_payout_value.split(' ')[0])
        })
        
        this.earningSeries.push({
            name: 'Curation',
            data: blogPosts.map(post => +post.curator_payout_value.split(' ')[0] || 0)
        })
          
        this.engagementOptions.xaxis.categories = blogPosts.map(post => post.title)
      
        this.engagementSeries.push({
          name: 'Post comments',
          data: blogPosts.map(post => post.children)
        })
          
        this.engagementSeries.push({
          name: 'Post votes',
          data: blogPosts.map(post => post.active_votes.length)
        })
         
        this.engagementSeries.push({
          name: 'Post earnings',
          data: blogPosts.map(post => +post.total_payout_value.split(' ')[0] || +post.pending_payout_value.split(' ')[0])
        })
        
    },
  },
  computed: {
  },
  template: `
    <div>
        
        <div v-if="this.ready">

            <div class="row steemwp-row">
            
                <div class="four columns steemwp-columns" style="margin-top: 2rem; text-align: left;">
            
                    <div class="steemwp-card fluid">
                        <div class="header">
                            {{this.postsCount}}
                        </div>
                        <div class="footer">
                            Last posts
                        </div>
                    </div>
            
                </div>
                
                <div class="four columns steemwp-columns" style="margin-top: 2rem; text-align: left;">
            
                    <div class="steemwp-card fluid">
                        <div class="header">
                            {{this.postsVotes}}
                        </div>
                        <div class="footer">
                            Votes
                        </div>
                    </div>
            
                </div>
                
                <div class="four columns steemwp-columns" style="margin-top: 2rem; text-align: left;">
            
                    <div class="steemwp-card fluid">
                        <div class="header">
                            {{this.postsComments}}
                        </div>
                        <div class="footer">
                            Comments
                        </div>
                    </div>
            
                </div>
                
                
                
            </div>
            
            
            <div>
            
                <div style="text-align:center; padding: 4rem">
                    <h6 style="display:inline"> Revenue</h6>
                </div>
                
                
                <div class="steemwp-row row" >
                    
                    <apexchart type="bar" :options="earningOptions" :series="earningSeries"></apexchart>
                
                </div>
                
            </div>
            
            
            
                
            <div>
                
                <div style="text-align:center; padding: 4rem">
                    <h6 style="display:inline"> Engagement</h6>
                </div>
                
                <div>
                    <apexchart type="bar" height="400" :options="engagementOptions" :series="engagementSeries"></apexchart>
                </div>
                
            </div>
            
    
        </div>
        
        <div v-else class="steemwp-loader"></div>
    
        
    </div>
  `
});