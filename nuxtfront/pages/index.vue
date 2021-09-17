<template>
  <main class="page">
    <header class="header-page">
      <div class="header__content" id="padding-scroll-content">
        <h1 id="header-title">COVIDSTAT in Malaysia</h1>
        <p>
          The unofficial Malaysia government website for data and insights on
          COVID-19.
        </p>
        <p>Last Update: {{ dataset[dataset.length - 1].date }}</p>
      </div>
    </header>
    <IndContent />
    <IndStates />
  </main>
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
    this.dataset = await fetch("http://127.0.0.1:8000/api/cases").then((res) =>
      res.json()
    );
  },
};
</script>

<style>
@media screen and (max-width: 600px) {
  .header__content {
    height: auto !important;
  }
  .page {
    padding-top: 50px !important;
  }
  .header-page {
    position: relative !important;
  }
}
</style>