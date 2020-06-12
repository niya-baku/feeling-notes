<template>
  <nav class="navbar">
    <RouterLink class="navbar__brand" to="/">
      Feeling-notes
    </RouterLink>
    <slide v-if="isLogin">
    <a class="navbar__chart" href="/">
      <span><i class="icon ion-md-home"></i> Home</span>
    </a>
    <a  class="navbar__chart" href="/chart">
      <span>|<i class="icon ion-md-trending-up"></i> Chart</span>
    </a>
    <a class="navbar__chart" href="YATTA">
      <span><i class="icon ion-md-sunny"></i> YATTA!</span>
    </a>
  </slide>
  <div id="page-wrap"></div>


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
import Vue from 'vue'
import NoteForm from './NoteForm.vue'
import { Slide } from 'vue-burger-menu'
export default {
  components: {
    NoteForm,
    Slide
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