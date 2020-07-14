<template>
  <div class="container--small">
    <div class="panel">
      <form class="form">
        <label for="login-email">OLD Password</label>
        <input type="text" class="form__item" id="login-email" >
        <label for="login-password">NEW Password</label>
        <input type="password" class="form__item" id="login-password" >
        <label for="login-password">NEW Password(Confirmation)</label>
        <input type="password" class="form__item" id="login-password">
        <div class="form__button">
          <button type="submit" class="button button--inverse">NEW Password Create</button>
        </div>
      </form>
    </div>
  </div>
</template>