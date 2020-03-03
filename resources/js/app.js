
// require('./bootstrap');
import './bootstrap'

// window.Vue = require('vue');
import Vue from 'vue';

// import axios from 'axios';

Vue.component('account-panel', require('./components/AccountPanel.vue').default);
Vue.component('bland-panel', require('./components/BlandPanel.vue').default);
// Components
import ExampleComponent from './components/ExampleComponent'
// import AccountLayout from './components/AccountLayout.vue'
import TestTest from './components/Test.vue'

Vue.config.devtools = true;
const config = {
    headers: {
        "Content-Type": "application/json",
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Methods": "OPTIONS",
        "Access-Control-Allow-Headers": "Content-Type, Authorization",
        "Access-Control-Allow-Credentials": "true",

    }
}



const app = new Vue({
    el: '#app',
    // router,
    // components: {
    //     ExampleComponent,
    //     TestTest,
    // },
    data: {
        aaa: 'あああ'
    }
});

// ヘッダーの高さコンテンツを下げる
$(function () {
    var height = $(".js-l-header").height();
    $("body").css("margin-top", height);
});