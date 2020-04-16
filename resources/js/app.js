
import './bootstrap'

// IE対応
import "core-js/stable";
import "regenerator-runtime/runtime";

import Vue from 'vue';

import InfiniteLoading from 'vue-infinite-loading';
Vue.use(InfiniteLoading)

Vue.component('account-panel', require('./components/AccountPanel.vue').default);
Vue.component('bland-panel', require('./components/BlandPanel.vue').default);
Vue.component('news-panel', require('./components/NewsPanel.vue').default);

Vue.config.devtools = true;

const app = new Vue({
    el: '#app',
    data: {
    }
});

$(function () {
    // フロートヘッダーメニュー
    var targetHeight = $('.js-float-menu').height();
    $(window).on('scroll', function () {
        $('.js-float-menu').toggleClass('float-active', $(this).scrollTop() > targetHeight);
    });
    // ハンバーガーメニュー
    $('.js-toggle-sp-menu').on('click', function () {
        $(this).toggleClass('active');
        $('.js-toggle-sp-menu-target').toggleClass('active');
    });
    // flash_messageのfadeout
    $('#c-flash').fadeOut(5000);
});

