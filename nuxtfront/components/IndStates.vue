<template>
  <div class="content__default">
    <div class="last-update" v-if="$fetchState.pending">
      <div class="loading">
        <div class="fake-effect"></div>
      </div>
    </div>
    <div class="card" v-else>
      <div class="example">
        <div>
          <vs-card-group>
            <vs-card
              v-for="(state, index) in dataset1"
              :key="index"
              @click="handleClick"
            >
              <template #title>
                <h3>{{ state.state }}</h3>
              </template>
              <template #img>
                <img
                  :src="
                    'https://malaysia-covid-stat.herokuapp.com/api/' +
                    state.state +
                    '/flag'
                  "
                />
              </template>
              <template #text>
                <p>Cases: {{ state.cases_new }}</p>
              </template>
            </vs-card>
          </vs-card-group>
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
  }),
  methods: {
    handleClick() {},
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
  },
  fetchOnServer: false,
};
</script>

<style>
.slider {
  overflow-x: auto;
  display: flex;
  flex-wrap: nowrap;
}
</style>