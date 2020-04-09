<script>
import HelloWorld from './components/HelloWorld.vue';
import HeroBannerSlider from './components/HeroBannerSlider.vue';
import VueSlider from './components/VueSlider.vue';
import HotPosts from './components/HotPosts.vue';
import PostsGrid from './components/PostsGrid.vue';

export default {
  name: 'App',
  components: {
    HelloWorld,
    HeroBannerSlider,
    VueSlider,
    HotPosts,
    PostsGrid
  },
  mounted() {
    this.initialize();
  },
  methods: {
    initialize() {

    }
  }
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
</style>
