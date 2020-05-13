<div v-show="value" class="note-form">
    <form method='POST' action="{{ route('create') }}" enctype="multipart/form-data">
        @csrf
        <h3 class="note_title">記録日</h3>
        <input type="date" name="record"><br>
        
        <h3 class="item">起床時間 ※15分単位に設定しているので近い時間を入力して下さい</h3>
        <input type="time" name="wake_uptime" value="00:00" step="900" ><br>
        <h3 class="item">就寝時間 ※15分単位に設定しているので近い時間を入力して下さい</h3>
        <input type="time" name="bedtime" value="00:00" step="900"><br>
        <div id="app">
            <h2 class="border">午前中の体調は？{{iconId_1}}</h2>
            <div class="display">
            
            <div
                v-for="(icon,am_id) in icons_1"
                class="image-radio-button"
                :style="{background: (am_id == iconId_1) ? '#ddd' : ''}">
                <label>
                    <input type="radio" name="am_image" :value="am_id" v-model="iconId_1"><br>
                    <img :src="icon">
                </label>
            </div>
            </div>
            

            <h2 class="border">午後の体調は？{{iconId_2}}</h2>
            <div class="display">
            
            <div
                v-for="(icon,pm_id) in icons_2"
                class="image-radio-button"
                :style="{background: (pm_id == iconId_2) ? '#ddd' : ''}">
                <label>
                    <input type="radio" name="pm_image" :value="pm_id" v-model="iconId_2"><br>
                    <img :src="icon">
                </label>
            </div>
            </div>
            

            <h2 class="border">夜の体調は？{{iconId_3}}</h2>
            <div class="display">
          
            <div
                v-for="(icon,night_id) in icons_3"
                class="image-radio-button"
                :style="{background: (night_id == noteform.iconId_3) ? '#ddd' : ''}">
                <label>
                    <input type="radio" name="night_image" :value="night_id" v-model="iconId_3"><br>
                    <img :src="icon">
                </label>
            </div>
            </div>
            
        
        <h2 class="border">今日のGoodポイントは？</h2>
        <textarea name="body" class="text_form" cols="30" rows="10" placeholder="(例)早く起きれた、投稿できたとか何か褒めてみよう！"></textarea>

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
            <button type="submit" class="raised">投稿する</button>
        </div>
    </form>
    </div>