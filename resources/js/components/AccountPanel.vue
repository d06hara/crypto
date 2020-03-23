<template>
  <div class="p-account">
    <!-- 自動フォローボタン -->
    <div class="p-account__auto">
      <input type="checkbox" v-model="autoMode" v-on:change="autoFollow" />
      <label for>自動フォロー</label>
      <p>テスト {{ autoMode }} （機能が完成したら削除</p>
    </div>

    <!-- アカウント件数 -->
    <div class="p-account__total">
      <p>全 {{total}} 件中 {{from}} 〜 {{to}} 件表示</p>
    </div>

    <!-- アカウントカード -->
    <div class="p-account__container">
      <div class="c-accountcard__container">
        <div v-for="account in reAccounts" class="c-accountcard" :key="account.id">
          <!-- <p>twitter_id:{{ account.twitter_id }}</p> -->
          <p class="c-accountcard__name">
            {{ account.name }}
            <span>@{{ account.screen_name }}</span>
          </p>
          <div class="c-accountcard__btn">
            <button v-on:click.prevent="follow(account)">フォロー</button>
          </div>
          <ul class="c-accountcard__data">
            <li>
              {{ account.friends_count }}
              <span>Following</span>
            </li>
            <li>
              {{ account.followers_count }}
              <span>Follower</span>
            </li>
          </ul>

          <!-- ボタントグルテスト用 -->
          <!-- <div>
            <p>テスト：{{ account.users }}</p>
            <button v-bind:class="{ active: account.users }">ボタントグルテスト</button>
          </div>-->
          <div class="c-accountcard__tweet">{{ account.text }}</div>
        </div>
      </div>
    </div>

    <!-- pagination draft  todo:css修正 -->
    <div class="p-account__pagination">
      <div class="p-account__pagination-content">
        <ul class="c-pagination">
          <li class="c-pagination__list" :class="{disabled: current_page <= 1}">
            <a href="#" class="c-pagination__list-link" @click="change(1)">
              <span>&laquo;</span>
            </a>
          </li>
          <li
            class="c-pagination__list c-pagination__list-pre"
            :class="{disabled: current_page <= 1}"
          >
            <a href="#" class="c-pagination__list-link" @click="change(current_page - 1)">
              <span>&lt;</span>
            </a>
          </li>
          <li
            class="c-pagination__list"
            v-for="page in pages"
            :key="page"
            :class="{active: page === current_page}"
          >
            <a href="#" class="c-pagination__list-link" @click="change(page)">
              <span>{{page}}</span>
            </a>
          </li>
          <li
            class="c-pagination__list c-pagination__list-next"
            :class="{disabled: current_page >= last_page}"
          >
            <a href="#" class="c-pagination__list-link" @click="change(current_page + 1)">
              <span>&gt;</span>
            </a>
          </li>
          <li class="c-pagination__list" :class="{disabled: current_page >= last_page}">
            <a href="#" class="c-pagination__list-link" @click="change(last_page)">
              <span>&raquo;</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- pagination 終了 -->
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
      current_page: 1,
      last_page: 1,
      total: 1,
      from: 0,
      to: 0
    };
  },
  created() {
    console.log("create");
    this.load(1);
    // this.reAccounts;
  },
  mounted() {
    console.log("load");
    // this.load(1);
    this.accounts.forEach(function(object, index) {
      if (object.users[0]) {
        return this.$set(this.accounts[index], "users", true);
      } else {
        return this.$set(this.accounts[index], "users", false);
      }
    });
  },
  computed: {
    reAccounts: function() {
      console.log("reaccounts");
      return this.accounts.map(function(element) {
        if (element.users[0]) {
          return { ...element, users: true };
        }
        return { ...element, users: false };
      });
      // return this.accounts.forEach(function(object, index) {
      //   if (object.users[0]) {
      //     return this.$set(this.accounts[index], "users", true);
      //   } else {
      //     return this.$set(this.accounts[index], "users", false);
      //   }
      // });

      // return this.accounts.forEach((object, index) => {
      //   if (object[index].users[0]) {
      //     this.$set(this.accounts[index], users[0], true);
      //   }
      //   this.$set(this.object[index], users[0], false);
      // });
      // if (this.accounts.users) {
      //   return { ...this.accounts, users: true };
      // }
      // return { ...this.accounts, users: false };
      // if (element.users[0]) {
      //   this.$set((this.accounts.users = true));
      // }
      // this.$set((this.accounts.users = false));
    },
    // reAccounts: {
    //   get() {
    //     return this.accounts;
    //   },
    //   set() {
    //     return this.accounts.map(function(element, index, array) {
    //       if (element.users[0]) {
    //         return (element.users = true);
    //       }
    //       return (element.users = false);
    //     });
    //   }
    // },
    pages() {
      let start = _.max([this.current_page - 2, 1]);
      let end = _.min([start + 5, this.last_page + 1]);
      start = _.max([end - 5, 1]);
      return _.range(start, end);
    },
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
    }
  },
  methods: {
    // フォロー機能
    follow: function(account) {
      // controllerに送る値(twitter_id)を設定
      console.log(account.twitter_id);

      axios
        .post("/account/follow", {
          // DB登録に必要なaccount_idとapiに必要なtwitter_idを取得
          account_id: account.id,
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
      console.log("loadします");
      axios.get("/api/account?page=" + page).then(({ data }) => {
        console.log(data);
        this.accounts = data.data;
        this.current_page = data.current_page;
        this.last_page = data.last_page;
        this.total = data.total;
        this.from = data.from;
        this.to = data.to;
      });
    },
    change(page) {
      if (page >= 1 && page <= this.last_page) {
        this.load(page);
      }
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