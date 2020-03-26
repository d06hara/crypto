<template>
  <div class="p-ranking">
    <!-- <div class="p-ranking__checkbox">
 
      <div class="p-ranking__checkbox-content">
        <p>銘柄チェックボックス</p>
        <p>TODO スクロールさせる</p>
        <ul>
          <li v-for="(check, index) in check_lists" :key="index">
            <label v-bind:for="check">
              <input type="checkbox" v-bind:value="check" v-model="preview" />
              {{ check }}
            </label>
          </li>
        </ul>
      </div>
    </div>-->

    <div class="p-ranking__content">
      <!-- ツイート数sort -->
      <div class="p-ranking__content-sort">
        <ul>
          <li>
            <button v-on:click="sortBy('hour')">過去１時間のツイート数順</button>
          </li>
          <li>
            <button v-on:click="sortBy('day')">過去１日のツイート数順</button>
          </li>
          <li>
            <button v-on:click="sortBy('week')">過去１週間のツイート数順</button>
          </li>
        </ul>
      </div>

      <!-- 銘柄filter-->
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

      <!-- ランキング何時部分 -->
      <div class="p-ranking__content-information">
        <p>
          <span>{{ time }}</span> 時点のランキング
        </p>
      </div>

      <!-- テスト -->

      <!-- ランキングテーブル -->
      <div class="p-ranking__content-table">
        <table class="c-table">
          <thead class="c-table__thead">
            <tr>
              <th width="10">ランク</th>
              <th width="40">銘柄</th>
              <th width="25">24時間での最高取引価格</th>
              <th width="25">24時間での最安取引価格</th>
            </tr>
          </thead>
          <tbody class="c-table__tbody">
            <!-- <tr v-for="(bland, index) in blands" :key="bland.id"> -->
            <tr v-for="(bland, index) in selectedBlands" :key="bland.id">
              <td width="10">
                <a v-bind:href="bland.url" target="_blank">{{ index + 1 }}</a>
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

  // props: ["time"],
  data() {
    return {
      selected: null,
      options: ["list", "of", "options"],
      check_lists: [
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
      preview: [], //チェックした銘柄を格納する
      blands: [],
      time: {},
      sortItems: [
        { name: "過去1時間" },
        { name: "過去1日" },
        { name: "過去1週間" }
      ],
      sortKey: "",
      test: {
        key: "", //ソートキー
        mode: false
      }
      // sortKey: "", //sort対象
      // sortOrders: sortData.sortOrders() //ソートの値
    };
  },
  // created: function() {
  //   this.sort("sort");
  // },
  mounted: function() {
    axios
      .get("/api/ranking")
      // .then(response => console.log(response))
      // .then(response => (this.time = response.data[0]))
      // .then(response => (this.blands = response.data[1]))
      .then(response => {
        this.time = response.data[0];
        this.blands = response.data[1];
      })
      .catch(response => console.log(response));
    this.sortBy("hour");
  },
  computed: {
    // checkboxを使用した銘柄filter
    selectedBlands: function() {
      var data = this.blands;

      // var sortKey = this.sortKey;

      // sortkeyの有無で処理を分ける
      // sortKeyがある場合⇨sortボタンが押された場合
      if (this.sortKey) {
        // switchで条件分岐
        switch (this.sortKey) {
          case "hour":
            this.blands.sort(function(a, b) {
              console.log("１時間で並び替え");
              if (a.hour_tweets_count > b.hour_tweets_count) return -1;
              if (a.hour_tweets_count < b.hour_tweets_count) return 1;
              return 0;
            });
            break;
          case "day":
            this.blands.sort(function(a, b) {
              console.log("１日で並び替え");
              if (a.day_tweets_count > b.day_tweets_count) return -1;
              if (a.day_tweets_count < b.day_tweets_count) return 1;
              return 0;
            });
            break;
          case "week":
            this.blands.sort(function(a, b) {
              console.log("１週間で並び替え");
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
      // sortKeyがない場合=初期表示では1時間のツイート数順に並べる
      this.sortKey = "hour";
      console.log("テスト");
      // return this.blands;

      this.blands.sort(function(a, b) {
        console.log("１時間で並び替え");
        if (a.hour_tweets_count > b.hour_tweets_count) return -1;
        if (a.hour_tweets_count < b.hour_tweets_count) return 1;
        return 0;
      });

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
  methods: {
    sortBy: function(key) {
      this.sortKey = key;
    }
    // sort: function(action_type) {
    //   switch (action_type) {
    //     case "hour":
    //       this.blands.sort(function(a, b) {
    //         console.log("１時間で並び替え");
    //         if (a.hour_tweets_count > b.hour_tweets_count) return -1;
    //         if (a.hour_tweets_count < b.hour_tweets_count) return 1;
    //         return 0;
    //       });
    //       break;
    //     case "day":
    //       this.blands.sort(function(a, b) {
    //         console.log("１日で並び替え");
    //         if (a.day_tweets_count > b.day_tweets_count) return -1;
    //         if (a.day_tweets_count < b.day_tweets_count) return 1;
    //         return 0;
    //       });
    //       break;
    //     case "week":
    //       this.blands.sort(function(a, b) {
    //         console.log("１週間で並び替え");
    //         if (a.week_tweets_count > b.week_tweets_count) return -1;
    //         if (a.week_tweets_count < b.week_tweets_count) return 1;
    //         return 0;
    //       });
    //       break;
    //     default:
    //   }
    // }
  }

  // methods: {
  //   find_blands: function() {
  //     var blands = this.blands;
  //     var preview = this.preview;

  //     if (preview.length > 0) {
  //       for (var i = 0; i < blands.length; i++) {
  //         var check_bland = blands[i].name;
  //         for (var j = 0; j < preview.length; j++) {
  //           if (check_bland === preview[j]) {
  //             blands[i].display = true;
  //             break;
  //           } else {
  //             blands[i].display = false;
  //           }
  //         }
  //       }
  //       // checkが全て外れた場合の処理
  //     } else {
  //       for (var i = 0; i < blands.length; i++) {
  //         // var checked_bland = blands[i].name;
  //         blands[i].display = true;
  //       }
  //     }
  //   }
  // },
};
</script>
