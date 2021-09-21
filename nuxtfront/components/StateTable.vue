<template>
  <div class="state-table" keep-alive>
    <h3>States</h3>
    <div class="state-content">
      <div class="table-wrap">
        <div class="last-update" v-if="$fetchState.pending">
          <div class="loading">
            <div class="fake-effect"></div>
          </div>
        </div>
        <table v-else>
          <thead>
            <tr>
              <td>State</td>
              <td>New Cases</td>
              <td>Imported</td>
              <td>Recovered</td>
              <td>Death</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(states, index) in dataset1" :key="index">
              <td>
                <div class="statename">
                  <img
                    :src="
                      'https://malaysia-covid-stat.herokuapp.com/api/' +
                      states.state +
                      '/flag'
                    "
                  />
                  {{ states.state }}
                </div>
              </td>
              <td>{{ states.cases_new }}</td>
              <td>{{ states.cases_import }}</td>
              <td>{{ states.cases_recovered }}</td>
              <td>{{ death1[index].deaths_new }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="state-foot">
        <div>
          *The number of new cases reported for the most recent day of complete
          data, within the last 24 hours.
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    dataset: [],
    dataset1: [],
    death1: [],
  }),
  methods: {
    handleClick() {},
    refresh() {
      this.$fetch();
    },
  },
  activated() {
    // Call fetch again if last fetch more than 30 sec ago
    if (this.$fetchState.timestamp <= Date.now() - 30000) {
      this.$fetch();
    }
  },
  async fetch() {
    this.dataset = await fetch(
      "https://malaysia-covid-stat.herokuapp.com/api/cases"
    ).then((res) => res.json());

    this.dataset1 = await fetch(
      "https://malaysia-covid-stat.herokuapp.com/api/state/" +
        this.dataset[this.dataset.length - 1].date
    ).then((res) => res.json());

    this.death1 = await fetch(
      "https://malaysia-covid-stat.herokuapp.com/api/death/state/" +
        this.dataset[this.dataset.length - 1].date
    ).then((res) => res.json());
  },
  fetchOnServer: false,
};
</script>

<style>
.state-table {
  padding: 16px;
  border: 1px solid #dadce0;
  -webkit-border-radius: 8px;
  border-radius: 8px;
  margin-bottom: 32px;
  background: #ffffff;
}
.state-content {
  display: -webkit-box;
  display: -webkit-flex;
  display: flex;
  -webkit-box-orient: vertical;
  box-orient: vertical;
  -webkit-flex-direction: column;
  flex-direction: column;
}
.table-wrap {
  overflow: auto;
  padding-right: 12px;
  max-height: 480px;
}
.table-wrap > table {
  width: 100%;
  border-collapse: collapse;
  font-family: "Roboto", sans-serif;
}
thead > tr {
  border-bottom: 1px solid #e8eaed;
  position: relative;
  margin-right: 16px;
}
thead > tr > td:first-child {
  text-align: left;
  min-width: 175px;
  padding-left: 0;
  padding: 0 8px 12px 8px;
  font-weight: 400;
  background-color: #ffffff;
  color: #70757a;
  font-size: 12px;
  position: -webkit-sticky;
  position: sticky;
  top: 0;
  z-index: 1;
}
thead > tr > td {
  padding: 0 8px 12px 8px;
  text-align: right;
  font-weight: 400;
  background-color: #ffffff;
  color: #70757a;
  font-size: 12px;
  position: -webkit-sticky;
  position: sticky;
  top: 0;
  z-index: 1;
  width: 94px;
}
tbody > tr {
  border-bottom: 1px solid #e8eaed;
  position: relative;
  margin-right: 16px;
}
tbody > tr > td:first-child {
  text-align: left;
  min-width: 175px;
  padding-left: 0;
  font-weight: 700;
  font-size: 14px;
  padding: 12px 8px;
}
tbody > tr > td {
  padding: 12px 8px;
  text-align: right;
  font-size: 14px;
  font-weight: 700;
}

.statename {
  display: flex;
}

.statename > img {
  height: 11px;
  width: 16px;
  margin-right: 12px;
  margin-top: auto;
  margin-bottom: auto;
}

.state-foot {
  padding-top: 16px;
  line-height: 1.33;
}
.state-foot > div {
  font-size: 0.75rem;
  color: #5f6368;
  margin-bottom: 12px;
}
</style>