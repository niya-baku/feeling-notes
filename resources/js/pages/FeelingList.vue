<template>
<v-app>
  <v-row class="fill-height" v-if="isLogin">
    <v-col>
      <v-sheet height="64">
        <v-toolbar flat color="white">
          <v-btn outlined class="mr-4" color="grey darken-2" @click="setToday">
            Today
          </v-btn>
          <v-btn fab text small color="grey darken-2" @click="prev">
            <v-icon small>mdi-chevron-left</v-icon>
          </v-btn>
          <v-btn fab text small color="grey darken-2" @click="next">
            <v-icon small>mdi-chevron-right</v-icon>
          </v-btn>
          <v-toolbar-title v-if="$refs.calendar">
            {{ $refs.calendar.title }}
          </v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
      </v-sheet>
      <v-sheet height="600">
        <v-calendar
          ref="calendar"
          v-model="focus"
          color="primary"
          :events="events"
          :event-color="getEventColor"
          :type="type"
          @click:event="showEvent"
          @change="updateRange"
        ></v-calendar>
        <v-menu
          v-model="selectedOpen"
          :close-on-content-click="false"
          :activator="selectedElement"
          offset-x
        >
          <v-card
            color="grey lighten-4"
            min-width="350px"
            flat
          >
            <v-toolbar
              :color="selectedEvent.color"
              dark
            >
              <v-toolbar-title v-html="selectedEvent.name"></v-toolbar-title>
              <v-spacer></v-spacer>
            </v-toolbar>
            <v-card-text>
              <span v-html="selectedEvent.details"></span>
            </v-card-text>
                <Note 
                  class="grid__item"
                  v-for="note in notes"
                  :key="note.id"
                  :item="note"
                  v-if="record_datatime() == note.record"
                />
            <v-card-actions>
              <v-btn
                text
                class="cansel"
                @click="selectedOpen = false"
              >
                Cancel
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-menu>
      </v-sheet>
    </v-col>
  </v-row>
  <div class="top_page" v-else>
    <img src="images/Green_Heart.jpg" alt="image">
    <div class="top_sentence">
      <h1>Feeling-notesとは？</h1>
        <p>あなたのある日の<span style="font-weight: bold">「起床時間」「就寝時間」</span>朝から寝るまでの間の<span style="font-weight: bold">「調子の変化」</span>を記録することができるアプリです。</p>
        <p><span style="font-weight: bold">「正しい生活リズム」</span>と<span style="font-weight: bold">「調子の波を知ること」</span>は心身の健康に繋がります。</p>
        <p>毎日の<span style="font-weight: bold">「Feeling」</span>を知りましょう。</p>
        <RouterLink class="button_top button_top--link" to="/login">
            Login / Register
        </RouterLink>
        <form class="form" @submit.prevent="guestlogin">
          <div class="guest_login">
            <input type="text" class="form__hidden" id="login-email" v-model="guestloginForm.email">
            <input type="password" class="form__hidden" id="login-password" v-model="guestloginForm.password">
            <button type="submit" class="guest" >ゲストログイン</button>
          </div>
        </form>
    </div>
  </div>
</v-app>
</template>

<script>
import Vue from 'vue'
import Calendar from 'v-calendar/lib/components/calendar.umd'

import { OK } from '../util'
import Note from '../components/Note.vue'
import { mapState } from 'vuex'
import moment from 'moment';

