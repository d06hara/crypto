<template>
  <div class="p-mypage">
    <div class="c-profile">
      <div class="c-profile__name">
        name:
        <span>{{ user.name }}</span>
      </div>
      <div class="c-profile__email">
        email:
        <span>{{ user.email }}</span>
      </div>
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
            <a href="/withdraw">退会</a>
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
  },
  methods: {
    // プロフィール編集
    edit: function() {
      console.log("プロフィールを編集します");

      axios
        .post("/mypage/edit", {
          name: user.name,
          email: user.email
        })

        .catch(error => console.log(error));
    }
  }
};
</script>