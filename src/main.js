import Vue from 'vue';
import VueMasonry from 'vue-masonry-css';
import App from './App.vue';

Vue.config.productionTip = false;

Vue.use(VueMasonry);

new Vue( App ).$mount( '#app' );
