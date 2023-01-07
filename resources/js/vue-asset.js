//axios adding
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// setting up csrf-token in js
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.css';

// vue js instance
import Vue from 'vue'
window.Vue = require('vue');
Vue.use(VueIziToast);
export const EventBus = new Vue();
