<template>
  <div class="pagination">
    <RouterLink
      v-if="! isFirstPage"
      :to="`/?page=${currentPage - 1}`"
      class="button"
    >&laquo; prev</RouterLink>
    <RouterLink
      v-if="! isLastPage"
      :to="`/?page=${currentPage + 1}`"
      class="button"
    >next &raquo;</RouterLink>
    {{currentPage}}
  </div>
</template>

<script>
export default {
  props: {
    currentPage: {
      type: Number,
      required: true
    },
    lastPage: {
      type: Number,
      required: true
    }
  },
  computed: {
    isFirstPage () {
      console.log("currentPage")
      console.log(this.currentPage)
      return this.currentPage === 1
    },
    isLastPage () {
      console.log("this.lastPage")
      console.log(this.lastPage)
      return this.currentPage === this.lastPage
    }
  }
}
</script>