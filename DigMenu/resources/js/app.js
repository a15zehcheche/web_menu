/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

Array.prototype.unique=function(a){
    return function(){return this.filter(a)}}(function(a,b,c){return c.indexOf(a,b+1)<0
  });
Array.prototype.diff = function(arr2) {var ret = [];this.sort();arr2.sort();
for(var i = 0; i < this.length; i += 1) {if(arr2.indexOf(this[i]) > -1){ret.push(this[i]);}}return ret; 
};


require('./bootstrap');

window.Vue = require('vue');

import { Plugin } from 'vue-fragment'
Vue.use(Plugin)
import VueFilterDateFormat from 'vue-filter-date-format';
Vue.use(VueFilterDateFormat);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('test', require('./components/TestComponent.vue').default);
Vue.component('carta', require('./components/user/MenuComponent.vue').default);
Vue.component('carta-guest', require('./components/guest/MenuComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
