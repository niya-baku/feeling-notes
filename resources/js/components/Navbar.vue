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
    <a class="navbar__chart" href="/columns">
      <span><i class="icon ion-md-paper"></i> Column</span>
    </a>
  </slide>
  <div id="page-wrap"></div>

    <div class="navbar__menu">
      <span v-if="isLogin" class="navbar__item">
            {{ username }}
      </span>
      <div v-if="isLogin && ispath == '/columns'" class="navbar__item">
        <button class="button_column" v-click-outside="column_toggle" @click="column_toggle">
          <i class="icon ion-md-add"></i>
          Submit a Columns
        </button>
      </div>
      <div v-else="isLogin" class="navbar__item">
        <button class="button_notes" v-click-outside="note_toggle" @click="note_toggle">
          <i class="icon ion-md-add"></i>
          Submit a Notes
        </button>
      </div>
    </div>
    <NoteForm v-model="showForm" />
    <ColumnForm v-model="showForm_column" />
  </nav>
</template>

<script>
import Vue from 'vue'
import NoteForm from './NoteForm.vue'
import ColumnForm from './ColumnForm.vue'
import { Slide } from 'vue-burger-menu'
import ClickOutside from 'vue-click-outside'
export default {
  components: {
    NoteForm,
    ColumnForm,
    Slide
  },
  data () {
    return {
      showForm: false,
      showForm_column: false,
    }
  },
  methods: {
    note_toggle () {
      this.showForm = !this.showForm
    },
    column_toggle () {
      this.showForm_column = !this.showForm_column
    }
  },
  mounted () {
    // prevent click outside event with popupItem.
    this.popupItem = this.$el
  },

  // do not forget this section
  directives: {
    ClickOutside
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
    username () {
      return this.$store.getters['auth/username']
    },
    ispath (){
      return this.$route.path
    }
  }
}
</script>