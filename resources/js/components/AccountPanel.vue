<template>
  <div class="p-account">
    <!-- 自動フォローボタン -->
    <div class="p-account__auto">
      <!-- <input id="auto_follow" type="checkbox" v-model="autoMode" /> -->
      <!-- <input id="auto_follow" type="checkbox" v-model="autoMode" v-on:change="autoFollow" /> -->

      <label for="auto_follow" class="u-checkbox">
        <input
          id="auto_follow"
          class="u-checkbox__input"
          type="checkbox"
          v-bind:checked="autoMode"
          @change="autoFollow"
        />
        <span class="u-checkbox__dummy"></span>
        <span class="u-checkbox__labeltext">自動フォロー(チェックすると自動フォローが開始します)</span>
      </label>
      <!-- <p>テスト {{ autoMode }} （機能が完成したら削除</p> -->
    </div>

    <!-- アカウント件数 -->
    <!-- <div class="p-account__total">
      <p>全 {{total}} 件中 {{from}} 〜 {{to}} 件表示</p>
    </div>-->
    <!-- accounts pagination todo css -->
    <!-- <div class="p-news__pagination">
      <div class="p-news__pagination-content">
        <ul class="c-pagination">
          <li class="c-pagination__list c-pagination__list-pre">
            <a @click="first" class="c-pagination__list-link" href="#">&laquo;</a>
          </li>
          <li class="c-pagination__list">
            <a @click="prev" class="c-pagination__list-link" href="#">&lt;</a>
          </li>

          <li
            v-for="(i, index) in displayPageRange"
            :key="index"
            class="c-pagination__list"
            :class="{active: i-1 === currentPage}"
          >
            <a @click="pageSelect(i)" class="c-pagination__list-link" href="#">{{ i }}</a>
          </li>

          <li class="c-pagination__list">
            <a @click="next" class="c-pagination__list-link" href="#">&gt;</a>
          </li>
          <li class="c-pagination__list c-pagination__list-next">
            <a @click="last" class="c-pagination__list-link" href="#">&raquo;</a>
          </li>
        </ul>
      </div>
    </div>-->

    <!-- アカウントカード -->
    <div class="p-account__container">
      <div class="c-accountcard__container">
        <div v-for="(account, index) in accounts" class="c-accountcard" :key="index">
          <!-- <p>twitter_id:{{ account.twitter_id }}</p> -->
          <p class="c-accountcard__name">
            {{ account.name }}
            <span>@{{ account.screen_name }}</span>
          </p>
          <div class="c-accountcard__btn">
            <button v-on:click="followUnfollow(account)" v-bind:class="{ active: account.users }">
              <p v-if="account.users">フォロー中</p>
              <p v-else>フォローする</p>
            </button>
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
          <div class="c-accountcard__profile">{{ account.description }}</div>

          <!-- ボタントグルテスト用 -->
          <!-- <div>
            <p>テスト：{{ account.users }}</p>
            <button v-bind:class="{ active: account.users }">ボタントグルテスト</button>
          </div>-->

          <div class="c-accountcard__tweet">{{ account.text }}</div>
        </div>
      </div>
    </div>

    <infinite-loading @infinite="infiniteHandler" spinner="spiral">
      <span slot="no-more">no more data</span>
    </infinite-loading>

    <!-- pagination draft  todo:css修正 -->
    <!-- <div class="p-account__pagination">
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
    </div>-->
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
  // props: [
  //   ("user_mode": {
  //     type: Boolean
  //   });
  // ], //使用者のauto_mode
  props: ["user_mode"],
  // props: {
  //   user_mode
  //   // user_mode: {
  //   //   // type: Number
  //   // }
  //   // user_mode: {
  //   //   coerce: function($val) {
  //   //     return Boolean($val);
  //   //   }
  //   // }
  // },

  data() {
    return {
      accounts: [], //accountデータを入れるための空配列
      follow_ids: [],
      isChecked: this.user_mode, //auto_mode初期ステータス
      page: 1,
      // current_page: 1,
      // last_page: 1,
      // total: 1,
      // from: 0,
      // to: 0,
      size: 10, // 1ページに表示するアイテムの上限
      pageRange: 10, // ページネーションに表示するページ数の上限
      currentPage: 0 // 現在のページ番号
    };
  },
  // created() {
  //   console.log("create");
  //   this.load(1);
  //   // this.reAccounts;
  // },
  mounted() {
    console.log("mounted");
    // this.infiniteHandler();
    // this.load(1);
    // this.reAccounts;
  },
  // mounted() {
  //   console.log("load");
  //   // this.load(1);
  //   this.accounts.forEach(function(object, index) {
  //     if (object.users[0]) {
  //       return this.$set(this.accounts[index], "users", true);
  //     } else {
  //       return this.$set(this.accounts[index], "users", false);
  //     }
  //   });
  // },
  computed: {
    // reAccounts: function() {
    //   console.log("reaccounts");
    //   // return this.accounts.map(function(element) {
    //   //   if (element.users[0]) {
    //   //     return { ...element, users: true };
    //   //   }
    //   //   return { ...element, users: false };
    //   // });
    //   // -------------------------
    //   // return this.accounts.forEach(function(object, index) {
    //   //   if (object.users[0]) {
    //   //     return this.$set(this.accounts[index], "users", true);
    //   //   } else {
    //   //     return this.$set(this.accounts[index], "users", false);
    //   //   }
    //   // });
    //   // return this.accounts.forEach((object, index) => {
    //   //   if (object[index].users[0]) {
    //   //     this.$set(this.accounts[index], users[0], true);
    //   //   }
    //   //   this.$set(this.object[index], users[0], false);
    //   // });
    //   // if (this.accounts.users) {
    //   //   return { ...this.accounts, users: true };
    //   // }
    //   // return { ...this.accounts, users: false };
    //   // if (element.users[0]) {
    //   //   this.$set((this.accounts.users = true));
    //   // }
    //   // this.$set((this.accounts.users = false));
    // },
    // /**
    //  * ページ数を取得する
    //  * @return {number} 総ページ数(1はじまり)
    //  */
    // pages() {
    //   return Math.ceil(this.accounts.length / this.size);
    // },
    // /**
    //  * ページネーションで表示するページ番号の範囲を取得する
    //  * @return {Array<number>} ページ番号の配列
    //  */
    // displayPageRange() {
    //   const half = Math.ceil(this.pageRange / 2);
    //   let start, end;
    //   if (this.pages < this.pageRange) {
    //     // ページネーションのrangeよりページ数がすくない場合
    //     start = 1;
    //     end = this.pages;
    //   } else if (this.currentPage < half) {
    //     // 左端のページ番号が1になったとき
    //     start = 1;
    //     end = start + this.pageRange - 1;
    //   } else if (this.pages - half < this.currentPage) {
    //     // 右端のページ番号が総ページ数になったとき
    //     end = this.pages;
    //     start = end - this.pageRange + 1;
    //   } else {
    //     // activeページを中央にする
    //     start = this.currentPage - half + 1;
    //     end = this.currentPage + half;
    //   }
    //   let indexes = [];
    //   for (let i = start; i <= end; i++) {
    //     indexes.push(i);
    //   }
    //   return indexes;
    // },
    // /**
    //  * 現在のページで表示するアイテムリストを取得する
    //  * @return {any} 表示用アイテムリスト
    //  */
    // displayItems() {
    //   const head = this.currentPage * this.size;
    //   return this.accounts.slice(head, head + this.size);
    // },
    // /**
    //  * 現在のページかどうか判定する
    //  * @param {number} page ページ番号
    //  * @return　{boolean} 現在のページならtrue
    //  */
    // isSelected(page) {
    //   return page - 1 === this.currentPage;
    // },
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
    // pages() {
    //   let start = _.max([this.current_page - 2, 1]);
    //   let end = _.min([start + 5, this.last_page + 1]);
    //   start = _.max([end - 5, 1]);
    //   return _.range(start, end);
    // },
    // accounts: function() {
    //   return this.twitter_accounts;
    // },
    // 画面表示した時ユーザーが自動フォロー状態かどうかを表示する
    autoMode: {
      get() {
        console.log(this.isChecked);
        if (this.isChecked === true) {
          console.log("自動フォロー中です");
        } else {
          console.log("自動フォロー停止中です");
        }
        return this.isChecked;
      },
      set() {
        // if (this.isChecked === true) {
        //   console.log("自動フォロー停止します");
        //   axios.post("/account/stop");
        // } else {
        //   console.log("自動フォロー開始します");
        //   axios.post("/account/start");
        // }
        this.isChecked = !this.isChecked;
      }
    }
  },
  methods: {
    infiniteHandler($state) {
      //web.phpで設定したルーティング
      console.log("読み込みます");
      axios
        .get("/api/account", {
          params: {
            page: this.page,
            per_page: 1
          }
        })
        .then(({ data }) => {
          console.log(data);
          //そのままだと読み込み時にカクつくので1500毎に読み込む

          // if (this.page < data.data.length) {
          //   console.log("次のページｗ読み込みます");
          //   this.page += 1;
          //   this.accounts.push(...data.data);
          //   $state.loaded();
          // } else {
          //   $state.complete();
          // }

          setTimeout(() => {
            if (this.page < data.data.length) {
              console.log("次のページｗ読み込みます");
              this.page += 1;
              this.accounts.push(...data.data);
              $state.loaded();
            } else {
              $state.complete();
            }
          }, 1500);
        })
        .catch(err => {
          $state.complete();
        });
    },
    // フォロー.アンフォロー機能
    followUnfollow: function(account) {
      // account.users === true  既にフォロー済み
      // account.users === false 未フォロー

      if (account.users === true) {
        // --------------------------
        // 既にフォローしている場合
        // アンフォロー処理
        // --------------------------
        console.log(account.twitter_id + "をアンフォローします");

        // ボタンを未フォロー状態に反転
        account.users = !account.users;

        // post処理
        // アカウントのDB内idとtwitter_id,screen_nameをサーバーに渡す
        axios
          .post("/account/unfollow", {
            account_id: account.id,
            twitter_id: account.twitter_id,
            screen_name: account.screen_name
          })
          .catch(error => console.log(error));
      } else {
        // --------------------------
        // 未フォローの場合
        // フォロー処理
        // --------------------------
        console.log(account.twitter_id + "をフォローします");

        // ボタンをフォロー済み状態に反転
        account.users = !account.users;

        // pose処理
        // アカウントのDB内idとtwitter_id,screen_nameをサーバーに渡す
        axios
          .post("/account/follow", {
            account_id: account.id,
            twitter_id: account.twitter_id,
            screen_name: account.screen_name
          })
          .catch(error => console.log(error));
      }
    },

    // 自動フォロー機能
    // auto_mode
    autoFollow: function() {
      this.isChecked = !this.isChecked;
      // if (this.isChecked === true) {
      //   console.log("自動フォローします");
      //   axios.post("/account/start");
      // } else {
      //   console.log("自動フォロー終了");
      //   axios.post("/account/stop");
      // }
      if (this.autoMode === true) {
        console.log("自動フォローします");
        axios.post("/account/start");
      } else {
        console.log("自動フォロー終了");
        axios.post("/account/stop");
      }
    },
    load(page) {
      console.log("loadします");
      axios.get("/api/account?page=" + page).then(({ data }) => {
        console.log(data);
        // this.accounts = data.data;
        // this.current_page = data.current_page;
        // this.last_page = data.last_page;
        // this.total = data.total;
        // this.from = data.from;
        // this.to = data.to;
        this.accounts = data.data;
        this.current_page = data.current_page;
        this.per_page = data.per_page;
        this.last_page = data.last_page;
        this.total = data.total;
        this.from = data.from;
        this.to = data.to;
      });
    }
    // /**
    //  * ページ先頭に移動する
    //  */
    // first() {
    //   this.currentPage = 0;
    //   this.selectHandler();
    // },
    // /**
    //  * ページ後尾に移動する
    //  */
    // last() {
    //   this.currentPage = this.pages - 1;
    //   this.selectHandler();
    // },
    // /**
    //  * 1ページ前に移動する
    //  */
    // prev() {
    //   if (0 < this.currentPage) {
    //     this.currentPage--;
    //     this.selectHandler();
    //   }
    // },
    // /**
    //  * 1ページ次に移動する
    //  */
    // next() {
    //   if (this.currentPage < this.pages - 1) {
    //     this.currentPage++;
    //     this.selectHandler();
    //   }
    // },
    // /**
    //  * 指定したページに移動する
    //  * @param {number} index ページ番号
    //  */
    // pageSelect(index) {
    //   this.currentPage = index - 1;
    //   this.selectHandler();
    // },
    // /**
    //  * ページを変更したときの処理
    //  */
    // selectHandler() {
    //   // なんかの処理
    // }
    // change(page) {
    //   if (page >= 1 && page <= this.last_page) {
    //     this.load(page);
    //   }
    // }
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