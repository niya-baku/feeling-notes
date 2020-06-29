<template>
    <div v-show="value" class="overlay">
    <perfect-scrollbar>
    <div class="modal-content">
    <div v-if="columnErrors" class="errors">
        <ul v-if="columnErrors.situation">
        <li v-for="msg in columnErrors.situation" :key="msg">{{ msg }}</li>
        </ul>
        <ul v-if="columnErrors.feeling">
        <li v-for="msg in columnErrors.feeling" :key="msg">{{ msg }}</li>
        </ul>
        <ul v-if="columnErrors.think">
        <li v-for="msg in columnErrors.think" :key="msg">{{ msg }}</li>
        </ul>
    </div>
    <button class="buttonBack buttonBack--back" title="戻る" @click="clickEvent">
        <i class="icon ion-md-close"></i>
    </button>
    <form class="form" @submit.prevent="update">
            <div class="situation_form" >
                <h3 class="column_item column_item--situation "><span class="required">必須</span>1.どんな状況・出来事があなたを悩ますのか？</h3>
                <textarea name="body" class="text_form text_form--situation" v-model="item.situation" rows="5" ></textarea>
            </div>

            <div class="arrow_middle">
                <img src="/images/arrow_buttom.png" >
            </div>
        
            <div class="feeling_form">
                <h3 class="column_item column_item--feeling"><span class="required">必須</span>2.その時のあなたの気分・感情は？</h3>
                <textarea name="body" class="text_form text_form--feeling" v-model="item.feeling" rows="5" ></textarea>
            </div>
            <div class="arrow_middle">
                <img src="/images/arrow_buttom.png" >
            </div>
            <div class="think_form">
                <h3 class="column_item column_item--think"><span class="required">必須</span>3.その時、あなたの中で浮かんだ考え方・思いは？</h3>
                <textarea name="body" class="text_form text_form--think" v-model="item.think" rows="5" ></textarea>
            </div>
            <div class="arrow_middle">
                <img src="/images/arrow_buttom.png" >
            </div> 
            <div class="roop_word">
                <h2 class="column_item column_item--sad_list">悲観的な考えがループするとさらに気分や体調が悪くなってしまう...</h2>
            </div>
            <div class="arrow_middle">
                <img src="/images/arrow_buttom.png" >
            </div>         
            <div class="another_think_form">
                <h3 class="column_item column_item--another_think">4.別の考え方・行動があなたの中にありますか？</h3>
                <textarea name="body" class="text_form text_form--another_think" v-model="item.another_think" rows="5"></textarea>
            </div>
            <div class="arrow_middle">
                <img src="/images/arrow_buttom.png" >
            </div>
            <div class="another_feeling_form">
                <h3 class="column_item column_item--another_feeling">5.別の方法を実施した時の気分・感情は？</h3>
                <textarea name="body" class="text_form text_form--another_feeling" v-model="item.another_feeling" rows="5"></textarea>
            </div>    
        
            <div class="arrow_middle">
                <img src="/images/arrow_buttom.png" >
            </div>
            <div class="another_situation">
                <h3 class="column_item column_item--another_situation">6.悩んでいた状況・出来事に再度遭遇した場合、あなたはどうする？</h3>
                <textarea name="body" class="text_form text_form--another_situation" v-model="item.another_situation"  rows="5" ></textarea>
            </div>    
            <div class="button-submit">
                <button @click.prevent="clickEvent" class="cancel">キャンセル</button>
                <button type="submit" class="change" >変更する</button>
            </div>
    </form>
    </div>
    </perfect-scrollbar>
    </div>
</template>

<script>
import { PerfectScrollbar } from 'vue2-perfect-scrollbar'
import { mapState } from 'vuex'
export default {
  components:{
    PerfectScrollbar
  },
  data(){
      return{
          msg : ""
      }
  },
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
      columnStatus: state => state.create.columns,
      apiStatus: state => state.create.apiStatus,
      columnErrors: state => state.create.columnErrorMessages,
    })
  },
  methods :{
    clickEvent: function(){
      this.$emit('from-edit')
    },
    async update () {
      await this.$store.dispatch('create/columnupdate', this.item)
      
      if (this.apiStatus) {
          this.$store.commit('message/setEditcontent', {
            content: 'コラム情報が更新されました！',
            timeout: 3000
          })
          this.$emit('input', false)
      }else{
          console.log('update NG')
      }
    }
  }
}
</script>
<style src="vue2-perfect-scrollbar/dist/vue2-perfect-scrollbar.css"/>