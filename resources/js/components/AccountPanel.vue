<template>
  <div class="p-account__card">
    <p>id{{ accounts.name }}</p>
    <p>name</p>
    <form>
      <button></button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data: function() {
    return {
      accounts: [] //accountデータを入れるための空配列
    };
  },
  mounted() {
    axios.get("/account").then(function(response) {
      self.accounts = response.data;
    });
  }
};
</script>