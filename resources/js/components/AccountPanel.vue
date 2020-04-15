<template>
  <div class="p-account">
    <div class="p-account-contents">
      <!-- 自動フォローボタン -->
      <div class="p-account-contents__auto">
        <label for="auto_follow" class="u-checkbox">
          <input
            id="auto_follow"
            class="u-checkbox__input"
            type="checkbox"
            v-bind:checked="autoMode"
            @change="autoFollow"
          />
          <span class="u-checkbox__dummy u-checkbox__dummy--checked"></span>
          <span class="u-checkbox__labeltext">自動フォロー(チェックすると自動フォローが開始します)</span>
        </label>
      </div>

      <!-- アカウントカード -->
      <div class="p-account-contents__card">
        <div class="accountcard__container">
          <div v-for="(account, index) in accounts" class="c-accountcard" :key="index">
            <p class="c-accountcard__name">
              {{ account.name }}
              <span class="c-accountcard__name--accent">@{{ account.screen_name }}</span>
            </p>

            <button
              class="c-accountcard__btn"
              v-on:click="followUnfollow(account)"
              v-bind:class="{ active: account.users }"
            >
              <p v-if="account.users">フォロー中</p>
              <p v-else>フォローする</p>
            </button>

            <ul class="c-accountcard-data">
              <li class="c-accountcard-data__item">
                {{ account.friends_count }}
                <span class="c-accountcard-data__item--accent">Following</span>
              </li>
              <li class="c-accountcard-data__item">
                {{ account.followers_count }}
                <span class="c-accountcard-data__item--accent">Follower</span>
              </li>
            </ul>
            <p class="c-accountcard__profile">{{ account.description }}</p>

            <p class="c-accountcard__tweet">{{ account.text }}</p>
          </div>
        </div>
      </div>

      <infinite-loading @infinite="infiniteHandler" spinner="spiral">
        <!-- 読み込みデータが終了した時は何も表示しない -->
        <span slot="no-more"></span>
      </infinite-loading>
    </div>
  </div>
</template>

<script>
export default {
  name: "AccountPanel",

  props: ["user_mode"],

  data() {
    return {
      accounts: [], //accountデータを入れるための空配列
      isChecked: this.user_mode, //auto_mode初期ステータス
      page: 0
    };
  },

  computed: {
    /**
     * ユーザーが自動フォロー状態か判定
     */
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
    /**
     * 無限ロード
     */
    infiniteHandler($state) {
      axios
        .get("/api/account", {
          params: {
            page: this.page
          }
        })
        .then(({ data }) => {
          //そのままだと読み込み時にカクつくので1500毎に読み込む
          setTimeout(() => {
            // 5ページ目以上がgetされたらload終了
            if (this.page < 5) {
              this.page += 1;
              this.accounts.push(...data);
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
    /**
     * フォロー、アンフォロー
     */
    followUnfollow: function(account) {
      if (account.users === true) {
        // --------------------------
        // 既にフォローしている場合
        // アンフォロー処理
        // --------------------------

        // post処理
        // アカウントのDB内id,twitter_id,screen_nameをサーバーに渡す
        axios
          .post("/account/unfollow", {
            account_id: account.id,
            twitter_id: account.twitter_id,
            screen_name: account.screen_name
          })
          .then(response => {
            if (response.status === 200) {
              // ボタンを未フォロー状態に反転
              account.users = !account.users;
            }
          })
          .catch(error => console.log(error));
      } else {
        // --------------------------
        // 未フォローの場合
        // フォロー処理
        // --------------------------

        // pose処理
        // アカウントのDB内idとtwitter_id,screen_nameをサーバーに渡す
        axios
          .post("/account/follow", {
            account_id: account.id,
            twitter_id: account.twitter_id,
            screen_name: account.screen_name
          })
          .then(response => {
            if (response.status === 200) {
              // ボタンをフォロー済み状態に反転
              account.users = !account.users;
            }
          })
          .catch(error => console.log(error));
      }
    },

    /**
     * 自動フォロー
     */
    autoFollow: function() {
      // autoModeがfalseの時自動フォロー開始
      if (this.autoMode === false) {
        axios.post("/account/start").then(response => {
          if (response.status === 200) {
            // isCheckedを反転
            this.isChecked = !this.isChecked;
          }
        });
      } else {
        // autoModeがtrueの時自動フォロー停止
        axios.post("/account/stop").then(response => {
          if (response.status === 200) {
            // isCheckedを反転
            this.isChecked = !this.isChecked;
          }
        });
      }
    }
  }
};
</script>