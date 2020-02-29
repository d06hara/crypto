/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
import './bootstrap'

// window.Vue = require('vue');
import Vue from 'vue';
// import axios from 'axios';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('notifications-component', require('./components/NotificationsComponent.vue').default);
// Vue.component('test-test', require('./components/Test.vue').default);
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