import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import error from './error'
import create from './create'


Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    error,
    create
  }
})

export default store