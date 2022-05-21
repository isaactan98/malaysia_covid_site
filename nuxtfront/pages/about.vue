<template>
  <div class="page">
    <div class="header-page center">
      <div class="header__content">
        <div class="head-title">About COVIDSTAT</div>
        <p>
          The unofficial Malaysia government website for data and insights on
          COVID-19.
        </p>
      </div>
    </div>
    <div class="about-content">
      <div class="contens-text">
        <p>
          The Ministry of Health's and the COVID-19 Immunisation Task Force's
          open data initiatives have been a new and refreshing experience for us
          at the MoH, as well as, we hope, for the rest of Malaysia. Open data
          has allowed both public and commercial actors to scrutinise our
          policies, exchange new information and analysis, and hold us to better
          standards.
        </p>
        <p>
          The number of high-quality data products made possible by data
          liberalisation was something we were really thrilled to see. Many
          developers and data scientists contacted us, offering their time and
          expertise to assist us in the fight against the virus.
        </p>
        <p>
          It was via this spirit of collaboration with the open data community
          that COVIDNOW was born. A group of innovative developers worked with
          us at MoH, 100% pro bono, to build a site that would help Malaysians
          monitor the epidemic. This work was led by the Crisis Preparedness and
          Response Centre (CPRC), in conjunction with CPRC Hospital and the
          National Public Health Laboratory (NPHL).
        </p>
      </div>
    </div>
    <div class="developer">
      <div class="dev-p">
        <div></div>
        <div></div>
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
.center {
  margin: auto;
}
.page {
  position: relative;
  z-index: 0;
  padding: 32px 16px;
  max-width: 1104px;
  margin: auto;
  min-height: 400px;
  overflow: auto;
  min-height: 100vh;
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
.about-content {
  display: grid;
  gap: 1rem;
}
.contens-text {
  font-size: 1rem;
  line-height: 1.75rem;
  display: grid;
  margin: auto;
}
.developer {
  display: grid;
  margin-top: 3rem;
  margin-bottom: 2rem;
}
.dev-p {
  flex-direction: row-reverse;
  gap: 1rem;
  align-items: center;
  display: flex;
}
</style>