Vue.config.productionTip = false
  export default {
    components: {
      Note,
      Calendar
    },
    data (){
      return{
        notes: [],
        guestloginForm: {
          email: 'guest@laravel.com',
          password: 'guestuser'
        },
        focus: '',
        record_data: '',
        type: 'month',
        typeToLabel: {
          month: 'Month'
        },
        selectedEvent: {},
        selectedElement: null,
        selectedOpen: false,
        events: [],
        alldays: [],
        testcount:[],
        colors: ['blue', 'indigo', 'deep-purple', 'cyan', 'green', 'orange', 'grey darken-1'],
        names: ['Meeting', 'Holiday', 'PTO', 'Travel', 'Event', 'Birthday', 'Conference', 'Party'],
        record_datatime: function() {
          return moment(this.record_data).format('YYYY-MM-DD');
        },
      }  
    },
    filters: {
        moment: function (date) {
            return moment(date).format('YYYY/MM/DD');
        }
    },
    computed: {
      ...mapState({
        apiStatus: state => state.auth.apiStatus,
        loginErrors: state => state.auth.loginErrorMessages,
        registerErrors: state => state.auth.registerErrorMessages
      }),
      isLogin () {
        return this.$store.getters['auth/check']
      },
      activeNotes: function () {
        return this.notes.filter(function (note) {
              return note
        })
      }
    },
    mounted () {
      this.$refs.calendar.checkChange()
    },
    methods: {
      async fetchNotes() {
        if(this.$store.getters['auth/check']){

          //ローカル環境用
          const response = await axios.get(`api/notes/?page=${this.page}`)
          
          if (response.status !== OK) {
            this.$store.commit('error/setCode', response.status)
            return false
          }

          this.notes = response.data.data
          
          this.currentPage = response.data.current_page
          this.lastPage = response.data.last_page
        }
      },
      async guestlogin () {
        // authストアのloginアクションを呼び出す
        await this.$store.dispatch('auth/login', this.guestloginForm)
        if (this.apiStatus) {
          // メッセージ登録
          this.$store.commit('message/setContent', {
              content: 'ゲストユーザーさん、ようこそ！！',
              timeout: 3000
          })
          const response = await axios.get(`api/notes/?page=${this.page}`)
          this.notes = response.data.data

          // トップページに移動する
          this.$router.push('/').catch(err => {})
          
        }
      },
      viewDay (alldays) {
        this.focus = date
        this.type = 'day'
      },
      getEventColor (event) {
        return event.color
      },
      setToday () {
        this.focus = ''
      },
      prev () {
        this.$refs.calendar.prev()
      },
      next () {
        this.$refs.calendar.next()
      },
      showEvent ({ nativeEvent, event }) {
        this.record_data= event.start
        const open = () => {
          this.selectedEvent = event
          this.selectedElement = nativeEvent.target
          setTimeout(() => this.selectedOpen = true, 10)
        }

        if (this.selectedOpen) {
          this.selectedOpen = false
          setTimeout(open, 10)
        } else {
          open()
        }
        
        nativeEvent.stopPropagation()
      },
      async updateRange ({ start, end }) {
        if(this.$store.getters['auth/check']){
          const response = await axios.get(`api/notes/?page=${this.page}`)
            
            if (response.status !== OK) {
              this.$store.commit('error/setCode', response.status)
              return false
            }

          this.notes = response.data.data

          const events = []
          const alldays = []
          
          const min = new Date(`${start.date}T00:00:00`)
          const max = new Date(`${end.date}T23:59:59`)
          const days = (max.getTime() - min.getTime()) / 86400000
          const eventCount = this.notes.length
          //console.log(eventCount)

          for (let i = 0; i < eventCount; i++) {
            const first = new Date(this.notes[i].record)
            const date = new Date(this.notes[i].record)
            //console.log(this.notes[i])
            events.push({
              name: "Oneday_note",
              start: first,
              color: this.colors[this.rnd(0, this.colors.length - 1)]
            })
            alldays.push({record: date})
          }

          this.events = events
          //console.log(this.events[0].start)
          this.alldays = alldays
          //console.log(this.alldays[0].record)
        }
      },
      rnd (a, b) {
        return Math.floor((b - a + 1) * Math.random()) + a
      },
    }
  }
</script>

<style>
/*vuetity_CSS*/ 
[role=button], [type=button], [type=reset], [type=submit], button {
  cursor: pointer;
  color: #FFF;
}
.v-application p {
    margin-bottom: 0.5em;
}
@media screen and ( max-width:479px ) {
  .v-menu__content {
      position: absolute;
      display: inline-block;
      max-width: 100%;
      overflow-y: auto;
      overflow-x: hidden;
      contain: content;
      will-change: transform;
      box-shadow: 0 5px 5px -3px rgba(0,0,0,.2), 0 8px 10px 1px rgba(0,0,0,.14), 0 3px 14px 2px rgba(0,0,0,.12);
      border-radius: 4px;
  }
}
</style>