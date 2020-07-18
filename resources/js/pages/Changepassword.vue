
<template>
  <div class="container--small">
    <div class="panel" >
      <form class="form" @submit.prevent="changepassword">
          <div v-if="ChangeErrorMessages" class="errors">
            <ul v-if="ChangeErrorMessages.currentpassword">
              <li v-for="msg in ChangeErrorMessages.currentpassword" :key="msg">{{ msg }}</li>
            </ul>
            <ul v-if="ChangeErrorMessages.newpassword">
              <li v-for="msg in ChangeErrorMessages.newpassword" :key="msg">{{ msg }}</li>
            </ul>
          </div>
        <label for="login-email">Current Password</label>
        <input type="password" class="form__item" id="login-email" v-model="changepasswordForm.currentpassword">
        <label for="login-password">New Password</label>
        <input type="password" class="form__item" id="login-password" v-model="changepasswordForm.newpassword">
        <label for="login-password">New Password(Confirmation)</label>
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
      currentpassword: '',
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
      this.$store.commit('auth/setChangeErrorMessages', null)
    }
  },
  created () {
    this.clearError()
  }
}
</script>
