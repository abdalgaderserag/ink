
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('file-upload', require("vue-upload-component").default);
Vue.component('authorized-clients', require('./components/passport/AuthorizedClients.vue').default);


Vue.component('ink-main', require('./components/inks/InkMain.vue').default);
Vue.component('ink-card', require('./components/inks/InkCard.vue').default);

Vue.component('comments', require('./components/comment/Comments.vue').default);
Vue.component('comment-card', require('./components/comment/CommentCard.vue').default);
Vue.component('reply-card', require('./components/comment/ReplyCard.vue').default);

Vue.component('replies-card', require('./components/comment/RepliesCard.vue').default);



Vue.component('file-reader', require('./components/FileReader.vue').default);


Vue.component('search-filter', require('./components/search/searchFilter.vue').default);



Vue.component('pop-up', require('./components/PopUps/PopUp.vue').default);
Vue.component('create-ink', require('./components/PopUps/CreateInk.vue').default);
Vue.component('add-comment', require('./components/PopUps/AddComment.vue').default);
Vue.component('edit-ink', require('./components/PopUps/EditInk.vue').default);
Vue.component('edit-comment', require('./components/PopUps/EditComment.vue').default);
Vue.component('media-display', require('./components/PopUps/MediaDisplay.vue').default);




Vue.component('notification-main', require('./components/notification/NotificationMain.vue').default);


// Vue.component('profile', require('./components/Profile.vue').default);




// Vue.component('profile-ink-card', require('./components/inks/ProfileInkCard.vue').default);
// Vue.component('profile-ink-main', require('./components/inks/ProfileInkMain.vue').default);




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app'
// });


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


window.axios.defaults.headers.common["Accept"] = "application/json";
/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
