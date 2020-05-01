<template>
	<div class="vgl-posts vgl-container">
		<h2 class="posts-heading">{{ heading }}</h2>
		<VueSlickCarousel v-bind="settings">
			<div v-for="post in posts" :key="post.id" class="vgl-posts-slider-item">
				<div class="featured_image" :style="{ 'background-image': 'url(' + post.featured_url + ')' }"></div>
				<div class="post-info">
					<p class="title">{{ post.title }}</p>
					<p class="name_category"><span>by </span>{{ post.authorName }} | {{ post.category }}</p>
					<a class="read_more btn" :href="post.permalink">Read More</a>
				</div>
			</div>
		</VueSlickCarousel>
	</div>
</template>

<script>
	import VueSlickCarousel from 'vue-slick-carousel';

	export default {
		name: "PostsSlider",
		components: {
			VueSlickCarousel
		},
		props: {
			posts: {
				type: Array,
				required: true
			},
			heading: {
				type: String,
				required: true
			},
			count: {
				type: Number,
				required: true
			},
			desktopSliderShow: {
				type: Number,
				required: true
			},
			mobileSlidershow: {
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
					slidesToShow: this.desktopSliderShow,
					responsive: [
						{
							breakpoint: 768,
							settings: {
								slidesToShow: this.mobileSlidershow,
								arrows: true
							}
						}
					]
				},
				dotCount: 0
			}
		},
		computed: function() {

		},
		mounted: function() {
			const dots = this.$el.querySelectorAll('.slick-dots li');
			this.dotCount = dots.length;
			dots.forEach( element => { element.style.width = "calc(100% / " + this.dotCount + ")"; } );
		}
	};
</script>

<style lang="scss">
	.vgl-posts.slider {
		position: relative;

		@media screen and (max-width: 768px) {
			.slick-next, .slick-prev {
				z-index: 100;
				left: initial;
				width: initial;
				height: initial;
				right: initial;
				top: -80px;
			}

			.slick-next:before, .slick-prev:before {
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
		}

		.posts-heading {
			font-size: 30px;
			font-weight: bold;
			font-stretch: normal;
			font-style: normal;
			line-height: 1.37;
			letter-spacing: normal;
			color: #000000;
			position: absolute;
			z-index: 100;
			transform: rotate(-90deg) translate(-100%, -50%);
			transform-origin: top left;
			top: 0;
			left: 0;

			@media screen and (max-width: 768px) {
				position: relative;
				transform: none;
				left: initial;
				top: initial;
				text-align: center;
				margin-bottom: 90px;
				font-size: 42px;
				max-width: 360px;
				margin-left: auto;
				margin-right: auto;
			}
		}		

		.vgl-posts-slider-item {
			padding-left: 30px;
			padding-right: 30px;

			.featured_image {
				padding-top: 125%;
				background-size: cover;
				background-position: center;
				background-repeat: no-repeat;
				border: solid 2px #fff;
			}

			.post-info {
				margin-top: 15px;

				.title {
					font-size: 29px;
					font-weight: 800;
					font-stretch: normal;
					font-style: normal;
					line-height: normal;
					letter-spacing: normal;
					color: #000000;
					margin-top: 0;
					margin-bottom: 0;
				}

				.name_category {
					font-size: 14px;
					font-weight: 300;
					font-stretch: normal;
					font-style: normal;
					line-height: normal;
					letter-spacing: normal;
					color: #424242;
				}

				.read_more {
					font-size: 16px;
					font-weight: normal;
					font-stretch: normal;
					font-style: normal;
					line-height: normal;
					letter-spacing: normal;
					color: #000000;
					text-transform: uppercase;
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

		.slick-dots {
			position: relative;
			bottom: 0;
			margin-top: 50px;

			@media screen and (max-width: 768px) {
				display: none !important;
			}
		}
	}
</style>