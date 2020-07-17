
<template>
  <div class="container--small">
    <div class="panel" @submit.prevent="changepassword">
      <form class="form">
        <label for="login-email">OLD Password</label>
        <input type="password" class="form__item" id="login-email" v-model="changepasswordForm.oldpassword">
        <label for="login-password">NEW Password</label>
        <input type="password" class="form__item" id="login-password" v-model="changepasswordForm.newpassword">
        <label for="login-password">NEW Password(Confirmation)</label>
        <input type="password" class="form__item" id="login-password" v-model="changepasswordForm.newpassword_confirmation">
        <div class="form__button">
          <button type="submit" class="button button--inverse">NEW Password Create</button>
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
    changepasswordForm: {
      oldpassword: '',
      newpassword: '',
      newpassword_confirmation: ''
      }
    }
  },
  computed: mapState({
      apiStatus: state => state.auth.apiStatus,
      ChangeErrorMessages: state => state.auth.ChangeErrorMessages
    }),
  methods: {
    async changepassword () {
      // authストアのresigterアクションを呼び出す
      await this.$store.dispatch('auth/changepassword', this.changepasswordForm)

      if (this.apiStatus) {
        // メッセージ登録
        this.$store.commit('message/setContent', {
            content: 'パスワードが変更されました！',
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
