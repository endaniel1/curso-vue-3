/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>


const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(
	key.split('/components/admin/').pop().split('.')[0], files(key).default))
 */
Vue.component('index-thought-component', require('./components/admin/IndexThoughtComponent.vue').default);

Vue.component('form-thought-component', require('./components/admin/FormThoughtComponent.vue').default);
Vue.component('lists-thought-component', require('./components/admin/ListsThoughtComponent.vue').default);


Vue.component('form-user-component', require('./components/admin/FormUserComponent.vue').default);
Vue.component('home-component', require('./components/admin/HomeComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        currentPage: 'home-component',
    },
    methods: {
        switchTo: function(component) {
            this.currentPage = component;
        }
    },
    computed: {
        switchTo: function() {
            this.currentPage = page;
        }
    }
})