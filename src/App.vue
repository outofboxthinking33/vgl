<script>
import ButtonRadio from './components/Minor/ButtonRadio.vue';
import RectangleMenu from './components/Header/RectangleMenu.vue';
import MobileBurger from './components/Header/MobileBurger.vue';
import MobileMenu from './components/Header/MobileMenu.vue';
import HelloWorld from './components/HelloWorld.vue';
import HeroBannerSlider from './components/HeroBannerSlider.vue';
import HeroBannerGrid from './components/HeroBannerGrid.vue';
import VueSlider from './components/VueSlider.vue';
import HotPosts from './components/HotPosts.vue';
import PostsGrid from './components/PostsGrid.vue';
import WooProductSlider from './components/WooProductSlider.vue';
import PostsSlider from './components/PostsSlider.vue';

export default {
  name: 'App',
  components: {
    ButtonRadio,
    RectangleMenu,
    MobileBurger,
    MobileMenu,
    HelloWorld,
    HeroBannerSlider,
    HeroBannerGrid,
    VueSlider,
    HotPosts,
    PostsGrid,
    WooProductSlider,
    PostsSlider
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
