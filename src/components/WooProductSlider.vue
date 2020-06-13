<template>
  <div class="vgl-woo-product-slider vgl-container">
    <VueSlickCarousel v-bind="settings">
      <div
        v-for="product in products"
        :key="product.id"
        class="vgl-woo-product-slider-item"
      >
        <div
          class="slider-image"
          :style="{ 'background-image': 'url(' + product.featured_url + ')' }"
        ></div>
        <div class="slider-content">
          <p class="title">{{ product.product_name }}</p>
          <p class="price">{{ product.currency }}{{ product.price }}</p>
        </div>
        <a class="add_to_cart" target="_blank" :href="product.shopnow_url">Shop now</a>
      </div>
    </VueSlickCarousel>
  </div>
</template>

<script>
import VueSlickCarousel from "vue-slick-carousel";

export default {
  name: "WooProductSlider",
  components: {
    VueSlickCarousel,
  },
  props: {
    products: {
      type: Array,
      required: true,
    },
    productCount: {
      type: Number,
      required: true,
    },
    desktopSlideCount: {
      type: Number,
      required: true,
    },
    mobileSlideCount: {
      type: Number,
      required: true,
    },
  },
  data: function() {
    return {
      settings: {
        arrows: true,
        dots: true,
        infinite: false,
        slidesToScroll: 1,
        slidesToShow: this.desktopSlideCount,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: this.mobileSlideCount,
              arrows: true,
              dots: false,
            },
          },
        ],
      },
      dotCount: 0,
    };
  },
  mounted: function() {
    const dots = this.$el.querySelectorAll(".slick-dots li");
    this.dotCount = dots.length;
    // this.$el.querySelectorAll('.slick-dots li').setAttribute("width", "calc(100% / " + this.dotCount + ");")
    dots.forEach((element) => {
      element.style.width = "calc(100% / " + this.dotCount + ")";
    });
  },
  computed: function() {
    return {};
  },
};
</script>

<style lang="scss">
.woo-slider-heading {
  text-align: center;
  font-size: 52px;
  font-weight: bold;
  text-align: center;
}

.woo-slider-subheading {
  text-align: center;
}

.vgl-woo-product-slider {
  .slick-next,
  .slick-prev {
    z-index: 100;
    left: initial;
    width: initial;
    height: initial;
    right: initial;
    top: -80px;
  }

  .slick-next:before,
  .slick-prev:before {
    font-family: initial;
    color: #000;
    font-size: 50px;
  }

  .slick-next {
    left: 50%;
    transform: translateX(50%);
  }

  .slick-prev {
    right: 50%;
    transform: translatex(-50%);
  }

  .vgl-woo-product-slider-item {
    padding-left: 30px;
    padding-right: 30px;

    .add_to_cart {
      font-family: Lato;
      font-size: 20px;
      font-weight: 700;
      background-color: #d4d6ea;
      padding: 15px 30px;
      display: block;
      text-align: center;
      width: 180px;
      margin: 0 auto;
      border: 2px solid #000;
      -webkit-box-shadow: 2px 5px 0 #000;
      box-shadow: 2px 5px 0 #000;
      text-decoration: none;
      color: #000;
      -webkit-transition: all 0.2s ease-out;
      -moz-transition: all 0.2s ease-out;
      -ms-transition: all 0.2s ease-out;
      -o-transition: all 0.2s ease-out;
      transition: all 0.2s ease-out;

      &:hover {
        transform: translate(6px, 6px);
        border-width: 1px;
        box-shadow: 1px 2px 0 #000;
      }
    }

    .slider-image {
      padding-bottom: 100%;
      background-position: 50%;
      background-size: 100%;
      border-radius: 50%;
      overflow: hidden;
      box-shadow: 7px 7px 0px #fedb02;
      -webkit-transition: all 0.5s ease-out;
      -moz-transition: all 0.5s ease-out;
      -ms-transition: all 0.5s ease-out;
      -o-transition: all 0.5s ease-out;
      transition: all 0.5s ease-out;
    }

    .slider-content {
      height: 95px;
      overflow-y: hidden;

      .title {
        font-size: 20px;
        font-weight: 900;
        text-align: center;
        margin-top: 10px;
        margin-bottom: 0;
        line-height: normal;
        max-height: 50px;
        overflow-y: hidden;
      }

      .price {
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        color: #424242;
        margin-top: 0;
        margin-bottom: 0;
      }
    }

    &:hover {
      .slider-image {
        background-size: 110%;
      }
    }
  }

  .slick-slider .slick-list {
    overflow: auto;
    padding: 15px 0px;
  }

  .slick-dots li {
    height: 7px;
    background-color: #a8abc9;
    margin: 0;
    padding: 0;
    float: left;
    transition: all ease-in-out 0.2s;
    -webkit-transition: all ease-in-out 0.2s;

    button {
      display: none;
    }
  }

  .slick-dots li.slick-active {
    background-color: #424242;
  }

  .slick-dots {
    position: relative;
    bottom: 0;
    margin-top: 50px;
  }

  @media screen and (min-width: 769px) {
    .slick-prev:before,
    .slick-next:before {
      font-family: auto;
      color: #000;
      font-size: 2.5rem;
    }
  }
}
</style>
