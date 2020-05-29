import { getCookieValue } from './util'

window.axios = require('axios')

// Ajaxリクエストであることを示すヘッダーを付与する


if (token) {
  //window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
  window.axios.defaults.headers.common = {
      'Accept':'application/json',
      'Content-Type':'application/json'
  };
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.axios.interceptors.request.use(config => {
  // クッキーからトークンを取り出してヘッダーに添付する
  config.headers['X-XSRF-TOKEN'] = getCookieValue('XSRF-TOKEN')

  return config
})

window.axios.interceptors.response.use(
  response => response,
  error => error.response || error
)