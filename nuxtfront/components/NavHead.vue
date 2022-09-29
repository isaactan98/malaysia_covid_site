<template>
  <header>
    <vs-navbar
      shadow-scroll
      fixed
      padding-scroll
      right-collapsed
      v-model="active"
    >
      <template #left>
        <vs-button @click="activeSidebar = !activeSidebar" shadow icon>
          <img
            src="https://covidnow.moh.gov.my/_nuxt/img/jata.5baa949.png"
            alt=""
            width="42"
            height="31.5"
          />
        </vs-button>
      </template>
      <template #right>
        <vs-navbar-item :active="active == 'guide'" id="guide" to="/">
          Home
        </vs-navbar-item>
        <vs-navbar-item :active="active == 'docs'" id="docs" to="/about">
          About
        </vs-navbar-item>
        <a
          href="https://isaactan.vercel.app/"
          class="vs-navbar__item"
          target="_blank"
        >
          Isaac Tan
        </a>
      </template>
    </vs-navbar>

    <!--  -->

    <vs-sidebar sticky v-model="active" :open.sync="activeSidebar">
      <template #logo>
        <!-- ...img logo -->
      </template>
      <vs-sidebar-item id="guide" to="/">
        <template #icon>
          <i class="bx bx-home"></i>
        </template>
        Home
      </vs-sidebar-item>
      <vs-sidebar-item id="docs" to="/about">
        <template #icon>
          <i class="bx bx-grid-alt"></i>
        </template>
        About
      </vs-sidebar-item>
      <template #footer>
        <vs-row justify="space-between">
          <vs-avatar>
            <img
              src="https://covidnow.moh.gov.my/_nuxt/img/jata.5baa949.png"
              alt=""
              width="42"
              height="31.5"
            />
          </vs-avatar>
        </vs-row>
      </template>
    </vs-sidebar>
  </header>
</template>

<script>
export default {
  data: () => ({
    active: "guide",
    activeSidebar: false
  })
};
</script>

<style></style>
