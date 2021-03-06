window.$ = require('jquery');
window.marked = require('marked');
window.hightlight = require('./vendor/highlight.min');

/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('jumbotron', require('./components/Jumbotron.vue'));
Vue.component('parse', require('./components/Parse.vue'));
Vue.component('avatar', require('./components/Avatar.vue'));
Vue.component('comment', require('./components/Comment.vue'));

const app = new Vue({
    el: '#app'
});
