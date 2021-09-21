<template>
  <div class="page">
    <div class="header-page">
      <div class="header__content">
        <div class="head-title">About</div>
        <p>
          The unofficial Malaysia government website for data and insights on
          COVID-19.
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  head: {
    title: "About - CovidStat in Malaysia",
  },
  data: () => ({
    active: "docs",
  }),
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
</style>