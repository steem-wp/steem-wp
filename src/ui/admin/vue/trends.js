Vue.component('apexchart', VueApexCharts)

var client = new dsteem.Client('https://api.steemit.com')

var app = new Vue({
  el: '#app',
  data: function() {
    return {
      ready: false,
      niche: undefined,
      chartSeries: [],
      chartOptions: {
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
      }
    }
  },
  async mounted () {
    await this.getData()
    this.ready = true
  },
  methods: {
    async getData () {
        
      const tagsData = await client.database.call('get_trending_tags', [this.niche, 10])
      
      this.chartOptions.xaxis.categories = tagsData.map(tag => tag.name)
      
      let chartSeries = []
      
      chartSeries.push({
        name: 'Top posts',
        data: tagsData.map(tag => tag.top_posts)
      })
      
      chartSeries.push({
        name: 'Comments',
        data: tagsData.map(tag => tag.comments)
      })
      
      chartSeries.push({
        name: '$ Earnings',
        data: tagsData.map(tag => +tag.total_payouts.split(' ')[0])
      })
      
      this.$refs.trendsChart.updateSeries(chartSeries)
      this.$refs.trendsChart.updateOptions(this.chartOptions)
    },
  },
  computed: {
  },
  template: `
    <div>
        
        <div >
        
            <div class="row steemwp-row">
            
                <div class="six columns steemwp-columns" style="text-align: center; padding-top: 2rem">
                    
                </div>
            
                <div class="six columns steemwp-columns" style="margin-top: 2rem; text-align: right;">
                
                    <input class="steemwp-input" type="text" v-model="niche" placeholder="Enter niche" id="">
                    <button class="steemwp-button" v-on:click="getData()"> Load</button>
                
                </div>
                
            </div>
            
            <div>
            
                    <apexchart type="bar" height="400" ref="trendsChart" :options="chartOptions" :series="chartSeries"></apexchart>
            
            </div>
            
            
    
        </div>
        
        <div v-if="!ready" class="steemwp-loader"></div>
    
        
    </div>
  `
});