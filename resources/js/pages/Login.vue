<template>
  <div class="container--small">
    <ul class="tab">
      <li
        class="tab__item"
        :class="{'tab__item--active': tab === 1 }"
        @click="tab = 1"
      >ログイン</li>
      <li
        class="tab__item"
        :class="{'tab__item--active': tab === 2 }"
        @click="tab = 2"
      >ユーザー登録</li>
    </ul>
    <div class="panel" v-show="tab === 1">
      <form class="form" @submit.prevent="login">
          <div v-if="loginErrors" class="errors">
            <ul v-if="loginErrors.email">
              <li v-for="msg in loginErrors.email" :key="msg">{{ msg }}</li>
            </ul>
            <ul v-if="loginErrors.password">
              <li v-for="msg in loginErrors.password" :key="msg">{{ msg }}</li>
            </ul>
          </div>
        <label for="login-email">Email</label>
        <input type="text" class="form__item" id="login-email" v-model="loginForm.email">
        <label for="login-password">パスワード</label>
        <input type="password" class="form__item" id="login-password" v-model="loginForm.password">
        <div class="form__button">
          <button type="submit" class="button button--inverse">ログイン</button>
        </div>
      </form>
        <form class="form" @submit.prevent="guestlogin">
        <div class="guest_login">
          <input type="text" class="form__hidden" id="login-email" v-model="guestloginForm.email">
          <input type="password" class="form__hidden" id="login-password" v-model="guestloginForm.password">
          <button type="submit" class="guest" >ゲストログイン</button>
        </div>
        </form>
    </div>

    <div class="panel" v-show="tab === 2">
      <form class="form" @submit.prevent="register">
          <div v-if="registerErrors" class="errors">
            <ul v-if="registerErrors.name">
              <li v-for="msg in registerErrors.name" :key="msg">{{ msg }}</li>
            </ul>
            <ul v-if="registerErrors.email">
              <li v-for="msg in registerErrors.email" :key="msg">{{ msg }}</li>
            </ul>
            <ul v-if="registerErrors.password">
              <li v-for="msg in registerErrors.password" :key="msg">{{ msg }}</li>
            </ul>
          </div>
        <label for="username">名前</label>
        <input type="text" class="form__item" id="username" v-model="registerForm.name">
        <label for="email">Email</label>
        <input type="text" class="form__item" id="email" v-model="registerForm.email">
        <label for="password">パスワード</label>
        <input type="password" class="form__item" id="password" v-model="registerForm.password">
        <label for="password-confirmation">パスワード (確認)</label>
        <input type="password" class="form__item" id="password-confirmation" v-model="registerForm.password_confirmation">
        <div class="form__button">
          <button type="submit" class="button button--inverse">ユーザー登録</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  data () {
    return {
      tab: 1,
        loginForm: {
        email: '',
        password: ''
      },
      guestloginForm: {
        email: null,
        password: null
      },
      registerForm: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
  computed: mapState({
    apiStatus: state => state.auth.apiStatus,
    loginErrors: state => state.auth.loginErrorMessages,
    registerErrors: state => state.auth.registerErrorMessages
  }),
  methods: {
    async login () {
      // authストアのloginアクションを呼び出す
      await this.$store.dispatch('auth/login', this.loginForm)
      if (this.apiStatus) {
        // メッセージ登録
        this.$store.commit('message/setContent', {
            content: 'ようこそ！ログインができました。',
            timeout: 3000
        })
        // トップページに移動する
        this.$router.push('/')
      }
    },
    async guestlogin () {
      // authストアのloginアクションを呼び出す
      this.guestloginForm = {
            email: 'guest@laravel.com',
            password: 'feelingnote-guestuser'
      }
      await this.$store.dispatch('auth/login', this.guestloginForm)
      if (this.apiStatus) {
        // メッセージ登録
        this.$store.commit('message/setContent', {
            content: 'ゲストユーザーさん、ようこそ！！',
            timeout: 3000
        })
        // トップページに移動する
        this.$router.push('/')
      }
    },
    async register () {
      // authストアのresigterアクションを呼び出す
      await this.$store.dispatch('auth/register', this.registerForm)

      if (this.apiStatus) {
        // メッセージ登録
        this.$store.commit('message/setContent', {
            content: 'Feeling-notesの世界へようこそ！！',
            timeout: 3000
        })
        // トップページに移動する
        this.$router.push('/')
      }
    },
    clearError () {
      this.$store.commit('auth/setLoginErrorMessages', null)
      this.$store.commit('auth/setRegisterErrorMessages', null)
    }
  },
  created () {
    this.clearError()
  }
}
</script>
