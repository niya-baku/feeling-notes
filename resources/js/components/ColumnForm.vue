<template>
    <div v-show="value" class="column-form">
    <form class="form" @submit.prevent="note">
        <div v-if="noteErrors" class="errors">
            <ul v-if="noteErrors.record">
            <li v-for="msg in noteErrors.record" :key="msg">{{ msg }}</li>
            </ul>
            <ul v-if="noteErrors.wake_uptime">
            <li v-for="msg in noteErrors.wake_uptime" :key="msg">{{ msg }}</li>
            </ul>
            <ul v-if="noteErrors.bedtime">
            <li v-for="msg in noteErrors.bedtime" :key="msg">{{ msg }}</li>
            </ul>
        </div>
        <div id="app">

        <div class="" >
            <h3 class="column_item"><span class="required">必須</span>どんな状況・出来事があなたを悩ますのか？</h3>
            <textarea name="body" class="text_form" v-model="columnform.situation" cols="30" rows="10" placeholder="(例)早く起きれた、投稿できたとか何か褒めてみよう！"></textarea>
        </div>
        <div class="">
            <h3 class="column_item"><span class="required">必須</span>その時のあなたの気分・感情は？</h3>
            <textarea name="body" class="text_form" v-model="columnform.feeling" cols="30" rows="10" placeholder="(例)早く起きれた、投稿できたとか何か褒めてみよう！"></textarea>
        </div>
        <div class="">
            <h3 class="column_item"><span class="required">必須</span>その時、あなたが浮かんだ考え方・思いは？</h3>
            <textarea name="body" class="text_form" v-model="columnform.think" cols="30" rows="10" placeholder="(例)早く起きれた、投稿できたとか何か褒めてみよう！"></textarea>
        </div>
        <div class="">
            <h3 class="column_item">別の考え方・行動はあなたの中に存在するか？</h3>
            <textarea name="body" class="text_form" v-model="columnform.another_think" cols="30" rows="10" placeholder="(例)早く起きれた、投稿できたとか何か褒めてみよう！"></textarea>
        </div>
        <div class="">
            <h3 class="column_item">別の考えや行動をあなた自身が実施した場合の気分・感情はどうなりますか？</h3>
            <textarea name="body" class="text_form" v-model="columnform.another_feeling" cols="30" rows="10" placeholder="(例)早く起きれた、投稿できたとか何か褒めてみよう！"></textarea>
        </div>    
        
        <h2 class="border">悩んでいた状況・出来事に再度遭遇した場合、あなたはどうする？</h2>
        <textarea name="body" class="text_form" v-model="columnform.another_situation" cols="30" rows="10" placeholder="(例)早く起きれた、投稿できたとか何か褒めてみよう！"></textarea>
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
            noteStatus: state => state.create.notes,
            apiStatus: state => state.create.apiStatus,
            noteErrors: state => state.create.noteErrorMessages
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
        async note () {
            await this.$store.dispatch('create/note', this.noteform)
            
            if (this.apiStatus) {

                // メッセージ登録
                this.$store.commit('message/setContent', {
                    content: '写真が投稿されました！',
                    timeout: 3000
                })
                //this.reset()
                this.$emit('input', false)
                this.$router.push(`/notes/${this.noteStatus.id}`)
                
            }else{
                console.log('send NG')
            }
            
        }
    }
}
</script>