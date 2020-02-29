<template>
  <div>
    <div class="p-ranking__brand-container" v-for="bland in blands" :key="bland.id">
      <a href>
        <p class="p-ranking__brand">銘柄名:{{ bland.name }}</p>
        <p>ツイート数：{{ bland.count }}</p>
        <p>２４時間での最高取引価格 : {{ bland.high }}</p>
        <p>２４時間での最安取引価格 : {{ bland.low }}</p>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: "BlandPanel",
  data() {
    return {
      test: "テスト",
      blands: []
      // coin_info: []
    };
  },
  mounted: function() {
    axios
      .get("/api/ranking")
      // .then(response => console.log(response))
      // .then(
      //   response => (
      //     (this.blands = response.data[0]), (this.coin_info = response.data[1])
      //   )
      // )
      .then(response => (this.blands = response.data))
      .catch(response => console.log(response));
  }
  // mounted: function() {
  //   axios
  //     .get("/api/ranking")
  //     .thne(response => (this.coin_info = response.data[1]));
  // }
};
</script>