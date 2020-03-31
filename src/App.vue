<script>
import HelloWorld from './components/HelloWorld.vue';
import HeroBannerSlider from './components/HeroBannerSlider.vue';
import VueSlider from './components/VueSlider.vue';

export default {
  name: 'App',
  components: {
    HelloWorld,
    HeroBannerSlider,
    VueSlider
  },
  mounted() {
    this.initialize();
  },
  methods: {
    initialize() {
      console.log('stareted');
    }
  }
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
}
</style>
