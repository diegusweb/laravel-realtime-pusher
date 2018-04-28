
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueResource from 'vue-resource';
Vue.use(VueResource);

import {ServerTable} from 'vue-tables-2';
Vue.use(ServerTable, {}, false, 'bootstrap4', 'default');

//necesario para http post, put, delete channel routes
Vue.http.interceptors.push((request, next) => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    request.headers.set('X-CSRF-TOKEN', csrfToken);
    next();
});

Vue.component('promotions', require('./components/PromotionsComponent'));
Vue.component('products', require('./components/ProductsComponent'));
Vue.component('cart', require('./components/CartComponent'));
Vue.component('admin-promotions', require('./components/admin/Promotions'));
Vue.component('admin-products', require('./components/admin/Products'));
Vue.component('admin-notifications', require('./components/admin/Notifications'));
Vue.component('admin-orders', require('./components/admin/Orders'));
Vue.component('customer-orders', require('./components/customers/Orders'));
Vue.component('admin-order-detail', require('./components/admin/OrderDetail'));
Vue.component('customer-order-detail', require('./components/customers/OrderDetail'));

const app = new Vue({
    el: '#main'
});
