<template>
     <div class="overlay" v-show="value" @click="clickEvent">
      <div class="modal-content">
      <p>削除画面です。</p>
      <p><button　@click="clickEvent">キャンセル</button></p>
      <p><button>削除</button></p>
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
      this.$emit('from-delete')
     }
  }
}
</script>