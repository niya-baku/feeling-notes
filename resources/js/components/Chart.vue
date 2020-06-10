<script>
import { OK } from '../util'
import { Line, mixins  } from 'vue-chartjs';
const { reactiveProp } = mixins;
export default {
  extends: Line ,
  mixins: [reactiveProp],
  props: ["chartData","options"],
  mounted () {
    this.renderChart(this.chartData, this.options);
  },
  watch: {
    options () {
      this.$data._chart.destroy();
      this.renderChart(this.chartData, this.options);
    },
    chartData () {
      this.$data._chart.destroy();
      this.renderChart(this.chartData, this.options);
    }
  }
}
</script>