<template>
  <div class="p-account">
    <div v-for="account in accounts" class="p-account__card">
      <p>id:{{ account.id }}</p>
      <p>name: {{ account.name }}</p>
      <p>screen_name: {{ account.screen_name }}</p>
      <p>frineds_count: {{ account.friends_count }}</p>
      <p>followers_count: {{ account.followers_count }}</p>
      <p>description: {{ account.description }}</p>
      <form>
        <button>フォロー</button>
      </form>
      <div class="p-account__card-tweet">{{ account.status.text }}</div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AccountPanel",
  data() {
    return {
      aa: "アイウエオ",
      accounts: [] //accountデータを入れるための空配列
    };
  },
  mounted: function() {
    axios
      .get("/api/account")
      // .then(response => console.log(response))
      .then(response => (this.accounts = response.data))
      .catch(response => console.log(response));
  }
};
</script>