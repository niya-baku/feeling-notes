import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import error from './error'
import create from './create'
import message from './message'


Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    error,
    create,
    message
  }
})

export default store