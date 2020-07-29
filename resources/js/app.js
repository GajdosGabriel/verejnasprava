/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('vue-multiselect/dist/vue-multiselect.min.css');
window.Vue = require('vue');

// get user Organization
Vue.prototype.user =  window.App.user;


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('order-index', require('./components/Order-index.vue').default);
Vue.component('order-group', require('./modules/order/OrderGroup.vue').default);
Vue.component('contact-table', require('./contacts/contactTable.vue').default);
Vue.component('nav-horizontal', require('./modules/navigation/navHorizontal.vue').default);
Vue.component('nav-items', require('./modules/navigation/navItems.vue').default);
Vue.component('flash-message', require('./modules/notification/flashMessage.vue').default);
Vue.component('accordion-table', require('./modules/accordion/accordion.vue').default);
Vue.component('post-table', require('./posts/postTable.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
