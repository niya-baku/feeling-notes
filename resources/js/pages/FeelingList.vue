<template>
  <div class="photo-list">
    <div class="grid">
      <Note 
        class="grid__item"
        v-for="note in notes"
        :key="note.id"
        :item="note"
      />
    </div>
    <Pagination v-if="isLogin" :current-page="currentPage" :last-page="lastPage" />
  </div>
</template>

<script>
import { OK } from '../util'
import Note from '../components/Note.vue'
import Pagination from '../components/Pagination.vue'

export default {
  components: {
    Note,
    Pagination
  },
  data () {
    return {
      notes: [],
      currentPage: 0,
      lastPage: 0
    }
  },
  computed: {
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
        //const response = await axios.get(`api/notes/?page=${this.page}`)

        //Mixed Contentエラー回避用
        const response = await axios.get(`api/notes`,
            {
                params: {
                  // ここにクエリパラメータを指定する
                  page: this.page // このようにパラメータを付けるとhttpsになる
                }
            }
        )

        if (response.status !== OK) {
          this.$store.commit('error/setCode', response.status)
          return false
        }

        this.notes = response.data.data
        this.currentPage = response.data.current_page
        this.lastPage = response.data.last_page
      }
    }
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
