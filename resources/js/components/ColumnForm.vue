<template>
    <div v-show="value" class="column-form">
    <form class="form" @submit.prevent="column">
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
        <div id="app">

            <div class="situation_form" >
                <h3 class="column_item column_item--situation "><span class="required">必須</span>1.どんな状況・出来事があなたを悩ますのか？</h3>
                <textarea name="body" class="text_form text_form--situation" v-model="columnform.situation" rows="5" ></textarea>
            </div>

            <div class="arrow_middle">
                <img src="/images/arrow_buttom.png" >
            </div>
        
            <div class="feeling_form">
                <h3 class="column_item column_item--feeling"><span class="required">必須</span>2.その時のあなたの気分・感情は？</h3>
                <textarea name="body" class="text_form text_form--feeling" v-model="columnform.feeling" rows="5" ></textarea>
            </div>
            <div class="arrow_middle">
                <img src="/images/arrow_buttom.png" >
            </div>
            <div class="think_form">
                <h3 class="column_item column_item--think"><span class="required">必須</span>3.その時、あなたの中で浮かんだ考え方・思いは？</h3>
                <textarea name="body" class="text_form text_form--think" v-model="columnform.think" rows="5" ></textarea>
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
                <textarea name="body" class="text_form text_form--another_think" v-model="columnform.another_think" rows="5"></textarea>
            </div>
            <div class="arrow_middle">
                <img src="/images/arrow_buttom.png" >
            </div>
            <div class="another_feeling_form">
                <h3 class="column_item column_item--another_feeling">5.別の方法を実施した時の気分・感情は？</h3>
                <textarea name="body" class="text_form text_form--another_feeling" v-model="columnform.another_feeling" rows="5"></textarea>
            </div>    
        
            <div class="arrow_middle">
                <img src="/images/arrow_buttom.png" >
            </div>
            <div class="another_situation">
                <h3 class="column_item column_item--another_situation">6.悩んでいた状況・出来事に再度遭遇した場合、あなたはどうする？</h3>
                <textarea name="body" class="text_form text_form--another_situation" v-model="columnform.another_situation"  rows="5" ></textarea>
            </div>    
            <div class="submit_button">
                <button type="submit" class="raised" >投稿する</button>
            </div>
        </div>
    </form>
    
    </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
    props: {
        value: {
            type: Boolean,
            required: true
        }
    },
    data(){
        return{
            columnform: {
                situation: null,
                feeling: null,
                think: null,
                another_think: null,
                another_feeling: null,
                another_situation: null
            }
        }
    },
    computed: {
        ...mapState({
            columnStatus: state => state.create.columns,
            apiStatus: state => state.create.apiStatus,
            columnErrors: state => state.create.columnErrorMessages
        })
    },
    methods: {
        reset() {
            this.columnform = {
                situation: null,
                feeling: null,
                think: null,
                another_think: null,
                another_feeling: null,
                another_situation: null
            }
        },
        async column () {
            await this.$store.dispatch('create/column', this.columnform)
            
            if (this.apiStatus) {

                // メッセージ登録
                this.$store.commit('message/setContent', {
                    content: 'コラムが投稿されました！',
                    timeout: 3000
                })
                this.reset()
                this.$emit('input', false)
                this.$router.push(`/columns/${this.columnStatus.id}`)
                var divElement = document.getElementsByClassName( "column-form" )
                var scrollTop = Array.prototype.slice.call(divElement)
                scrollTop.forEach(function(item) {
                    item.scrollTop = 0
                });
                
            }else{
                var divElement = document.getElementsByClassName( "column-form" )
                var scrollTop = Array.prototype.slice.call(divElement)
                scrollTop.forEach(function(item) {
                    item.scrollTop = 0
                });
                console.log('send NG')
            }
            
        }
    }
}
</script>