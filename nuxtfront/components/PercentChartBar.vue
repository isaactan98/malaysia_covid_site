<script>
import { HorizontalBar, mixins } from "vue-chartjs";
const { reactiveProp } = mixins;

export default {
  extends: HorizontalBar,
  mixins: [reactiveProp],

  mounted() {
    this.renderChart(this.chartData, {
      maintainAspectRatio: false,
      scales: {
        xAxes: [
          {
            stacked: true,
          },
        ],
        yAxes: [
          {
            stacked: true,
            barPercentage: 0.4,
          },
        ],
      },
    });
  },
};
</script>

<style>
</style>