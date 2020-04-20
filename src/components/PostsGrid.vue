<template>
	<div class="vgl-posts vgl-container">
		<h2 class="posts-heading" v-if="heading != ' '">{{ heading }}</h2>
		<masonry :cols="colCount" :gutter="30" v-if="gridStyle == 'masonry'">
			<div v-for="post in posts" :key="post.id" class="vgl-post">
				<img :src="post.featured_url">
				<div class="vgl-post-info">
					<h3 class="title">{{ post.title }}</h3>
					<span><b>by</b> {{ post.authorName }} | {{ post.category }}</span>
					<a :href="post.permalink">READ MORE</a>
				</div>
			</div>
		</masonry>
		<div v-else-if="gridStyle == 'list'">
			<div v-for="post in posts" :key="post.id" class="vgl-post">
				<div class="featured-image">
					<div :style="{ 'background-image': 'url(' + post.featured_url + ')' }"></div>
				</div>
				<div class="post-info">
					<p class="title">{{ post.title }}</p>
					<p class="excerpt"></p>
					<span class="name_category"><b>by</b> {{ post.authorName }} | {{ post.category }}</span>
					<a :href="post.permalink">READ MORE</a>
				</div>
			</div>
		</div>
	</div>
</template>
	
<script>
	// import VueMasonry from 'vue-masonry-css';

	export default {
		name: "PostsGrid",
		components: {
			// VueMasonry
		},
		props: {
			posts: {
				type: Array,
				required: true
			},
			count: {
				type: Number,
				required: true
			},
			colCount: {
				type: Number,
				required: true
			},
			gridStyle: {
				type: Number,
				required: true
			},
			heading: {
				type: String,
				required: true
			}
		},
		data: function() {
			return {
				displayCount: this.count
			}
		},
		mounted: function() {
			console.log(this.heading);
		}
	};
</script>

<style lang="scss">
	
	.vgl-posts.masonry {
		.vgl-post {
			margin-bottom: 30px;

			&::before,
			&::after {
				content: none;
				display: none;
			}

			.vgl-post-info {
				margin-top: 20px;

				.title {
					font-family: SportingGrotesque;
					font-size: 30px;
					font-weight: bold;
					font-stretch: normal;
					font-style: normal;
					line-height: 1.37;
					letter-spacing: normal;
					color: #000000;
				}

				> span {
					font-family: Lato;
					font-size: 14px;
					font-weight: 300;
					font-stretch: normal;
					font-style: normal;
					line-height: normal;
					letter-spacing: normal;
					color: #424242;
					display: block;
					font-weight: bold;
				}

				> a {
					font-family: Lato;
					font-size: 14px;
					font-weight: 300;
					font-stretch: normal;
					font-style: normal;
					line-height: normal;
					letter-spacing: normal;
					color: #424242;
					display: inline-block;
					margin-top: 13px;
					text-decoration: underline;
				}
			}
		}
	}

	.vgl-posts.list {
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
			transform: rotate(-90deg) translate(-100%,-100%);
			transform-origin: top left;
			top: 0;
			left: 0;
		}
		
		.vgl-post{
			margin-bottom: 50px;

			&:before,
			&:after {
				content: '';
				display: table;
				clear: both;
			}

			.featured-image {
				width: 50%;
				float: left;
				padding-right: 15px;

				> div {
					padding-top: calc(100% / 16 * 8);
					background-size: cover;
					background-repeat: no-repeat;
					background-position: center;
				}
			}

			.post-info {
				width: 50%;
				float: left;
				padding-left: 15px;

				.title {
					font-size: 28px;
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
					display: block;
					margin-top: 10px;
					margin-bottom: 30px;
				}

				> a {
					font-size: 16px;
					font-weight: 700;
					font-stretch: normal;
					font-style: normal;
					line-height: normal;
					letter-spacing: normal;
					color: #000000;
				}
			}
		}
	}

</style>