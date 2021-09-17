<template>
  <div class="center">
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
          rel: "stylesheet",
          href: "https://vuesax.com/assets/css/0.styles.9c3c9a79.css",
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
</style>