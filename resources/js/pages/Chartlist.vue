<template>
  <div class="photo-list">
    <div class="errors" v-if="errors">
      <ul v-if="errors.year">
        <li v-for="msg in errors.year" :key="msg">{{ msg }}</li>
      </ul>
      <ul v-if="errors.month">
        <li v-for="msg in errors.month" :key="msg">{{ msg }}</li>
      </ul>
    </div>
    <div v-else>
      <h2 class="border">検索したい「年(4桁)」「月(2桁)」を入力してください</h2>
    </div>
    <div class="chart">
      <form class="form_chart" @submit.prevent="onSubmit">
        <input type="text"  name="year" class="year_title" v-model="year" >
        <h3 class="year_letter">年</h3>
        <input type="text"  name="month" class="month_title" v-model="month" >
        <h3 class="month_letter">月</h3>
        <div class="submit_button_chart">
          <button type="submit" class="chart_isplay" >表示する</button>
        </div>
      </form>
      <Chart 
        v-if="show_chart"
        class="chart__item"
        :chart-data="chartData"
        :options="options"
      />
    </div>
  </div>
</template>

<script>
import { OK ,UNPROCESSABLE_ENTITY} from '../util'
import Chart from '../components/Chart.vue'

export default {
  components: {
    Chart
  },
  data(){
    return{
      year: '',
      month: '',
      charts: [],
      chartData: null,
      options: null,
      chartrecord: [],
      chartsum: [],
      show_chart: false,
      errors: null
    }
  },
  methods: {
    async onSubmit() {

        var params = {
            year: this.year,
            month: this.month,
        };
        const response = await axios.post('api/chart', params)
  
        if (response.status === UNPROCESSABLE_ENTITY) {
          this.errors = response.data.errors
          return false
        }


        if (response.status !== OK) {
          this.$store.commit('error/setCode', response.status)
          return false
        }else{
          this.errors = null
        }

        if(this.charts.length > 0) {
            this.chartData = null
            this.charts.splice(0, this.charts.length)
            this.chartsum.splice(0, this.chartsum.length)
            this.chartrecord.splice(0, this.chartrecord.length)
            this.charts = response.data
            console.log("配列が入っていたのでリセットしました")
            console.log(this.charts)
          }else{
            this.charts = response.data
            console.log("配列が空なので、新しく設置しました")
            console.log(this.charts)
          }

        for(let i = 0; i < this.charts.length; i++){
            //this.data.labels[i] = this.charts[i].record
            this.$set(this.chartrecord, i, this.charts[i].record )
            //this.data.datasets[0].data[i] = this.charts[i].am_image + this.charts[i].pm_image + this.charts[i].night_image
            this.$set(this.chartsum, i, this.charts[i].am_image + this.charts[i].pm_image + this.charts[i].night_image)
            //console.log(this.data.datasets[0].data) 
        }
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
        },
        this.show_chart = true
        
    }
    /*async fetchCharts() {

        //ローカル環境用
        const response = await axios.post(`api/chart`)
        
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
    }*/
  },
  /*watch: {
    $route: {
      async handler () {
        await this.fetchCharts()
      },
      immediate: true
    }
  },*/
}
</script>
