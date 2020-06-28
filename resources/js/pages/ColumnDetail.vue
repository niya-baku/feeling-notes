<template>
  <div class ="column">
    <div class="situation_form_list" >
        <h3 class="column_item column_item--situation_list ">1.どんな状況・出来事があなたを悩ますのか？</h3>
        <p name="body" class="column_textform column_textform--situation">{{column.situation}}</p>
    </div>

    <div class="arrow_middle">
        <img src="/images/arrow_buttom.png" >
    </div>
    <div class="flex_width">
        <div class="feeling_form_list">
            <h3 class="column_item column_item--feeling_list">2.その時のあなたの気分・感情は？</h3>
            <p name="body" class="column_textform column_textform--feeling">{{column.feeling}}</p>
        </div>

        <div class="think_form_list">
            <h3 class="column_item column_item--think_list">3.その時、あなたの中で浮かんだ考え方・思いは？</h3>
            <p name="body" class="column_textform column_textform--think">{{column.think}}</p>
        </div>
    </div>
    <div class="arrow_middle">
        <img src="/images/arrow_buttom.png" >
    </div> 
    <div class="roop_word_list">
        <h2 class="column_item column_item--sad_list">悲観的な考えがループするとさらに気分や体調が悪くなってしまう...</h2>
    </div>
    <div class="arrow_middle">
        <img src="/images/arrow_buttom.png" >
    </div> 
    <div class="flex_width">        
        <div class="another_think_form_list">
            <h3 class="column_item column_item--another_think_list">4.別の考え方・行動があなたの中にありますか？</h3>
            <p name="body" class="column_textform column_textform--another_think">{{column.another_think}}</p>
        </div>
        <div class="another_feeling_form_list">
            <h3 class="column_item column_item--another_feeling_list">5.別の方法を実施した時の気分・感情は？</h3>
            <p name="body" class="column_textform column_textform--another_feeling">{{column.another_feeling}}</p>
        </div>    
    </div>
    <div class="arrow_middle">
        <img src="/images/arrow_buttom.png" >
    </div>
    <div class="another_situation_list">
        <h3 class="column_item column_item--another_situation_list">6.悩んでいた状況・出来事に再度遭遇した場合、あなたはどうする？</h3>
        <p name="body" class="column_textform column_textform--another_situation">{{column.another_situation}}</p>
    </div>    
  </div>
</template>

<script>
import { OK } from '../util'
export default {
    data(){
      return {
          column : ""
      }
    },
    props: {
        id: {
        type: String,
        required: true
        }
    },
    methods: {
      async fetchColumns() {
        //ローカル環境用
        const response = await axios.get(`/api/columns/${this.id}`)
        
        if (response.status !== OK) {
            this.$store.commit('error/setCode', response.status)
            return false
        }
        this.column = response.data
        
      }
      
    },
     watch: {
    $route: {
      async handler () {
        await this.fetchColumns()
      },
      immediate: true
    }
  }
}
</script>