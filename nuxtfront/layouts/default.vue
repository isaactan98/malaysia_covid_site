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
    active: "guide",
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
  fetchOnServer: false,
};
</script>

<style>
* {
  font-family: "Montserrat", sans-serif;
}
/* Loading animation */
.loading {
  position: relative;
  background: #f6f7f8 no-repeat 80px 10px;
  background-size: 100%;
  background-image: -webkit-gradient(
    linear,
    0% 50%,
    100% 50%,
    color-stop(0%, #f6f7f8),
    color-stop(20%, #edeef1),
    color-stop(40%, #f6f7f8),
    color-stop(100%, #f6f7f8)
  );
  background-image: -moz-linear-gradient(
    left,
    #f6f7f8 0%,
    #edeef1 20%,
    #f6f7f8 40%,
    #f6f7f8 100%
  );
  background-image: -webkit-linear-gradient(
    left,
    #f6f7f8 0%,
    #edeef1 20%,
    #f6f7f8 40%,
    #f6f7f8 100%
  );
  background-image: linear-gradient(
    to right,
    #f6f7f8 0%,
    #edeef1 20%,
    #f6f7f8 40%,
    #f6f7f8 100%
  );
  height: 30px;
  width: 80%;
  border-radius: 10px;
  -moz-animation: anim 1s forwards infinite linear;
  -webkit-animation: anim 1s forwards infinite linear;
  animation: anim 1s forwards infinite linear;
}
.fake-effect {
  position: absolute;
  background: #fff;
  right: 0;
  left: 0;
  height: 6px;
}
@keyframes anim {
  0% {
    background-position: -468px 0;
  }
  100% {
    background-position: 468px 0;
  }
}
@-o-keyframes anim {
  0% {
    background-position: -468px 0;
  }
  100% {
    background-position: 468px 0;
  }
}
@-ms-keyframes anim {
  0% {
    background-position: -468px 0;
  }
  100% {
    background-position: 468px 0;
  }
}
@-moz-keyframes anim {
  0% {
    background-position: -468px 0;
  }
  100% {
    background-position: 468px 0;
  }
}
@-webkit-keyframes anim {
  0% {
    background-position: -468px 0;
  }
  100% {
    background-position: 468px 0;
  }
}
</style>