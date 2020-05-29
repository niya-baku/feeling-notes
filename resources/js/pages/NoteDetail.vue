<template>
  <div v-if="note" class="photo-detail">
    <div class="photo-detail__pane photo-detail__image">
    <RouterLink class="detail-back__brand" to="/">
      <i class="icon ion-ios-arrow-back"></i> トップに戻る
    </RouterLink>
      <div class="condition_display">
        <div class=note-icon>
        <h1>{{note.record}}の体調</h1>
        <button
          class="button2 button2--info"
          title="更新・編集"
          @click="showEdit = ! showEdit"
        >
        <i class="icon ion-md-information-circle"></i>
        </button>
        <button
          class="button2 button2--delete"
          title="削除"
          @click="showDelete = ! showDelete"
        >
        <i class="icon ion-ios-trash"></i>
        </button>
        </div>
        <div class="icon_display_edit">
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
    </div>
    <div class="photo-detail__pane">
      <h3 class="note_title">日付  {{ note.record }}</h3>
      <h3 class="item">起床時間  {{ note.wake_uptime }}</h3>
      <h3 class="item">就寝時間  {{ note.bedtime }}</h3>
      <h2 class="photo-detail__title">今日の一言</h2>
      <p>{{note.body}}</p>
    </div>
    <EditForm v-model="showEdit" v-on:from-edit="close_editModal" :item="note"/>
    <DeleteForm　v-model="showDelete" v-on:from-delete="close_deleteModal" :item="note"/>
  </div>
</template>

<script>
import { OK } from '../util'
import EditForm from '../components/EditForm.vue'
import DeleteForm from '../components/DeleteForm.vue'

export default {
    components: {
      EditForm,
      DeleteForm
  },
  props: {
    id: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      //showContent: false,
      showEdit: false,
      showDelete: false,
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
    },
    close_editModal: function(){
      this.showEdit = false
    },
    close_deleteModal: function(){
      this.showDelete = false
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