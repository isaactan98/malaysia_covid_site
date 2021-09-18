<template>
  <div class="content">
    <div class="grid100">
      <!-- left -->
      <div class="left-grid">
        <!-- 1st -->
        <div class="main-content">
          <h3>Malaysia</h3>
          <div class="w-content">
            <div class="mb-16">
              <div class="d-grid">
                <!-- New Cases -->
                <div class="c-content">
                  <div class="content-title">New Cases</div>
                  <div class="content-text">
                    {{ dataset[dataset.length - 1].cases_new }}
                  </div>
                </div>
                <!-- Recovered -->
                <div class="c-content">
                  <div class="content-title">Recovered</div>
                  <div class="content-text">
                    {{ dataset[dataset.length - 1].cases_recovered }}
                  </div>
                </div>
                <!-- Death -->
                <div class="c-content">
                  <div class="content-title">Death</div>
                  <div class="content-text">-</div>
                </div>
              </div>
            </div>
            <div class="bt-b1"></div>
            <div class="mb-16">
              <div class="d-grid">
                <!-- New Cases -->
                <div class="c-content">
                  <div class="content-title">New Cases</div>
                  <div class="content-text">-</div>
                </div>
                <!-- Recovered -->
                <div class="c-content">
                  <div class="content-title">New Cases</div>
                  <div class="content-text">-</div>
                </div>
                <!-- Death -->
                <div class="c-content">
                  <div class="content-title">New Cases</div>
                  <div class="content-text">-</div>
                </div>
              </div>
            </div>
          </div>
          <div>
            <div class="font-xs">
              cases reported in the 24h since the last report (except for 16th
              March 2020, for which the data is cumulative)
            </div>
            <span></span>
          </div>
        </div>
        <div>
          <state-table />
        </div>
        <div></div>
      </div>
      <!-- right -->
      <div class="right-grid">
        <news-feed />
      </div>
    </div>
  </div>
</template>

<script>
import NewsFeed from "./NewsFeed.vue";
import StateTable from "./StateTable.vue";
export default {
  components: {
    NewsFeed,
    StateTable,
  },
  data: () => ({
    dataset: [],
  }),
  async fetch() {
    this.dataset = await fetch(
      "https://malaysia-covid-stat.herokuapp.com/api/cases"
    ).then((res) => res.json());
  },
};
</script>

<style>
.grid100 {
  display: grid;
  grid-template-columns: repeat(12, minmax(0, 1fr));
  grid-gap: 16px 32px;
  width: 100%;
}
.left-grid {
  grid-column: span 8;
}
.right-grid {
  grid-column: span 4;
}
.main-content {
  padding: 16px;
  border: 1px solid #dadce0;
  -webkit-border-radius: 8px;
  border-radius: 8px;
  margin-bottom: 32px;
  background: #ffffff;
}
.bt-b1 {
  width: 100%;
  height: 0;
  border-top: 1px solid #dadce0;
  margin-bottom: 16px;
}
.w-content {
  display: flex;
  -webkit-box-orient: vertical;
  box-orient: vertical;
  -webkit-flex-direction: column;
  flex-direction: column;
  -webkit-box-align: flex-start;
  box-align: flex-start;
  -webkit-align-items: flex-start;
  align-items: flex-start;
  -webkit-justify-content: flex-start;
  justify-content: flex-start;
  outline: none;
  width: 100%;
  padding-left: 0;
  padding-right: 0;
}
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
.content-title {
  overflow-wrap: break-word;
  word-wrap: break-word;
  word-break: break-word;
  font-family: "Roboto", sans-serif;
  color: #5f6368;
  font-size: 0.75rem;
  line-height: 1.3;
}
.content-text {
  font-family: "Open Sans", sans-serif;
  font-weight: 500;
  color: #202124;
  margin: 4px 0 8px;
  font-size: 26px;
}
.mb-16 {
  margin-bottom: 16px;
  width: 100%;
}
.font-xs {
  color: #5f6368;
  font-size: 0.75rem;
  margin-bottom: 12px;
  line-height: 1.33;
}

@media screen and (max-width: 700px) {
  .grid100 {
    display: block;
    width: 100%;
    padding: 0;
    grid-gap: 16px;
  }
  .left-grid {
    grid-column: span 12;
  }
  .right-grid {
    grid-column: span 12;
  }
}
</style>