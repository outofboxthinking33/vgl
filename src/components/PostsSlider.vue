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
								slidesToShow: this.mobileSlidershow
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
			transform: rotate(-90deg) translateY(-50%);
			transform-origin: top left;
			bottom: 50%;
		}		

		.vgl-posts-slider-item {
			padding-left: 30px;
			padding-right: 30px;
			border: solid 2px #fff;

			.featured_image {
				padding-top: 125%;
				background-size: cover;
				bacgkround-position: center;
				background-repeat: no-repeat;
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
	}
</style>