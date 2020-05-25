import Vue from 'vue';
import VueMasonry from 'vue-masonry-css';
import App from './App.vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueCookies from 'vue-cookies';

Vue.prototype.$eventBus = new Vue();

Vue.config.productionTip = false;
Vue.config.devtools = true

Vue.use(VueMasonry);
Vue.use(VueAxios, axios);
Vue.use(VueCookies);
Vue.$cookies.config('7d');

new Vue( App ).$mount( '#app' );
