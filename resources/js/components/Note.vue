<template>
  <div class ="note">
    <figure class="note__wrapper">
      <h3 class="note-title">調子合計  {{ sum() }}</h3>
      <h3 class="note-title">日付  {{ record() }}</h3>
      <h3 class="note-item">起床時間 {{ wake_uptime() }}</h3>
      <h3 class="note-item">就寝時間 {{ bed_time() }}</h3>
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
    </figure>
    <RouterLink
      class="note__overlay"
      :to="`/notes/${item.id}`"
    >
    </RouterLink>
  </div>
</template>

<script>
import moment from 'moment';
export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  data(){
    return{
      show: false, 
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
      record: function() {
        moment.updateLocale('ja', {
          weekdays: ["日曜日","月曜日","火曜日","水曜日","木曜日","金曜日","土曜日"],
          weekdaysShort: ["日","月","火","水","木","金","土"],
        }); 
        return moment(this.item.record).format('YYYY年MM月DD日(ddd)');
      },
      wake_uptime: function() {
        return moment(this.item.wake_uptime,'HH:mm:ss').format('HH時mm分');
      },
      bed_time: function() {
        return moment(this.item.bedtime,'HH:mm:ss').format('HH時mm分');
      }
    }
  },
  methods: {
    am_icon_display: function() {
      this.am_icon_id = this.item.am_image;
      return this.am_icon_id;
    },
    pm_icon_display: function() {
      this.pm_icon_id = this.item.pm_image;
      return this.pm_icon_id;
    },
    night_icon_display: function() {
      this.night_icon_id = this.item.night_image;
      return this.night_icon_id;
    },
    sum: function(){
      return this.item.am_image + this.item.pm_image + this.item.night_image
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
  }
}
</script>