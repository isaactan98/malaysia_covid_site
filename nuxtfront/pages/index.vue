<template>
  <div class="page">
    <div class="header-page">
      <div class="header__content">
        <div class="head-title">COVIDSTAT in Malaysia</div>
        <p>
          The unofficial Malaysia government website for data and insights on
          COVID-19.
        </p>
        <p class="last-update" v-if="$fetchState.pending">Loading....</p>
        <p class="last-update" v-else>
          Last Update: {{ dataset[dataset.length - 1].date }}
          <span>
            <vs-button @click="refresh" color="dark" transparent>
              <i class="fa">&#xf021;</i>
            </vs-button>
          </span>
        </p>
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
  activated() {
    // Call fetch again if last fetch more than 30 sec ago
    if (this.$fetchState.timestamp <= Date.now() - 30000) {
      this.$fetch();
    }
  },
  methods: {
    refresh() {
      this.$fetch();
      window.location.reload(true);
    },
  },
  async fetch() {
    this.dataset = await fetch(
      "https://malaysia-covid-stat.herokuapp.com/api/cases"
    ).then((res) => res.json());
  },
  fetchOnServer: false,
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
.last-update {
  font-size: 0.875rem;
  line-height: 1.25rem;
}
span > button {
  padding: 1px;
  border-width: 1px;
  border-radius: 0.25rem;
  line-height: inherit;
  color: inherit;
  border: rgba(209, 213, 219);
  display: inline-block !important;
}
span > button > i {
  display: block;
  font-size: 18px;
  color: #5f6368;
}
</style>