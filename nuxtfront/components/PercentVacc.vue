<template>
  <div class="main-content">
    <div class="percent-title">
      <div class="p-title">Vaccination Progress</div>
      <h3 class="p-text">Current Progress of Vaccination</h3>
    </div>

    <div class="percentage-bar">
      <div class="bar-wrap">
        <!-- Text -->
        <div class="" v-if="$fetchState.pending">
          <div class="loading">
            <div class="fake-effect"></div>
          </div>
        </div>
        <div class="per-txt" v-else>
          <div>
            <div>At Least 1 Dose</div>
            <span>{{ Number(oneDoseP).toFixed(1) }}%</span>
          </div>
          <div>
            <div>Fully Vaccinated</div>
            <span>{{ Number(fullDoseP).toFixed(1) }}%</span>
          </div>
        </div>
        <!-- Bar -->
        <div class="" v-if="$fetchState.pending">
          <div class="loading">
            <div class="fake-effect"></div>
          </div>
        </div>
        <div class="per-bar" v-else>
          <percent-chart-bar :chart-data="percentChart" :height="180" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PercentChartBar from "./PercentChartBar.vue";
export default {
  components: {
    PercentChartBar,
  },
  data: () => ({
    vaccine: [],
    oneDose: [],
    fullDose: [],
    totalpart: 0,
    totalfull: 0,
    childpart: 0,
    childfull: 0,
  }),
  async fetch() {
    this.vaccine = await fetch(
      "https://malaysia-covid-stat.herokuapp.com/api/vaccine/all"
    ).then((res) => res.json());
  },
  computed: {
    oneDoseP: function () {
      this.totalpart = this.vaccine
        .map((el) => +el.daily_partial)
        .reduce((e, f) => e + f);
      this.childpart = this.vaccine
        .map((el) => +el.daily_partial_child)
        .reduce((e, f) => e + f);
      this.oneDose = ((this.totalpart - this.childpart) / 23409600) * 100;
      return this.oneDose;
    },
    fullDoseP: function () {
      this.totalfull = this.vaccine
        .map((el) => +el.daily_full)
        .reduce((e, f) => e + f);
      this.childfull = this.vaccine
        .map((el) => +el.daily_full_child)
        .reduce((e, f) => e + f);
      this.fullDose = ((this.totalfull - this.childfull) / 23409600) * 100;
      return this.fullDose;
    },
    percentChart: function () {
      return {
        datasets: [
          {
            label: ["Fully Vaccinated"],
            data: [this.fullDose.toFixed(1)],
            backgroundColor: ["#337958"],
          },
          {
            label: ["Partially Vaccinated"],
            data: [(this.oneDose - this.fullDose).toFixed(1)],
            backgroundColor: ["#60d49a"],
          },
          {
            label: ["Unvaccinated"],
            data: [(100 - this.oneDose).toFixed(1)],
            backgroundColor: ["#e5e7eb"],
          },
        ],
      };
    },
  },
};
</script>

<style>
.percent-title {
  gap: 0.125rem;
  grid-template-columns: 1fr auto;
  display: grid;
  margin-bottom: 1rem;
}
.p-title {
  color: rgba(107, 114, 128);
  letter-spacing: -0.05em;
  line-height: 0.75rem;
  font-weight: 500;
  font-size: 0.875rem;
  grid-column: span 1 / span 1;
}
.p-date {
  color: rgba(107, 114, 128);
  letter-spacing: -0.05em;
  line-height: 0.75rem;
  text-align: right;
  font-size: 0.75rem;
  grid-column: span 1 / span 1;
}
.p-text {
  line-height: 1.5rem;
  color: rgba(31, 41, 55);
  font-weight: 700;
  padding-right: 1rem;
  margin: 1rem 0;
  grid-column: 1/-1;
}
.percentage-bar {
  display: grid;
}
.bar-wrap {
  display: grid;
  overflow-x: hidden;
  margin-bottom: auto;
}
.per-txt {
  display: grid;
  text-align: center;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 1rem;
}
.per-bar {
  position: relative;
  display: flex;
  font-size: 0.875rem;
  line-height: 1.25rem;
  font-weight: 600;
  margin: 1rem auto 1rem;
}

.per-txt > div:first-child {
  grid-column-start: 2;
  padding-top: 1rem;
  padding-bottom: 1.5rem;
  gap: 0.25rem;
  display: grid;
}

.per-txt > div:last-child {
  grid-column-start: 3;
  padding-top: 1rem;
  padding-bottom: 1.5rem;
  gap: 0.25rem;
  display: grid;
}

.per-txt > div > div {
  font-size: 0.875rem;
  line-height: 1.25rem;
  color: rgba(31, 41, 55);
}
.per-txt > div > span {
  font-size: 1.25rem;
  line-height: 1.75rem;
  font-weight: 700;
}

@media screen and (max-width: 700px) {
  .per-txt > div > div {
    font-size: 0.75rem;
  }
  .per-txt > div > span {
    font-size: 1rem;
  }
  #horizontalbar-chart {
    height: 300px !important;
    width: 300px !important;
  }
}
@media screen and (max-width: 1000px) {
  .per-txt > div > div {
    font-size: 0.8rem;
  }
  .per-txt > div > span {
    font-size: 1rem;
  }
}
</style>