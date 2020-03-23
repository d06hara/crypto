
// require('./bootstrap');
import './bootstrap'

// window.Vue = require('vue');
import Vue from 'vue';

// import InfiniteLoading from 'vue-infinite-loading';
// Vue.use(InfiniteLoading)
// import infinite from './infinite'
// import Multiselect from 'vue-multiselect';
// Vue.component('multiselect', Multiselect);


// import axios from 'axios';

Vue.component('account-panel', require('./components/AccountPanel.vue').default);
Vue.component('bland-panel', require('./components/BlandPanel.vue').default);
Vue.component('news-panel', require('./components/NewsPanel.vue').default);
Vue.component('my-page', require('./components/MyPage.vue').default);
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
    // infinite,
    // router,
    // components: {
    //     multiselect
    // },
    data: {
        aaa: 'あああ'
    }
});


$(function () {
    // ヘッダーの高さコンテンツを下げる
    var height = $(".js-l-header").height();
    $("body").css("margin-top", height);

    // フロートヘッダーメニュー
    var targetHeight = $('.js-float-menu-target').height();
    $(window).on('scroll', function () {
        $('.js-float-menu').toggleClass('float-active', $(this).scrollTop() > targetHeight);
    });


    // SPメニュー
    $('.js-toggle-sp-menu').on('click', function () {
        $(this).toggleClass('active');
        $('.js-toggle-sp-menu-target').toggleClass('active');
    });
});

