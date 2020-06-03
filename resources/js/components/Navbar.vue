<template>
  <nav class="navbar">
    <RouterLink class="navbar__brand" to="/">
      Feeling-notes
    </RouterLink>
    <div class="navbar__menu">
      <span v-if="isLogin" class="navbar__item">
            {{ username }}
      </span>
      <div v-if="isLogin" class="navbar__item">
        <button class="button" @click="showForm = ! showForm">
          <i class="icon ion-md-add"></i>
          Submit a notes
        </button>
      </div>
      <div v-else class="navbar__item">
        <RouterLink class="button button--link" to="/login">
          Login / Register
        </RouterLink>
      </div>
    </div>
    <NoteForm v-model="showForm" />
  </nav>
</template>

<script>
import NoteForm from './NoteForm.vue'

export default {
  components: {
    NoteForm
  },
  data () {
    return {
      showForm: false
    }
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
    username () {
      return this.$store.getters['auth/username']
    },
  }
}
</script>