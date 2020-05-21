<template>
     <div class="overlay" v-show="value" @click="clickEvent">
      <div class="modal-content">
      <p>編集画面です。</p>
      <p><button>close</button></p>
      </div>
    </div>
</template>

<script>
export default {
  props: {
    value: {
      type: Boolean,
      required: true
    }
  },
  methods :{
    clickEvent: function(){
      this.$emit('from-edit')
     }
  }
}
</script>