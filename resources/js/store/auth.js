import { OK, CREATED, UNPROCESSABLE_ENTITY } from '../util'

const state = {
    user: null,
    apiStatus: null,
    loginErrorMessages: null,
    registerErrorMessages: null,
    ChangeErrorMessages: null,
    guestuser: 'ゲストユーザー'
  }

  const getters = {
    check: state => !! state.user,
    username: state => state.user ? state.user.name : '',
    usercheck: state => state.guestuser
  }

  const mutations = {
    setUser (state, user) {
      state.user = user
    },
    setApiStatus (state, status) {
      state.apiStatus = status
    },
    setLoginErrorMessages (state, messages) {
      state.loginErrorMessages = messages
    },
    setRegisterErrorMessages (state, messages) {
      state.registerErrorMessages = messages
    },
    setChangeErrorMessages (state, messages) {
      state.ChangeErrorMessages = messages
    }
  }

  const actions = {
    // 会員登録
    async register (context, data) {
      context.commit('setApiStatus', null)
      const response = await axios.post('/api/register', data)

      if (response.status === CREATED) {
        context.commit('setApiStatus', true)
        context.commit('setUser', response.data)
        return false
      }

      context.commit('setApiStatus', false)
      if (response.status === UNPROCESSABLE_ENTITY) {
        context.commit('setRegisterErrorMessages', response.data.errors)
      } else {
        context.commit('error/setCode', response.status, { root: true })
      }
    },

    // PW変更
    async changepassword (context, data) {
      context.commit('setApiStatus', null)
      const response = await axios.post('/api/changepassword', data)
      if (response.status ===  OK) {
        context.commit('setApiStatus', true)
        context.commit('setUser', response.data)
        return false
      }

      context.commit('setApiStatus', false)
      if (response.status === UNPROCESSABLE_ENTITY) {
        context.commit('setChangeErrorMessages', response.data.errors)
      } else {
        context.commit('error/setCode', response.status, { root: true })
      }
    },

    //ログイン
    async login (context, data) {
      context.commit('setApiStatus', null)
      const response = await axios.post('/api/login', data)
        .catch(err => err.response || err)

      if (response.status === OK) {
        context.commit('setApiStatus', true)
        context.commit('setUser', response.data)
        return false
      }
      context.commit('setApiStatus', false)
      if (response.status === UNPROCESSABLE_ENTITY) {
        context.commit('setLoginErrorMessages', response.data.errors)
      } else {
        context.commit('error/setCode', response.status, { root: true })
      }
    },

    //ゲストログイン
    async guestlogin (context, data) {
      context.commit('setApiStatus', null)
      const response = await axios.post('/api/login', data)
        .catch(err => err.response || err)

      if (response.status === OK) {
        context.commit('setApiStatus', true)
        context.commit('setUser', response.data)
        return false
      }
      context.commit('setApiStatus', false)
      if (response.status === UNPROCESSABLE_ENTITY) {
        context.commit('setLoginErrorMessages', response.data.errors)
      } else {
        context.commit('error/setCode', response.status, { root: true })
      }
    },

    //ログアウト
    async logout (context) {
      context.commit('setApiStatus', null)
      const response = await axios.post('/api/logout')

      if (response.status === OK) {
        context.commit('setApiStatus', true)
        context.commit('setUser', null)
        return false
      }

      context.commit('setApiStatus', false)
      context.commit('error/setCode', response.status, { root: true })
    },
    // ログインユーザーチェック
    async currentUser (context) {
      context.commit('setApiStatus', null)
      const response = await axios.get('/api/user')
      const user = response.data || null

      if (response.status === OK) {
        context.commit('setApiStatus', true)
        context.commit('setUser', user)
        return false
      }

      context.commit('setApiStatus', false)
      context.commit('error/setCode', response.status, { root: true })
    }
  }

  export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
  }
