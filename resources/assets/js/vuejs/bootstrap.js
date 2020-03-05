import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import jquery from 'jquery';
import toastr from 'toastr';
import Form from './core/Form';


// import flickity from ('./flickety');

window.jQuery = jquery;
window.Vue = Vue;
Vue.use(VueRouter);

window.axios = axios;
window.toastr = toastr;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.Form = Form;
