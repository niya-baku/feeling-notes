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
      <h3 class="border_chart">検索したい「年(4桁)」「月(2桁)」を入力してください</h3>
    </div>
    <div class="chart">
      <form class="form_chart" @submit.prevent="onSubmit">
        <input type="text"  name="year" class="year_title" v-model="year" >
        <h3 class="year_letter">年</h3>
        <input type="text"  name="month" class="month_title" v-model="month" >
        <h3 class="month_letter">月</h3>
        <div class="submit_button_chart">
          <button type="submit" class="chart_display" >表示する</button>
        </div>
      </form>
       <p  class="chart_p" v-if="show_chart">午前・午後・夜の体調を5段階で評価しています。</p>
      <div class="display" v-if="show_chart">
        <div v-for="(icon,icon_id) in icons_image" :key="icon_id" class="image-chart">
          <label>
            {{icon_id}}
            <img :src="icon">
          </label>
        </div>
      </div>
      <Chart
        v-if="show_chart"
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
      show_chart: true,
      errors: null,
      icons_image: {
        1: '/images/absolute_upset_nimi.png',
        2: '/images/upset_nimi.png',
        3: '/images/usually_nimi.png',
        4: '/images/smile_nimi.png',
        5: '/images/nice_smile_nimi.png'
      }
    }
  },
  async mounted() {
        var params = {
            year: this.year,
            month: this.month,
        };
        const response = await axios.get('api/chart', params)
        console.log(response)
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

          }else{
            this.charts = response.data
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
          responsive: true,
          maintainAspectRatio: false,
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
                  stepSize: 3,
                  min: 3,
                  max: 15
                }
              }]
            }
        }
        //this.show_chart = true
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

          }else{
            this.charts = response.data
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
          responsive: true,
          maintainAspectRatio: false,
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
                  stepSize: 3,
                  min: 3,
                  max: 15
                }
              }]
            }
        }
        //this.show_chart = true
    }
  }
}
</script>
