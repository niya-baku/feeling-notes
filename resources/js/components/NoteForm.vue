<template>
    <div v-show="value" class="note-form">
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

        <div class="display-item">
            <h3 class="note_title"><span class="required">必須</span>記録日</h3>
            <input type="date" name="record" class="width-record" v-model="noteform.record">
        </div>
        <div class="display-item">
            <h3 class="item"><span class="required">必須</span>起床時間</h3>
            <input type="time" name="wake_uptime" class="width-time" value="00:00"  v-model="noteform.wake_uptime">
        </div>
        <div class="display-item">
            <h3 class="item"><span class="required">必須</span>就寝時間</h3>
            <input type="time" name="bedtime" class="width-time" value="00:00"  v-model="noteform.bedtime">
        </div>
        <div id="app">
            <h2 class="border">午前中の体調は？</h2>
            <div class="display">

            <div
                v-for="(icon,am_id) in noteform.icons_1"
                class="image-radio-button"
                :style="{background: (am_id == noteform.iconId_1) ? '#ddd' : ''}"
                :key="am_id"
            >
                <label>
                    <input type="radio" name="iconId_1" :value="am_id" v-model="noteform.iconId_1"><br>
                    <img :src="icon">
                </label>
            </div>
            </div>


            <h2 class="border">午後の体調は？</h2>
            <div class="display">

            <div
                v-for="(icon,pm_id) in noteform.icons_2"
                class="image-radio-button"
                :style="{background: (pm_id == noteform.iconId_2) ? '#ddd' : ''}"
                :key="pm_id"
            >
                <label>
                    <input type="radio" name="iconId_2" :value="pm_id" v-model="noteform.iconId_2"><br>
                    <img :src="icon">
                </label>
            </div>
            </div>


            <h2 class="border">夜の体調は？</h2>
            <div class="display">

            <div
                v-for="(icon,night_id) in noteform.icons_3"
                class="image-radio-button"
                :style="{background: (night_id == noteform.iconId_3) ? '#ddd' : ''}"
                :key="night_id"
            >
                <label>
                    <input type="radio" name="iconId_3" :value="night_id" v-model="noteform.iconId_3"><br>
                    <img :src="icon">
                </label>
            </div>
            </div>


        <h2 class="border">一言ありますか？</h2>
        <textarea name="body" class="text_form" v-model="noteform.body" cols="30" rows="10" placeholder="(例)早く起きれた、投稿できたとか何か褒めてみよう！"></textarea>
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
            scrollX: 0,
            scrollY: 0,
            noteform: {
                record: '',
                wake_uptime: '',
                bedtime: '',
                body: null,
                icons_1: {
                    1: '/images/absolute_upset_nimi.png',
                    2: '/images/upset_nimi.png',
                    3: '/images/usually_nimi.png',
                    4: '/images/smile_nimi.png',
                    5: '/images/nice_smile_nimi.png'
                },
                iconId_1: 3,
                icons_2: {
                    1: '/images/absolute_upset_nimi.png',
                    2: '/images/upset_nimi.png',
                    3: '/images/usually_nimi.png',
                    4: '/images/smile_nimi.png',
                    5: '/images/nice_smile_nimi.png'
                },
                iconId_2: 3,
                icons_3: {
                    1: '/images/absolute_upset_nimi.png',
                    2: '/images/upset_nimi.png',
                    3: '/images/usually_nimi.png',
                    4: '/images/smile_nimi.png',
                    5: '/images/nice_smile_nimi.png'
                },
                iconId_3: 3,
            },
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
            this.noteform = {
                record: '',
                wake_uptime: '',
                bedtime: '',
                body: null,
                icons_1: {
                    1: '/images/absolute_upset_nimi.png',
                    2: '/images/upset_nimi.png',
                    3: '/images/usually_nimi.png',
                    4: '/images/smile_nimi.png',
                    5: '/images/nice_smile_nimi.png'
                },
                iconId_1: 3,
                icons_2: {
                    1: '/images/absolute_upset_nimi.png',
                    2: '/images/upset_nimi.png',
                    3: '/images/usually_nimi.png',
                    4: '/images/smile_nimi.png',
                    5: '/images/nice_smile_nimi.png'
                },
                iconId_2: 3,
                icons_3: {
                    1: '/images/absolute_upset_nimi.png',
                    2: '/images/upset_nimi.png',
                    3: '/images/usually_nimi.png',
                    4: '/images/smile_nimi.png',
                    5: '/images/nice_smile_nimi.png'
                },
                iconId_3: 3,
            }
        },
        async note () {
            await this.$store.dispatch('create/note', this.noteform)

            if (this.apiStatus) {

                // メッセージ登録
                this.$store.commit('message/setContent', {
                    content: 'ノートが投稿されました！',
                    timeout: 5000
                })

                this.reset()
                this.$emit('input', false)
                this.$router.push(`/notes/${this.noteStatus.id}`)
                var divElement = document.getElementsByClassName( "note-form" )
                var scrollTop = Array.prototype.slice.call(divElement)
                scrollTop.forEach(function(item) {
                    item.scrollTop = 0
                });

            }else{
                var divElement = document.getElementsByClassName( "note-form" )
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
