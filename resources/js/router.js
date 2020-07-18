import Vue from 'vue'
import VueRouter from 'vue-router'


// ページコンポーネントをインポートする
import FeelingList from './pages/FeelingList.vue'
import Login from './pages/Login.vue'
import Changepassword from './pages/Changepassword.vue'
import store from './store'
import SystemError from './pages/errors/System.vue'
import NoteDetail from './pages/NoteDetail.vue'
import Chartlist from './pages/Chartlist.vue'
import Columnlist from './pages/Columnlist.vue'
import ColumnDetail from './pages/ColumnDetail.vue'
import NotFound from './pages/errors/NotFound.vue'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
  {
    path: '/',
    component: FeelingList,
    props: route => {
      const page = route.query.page
      return { page: /^[1-9][0-9]*$/.test(page) ? page * 1 : 1 }
    }
  },
  {
    path: '/notes/:id',
    component: NoteDetail,
    props: true,
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/login')
      }
    }
  },
  {
    path: '/chart',
    component: Chartlist,
    props: true,
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/login')
      }
    }
  },
  {
    path: '/columns',
    component: Columnlist,
    props: route => {
      const page = route.query.page
      return { page: /^[1-9][0-9]*$/.test(page) ? page * 1 : 1 }
    },
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/login')
      }
    }
  },
  {
    path: '/columns/:id',
    component: ColumnDetail,
    props: true,
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/login')
      }
    }
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
    path: '/changepassword',
    component: Changepassword,
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        if(store.getters['auth/username'] != store.getters['auth/usercheck']){
          next()
        }else{
          next('/')
        }
      } else {
        next('/login')
      }
    }
  },
  {
    path: '/500',
    component: SystemError
  },
  {
    path: '*',
    component: NotFound
  }
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
    mode: 'history',
    scrollBehavior () {
      return { x: 0, y: 0 }
    },
    routes
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router
