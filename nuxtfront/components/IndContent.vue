<template>
  <div class="content__default">
    <div class="card">
      <div class="example">
        <div class="grid center">
          <vs-row>
            <vs-col offset="0" w="12">
              <div>
                <h3>Malaysia</h3>
                <div>
                  <div class="d-grid">
                    <div class="c-content">
                      <div>New Cases</div>
                      <div>
                        <h2>{{ dataset[dataset.length - 1].cases_new }}</h2>
                      </div>
                    </div>
                    <div class="c-content">
                      <div>Recovered Cases</div>
                      <div>
                        <h2>
                          {{ dataset[dataset.length - 1].cases_recovered }}
                        </h2>
                      </div>
                    </div>
                    <div class="c-content">
                      <div>Imported Cases</div>
                      <div>
                        <h2>{{ dataset[dataset.length - 1].cases_import }}</h2>
                      </div>
                    </div>
                  </div>
                  <div></div>
                </div>
              </div>
            </vs-col>
          </vs-row>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    dataset: [],
  }),
  async fetch() {
    this.dataset = await fetch("http://127.0.0.1:8000/api/cases").then((res) =>
      res.json()
    );
  },
};
</script>

<style>
.d-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  grid-gap: 24px;
}
.c-content {
  display: flex;
  justify-content: flex-start;
  flex-direction: column;
  position: relative;
}
</style>