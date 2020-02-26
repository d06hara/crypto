<template>
  <div>
    <div>
      <ul>
        <li v-for="user in users">{{ user.name }}</li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  // created() {
  //   this.getUsers();
  // },
  data() {
    return {
      users: []
    };
  },
  mounted: function() {
    axios
      .get("/aaa")
      // .then(response => console.log(response))
      .then(response => (this.users = response.data))
      .catch(response => console.log(response));
  }
  // mounted() {
  //   axios.get("/api/test").then(function(response) {
  //     this.users = response.data;
  //   });
  // }
  // mounted() {
  //   axios
  //     .get("https://api.coindesk.com/v1/bpi/currentprice.json")
  //     .then(response => (this.info = response));
  // }
  // methods: {
  //   getUsers() {
  //     this.$http.get("/api/test").then(function(response) {
  //       this.users = response.data;
  //     });
  //   }
  // }
};
</script>