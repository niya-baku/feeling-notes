<template>
  <div v-if="note" class="photo-detail">
    <div class="photo-detail__pane photo-detail__image">
      <div class="icon_display">
        <div class="icon_side">
          <p class="icon_Vertical" >午前の気分</p>  
          <div v-for="(am_icon,id) in am_icons">
            <div v-if="id == show_am_id" class="image-radio-button">
              <img :src="am_icon">    
            </div>
          </div>
        </div>
        <div class="icon_side">
          <p class="icon_Vertical">午後の気分</p>
          <div v-for="(pm_icon,id) in pm_icons">
            <div v-if="id == show_pm_id" class="image-radio-button">
              <img :src="pm_icon">    
            </div>
          </div>
        </div>
        <div class="icon_side">
          <p class="icon_Vertical">夜の気分</p>  
          <div v-for="(night_icon,id) in night_icons">
            <div v-if="id == show_night_id" class="image-radio-button">
              <img :src="night_icon">    
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="photo-detail__pane">
      <h3 class="note_title">日付  {{ note.record }}</h3>
      <h3 class="item">起床時間  {{ note.wake_uptime }}</h3>
      <h3 class="item">就寝時間  {{ note.bedtime }}</h3>
      <h2 class="photo-detail__title">コメント</h2>
      <p>{{note.body}}</p>
    </div>
    
  </div>
</template>

<script>
import { OK } from '../util'

export default {
  props: {
    id: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      note: null,
      am_icon_id: 1,
      pm_icon_id: 1,
      night_icon_id: 1,
      am_icons: {
        1: '/images/absolute_upset_nimi.png',
        2: '/images/upset_nimi.png',
        3: '/images/usually_nimi.png',
        4: '/images/smile_nimi.png',
        5: '/images/nice_smile_nimi.png'
      },
      pm_icons: {
        1: '/images/absolute_upset_nimi.png',
        2: '/images/upset_nimi.png',
        3: '/images/usually_nimi.png',
        4: '/images/smile_nimi.png',
        5: '/images/nice_smile_nimi.png'
      },
      night_icons: {
        1: '/images/absolute_upset_nimi.png',
        2: '/images/upset_nimi.png',
        3: '/images/usually_nimi.png',
        4: '/images/smile_nimi.png',
        5: '/images/nice_smile_nimi.png'
      },
    }
  },
  methods: {
    async fetchNote () {
      const response = await axios.get(`/api/notes/${this.id}`)

      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }

      this.note = response.data
    },
    am_icon_display: function() {
      this.am_icon_id = this.note.am_image;
      return this.am_icon_id;
    },
    pm_icon_display: function() {
      this.pm_icon_id = this.note.pm_image;
      return this.pm_icon_id;
    },
    night_icon_display: function() {
      this.night_icon_id = this.note.night_image;
      return this.night_icon_id;
    }     
  },
  computed: {
    show_am_id() {
      return this.am_icon_display();
    },
    show_pm_id() {
      return this.pm_icon_display();
    },
    show_night_id() {
      return this.night_icon_display();
    },
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchNote()
      },
      immediate: true
    }
  }
}
</script>