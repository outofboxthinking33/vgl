<template>
	<div class="vgl-home-hero-slider vgl-container" :style="{ '--bordder-color': borderColor, '--border-width': borderWidth }">
		<div class="vgl-slider-item-border-bottom"></div>
		<VueSlickCarousel :slidesToShow="1" :slidesToScroll="1" :speed="1000" :autoplay="true" :infinite="true" :dots="true">
			{{ borderColor }}
			<div v-for="post in posts" :key="post.id">
				<div class="vgl-slider-item" v-bind:style="{ 'background-image': 'url(' + post.featured_url + ')' }">
					<div class="vgl-slider-info">
						<h2 class="vgl-slider-title"><a :href="post.permalink">{{ post.title }}</a></h2>
						<span>by {{ post.authorName }} | {{ post.category }}</span>
					</div>
				</div>
			</div>
		</VueSlickCarousel>
		<HelloWorld></HelloWorld>
	</div>
</template>

<script>
	import VueSlickCarousel from 'vue-slick-carousel';

	export default {
		name: 'HeroBannerSlider',
		components: {
			VueSlickCarousel
		},
		props: {
			posts: {
				type: Array,
				default: () => [{title: 'aaa', id: 1}, {title: 'bbb', id: 2}]
			},
			borderColor: {
				type: String,
				required: false
			},
			borderWidth: {
				type: String,
				required: false
			}
		},
		mounted: function() {
			
		},
		computed: function() {
			return {

			}
		}
	};
</script>

<style lang="scss">
	@import '../../node_modules/vue-slick-carousel/dist/vue-slick-carousel.css';
	@import '../../node_modules/vue-slick-carousel/dist/vue-slick-carousel-theme.css';
	
	.vgl-home-hero-slider {
		clip-path: polygon(0 0, 100% 0, 100% 95%, 50% 100%, 0 95%);
		-webkit-clip-path: polygon(0 0, 100% 0, 100% 95%, 50% 100%, 0 95%);
	}

	.vgl-slider-item {
		position: relative;
		min-height: 80vh;
		max-height: 90vh;
		background-size: cover;
		background-position: center;
	}

	.vgl-slider-item-border-bottom {
		position: absolute;
		left: 0;
		bottom: 0;
		height: calc(5% + var(--border-width));
		width: 100%;
		background: var(--bordder-color);
		clip-path: polygon(0 0, 50% calc(100% - var(--border-width)), 100% 0, 100% 100%, 0 100%);
		z-index: 10;
	}

	.vgl-slider-info {
		width: 50%;
		text-align: left;
		padding-left: 70px;
		position: absolute;
		bottom: 100px;

		@media screen and (max-width: 768px) {
			width: 100%;
			padding-left: 25px;
			padding-right: 25px;
			bottom: 60px;

			> .vgl-slider-title a {
				font-size: 24px;
			}

			> span {
				font-size: 10px;
			}
		}

	}

	.vgl-slider-title a{
		font-family: SportingGrotesque;
		font-size: 42px;
		font-weight: bold;
		font-stretch: normal;
		font-style: normal;
		line-height: 1.24;
		letter-spacing: normal;
		color: #ffffff;
		text-decoration: none;
	}

	.vgl-slider-info span {
		opacity: 0.6;
		font-family: Lato;
		font-size: 18px;
		font-weight: bold;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		color: #ffffff;
	}

	.vgl-home-hero-slider .slick-dots {
		bottom: 100px;
		right: 70px;
		display: inline-block !important;
		width: initial;

		@media screen and (max-width: 768px) {
			bottom: 55px;
			right: 25px;
		}
	}

	.vgl-home-hero-slider .slick-dots li button:before {
		opacity: .75;
		color: #000;
		width: 15px;
		height: 2px;
		border-bottom: solid 3px #ffffff;
		content: '';
		line-height: 0;
	}

	.vgl-home-hero-slider .slick-dots li.slick-active button:before {
		border-color: #ff7b64;
	}

	.vgl-home-hero-slider .slick-dots li, 
	.vgl-home-hero-slider .slick-dots li button {
		width: 15px;
	}
</style>

