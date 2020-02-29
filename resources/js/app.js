
// require('./bootstrap');
import './bootstrap'

// window.Vue = require('vue');
import Vue from 'vue';
// import axios from 'axios';

Vue.component('account-panel', require('./components/AccountPanel.vue').default);
// Components
import ExampleComponent from './components/ExampleComponent'
// import AccountLayout from './components/AccountLayout.vue'
import TestTest from './components/Test.vue'



const app = new Vue({
    el: '#app',
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