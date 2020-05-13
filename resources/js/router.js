import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import FeelingList from './pages/FeelingList.vue'
import Login from './pages/Login.vue'
import store from './store'
import SystemError from './pages/errors/System.vue'
import NoteDetail from './pages/NoteDetail.vue'

import sendpage from './pages/sendpage.vue'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
  {
    path: '/',
    component: FeelingList
  },
  {
    path: '/sendpage',
    component: sendpage
  },
  {
    path: '/notes/:id',
    component: NoteDetail,
    props: true
  },
  {
    path: '/login',
    component: Login,
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        next('/')
      } else {
        next()
      }
    }
  },
  {
    path: '/500',
    component: SystemError
  }
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
    mode: 'history',
    routes
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router