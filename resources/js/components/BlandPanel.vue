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
        <p>選択している銘柄:{{ preview }}</p>
      </div>
    </div>
    <div class="p-ranking__index-container">
      <div class="p-ranking__index">
        <p>銘柄一覧</p>
        <div class="p-ranking__brand-container" v-for="bland in selectedBlands" :key="bland.id">
          <a v-bind:href="bland.url" target="_blank">
            <p class="p-ranking__brand">銘柄名:{{ bland.name }}</p>
            <p>ツイート数：{{ bland.count }}</p>
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
        "ファクトム",
        "ネム"
      ],
      preview: [], //チェックした銘柄を格納する
      blands: []
    };
  },
  computed: {
    selectedBlands: function() {
      if (this.preview.length === 0) {
        return this.blands;
      }
      return this.blands.filter(function(bland) {
        return this.preview.includes(bland.name);
      }, this);
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
      .then(response => (this.blands = response.data))
      .catch(response => console.log(response));
  }
};
</script>