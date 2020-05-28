import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import error from './error'
import create from './create'
import message from './message'
import deletemessage from './deletemessage'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    error,
    create,
    message,
    deletemessage
  }
})

export default store