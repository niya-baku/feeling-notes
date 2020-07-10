# 体調管理アプリ「Feeling-notes」

![20200710221652](https://user-images.githubusercontent.com/40636920/87165260-dd66aa80-c304-11ea-9fa5-166b2c668ab5.png)

![20200613004055](https://user-images.githubusercontent.com/40636920/84520836-1e23d180-ad0f-11ea-9056-df95e0aaafa2.png)

![20200613004021](https://user-images.githubusercontent.com/40636920/84520968-4f040680-ad0f-11ea-9a89-7a90925bd1fe.png)

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
    <li>ゲストユーザー用ログイン</li>
    <li>チャート機能</li>
    <li>レスポンシブ対応</li>
</ul>

## 使用ツール(本番環境)
<ul>
    <li>PHP 7.4</li>
    <li>Laravel Framework  6.18.13</li>
    <li>MySQL 5.7</li>
    <li>AWS EC2</li>
    <li>AWS RDS</li>
    <li>AWS Route53</li>
    <li>SSL証明書 Let’s Encrypt</li>
    <li>node.js v12.16.2</li>
    <li>npm 6.14.5</li>
    <li>Vue.js 2.6.11</li>
    <li>vue-router 3.1.6</li>
    <li>vuex 3.3.0</li>
    <li>git 2.17.1</li>
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

## 使用ツール(検証環境)
<ul>
    <li>VirtualBox</li>
    <li>Vagrant</li>
    <li>Homestead</li>
</ul>
