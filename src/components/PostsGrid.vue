<template>
	<div class="vgl-posts vgl-container">
		<masonry :cols="colCount" :gutter="30">
			<div v-for="post in posts" :key="post.id" class="vgl-post">
				<img :src="post.featured_url">
				<div class="vgl-post-info">
					<h3 class="title">{{ post.title }}</h3>
					<span>by {{ post.authorName }} | {{ post.category }}</span>
					<a :href="post.permalink">READ MORE</a>
				</div>
			</div>
		</masonry>
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
			}
		},
		data: function() {
			return {
				displayCount: this.count
			}
		},
		mounted: function() {
			// console.log(this.posts);
			// console.log(this.displayCount);
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

</style>