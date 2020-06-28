<template>
  <div class ="column">
    <div class="situation_form_list" >
        <h3 class="column_item column_item--situation_list ">1.どんな状況・出来事があなたを悩ますのか？</h3>
        <p name="body" class="column_textform column_textform--situation">{{item.situation | capitalize(68)}}</p>
    </div>

    <div class="arrow_middle">
        <img src="/images/arrow_buttom.png" >
    </div>
    <div class="flex_width">
        <div class="feeling_form_list">
            <h3 class="column_item column_item--feeling_list">2.その時のあなたの気分・感情は？</h3>
            <p name="body" class="column_textform column_textform--feeling">{{item.feeling | capitalize(38)}}</p>
        </div>

        <div class="think_form_list">
            <h3 class="column_item column_item--think_list">3.その時、あなたの中で浮かんだ考え方・思いは？</h3>
            <p name="body" class="column_textform column_textform--think">{{item.think | capitalize(38)}}</p>
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
            <p name="body" class="column_textform column_textform--another_think">{{item.another_think | capitalize(38)}}</p>
        </div>
        <div class="another_feeling_form_list">
            <h3 class="column_item column_item--another_feeling_list">5.別の方法を実施した時の気分・感情は？</h3>
            <p name="body" class="column_textform column_textform--another_feeling">{{item.another_feeling | capitalize(38)}}</p>
        </div>    
    </div>
    <div class="arrow_middle">
        <img src="/images/arrow_buttom.png" >
    </div>
    <div class="another_situation_list">
        <h3 class="column_item column_item--another_situation_list">6.悩んでいた状況・出来事に再度遭遇した場合、あなたはどうする？</h3>
        <p name="body" class="column_textform column_textform--another_situation">{{item.another_situation | capitalize(68)}}</p>
    </div>    
    <RouterLink
      class="column__overlay"
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
  },
  filters: {
    capitalize: function (value, length, omission) {
      var length = length ? parseInt(length, 10) : 20;
      var ommision = omission ? omission.toString() : '...';
      if (value == null || value.length <= length) {
        return value;
      }
       return value.substring(0, length) + ommision;
    }
  }
}
</script>