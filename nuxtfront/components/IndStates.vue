<template>
  <div class="content__default">
    <div class="card">
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
                  src="https://covidnow.moh.gov.my/_nuxt/img/jata.5baa949.png"
                  alt=""
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
    dateState: [],
  }),
  methods: {
    handleClick() {},
  },
  async fetch() {
    this.dataset = await fetch("https://malaysia-covid-stat.herokuapp.com/api/cases").then((res) =>
      res.json()
    );
    this.dataset1 = await fetch(
      "https://malaysia-covid-stat.herokuapp.com/api/state/" +
        this.dataset[this.dataset.length - 1].date
    ).then((res) => res.json());
  },
};
</script>

<style>
.slider {
  overflow-x: auto;
  display: flex;
  flex-wrap: nowrap;
}
</style>