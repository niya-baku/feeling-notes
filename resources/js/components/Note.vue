<template>
  <div class ="note">
    <figure class="note__wrapper">
      <h3 class="note_title">日付 {{ item.record }}</h3>
      <h3 class="item">起床時間{{ item.wake_uptime }}</h3>
      <h3 class="item">就寝時間{{ item.bedtime }}</h3>
      <div class="icon_display">
        <div class="icon_side">
          <p class="icon_Vertical" >午前の気分<span class="hidden_id">{{am_icon_id = item.am_image}}</span></p>  
          <div v-for="(am_icon,id) in am_icons">
            <div v-if="id == am_icon_id" class="image-radio-button">
              <img :src="am_icon">    
            </div>
          </div>
        </div>
        <div class="icon_side">
          <p class="icon_Vertical">午後の気分<span class="hidden_id">{{pm_icon_id = item.pm_image}}</span</p>
          <div v-for="(pm_icon,id) in pm_icons">
            <div v-if="id == pm_icon_id" class="image-radio-button">
              <img :src="pm_icon">    
            </div>
          </div>
        </div>
        <div class="icon_side">
          <p class="icon_Vertical">夜の気分<span class="hidden_id">{{night_icon_id = item.night_image}}</span></p>  
          <div v-for="(night_icon,id) in night_icons">
            <div v-if="id == night_icon_id" class="image-radio-button">
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
    }
  }
}
</script>