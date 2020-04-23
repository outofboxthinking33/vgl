import Vue from 'vue';
import VueMasonry from 'vue-masonry-css';
import App from './App.vue';
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.config.productionTip = false;

Vue.use(VueMasonry);
Vue.use(VueAxios, axios);

new Vue( App ).$mount( '#app' );
