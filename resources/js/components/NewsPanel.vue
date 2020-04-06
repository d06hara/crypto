<template>
  <div class="p-news">
    <div class="p-news__contents">
      <!-- news card -->
      <div class="p-news__contents-cards">
        <div class="c-card__container">
          <div v-for="(item, index) in news" :key="index" class="c-card">
            <div class="c-card__textbox">
              <a v-bind:href="item.url" target="_blank">
                <div class="c-card__textbox-text">{{ item.title }}</div>
                <p class="c-card__textbox-item">{{ item.source }}</p>
                <p class="c-card__textbox-item">{{ item.pubDate }}</p>
              </a>
            </div>
          </div>
        </div>
      </div>

      <infinite-loading @infinite="infiniteHandler" spinner="spiral">
        <span slot="no-more">no more data</span>
      </infinite-loading>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      news: [], //news格納用配列
      page: 0 //初期表示ページ
    };
  },

  methods: {
    infiniteHandler($state) {
      axios
        .get("/api/news", {
          params: {
            page: this.page
          }
        })
        .then(({ data }) => {
          //そのままだと読み込み時にカクつくので1500毎に読み込む
          setTimeout(() => {
            if (this.page < data.data.length) {
              this.page += 1;
              this.news.push(...data.data);
              $state.loaded();
            } else {
              $state.complete();
            }
          }, 1500);
        })
        .catch(err => {
          $state.complete();
        });
    }
  }
};
</script>