<template>
  <div class="feeds" keep-alive>
    <h3>Top News</h3>

    <div class="last-update" v-if="$fetchState.pending">
      <div class="loading">
        <div class="fake-effect"></div>
      </div>
    </div>
    <p v-else-if="$fetchState.error">
      Error Loading... {{ $fetchState.error }}
    </p>
    <div class="feed-grid" v-else>
      <article
        v-for="(news, index) in this.newfeed.channel.item.slice(0, 7)"
        :key="index"
      >
        <a :href="news.link" target="_blank"></a>
        <figure v-if="news.lead != null">
          <img :src="news.lead" />
        </figure>
        <div class="feedtext">
          <span>The Star : News Feed</span>
        </div>
        <h4>{{ news.title }}</h4>
        <div class="feedtime">
          <span>{{ timeSince(new Date(news.pubDate)) }} ago</span>
        </div>
      </article>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    newfeed: [],
    attribute: "@attributes",
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
    },
    timeSince(date) {
      var seconds = Math.floor((new Date() - date) / 1000);

      var interval = seconds / 31536000;

      if (interval > 1) {
        return Math.floor(interval) + " years";
      }
      interval = seconds / 2592000;
      if (interval > 1) {
        return Math.floor(interval) + " months";
      }
      interval = seconds / 86400;
      if (interval > 1) {
        return Math.floor(interval) + " days";
      }
      interval = seconds / 3600;
      if (interval > 1) {
        return Math.floor(interval) + " hours";
      }
      interval = seconds / 60;
      if (interval > 1) {
        return Math.floor(interval) + " minutes";
      }
      return Math.floor(seconds) + " seconds";
    },
  },
  async fetch() {
    this.newfeed = await fetch(
      "https://malaysia-covid-stat.herokuapp.com/api/news"
    ).then((res) => res.json());
  },
  fetchOnServer: false,
};
</script>

<style>
.feeds {
  padding: 16px;
  border: 1px solid #dadce0;
  -webkit-border-radius: 8px;
  border-radius: 8px;
  margin-bottom: 32px;
  background: #ffffff;
}
.feed-grid {
  display: grid;
  grid-template-columns: repeat(12, minmax(0, 1fr));
  grid-gap: 32px;
  grid-column-gap: 0;
  margin-bottom: 32px;
}
.feed-grid > article {
  display: grid;
  grid-template-rows: repeat(6, minmax(0px, auto));
  grid-column-gap: 0;
  grid-row-gap: 0;
  grid-template-columns: 1fr 16px auto;
  grid-column: span 12;
  -webkit-box-orient: vertical;
  box-orient: vertical;
  -webkit-box-orient: vertical;
  -webkit-flex-direction: column;
  flex-direction: column;
  position: relative;
  color: #202124;
  vertical-align: top;
}
article > a {
  text-decoration: none;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 5;
  cursor: pointer;
}

figure {
  width: 72px;
  height: 72px;
  grid-column: 3/3;
  grid-row: 1 / span 5;
  flex: 0 0 auto;
  padding-top: 100%;
  position: relative;
  margin: 0;
  border-radius: 8px;
  display: block;
  overflow: hidden;
  flex-direction: row;
  -webkit-box-orient: horizontal;
  padding: 0;
}

figure > img {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 1;
  max-width: 175px;
  max-height: 175px;
  margin: auto;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

article > .feedtext {
  display: -webkit-box;
  display: -webkit-flex;
  display: flex;
  -webkit-box-align: center;
  box-align: center;
  -webkit-align-items: center;
  align-items: center;
  -webkit-flex-wrap: wrap;
  flex-wrap: wrap;
  font-size: 0.75rem;
  color: inherit;
  vertical-align: middle;
}
article > h4 {
  font-size: 0.9375rem;
  margin-top: 8px;
  margin-bottom: 0;
  line-height: 1.4;
  grid-column: 1 / span 1;
}
article > .feedtime {
  grid-column: 1 / span 1;
  padding-top: 8px;
  display: flex;
  -webkit-box-align: center;
  box-align: center;
  -webkit-align-items: center;
  align-items: center;
  box-pack: start;
  -webkit-box-pack: start;
  -webkit-justify-content: flex-start;
  justify-content: flex-start;
  -webkit-flex-wrap: wrap;
  flex-wrap: wrap;
  font-size: 0.75rem;
}

@media screen and (max-width: 700px) {
  article > h4 {
    font-size: 0.8rem;
  }
}

@media screen and (max-width: 960px) {
  article > h4 {
    font-size: 0.8rem;
  }
}
</style>