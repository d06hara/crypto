<template>
  <div>
    <div>
      <input type="checkbox" v-model="autoMode" v-on:change="autoFollow" />
      <label for>自動フォロー</label>
      <p>テスト {{ autoMode }} （機能が完成したら削除</p>
    </div>
    <div class="p-account">
      <div v-for="account in accounts" class="p-account__card" :key="account.id">
        <p>twitter_id:{{ account.twitter_id }}</p>
        <p>name: {{ account.name }}</p>
        <p>screen_name: {{ account.screen_name }}</p>
        <p>frineds_count: {{ account.friends_count }}</p>
        <p>followers_count: {{ account.followers_count }}</p>
        <p>description: {{ account.description }}</p>
        <!-- <form method="POST" v-on:submit.prevent="follow" v-bind:value="account"> -->
        <!-- <input type="submit" />あああ -->
        <button v-on:click.prevent="follow(account)">フォロー</button>
        <!-- </form> -->
        <div class="p-account__card-tweet">{{ account.text }}</div>
      </div>
    </div>
  </div>
</template>

<script>
const config = {
  headers: {
    "Content-Type": "application/json",
    "Access-Control-Allow-Origin": "*",
    "Access-Control-Allow-Methods": "OPTIONS",
    "Access-Control-Allow-Headers": "Content-Type, Authorization",
    "Access-Control-Allow-Credentials": "true"
  }
};
export default {
  name: "AccountPanel",
  props: ["twitter_accounts", "user_mode"],

  data() {
    return {
      // accounts: [], //accountデータを入れるための空配列
      follow_ids: [],
      isChecked: this.user_mode
    };
  },
  computed: {
    accounts: function() {
      return this.twitter_accounts;
    },
    autoMode: {
      get() {
        return this.isChecked;
      },
      set() {
        this.isChecked = !this.isChecked;
      }
    }
  },
  methods: {
    follow: function(account) {
      // controllerに送る値(twitter_id)を設定
      console.log(account.twitter_id);
      axios
        .post("/account/follow", {
          twitter_id: account.twitter_id
        })

        .catch(error => console.log(error));
    },
    autoFollow: function(event) {
      if (this.autoMode === true) {
        console.log("自動フォローします");
        axios.post("/account/start");
      } else {
        console.log("自動フォロー終了");
        axios.post("/account/stop");
      }

      console.log("変更" + this.autoMode);
    }
  }

  // mounted: function() {
  //   axios
  //     .get("/api/account")
  //     // .then(response => console.log(response))
  //     .then(response => (this.accounts = response.data))
  //     .catch(response => console.log(response));
  // }
};
</script>