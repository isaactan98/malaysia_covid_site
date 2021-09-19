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
        <vs-navbar-item :active="active == 'guide'" id="guide">
          Home
        </vs-navbar-item>
        <vs-navbar-item :active="active == 'docs'" id="docs">
          Documents
        </vs-navbar-item>
        <vs-navbar-item :active="active == 'components'" id="components">
          Components
        </vs-navbar-item>
      </template>
    </vs-navbar>

    <!--  -->

    <vs-sidebar sticky v-model="active" :open.sync="activeSidebar">
      <template #logo>
        <!-- ...img logo -->
      </template>
      <vs-sidebar-item id="guide">
        <template #icon>
          <i class="bx bx-home"></i>
        </template>
        Home
      </vs-sidebar-item>
      <vs-sidebar-item id="market">
        <template #icon>
          <i class="bx bx-grid-alt"></i>
        </template>
        Market Overview
      </vs-sidebar-item>
      <vs-sidebar-item id="Music">
        <template #icon>
          <i class="bx bxs-music"></i>
        </template>
        Music
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
    activeSidebar: false,
  }),
};
</script>

<style>
</style>