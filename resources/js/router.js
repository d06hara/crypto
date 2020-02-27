import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import AccountList from './pages/AccountList.vue'
import Login from './pages/Login.vue'

// VueRouterプラグインを使用する
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
  {
    path: '/',
    component: AccountList
  },
  {
    path: '/login',
    component: Login
  }
]

// VueRouterインスタンスを作成
const router = new VueRouter({
  routes
})

// app.jsでインポートするためVueRouterインスタンスをエクスポート
export default router