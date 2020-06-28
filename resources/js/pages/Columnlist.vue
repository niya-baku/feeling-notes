<template>
  <div class="photo-list">
    <div class="grid_column" media="(min-width: 320px) and (max-width: 639px)">
      <Column 
        class="grid_column__item"
        v-for="column in columns"
        :key="column.id"
        :item="column"
        v-if="isLogin"
      />
    </div>
    <Pagination v-if="isLogin " :current-page="currentPage" :last-page="lastPage" />
  </div>
</template>

<script>
import { OK } from '../util'
import Column from '../components/Column.vue'
import Pagination from '../components/Pagination.vue'
import { mapState } from 'vuex'

export default {
  components: {
    Column,
    Pagination
  },
  data () {
    return {
      columns: [],
      currentPage: 0,
      lastPage: 0,
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
  methods: {
      async fetchColumns() {
        if(this.$store.getters['auth/check']){

          //ローカル環境用
          const response = await axios.get(`api/columns`)
          
          if (response.status !== OK) {
            this.$store.commit('error/setCode', response.status)
            return false
          }
          this.columns = response.data.data
          this.currentPage = response.data.current_page
          this.lastPage = response.data.last_page
        }
      },
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchColumns()
      },
      immediate: true
    }
  }
}
</script>

