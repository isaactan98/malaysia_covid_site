<template>
  <div>
    <NavHead />
    <keep-alive>
      <Nuxt />
    </keep-alive>
    <FootVue />
  </div>
</template>

<script>
import Vue from "vue";
import Vuesax from "vuesax";

import "vuesax/dist/vuesax.css"; //Vuesax styles
Vue.use(Vuesax, {
  // options here
});

import NavHead from "~/components/NavHead.vue";
import FootVue from "~/components/FootVue.vue";
export default {
  head() {
    return {
      link: [
        {
          rel: "preconnect",
          href: "https://fonts.googleapis.com",
        },
        {
          rel: "stylesheet",
          href: "https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto&family=Open+Sans&display=swap",
        },
        {
          rel: "stylesheet",
          href: "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css",
        },
      ],
    };
  },
  components: {
    NavHead,
    FootVue,
  },
  data: () => ({
    active: "docs",
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
      window.location.reload;
    },
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
    this.newfeed = await fetch(
      "https://v1.nocodeapi.com/tyhisaac2/xml_to_json/RKCIAmhpuTcOwyrP?url=https://www.thestar.com.my/rss/News"
    ).then((res) => res.json());
  },
  fetchOnServer: false,
};
</script>

<style>
* {
  font-family: "Montserrat", sans-serif;
}
</style>