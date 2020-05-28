<template>
  <div class="deletemessage" v-show="message">
    {{ message }}
  </div>
</template>

<script>
  import { mapState } from 'vuex'

  export default {
    computed: {
      ...mapState({
        message: state => state.deletemessage.content
      })
    }
  }
</script>