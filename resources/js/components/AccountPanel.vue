<template>
  <div>
    <div>
      <input type="checkbox" v-model="autoMode" v-on:change="autoFollow" />
      <label for>自動フォロー</label>
      <p>テスト {{ autoMode }} （機能が完成したら削除</p>
    </div>

    <!-- pagination draft  todo:css修正 -->
    <div>
      <div class="c-pagination">
        <ul class="c-pagination__ul">
          <li :class="{disabled: current_page <= 1}">
            <a href="#" @click="change(1)">
              <span>&laquo;</span>
            </a>
          </li>
          <li :class="{disabled: current_page <= 1}">
            <a href="#" @click="change(current_page - 1)">
              <span>&lt;</span>
            </a>
          </li>
          <li v-for="page in pages" :key="page" :class="{active: page === current_page}">
            <a href="#" @click="change(page)">
              <span>{{page}}</span>
            </a>
          </li>
          <li :class="{disabled: current_page >= last_page}">
            <a href="#" @click="change(current_page + 1)">
              <span>&gt;</span>
            </a>
          </li>
          <li :class="{disabled: current_page >= last_page}">
            <a href="#" @click="change(last_page)">
              <span>&raquo;</span>
            </a>
          </li>
        </ul>
      </div>
      <div style="margin-top: 40px" class="col-sm-6 text-right">全 {{total}} 件中 {{from}} 〜 {{to}} 件表示</div>
    </div>
    <!-- pagination 終了 -->

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
        <!-- ボタントグルテスト用 -->
        <div>
          <button>ボタントグルテスト</button>
        </div>
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
      accounts: [], //accountデータを入れるための空配列
      follow_ids: [],
      isChecked: this.user_mode,
      page: 0,
      current_page: 1,
      last_page: 1,
      total: 1,
      from: 0,
      to: 0
    };
  },
  mounted() {
    this.load(1);
  },
  computed: {
    // accounts: function() {
    //   return this.twitter_accounts;
    // },
    autoMode: {
      get() {
        return this.isChecked;
      },
      set() {
        this.isChecked = !this.isChecked;
      }
    },
    pages() {
      let start = _.max([this.current_page - 2, 1]);
      let end = _.min([start + 5, this.last_page + 1]);
      start = _.max([end - 5, 1]);
      return _.range(start, end);
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

    // 自動フォロー機能
    autoFollow: function(event) {
      if (this.autoMode === true) {
        console.log("自動フォローします");
        axios.post("/account/start");
      } else {
        console.log("自動フォロー終了");
        axios.post("/account/stop");
      }

      console.log("変更" + this.autoMode);
    },
    load(page) {
      axios.get("/api/account?page=" + page).then(({ data }) => {
        this.accounts = data.data;
        this.current_page = data.current_page;
        this.last_page = data.last_page;
        this.total = data.total;
        this.from = data.from;
        this.to = data.to;
      });
    },
    change(page) {
      if (page >= 1 && page <= this.last_page) this.load(page);
    }
  }
  // mounted: function() {
  //   axios
  //     .get("/api/user")
  //     // .then(response => console.log(response))
  //     .then(response => (this.users = response.data.data))
  //     .catch(response => console.log(response));
  // }

  // mounted: function() {
  //   axios
  //     .get("/api/account")
  //     // .then(response => console.log(response))
  //     .then(response => (this.accounts = response.data.data))
  //     .catch(response => console.log(response));
  // }
};
</script>