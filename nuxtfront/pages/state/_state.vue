<template>
  <main>
    <div class="header-page">
      <div class="">
        <div class="head-title">COVIDSTAT in {{ stateName }}</div>
        <p>
          The unofficial Malaysia government website for data and insights on
          COVID-19.
        </p>
      </div>
    </div>
    <div>
      <div class="main">
        <div class="statechart">
          <div class="statetitle">
            <div>Cases by State</div>
            <div class="last-update" v-if="$fetchState.pending">
              <div class="loading">
                <div class="fake-effect"></div>
              </div>
            </div>
            <div v-else>
              Data as of
              {{
                new Date(statedetails[statedetails.length - 1].date)
                  .toGMTString()
                  .slice(0, 16)
              }}
            </div>
            <h3 class="card-title">COVID-19 Cases Tracker</h3>
          </div>
          <div class="statechartdetails">
            <div class="chartwrap">
              <div class="last-update" v-if="$fetchState.pending">
                <div class="loading">
                  <div class="fake-effect"></div>
                </div>
              </div>
              <div class="flex-column" v-else>
                <div>Daily Cases</div>
                <div>
                  +
                  {{
                    Number(
                      statedetails[statedetails.length - 1].cases_new
                    ).toLocaleString()
                  }}
                </div>
              </div>
              <div class="last-update" v-if="$fetchState.pending">
                <div class="loading">
                  <div class="fake-effect"></div>
                </div>
              </div>
              <div class="chart-height" v-else>
                <state-chart :chart-data="stateChartData" />
                <div class="hidden">{{ getCase }} {{ getDate }}</div>
              </div>
            </div>
          </div>
        </div>
        <div class="goals">
          <div class="statetitle">
            <div>Vaccine by State</div>
            <div class="last-update" v-if="$fetchState.pending">
              <div class="loading">
                <div class="fake-effect"></div>
              </div>
            </div>
            <div v-else>
              Data as of
              {{
                new Date(statedetails[statedetails.length - 1].date)
                  .toGMTString()
                  .slice(0, 16)
              }}
            </div>
            <h3 class="card-title">Vaccine Tracker</h3>
          </div>
          <div class="statechartdetails">
            <div class="chartwrap">
              <div class="last-update" v-if="$fetchState.pending">
                <div class="loading">
                  <div class="fake-effect"></div>
                </div>
              </div>
              <div class="flex-column" v-else>
                <div>Daily Vaccine</div>
                <div>
                  +
                  {{
                    Number(
                      vccDetails[vccDetails.length - 1].daily
                    ).toLocaleString()
                  }}
                </div>
              </div>
              <div class="last-update" v-if="$fetchState.pending">
                <div class="loading">
                  <div class="fake-effect"></div>
                </div>
              </div>
              <div class="chart-height" v-else>
                <state-vcc-chart :chart-data="stateVCC" />
                <div class="hidden">{{ getVDate }}{{ getVcc }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import StateChart from "~/components/StateChart.vue";
import StateVccChart from "~/components/StateVccChart.vue";
export default {
  components: { StateChart, StateVccChart },
  data() {
    return {
      active: "",
      stateName: this.$route.params.state,
      statedetails: [],
      stateCase: [],
      dateCase: [],
      vccDetails: [],
      stateVcc: [],
      vccLabel: [],
    };
  },
  head() {
    return {
      title: this.stateName + " - COVIDSTAT in Malaysia",
    };
  },
  async fetch() {
    this.statedetails = await fetch(
      "https://malaysia-covid-stat.herokuapp.com/api/" +
        this.stateName +
        "/cases"
    ).then((res) => res.json());
    this.vccDetails = await fetch(
      "https://malaysia-covid-stat.herokuapp.com/api/vaccine/" + this.stateName
    ).then((res) => res.json());
  },
  fetchOnServer: false,
  computed: {
    getCase: function () {
      this.stateCase = this.statedetails.map(function (e) {
        return e.cases_new;
      });
      return this.stateCase;
    },
    getDate: function () {
      this.dateCase = this.statedetails.map(function (e) {
        return e.date;
      });
      return this.stateCase;
    },
    stateChartData: function () {
      return {
        labels: this.dateCase,
        datasets: [
          {
            label: "Covid Cases",
            data: this.stateCase,
            backgroundColor: "#ff9b37",
          },
        ],
      };
    },
    getVcc: function () {
      this.stateVcc = this.vccDetails.map(function (e) {
        return e.daily;
      });
      return this.stateVcc;
    },
    getVDate: function () {
      this.vccLabel = this.vccDetails.map(function (e) {
        return e.date;
      });
      return this.vccLabel;
    },
    stateVCC: function () {
      return {
        labels: this.vccLabel,
        datasets: [
          {
            label: "Total Vaccine",
            data: this.stateVcc,
            backgroundColor: "#337958",
          },
        ],
      };
    },
  },
};
</script>

<style>
.hidden {
  display: none;
}
main {
  position: relative;
  z-index: 0;
  padding: 32px 16px;
  max-width: 1104px;
  margin: 5rem auto 0;
  min-height: 400px;
  overflow: auto;
}
.main {
  display: grid;
  grid-template-columns: repeat(12, minmax(0, 1fr));
  gap: 0.5rem;
  width: 100%;
}
.statechart {
  grid-template-rows: auto 1fr;
  padding: 1rem;
  display: grid;
  grid-column: span 6 / span 6;
  position: relative;
  border: 1px solid #dadce0;
  -webkit-border-radius: 8px;
  border-radius: 8px;
}

.goals {
  grid-template-rows: auto 1fr;
  padding: 1rem;
  display: grid;
  grid-column: span 6 / span 6;
  position: relative;
  border: 1px solid #dadce0;
  -webkit-border-radius: 8px;
  border-radius: 8px;
}

.statetitle {
  display: grid;
  margin-bottom: 0.5rem;
  grid-template-columns: 1fr auto;
  gap: 0.125rem;
}

.statetitle > div {
  font-size: 0.875rem;
}
.card-title {
  line-height: 1.5rem;
  color: rgba(31, 41, 55);
  font-weight: 700;
  padding-right: 1rem;
  margin: 1rem 0;
  grid-column: 1/-1;
}

.flex-column {
  display: flex;
  flex-direction: column;
}

.flex-column > div:first-child {
  font-size: 0.875rem;
  line-height: 1.25rem;
  flex: 1 1 0%;
}
.flex-column > div:last-child {
  font-size: 1.5rem;
  line-height: 2rem;
  font-weight: 700;
}

.statechartdetails {
  display: grid;
  margin-top: 0.25rem;
}
.chartwrap {
  gap: 1.5rem;
  display: grid;
}
.chart-height {
  display: grid;
  max-width: 100%;
  padding: 10px;
  margin: auto;
}
@media screen and (max-width: 1000px) {
  .statetitle > div {
    font-size: 0.75rem;
  }
  .statechart {
    padding: 00.5rem !important;
  }
  #bar-chart {
    height: 310px !important;
    width: 310px !important;
  }
}
@media screen and (max-width: 700px) {
  .statetitle > div {
    font-size: 0.75rem;
  }
  .statechart {
    grid-column: span 12 / span 12;
    padding: 00.5rem !important;
  }

  .goals {
    grid-column: span 12 / span 12;
  }

  #bar-chart {
    height: 300px !important;
    width: 300px !important;
  }
}
</style>