# 体調管理アプリ「Feeling-notes」

![20200710221652](https://user-images.githubusercontent.com/40636920/87165260-dd66aa80-c304-11ea-9fa5-166b2c668ab5.png)

![20200710221511](https://user-images.githubusercontent.com/40636920/87165360-00915a00-c305-11ea-8b08-0fd7bf50a2d4.png)

![20200710221445](https://user-images.githubusercontent.com/40636920/87165441-1d2d9200-c305-11ea-8242-98935e8d7546.png)

![20200613004021](https://user-images.githubusercontent.com/40636920/84520968-4f040680-ad0f-11ea-9a89-7a90925bd1fe.png)

![20200710221619](https://user-images.githubusercontent.com/40636920/87165554-46e6b900-c305-11ea-9b04-74ed0b6d1160.png)


# Feeling-notesとは

自分のその日の体調を投稿し、集計してチャート化することで日々の体調の変化を記録することができるアプリです
主な機能として「起床時間」「就寝時間」「午前・午後・夜」の体調を記録する『notes機能』
「午前・午後・夜」の体調を値として集計を行い、月の体調の変化を『チャート機能』
「認知行動療法」のコラム法からヒントを得て、「思い込みに縛られないで現実に目を向け、自分にとって大切なものを見落としていないか考える」キッカケを
作ることができる「Column機能」があります。

またトップページにはカレンダー機能を入れて、記録した日付がわかりやすく表示できるように工夫しました。

## 🌐 App URL 
### https://feeling-notes.site

## 💬 Usage
`$ git clone https://github.com/niya-baku/feeling-notes.git` 

## 機能概要
<ul>
    <li>トップページ（カレンダー機能）</li>
    <li>体調投稿・コラム投稿機能</li>
    <li>体調投稿・コラム投稿詳細画面</li>
    <li>体調投稿・コラム投稿編集・変更</li>
    <li>体調投稿・コラム投稿削除</li>
    <li>ログイン / 会員登録</li>
    <li>パスワード変更機能（ゲストログインのみ使用不可にしています）</li>
    <li>ゲストユーザー用ログイン</li>
    <li>チャート機能</li>
    <li>レスポンシブ対応</li>
</ul>

## 使用技術(本番環境)
<h2>フロントエンド</h2>
<ul>
    <li>HTML/CSS・Sass</li>
    <li>Vue.js 2.6.11</li>
    <li>node.js v12.16.2</li>
    <li>vue-router 3.1.6</li>
    <li>vuex 3.3.0</li>
    <li>chart.js ^2.9.3</li>
    <li>moment ^2.26.0</li>
    <li>vue-chartjs ^3.5.0</li>
    <li>v-calendar ^1.0.0-beta.23</li>
    <li>vue-js-modal ^2.0.0-rc.3</li>
    <li>vue-scrollto ^2.18.1</li>
    <li>vue-click-outside ^1.1.0</li>
    <li>vuetify ^2.3.3</li>
    <li>vue-burger-menu ^2.0.5</li>
    <li>vue-click-outside ^1.1.0</li>
    <li>vue2-perfect-scrollbar ^1.5.0</li>
    <li>yargs-parser ^13.1.2</li>
</ul>
<h2>バックエンド</h2>
<ul>
    <li>PHP 7.3.19</li>
    <li>Laravel Framework  6.18.13</li>
</ul>
<h2>インフラストラクチャー</h2>
<ul>
    <li>Mysql 5.7</li>
    <li>nginx 1.18.0</li>
    <li>Docker 19.03.1</li>
    <li>docker-compose 1.24.1</li>
    <li>CircleCI</li>
</ul>
<h2>AWS</h2>
<ul>
    <li>AWS EC2</li>
    <li>AWS RDS</li>
    <li>AWS Route53</li>
    <li>VPC</li>
</ul>
<h2>その他</h2>
<ul>
    <li>SSL証明書 Let’s Encrypt</li>
    <li>git 2.17.1</li>
</ul>

## 使用技術(検証環境)
<ul>
    <li>VirtualBox</li>
    <li>Vagrant</li>
    <li>Homestead</li>
</ul>
