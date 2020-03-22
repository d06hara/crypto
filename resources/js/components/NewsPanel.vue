<template>
  <div class="p-news">
    <!-- news card -->
    <div class="p-news__cards">
      <div class="c-card__container">
        <div v-for="(item, index) in displayItems" :key="index" class="c-card">
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

    <!-- news pagination todo css -->
    <div class="p-news__pagination">
      <div class="p-news__pagination-content">
        <ul class="c-pagination">
          <li class="c-pagination__list c-pagination__list-pre">
            <a @click="first" class="c-pagination__list-link" href="#">&laquo;</a>
          </li>
          <li class="c-pagination__list">
            <a @click="prev" class="c-pagination__list-link" href="#">&lt;</a>
          </li>

          <li
            v-for="(i, index) in displayPageRange"
            :key="index"
            class="c-pagination__list"
            :class="{active: i-1 === currentPage}"
          >
            <a @click="pageSelect(i)" class="c-pagination__list-link" href="#">{{ i }}</a>
          </li>

          <li class="c-pagination__list">
            <a @click="next" class="c-pagination__list-link" href="#">&gt;</a>
          </li>
          <li class="c-pagination__list c-pagination__list-next">
            <a @click="last" class="c-pagination__list-link" href="#">&raquo;</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      news: [],
      currentPage: 0, // 現在のページ番号
      size: 10, // 1ページに表示するアイテムの上限
      pageRange: 10 // ページネーションに表示するページ数の上限
    };
  },
  mounted() {
    // 表示するアイテムの初期化（APIで取得するなど）
    console.log("mounted");
    this.load(1);
  },
  computed: {
    /**
     * ページ数を取得する
     * @return {number} 総ページ数(1はじまり)
     */
    pages() {
      return Math.ceil(this.news.length / this.size);
    },
    /**
     * ページネーションで表示するページ番号の範囲を取得する
     * @return {Array<number>} ページ番号の配列
     */
    displayPageRange() {
      const half = Math.ceil(this.pageRange / 2);
      let start, end;

      if (this.pages < this.pageRange) {
        // ページネーションのrangeよりページ数がすくない場合
        start = 1;
        end = this.pages;
      } else if (this.currentPage < half) {
        // 左端のページ番号が1になったとき
        start = 1;
        end = start + this.pageRange - 1;
      } else if (this.pages - half < this.currentPage) {
        // 右端のページ番号が総ページ数になったとき
        end = this.pages;
        start = end - this.pageRange + 1;
      } else {
        // activeページを中央にする
        start = this.currentPage - half + 1;
        end = this.currentPage + half;
      }

      let indexes = [];
      for (let i = start; i <= end; i++) {
        indexes.push(i);
      }
      return indexes;
    },
    /**
     * 現在のページで表示するアイテムリストを取得する
     * @return {any} 表示用アイテムリスト
     */
    displayItems() {
      const head = this.currentPage * this.size;
      return this.news.slice(head, head + this.size);
    },
    /**
     * 現在のページかどうか判定する
     * @param {number} page ページ番号
     * @return　{boolean} 現在のページならtrue
     */
    isSelected(page) {
      return page - 1 === this.currentPage;
    }
  },
  methods: {
    load(page) {
      console.log("loadします");
      axios.get("api/news?page=" + page).then(({ data }) => {
        console.log(data);
        this.news = data.data;
        this.current_page = data.current_page;
        this.per_page = data.per_page;
        this.last_page = data.last_page;
        this.total = data.total;
        this.from = data.from;
        this.to = data.to;
      });
    },
    /**
     * ページ先頭に移動する
     */
    first() {
      this.currentPage = 0;
      this.selectHandler();
    },
    /**
     * ページ後尾に移動する
     */
    last() {
      this.currentPage = this.pages - 1;
      this.selectHandler();
    },
    /**
     * 1ページ前に移動する
     */
    prev() {
      if (0 < this.currentPage) {
        this.currentPage--;
        this.selectHandler();
      }
    },
    /**
     * 1ページ次に移動する
     */
    next() {
      if (this.currentPage < this.pages - 1) {
        this.currentPage++;
        this.selectHandler();
      }
    },
    /**
     * 指定したページに移動する
     * @param {number} index ページ番号
     */
    pageSelect(index) {
      this.currentPage = index - 1;
      this.selectHandler();
    },
    /**
     * ページを変更したときの処理
     */
    selectHandler() {
      // なんかの処理
    }
  }
};
</script>