<template>
  <div class="pagination">
    <RouterLink
      v-if="! column_isFirstPage"
      :to="`?page=${column_currentPage - 1}`"
      class="button"
    >&laquo; prev</RouterLink>
    <RouterLink
      v-if="! column_isLastPage"
      :to="`?page=${column_currentPage + 1}`"
      class="button"
    >next &raquo;</RouterLink>
  </div>
</template>

<script>
export default {
  props: {
    column_currentPage: {
      type: Number,
      required: true
    },
    column_lastPage: {
      type: Number,
      required: true
    }
  },
  computed: {
    column_isFirstPage () {
      return this.column_currentPage === 1
    },
    column_isLastPage () {
      return this.column_currentPage === this.column_lastPage
    }
  }
}
</script>