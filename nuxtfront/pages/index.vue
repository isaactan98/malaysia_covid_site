<template>
  <div class="page">
    <div class="header-page">
      <div class="header__content">
        <div class="head-title">COVIDSTAT in Malaysia</div>
        <p>
          The unofficial Malaysia government website for data and insights on
          COVID-19.
        </p>
        <p>Last Update: {{ dataset[dataset.length - 1].date }}</p>
      </div>
    </div>
    <IndContent />
    <IndStates />
  </div>
</template>

<script>
import IndContent from "~/components/IndContent.vue";
import IndStates from "~/components/IndStates.vue";
export default {
  components: { IndContent, IndStates },
  data: () => ({
    active: "docs",
    dataset: [],
  }),
  async fetch() {
    this.dataset = await fetch(
      "https://malaysia-covid-stat.herokuapp.com/api/cases"
    ).then((res) => res.json());
  },
};
</script>

<style>
.page {
  position: relative;
  z-index: 0;
  padding: 32px 16px;
  max-width: 1104px;
  margin: auto;
  min-height: 400px;
  overflow: auto;
}
.header-page {
  display: grid;
  margin-bottom: 0.5rem;
  grid-column: 1/-1;
  grid-template-columns: 1fr auto;
  align-items: flex-end;
}
.header__content {
  margin-top: 5rem;
}
.head-title {
  font-weight: 700;
  font-size: 1.5rem;
  line-height: 1.5rem;
}
</style>