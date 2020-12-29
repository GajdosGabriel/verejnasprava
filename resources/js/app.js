/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('vue-multiselect/dist/vue-multiselect.min.css');
window.Vue = require('vue');

import store from './store';

// get user Organization
Vue.prototype.user =  window.App.user;


////////////  ACL   /////////////////
// console.log(window.App.user);

import Auth from './Auth'
Vue.prototype.$auth = new Auth(window.App.user);
///////////////////////////////

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
Vue.component('nav-drop-down', require('./modules/navigation/navDropDown.vue').default);
Vue.component('nav-items', require('./modules/navigation/navItems.vue').default);
Vue.component('flash-message', require('./modules/notification/flashMessage.vue').default);
Vue.component('table-front-post', require('./posts/tableFrontPost.vue').default);
Vue.component('post-table', require('./posts/postTable.vue').default);
Vue.component('vote-form-button', require('./votes/voteButtons.vue').default);
Vue.component('vote-start-button', require('./votes/voteStartButton.vue').default);
Vue.component('organization-edit', require('./organizations/edit.vue').default);
Vue.component('user-edit', require('./user/edit.vue').default);
Vue.component('contact-create', require('./contacts/formCreate.vue').default);
Vue.component('meeting', require('./meetings/meeting.vue').default);
Vue.component('council-table', require('./councils/councilTable.vue').default);
Vue.component('council-edit', require('./councils/edit.vue').default);
Vue.component('vote-list', require('./votes/voteList.vue').default);
Vue.component('item-show', require('./items/itemShow.vue').default);
Vue.component('meeting-users', require('./meetings/meetingUsers.vue').default);
Vue.component('menu-activators', require('./menu/activationMenu.vue').default);
Vue.component('messenger-card', require('./messenger/card.vue').default);
Vue.component('card-mails-user', require('./messenger/mail/card-user.vue').default);




Vue.component('todo-component', require('./tasks/Todos.vue').default);
Vue.component('notification-list', require('./notifications/NotificationList.vue').default);


export const bus = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    store,
    el: '#app',
});
