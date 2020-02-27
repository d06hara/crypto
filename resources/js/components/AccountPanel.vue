<template>
  <div class="p-account__card">
    <!-- <div v-for="account in accounts"> -->
    <p>id{{ accounts.id }}</p>
    <p>name</p>
    <p>{{ aa }}</p>
    <form>
      <button></button>
    </form>
    <!-- </div> -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      aa: "アイウエオ",
      accounts: [] //accountデータを入れるための空配列
    };
  },
  mounted: function() {
    axios
      .get("/api/account")
      .then(response => console.log(response))
      // .then(response => (this.accounts = response.data))
      .catch(response => consol.lod(response));
  }
};
</script>