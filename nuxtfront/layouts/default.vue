<template>
  <div>
    <NavHead />
    <Nuxt />
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
};
</script>

<style>
* {
  font-family: "Montserrat", sans-serif;
}
</style>