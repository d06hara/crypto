<template>
  <div class="p-ranking">
    <div class="p-ranking__content">
      <!-- ソートタブ -->
      <div class="p-ranking__content-sort">
        <ul>
          <li>
            <button
              v-on:click="sortBy('hour')"
              v-bind:class="[ activetab === 1 ? 'active': '']"
            >過去１時間のツイート数順</button>
          </li>
          <li>
            <button
              v-on:click="sortBy('day')"
              v-bind:class="[ activetab === 2 ? 'active' : '']"
            >過去１日のツイート数順</button>
          </li>
          <li>
            <button
              v-on:click="sortBy('week')"
              v-bind:class="[ activetab === 3 ? 'active' : '']"
            >過去１週間のツイート数順</button>
          </li>
        </ul>
      </div>

      <!-- フィルターボックス-->
      <div class="p-ranking__content-filter">
        <select v-model="preview" multiple class="c-filter">
          <option class="c-filter__option" disabled>--銘柄の絞り込みが可能です--</option>
          <option
            class="c-filter__option"
            v-bind:value="check"
            v-for="(check, index) in check_lists"
            :key="index"
          >{{ check }}</option>
        </select>
      </div>

      <!-- 時間情報 -->
      <div class="p-ranking__content-information">
        <p>
          <span>{{ time }}</span> 時点のランキング
        </p>
      </div>

      <!-- ランキングテーブル -->
      <div class="p-ranking__content-table">
        <table class="c-table">
          <thead class="c-table__thead">
            <tr>
              <th width="10">ツイート数</th>
              <th width="40">銘柄</th>
              <th width="25">24時間での最高取引価格</th>
              <th width="25">24時間での最安取引価格</th>
            </tr>
          </thead>
          <tbody class="c-table__tbody">
            <tr v-for="bland in selectedBlands" :key="bland.id">
              <td width="10" v-if="activetab === 1">
                <a v-bind:href="bland.url" target="_blank">{{ bland.hour_tweets_count }}</a>
              </td>
              <td width="10" v-else-if="activetab === 2">
                <a v-bind:href="bland.url" target="_blank">{{ bland.day_tweets_count }}</a>
              </td>
              <td width="10" v-else>
                <a v-bind:href="bland.url" target="_blank">{{ bland.week_tweets_count }}</a>
              </td>
              <td width="40">
                <a v-bind:href="bland.url" target="_blank">{{ bland.name }}</a>
              </td>
              <td width="25">
                <a v-bind:href="bland.url" target="_blank">{{ bland.high }}</a>
              </td>
              <td width="25">
                <a v-bind:href="bland.url" target="_blank">{{ bland.low }}</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "BlandPanel",
  data() {
    return {
      check_lists: [
        //filter機能用に銘柄を格納
        "ビットコイン",
        "イーサリアム",
        "イーサリアムクラシック",
        "リスク",
        "ファクトム",
        "リップル",
        "ネム",
        "ライトコイン",
        "ビットコインキャッシュ",
        "モナコイン",
        "ステラルーメン",
        "クアンタム"
      ],
      preview: [], //絞り込んだ銘柄を格納するため空配列
      blands: [], //銘柄情報入れるための空配列
      time: [], //DB最終更新時間を入れる
      sortKey: "", //ソートキー
      activetab: 1 //ソートの状態表示
    };
  },

  mounted: function() {
    // console.log("mounted");
    axios
      .get("/api/ranking")
      .then(response => {
        // 時間を取得
        this.time = response.data[0];
        //  銘柄データを取得
        this.blands = response.data[1];
      })
      .catch(response => console.log(response));
    // 初期画面では1時間ごとのランキングになるようにする
    this.sortBy("hour");
  },
  computed: {
    /**
     * sort&fileter
     */
    selectedBlands: function() {
      // sortKeyでswitch
      switch (this.sortKey) {
        case "hour":
          // console.log("１時間で並び替え");
          this.activetab = 1;
          this.blands.sort(function(a, b) {
            if (a.hour_tweets_count > b.hour_tweets_count) return -1;
            if (a.hour_tweets_count < b.hour_tweets_count) return 1;
            return 0;
          });
          break;

        case "day":
          // console.log("１日で並び替え");
          this.activetab = 2;
          this.blands.sort(function(a, b) {
            if (a.day_tweets_count > b.day_tweets_count) return -1;
            if (a.day_tweets_count < b.day_tweets_count) return 1;
            return 0;
          });
          break;

        case "week":
          // console.log("１週間で並び替え");
          this.activetab = 3;
          this.blands.sort(function(a, b) {
            if (a.week_tweets_count > b.week_tweets_count) return -1;
            if (a.week_tweets_count < b.week_tweets_count) return 1;
            return 0;
          });
          break;
        default:
      }
      // 初期値,previewに何もない場合は全てを表示
      if (this.preview.length === 0) {
        return this.blands;
      }
      // previewに入っている場合、その名前を含んでいる銘柄を取得
      return this.blands.filter(function(bland) {
        return this.preview.includes(bland.name);
      }, this);
    }
  },
  /**
   * ソート機能発火
   */
  methods: {
    sortBy: function(key) {
      // console.log("methods");
      this.sortKey = key;
    }
  }
};
</script>
