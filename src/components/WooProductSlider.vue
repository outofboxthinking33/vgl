<template>
	<div class="vgl-woo-product-slider vgl-container">
		<VueSlickCarousel v-bind="settings">
			<div v-for="product in products" :key="product.id" class="vgl-woo-product-slider-item">
				<div class="slider-image" :style="{ 'background-image': 'url(' + product.featured_url + ')'  }"></div>
				<div class="slider-content">
					<p class="title">{{ product.product_name }}</p>
					<p class="price">{{ product.currency }}{{ product.price }}</p>
				</div>
			</div>
		</VueSlickCarousel>
	</div>
</template>

<script>
	import VueSlickCarousel from 'vue-slick-carousel';

	export default {
		name: 'WooProductSlider',
		components: {
			VueSlickCarousel
		},
		props: {
			products: {
				type: Array,
				required: true
			},
			productCount: {
				type: Number,
				required: true
			},
			desktopSlideCount: {
				type: Number,
				required: true
			},
			mobileSlideCount: {
				type: Number,
				required: true
			}
		},
		data: function() {
			return {
				settings: {
					arrows: false,
					dots: true,
					infinite: false,
					slidesToScroll: 1,
					slidesToShow: this.desktopSlideCount,
					responsive: [
						{
							breakpoint: 768,
							settings: {
								slidesToShow: this.mobileSlideCount
							}
						}
					]
				},
				dotCount: 0
			}
		},
		mounted: function() {
			const dots = this.$el.querySelectorAll('.slick-dots li');
			this.dotCount = dots.length;
			// this.$el.querySelectorAll('.slick-dots li').setAttribute("width", "calc(100% / " + this.dotCount + ");")
			dots.forEach( element => { element.style.width = "calc(100% / " + this.dotCount + ")"; } )
		},
		computed: function() {
			return {

			}
		}
	};
</script>

<style lang="scss">
	.vgl-woo-product-slider {
		.vgl-woo-product-slider-item {
			padding-left: 30px;
			padding-right: 30px;

			.slider-image {
				padding-bottom: 100%;
				background-position: 50%;
				background-size: cover;
				border-radius: 50%;
				overflow: hidden;
				box-shadow: 7px 7px 0px #fedb02;
			}

			.slider-content {
				.title {
					font-size: 20px;
					font-weight: 900;
					text-align: center;
					margin-top: 10px;
					margin-bottom: 0;
					line-height: normal;
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
		}

		.slick-slider .slick-list {
			overflow: visible;
		}

		.slick-dots li {
			height: 7px;
			background-color: #a8abc9;
			margin: 0;
			padding: 0;
			float: left;
			transition: all ease-in-out .2s;
			-webkit-transition: all ease-in-out .2s;

			button {
				display: none;
			}
		}

		.slick-dots li.slick-active {
			background-color: #424242;
		}
	}
</style>