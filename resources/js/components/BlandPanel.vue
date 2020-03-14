<template>
  <div class="p-ranking">
    <div class="p-ranking__checkbox-container">
      <div class="p-ranking__checkbox">
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
        <!-- <p>選択している銘柄:{{ preview }}</p> -->
      </div>
    </div>
    <div class="p-ranking__index-container">
      <div class="p-ranking__index">
        <p>銘柄一覧</p>
        <div>
          <div>
            <p>
              <span>{{ time }}</span>時点のランキング
            </p>
          </div>
          <nav>
            <div>
              <button v-on:click="sort('hour')">過去１時間のツイート数順</button>
              <button v-on:click="sort('day')">過去１日のツイート数順</button>
              <button v-on:click="sort('week')">過去１週間のツイート数順</button>
            </div>
          </nav>
          <!-- <i class="selectbox__icon"></i> -->
        </div>
        <div class="p-ranking__brand-container" v-for="bland in selectedBlands" :key="bland.id">
          <a v-bind:href="bland.url" target="_blank">
            <p class="p-ranking__brand">銘柄名:{{ bland.name }}</p>
            <p>１時間ツイート数：{{ bland.hour_tweets_count }}</p>
            <p>１日ツイート数：{{ bland.day_tweets_count }}</p>
            <p>１週間ツイート数：{{ bland.week_tweets_count }}</p>
            <p>２４時間での最高取引価格 : {{ bland.high }}</p>
            <p>２４時間での最安取引価格 : {{ bland.low }}</p>
          </a>
        </div>
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
      check_lists: [
        "ビットコイン",
        "ビットコインキャッシュ",
        "イーサリアム",
        "イーサリアムクラシック",
        "リップル",
        "ライトコイン",
        "モナコイン",
        "ネム",
        "ファクトム"
      ],
      preview: [], //チェックした銘柄を格納する
      blands: [],
      time: {},
      sortItems: [
        { name: "過去1時間" },
        { name: "過去1日" },
        { name: "過去1週間" }
      ]
    };
  },
  computed: {
    // checkboxを使用した銘柄filter
    selectedBlands: function() {
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
    sort: function(action_type) {
      switch (action_type) {
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
    }
  },

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
  }
};
</script>