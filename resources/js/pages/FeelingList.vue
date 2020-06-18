<template>
  <div class="photo-list">
    <div class="grid" media="(min-width: 320px) and (max-width: 639px)">
      <Note 
        class="grid__item"
        v-for="note in notes"
        :key="note.id"
        :item="note"
        v-if="isLogin"
      />
    </div>
    <Pagination v-if="isLogin " :current-page="currentPage" :last-page="lastPage" />
    <div class="top_page" v-else>
      <img src="images/Green_Heart.jpg" alt="image">
      <div class="top_sentence">
        <h1>Feeling-notesとは？</h1>
          <p>あなたのある日の<span style="font-weight: bold">「起床時間」「就寝時間」</span>朝から寝るまでの間の<span style="font-weight: bold">「調子の変化」</span>を記録することができるアプリです。</p>
          <p><span style="font-weight: bold">「正しい生活リズム」</span>と<span style="font-weight: bold">「調子の波を知ること」</span>は心身の健康に繋がります。</p>
          <p>毎日の<span style="font-weight: bold">「Feeling」</span>を知りましょう。</p>
          <RouterLink class="button_top button_top--link" to="/login">
              Login / Register
          </RouterLink>
          <form class="form" @submit.prevent="guestlogin">
            <div class="guest_login">
              <input type="text" class="form__hidden" id="login-email" v-model="guestloginForm.email">
              <input type="password" class="form__hidden" id="login-password" v-model="guestloginForm.password">
              <button type="submit" class="guest" >ゲストログイン</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</template>

<script>
import { OK } from '../util'
import Note from '../components/Note.vue'
import Pagination from '../components/Pagination.vue'
import { mapState } from 'vuex'

export default {
  components: {
    Note,
    Pagination
  },
  data () {
    return {
      notes: [],
      currentPage: 0,
      lastPage: 0,
      guestloginForm: {
        email: 'guest@laravel.com',
        password: 'guestuser'
      },
    }
  },
  computed: {
    ...mapState({
      apiStatus: state => state.auth.apiStatus,
      loginErrors: state => state.auth.loginErrorMessages,
      registerErrors: state => state.auth.registerErrorMessages
    }),
    isLogin () {
      return this.$store.getters['auth/check']
    }
  },
  props: {
    page: {
      type: Number,
      required: false,
      default: 1
    }
  },
  methods: {
    async fetchNotes() {
      if(this.$store.getters['auth/check']){

        //ローカル環境用
        const response = await axios.get(`api/notes/?page=${this.page}`)
        
        if (response.status !== OK) {
          this.$store.commit('error/setCode', response.status)
          return false
        }

        this.notes = response.data.data
        this.currentPage = response.data.current_page
        this.lastPage = response.data.last_page
      }
    },
    async guestlogin () {
      // authストアのloginアクションを呼び出す
      await this.$store.dispatch('auth/login', this.guestloginForm)
      if (this.apiStatus) {
        // メッセージ登録
        this.$store.commit('message/setContent', {
            content: 'ゲストユーザーさん、ようこそ！！',
            timeout: 3000
        })
        const response = await axios.get(`api/notes/?page=${this.page}`)
        this.notes = response.data.data
        this.currentPage = response.data.current_page
        this.lastPage = response.data.last_page
        // トップページに移動する
        this.$router.push('/').catch(err => {})
        
      }
    },
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchNotes()
      },
      immediate: true
    }
  }
}
</script>
