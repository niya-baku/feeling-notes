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
    <ColumnPagination v-if="isLogin " :column_current-page="column_currentPage" :column_last-page="column_lastPage" />
  </div>
</template>

<script>
import { OK } from '../util'
import Column from '../components/Column.vue'
import ColumnPagination from '../components/ColumnPagination.vue'
import { mapState } from 'vuex'

export default {
  components: {
    Column,
    ColumnPagination
  },
  data () {
    return {
      columns: [],
      column_currentPage: 0,
      column_lastPage: 0,
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
      async fetchColumns() {
        if(this.$store.getters['auth/check']){

          //ローカル環境用
          const response = await axios.get(`api/columns/?page=${this.page}`)
          
          if (response.status !== OK) {
            this.$store.commit('error/setCode', response.status)
            return false
          }
          this.columns = response.data.data
          this.column_currentPage = response.data.current_page
          this.column_lastPage = response.data.last_page
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

