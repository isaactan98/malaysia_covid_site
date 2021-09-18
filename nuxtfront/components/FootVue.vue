<template>
  <div class="footer">
    <div class="mr">
      <img
        src="https://covidnow.moh.gov.my/_nuxt/img/jata.5baa949.png"
        width="48"
      />
    </div>
    <div class="grid">
      <div class="font-bold">MINISTRY OF HEALTH MALAYSIA</div>
      <div class="font-xs">
        <div class="footer-text">
          Open data:
          <a
            href="https://github.com/MoH-Malaysia/covid19-public/tree/main/epidemic"
            target="_blank"
            rel="noopener"
            >Ministry of Health Malaysia</a
          >,
          <a
            href="https://github.com/CITF-Malaysia/citf-public"
            target="_blank"
            rel="noopener"
            >COVID-19 Immunisation Task Force</a
          >
        </div>
        <div class="footer-text">
          A collaboration between MoH Malaysia and the
          <a href="http://isaactan.website" class=""> open data community </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
.footer {
  padding: 1rem 2rem;
  display: flex;
  margin: auto;
}
.mr {
  margin-right: 1rem;
}
.font-bold {
  font-weight: 700;
  font-size: 1.25rem;
  line-height: 1.75rem;
}
.font-xs {
  font-size: 0.75rem;
  line-height: 1rem;
}
.footer-text > a {
  text-decoration: underline;
}
</style>