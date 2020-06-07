<template>
  <div class="photo-list">
    <div class="chart">
      <Chart 
        class="chart__item"
        :chart-data="chartData"
        :options="options"
      />
    </div>
  </div>
</template>

<script>
import { OK } from '../util'
import Chart from '../components/Chart.vue'

export default {
  components: {
    Chart
  },
  data(){
    return{
      charts: [],
      chartData: null,
      options: null,
      chartrecord: [],
      chartsum: []
    }
  },
  methods: {
    async fetchCharts() {

        //ローカル環境用
        const response = await axios.get(`api/chart`)
        
        if (response.status !== OK) {
          this.$store.commit('error/setCode', response.status)
          return false
        }

        this.charts = response.data

        //console.log(this.charts)
        //console.log(this.data.datasets[0].data)
        for(let i = 0; i < this.charts.length; i++){
            //this.data.labels[i] = this.charts[i].record
            this.$set(this.chartrecord, i, this.charts[i].record )
            //this.data.datasets[0].data[i] = this.charts[i].am_image + this.charts[i].pm_image + this.charts[i].night_image
            this.$set(this.chartsum, i, this.charts[i].am_image + this.charts[i].pm_image + this.charts[i].night_image)
            //console.log(this.data.datasets[0].data) 
        }
        console.log(this.chartrecord)
        console.log(this.chartsum)
        this.chartData = {
          labels: this.chartrecord,
            datasets: [
              {
                label: '調子の波',
                data: this.chartsum,
                borderColor: '#66CCFF',
                fill: false,
                type: 'line',
                lineTension: 0.3,
              }
            ]
        },
        this.options = {
          
            scales: {
              xAxes: [{
                scaleLabel: {
                  display: true,
                  labelString: 'day'
                }
              }],
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                  stepSize: 10,
                }
              }]
            }
        }
    }
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchCharts()
      },
      immediate: true
    }
  },
}
</script>
