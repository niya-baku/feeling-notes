<template>
  <div class ="note">
    <div class="situation_form" >
        <h3 class="column_item column_item--situation ">1.どんな状況・出来事があなたを悩ますのか？</h3>
        <p name="body" class="text_form text_form--situation">{{item.situation}}</p>
    </div>

    <div class="arrow_middle">
        <img src="/images/arrow_buttom.png" >
    </div>

    <div class="feeling_form">
        <h3 class="column_item column_item--feeling">2.その時のあなたの気分・感情は？</h3>
        <p name="body" class="text_form text_form--feeling">{{item.feeling}}</p>
    </div>
    <div class="arrow_middle">
        <img src="/images/arrow_buttom.png" >
    </div>
    <div class="think_form">
        <h3 class="column_item column_item--think">3.その時、あなたの中で浮かんだ考え方・思いは？</h3>
        <p name="body" class="text_form text_form--think">{{item.think}}</p>
    </div>
    <div class="arrow_middle">
        <img src="/images/arrow_buttom.png" >
    </div> 
    <div class="roop_word">
        <h2 class="column_item column_item--sad">悲観的な考えがループするとさらに気分や体調が悪くなってしまう...</h2>
    </div>
    <div class="arrow_middle">
        <img src="/images/arrow_buttom.png" >
    </div>         
    <div class="another_think_form">
        <h3 class="column_item column_item--another_think">4.別の考え方・行動があなたの中にありますか？</h3>
        <p name="body" class="text_form text_form--another_think">{{item.another_think}}</p>
    </div>
    <div class="arrow_middle">
        <img src="/images/arrow_buttom.png" >
    </div>
    <div class="another_feeling_form">
        <h3 class="column_item column_item--another_feeling">5.別の方法を実施した時の気分・感情は？</h3>
        <p name="body" class="text_form text_form--another_feeling">{{item.another_feeling}}</p>
    </div>    

    <div class="arrow_middle">
        <img src="/images/arrow_buttom.png" >
    </div>
    <div class="another_situation">
        <h3 class="column_item column_item--another_situation">6.悩んでいた状況・出来事に再度遭遇した場合、あなたはどうする？</h3>
        <p name="body" class="text_form text_form--another_situation">{{item.another_situation}}</p>
    </div>    
    <RouterLink
      class="note__overlay"
      :to="`/columns/${item.id}`"
    >
    </RouterLink>
  </div>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  }
}
</script>