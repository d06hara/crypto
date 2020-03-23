<template>
  <div class="p-mypage">
    <div class="p-mypage__left">
      <div class="p-mybrand">
        <p class="p-mybrand__title">マイ銘柄</p>
        <div class="p-mybrand__card-container">
          <div class="p-mybrand__card p-ranking__brand-container">
            <p class="p-mybrand__card-name">ビットコイン</p>
          </div>
          <div class="p-mybrand__card p-ranking__brand-container">
            <p class="p-mybrand__card-name">リップル</p>
          </div>
          <div class="p-mybrand__card p-ranking__brand-container">
            <p class="p-mybrand__card-name">＋</p>
          </div>
        </div>
      </div>
    </div>
    <div>
      <p>{{ user.name }}</p>
    </div>

    <div class="p-mypage__right">
      <div class="p-mypage__menu">
        <ul>
          <li>
            <a href>プロフィール編集</a>
          </li>
          <li>
            <a href>パスワード変更</a>
          </li>
          <li>
            <a href>退会</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MyPage",
  // props: ["user"],
  data() {
    return {
      user: []
    };
  },
  mounted() {
    console.log("user情報を読み込みます");
    let self = this;
    axios
      .get("api/mypage")
      .then(function(response) {
        console.log(response);
        self.user = response.data;
      })
      .catch(error => console.log(error));
  }
};
</script>