<template>
     <div class="overlay" v-show="value">
      <perfect-scrollbar>
      <div class="modal-content">
        <button class="buttonBack buttonBack--back" title="戻る" @click="clickEvent">
          <i class="icon ion-md-close"></i>
        </button>
      <form class="form-edit" @submit.prevent="update">
        <dl class="input-wide">
          <dt >起床時間</dt>
          <dd>
            <input type="time" name="wake_uptime" value="00:00" step="900" v-model="item.wake_uptime">
          </dd> 
          <dt>就寝時間</dt>
          <dd>
            <input type="time" name="bedtime" value="00:00" step="900"  v-model="item.bedtime">
          </dd>
        </dl>
          <h3>コメント</h3>
          <textarea name="body" class="text_edit" v-model="item.body"></textarea>
        
      

            <h3 class="border">午前中の体調は？{{item.am_image}}</h3>
            <div class="display">          
            <div
                v-for="(icon,am_id) in am_icons"
                class="image-radio-button-small"
                :style="{background: (am_id == item.am_image) ? '#ddd' : ''}">
                <label>
                    <input type="radio" name="am_icons" :value="am_id"  v-model="item.am_image"><br>
                    <img :src="icon"  class="small-icon" >
                </label>
            </div>
            </div>
            <h3 class="border">午後の体調は？{{item.pm_image}}</h3>
            <div class="display">            
            <div
                v-for="(icon,pm_id) in pm_icons"
                class="image-radio-button-small"
                :style="{background: (pm_id == item.pm_image) ? '#ddd' : ''}">
                <label>
                    <input type="radio" name="pm_icons" :value="pm_id" v-model="item.pm_image"><br>
                    <img :src="icon" class="small-icon">
                </label>
            </div>
            </div>
            <h3 class="border">夜の体調は？{{item.night_image}}</h3>
            <div class="display">    
            <div
                v-for="(icon,night_id) in night_icons"
                class="image-radio-button-small"
                :style="{background: (night_id == item.night_image) ? '#ddd' : ''}">
                <label>
                    <input type="radio" name="night_icons" :value="night_id" v-model="item.night_image"><br>
                    <img :src="icon" class="small-icon">
                </label>
            </div>
            </div>
        <div class="button-submit">
          <button @click="clickEvent" class="cancel">キャンセル</button>
          <button type="submit" class="change" >変更する</button>
        </div>
      </form>
      </div>
      </perfect-scrollbar>
    </div>
</template>

<script>
import { PerfectScrollbar } from 'vue2-perfect-scrollbar'
import { mapState } from 'vuex'
export default {
  components:{
    PerfectScrollbar
  },
  props: {
    item: {
      type: Object,
      required: true
    },
    value: {
      type: Boolean,
      required: true
    }
  },
  data () {
    return {
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
  computed: {
      ...mapState({
      apiStatus: state => state.create.apiStatus,
      noteErrors: state => state.create.noteErrorMessages,
    })
  },
  methods :{
    clickEvent: function(){
      this.$emit('from-edit')
    },
    async update () {
      await this.$store.dispatch('create/update', this.item)
      
      if (this.apiStatus) {
          this.$emit('input', false)
      }else{
          console.log('update NG')
      }
    }
  }
}
</script>
<style src="vue2-perfect-scrollbar/dist/vue2-perfect-scrollbar.css"/>