<template>
     <div class="overlay" v-show="value">
      <div class="modal-delete">
        <button class="buttonBack buttonBack--back" title="戻る" @click="clickEvent">
            <i class="icon ion-md-close"></i>
        </button>
        <div class="form-edit">
        <p>本当に削除しますか?</p>
        
        <form  @submit.prevent="delete_column">
          <div class="button-submit">
            <button type="button" @click="clickEvent" class="cancel">キャンセル</button>
            <button type="submit" class="change" >削除</button>
          </div>
        </form>
        </div>
      </div>
    </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  props: {
    item: {
      type: Object,
      required: true
    },
    value: {
      type: Boolean,
      required: true
    }
  },
  computed: {
      ...mapState({
      apiStatus: state => state.create.apiStatus,
      columnErrors: state => state.create.columnErrorMessages,
    })
  },
  methods :{
    async delete_column () {
      await this.$store.dispatch('create/columndelete',this.item)
      
      if (this.apiStatus) {
          // 削除メッセージ
          this.$store.commit('deletemessage/deletecontent', {
            content: 'コラムが削除されました！',
            timeout: 3000
          })
          this.$emit('input', false)
          this.$router.push("/columns")
      }else{
          console.log('delete NG')
      }
    },
    clickEvent: function(){
      this.$emit('from-delete')
     }
  }
}
</script>