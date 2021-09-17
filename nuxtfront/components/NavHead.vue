<template>
  <header>
    <vs-navbar
      target-scroll="#padding-scroll-content"
      padding-scroll
      center-collapsed
      v-model="active"
      fixed
      shadow-scroll
    >
      <template #left>
        <vs-button @click="activeSidebar = !activeSidebar" flat icon>
          <i class="bx bx-menu"></i>
        </vs-button>
        <img
          src="https://covidnow.moh.gov.my/_nuxt/img/jata.5baa949.png"
          alt=""
          width="42"
          height="31.5"
        />
      </template>
      <vs-navbar-item :active="active == 'guide'" id="guide">
        Home
      </vs-navbar-item>
      <vs-navbar-item :active="active == 'docs'" id="docs">
        Documents
      </vs-navbar-item>
      <vs-navbar-item :active="active == 'components'" id="components">
        Components
      </vs-navbar-item>
      <template #right> </template>
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

          <vs-avatar badge-color="danger" badge-position="top-right">
            <i class="bx bx-bell"></i>

            <template #badge> 28 </template>
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