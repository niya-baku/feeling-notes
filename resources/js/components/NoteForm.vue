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

        <h3 class="note_title">記録日</h3>
        <input type="date" name="record" v-model="noteform.record"><br>
        
        <h3 class="item">起床時間 ※15分単位に設定しているので近い時間を入力して下さい</h3>
        <input type="time" name="wake_uptime" value="00:00" step="900" v-model="noteform.wake_uptime"><br>
        <h3 class="item">就寝時間 ※15分単位に設定しているので近い時間を入力して下さい</h3>
        <input type="time" name="bedtime" value="00:00" step="900" v-model="noteform.bedtime"><br>
        <div id="app">
            <h2 class="border">午前中の体調は？{{noteform.iconId_1}}</h2>
            <div class="display">
            
            <div
                v-for="(icon,am_id) in noteform.icons_1"
                class="image-radio-button"
                :style="{background: (am_id == noteform.iconId_1) ? '#ddd' : ''}">
                <label>
                    <input type="radio" name="iconId_1" :value="am_id" v-model="noteform.iconId_1"><br>
                    <img :src="icon">
                </label>
            </div>
            </div>
            

            <h2 class="border">午後の体調は？{{noteform.iconId_2}}</h2>
            <div class="display">
            
            <div
                v-for="(icon,pm_id) in noteform.icons_2"
                class="image-radio-button"
                :style="{background: (pm_id == noteform.iconId_2) ? '#ddd' : ''}">
                <label>
                    <input type="radio" name="iconId_2" :value="pm_id" v-model="noteform.iconId_2"><br>
                    <img :src="icon">
                </label>
            </div>
            </div>
            

            <h2 class="border">夜の体調は？{{noteform.iconId_3}}</h2>
            <div class="display">
          
            <div
                v-for="(icon,night_id) in noteform.icons_3"
                class="image-radio-button"
                :style="{background: (night_id == noteform.iconId_3) ? '#ddd' : ''}">
                <label>
                    <input type="radio" name="iconId_3" :value="night_id" v-model="noteform.iconId_3"><br>
                    <img :src="icon">
                </label>
            </div>
            </div>
            
        
        <h2 class="border">今日のGoodポイントは？</h2>
        <textarea name="body" class="text_form" v-model="noteform.body" cols="30" rows="10" placeholder="(例)早く起きれた、投稿できたとか何か褒めてみよう！"></textarea>

            <!--<div>
                <h2>残しておきたい画像があればこちら</h2>
                <input type="file" name="image" @change="onFileChange">
            </div>
            <div v-if="images">
                <ol>
                    <li v-for="(image, index) in images">
                        <h2>{{image.name}}</h2>
                        <img :src="image.thumnail" />
                        <button @click="images.splice(index, 1)">Remove image</button>
                    </li>
                </ol>
            </div>-->
            <button type="submit" class="raised" >投稿する</button>
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
            noteform: {
                record: '',
                wake_uptime: '',
                bedtime: '',
                body: '',
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
        }
    },
    computed: {
        ...mapState({
        apiStatus: state => state.create.apiStatus,
        noteErrors: state => state.create.noteErrorMessages
        })
    },
    methods: {
        async note () {
            await this.$store.dispatch('create/note', this.noteform)
            
            if (this.apiStatus) {
                this.$emit('input', false)
                this.$router.push('/sendpage')
                //this.$router.push(`/notes/${response.data.id}`)
            }else{
                console.log('send NG')
            }
        }
    }
}
</script>