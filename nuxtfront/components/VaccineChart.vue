<template>
  <div class="main-content">
    <div class="vacc-title">
      <div class="vaccination">Vaccinations</div>
      <span v-if="$fetchState.pending"></span>
      <div class="date-vacc" v-else>
        Data as of {{ vaccine[vaccine.length - 1].date }}, 11:59 pm
      </div>
      <h3 class="ppl-vcc">Population Vaccinated</h3>
    </div>

    <div class="vacc-details">
      <!-- left -->
      <div class="" v-if="$fetchState.pending">
        <div class="loading">
          <div class="fake-effect"></div>
        </div>
      </div>
      <div class="left-vacc" v-else>
        <div class="dose-given">
          <div>Today Total Dose</div>
          <div>
            {{ Number(vaccine[vaccine.length - 1].daily).toLocaleString() }}
          </div>
        </div>
        <div class="dose-given">
          <div>Total Dose Given</div>
          <div>{{ totalvacc.toLocaleString() }}</div>
        </div>
        <div class="dose-given">
          <div>Today Fully Vacc</div>
          <div>
            {{
            Number(vaccine[vaccine.length - 1].daily_full).toLocaleString()
            }}
          </div>
        </div>
        <div class="dose-given">
          <div>Total Fully Vacc</div>
          <div>{{ fullyvac.toLocaleString() }}</div>
        </div>
        <div class="dose-given">
          <div>Today Partially Vacc</div>
          <div>
            {{
            Number(vaccine[vaccine.length - 1].daily_partial).toLocaleString()
            }}
          </div>
        </div>
        <div class="dose-given">
          <div>Total Partially Vacc</div>
          <div>{{ parTotal.toLocaleString() }}</div>
        </div>
      </div>
      <!-- right -->
      <div class="right-vacc">
        <div class="" v-if="$fetchState.pending">
          <div class="loading">
            <div class="fake-effect"></div>
          </div>
        </div>
        <div v-else>
          <!-- chart -->
          <chart-file :chart-data="setchart" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ChartFile from "./ChartFile.vue";
export default {
  components: { ChartFile },
  data: () => ({
    vaccine: [],
    datacollection: null,
    calTotal: 0,
    partTotal: 0,
    loaded: false,
  }),
  async fetch() {
    this.vaccine = await fetch(
      "https://malaysiacovidsite.up.railway.app/api/vaccine/all"
    ).then((res) => res.json());
  },
  fetchOnServer: false,
  computed: {
    totalvacc: function () {
      return this.vaccine.map((el) => +el.daily).reduce((e, f) => e + f);
    },
    fullyvac: function () {
      this.calTotal =
        (this.vaccine.map((el) => +el.daily_full).reduce((e, f) => e + f) /
          32657400) *
        100;
      return this.vaccine.map((el) => +el.daily_full).reduce((e, f) => e + f);
    },
    parTotal: function () {
      this.partTotal =
        (this.vaccine.map((el) => +el.daily_partial).reduce((e, f) => e + f) /
          32657400) *
        100;
      return this.vaccine
        .map((el) => +el.daily_partial)
        .reduce((e, f) => e + f);
    },
    setchart: function () {
      this.datacollection = {
        labels: ["Fully Vaccinated", "1 Dose", "Unvaccinated"],
        datasets: [
          {
            label: "",
            data: [
              this.calTotal.toFixed(2),
              this.partTotal.toFixed(2),
              (100 - this.partTotal).toFixed(2),
            ],
            backgroundColor: ["#337958", "#60d49a", "#e5e7eb"],
          },
        ],
      };
      return this.datacollection;
    },
  },
};
</script>

<style>
.vacc-title {
  gap: 0.125rem;
  grid-template-columns: 1fr auto;
  display: grid;
  margin-bottom: 1rem;
}

.vaccination {
  color: rgba(107, 114, 128);
  letter-spacing: -0.05em;
  line-height: 0.75rem;
  font-weight: 500;
  font-size: 0.875rem;
  grid-column: span 1 / span 1;
}

.date-vacc {
  color: rgba(107, 114, 128);
  letter-spacing: -0.05em;
  line-height: 0.75rem;
  text-align: right;
  font-size: 0.75rem;
  grid-column: span 1 / span 1;
}

.ppl-vcc {
  line-height: 1.5rem;
  color: rgba(31, 41, 55);
  font-weight: 700;
  padding-right: 1rem;
  margin: 1rem 0;
  grid-column: 1/-1;
}

.vacc-details {
  display: grid;
  margin-top: 0.25rem;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 1.5rem;
}

.left-vacc {
  margin-top: auto;
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 0.75rem;
  row-gap: 1.5rem;
}

.right-vacc {
  gap: 0.75rem;
  align-items: flex-end;
  grid-template-columns: 1fr auto;
  display: grid;
  margin-left: auto;
  margin-top: auto;
}

.dose-given {
  gap: 0.25rem;
  display: grid;
}

.dose-given>div:first-child {
  color: rgba(31, 41, 55);
  line-height: 1rem;
  font-size: 0.875rem;
}

.dose-given>div:last-child {
  outline: 0;
  align-self: flex-end;
  position: relative;
  font-weight: 700;
  font-size: 1.5rem;
  line-height: 2rem;
  letter-spacing: 0.1rem;
}

#pie-chart {
  width: 210px !important;
  height: 210px !important;
}

@media screen and (max-width: 700px) {
  .left-vacc {
    grid-column: span 12;
  }

  .right-vacc {
    grid-column: span 12;
    margin: auto;
  }
}

@media screen and (max-width: 1000px) {
  .dose-given>div:first-child {
    font-size: 0.775rem;
  }

  .dose-given>div:last-child {
    font-size: 1rem;
  }
}
</style>