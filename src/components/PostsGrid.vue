<template>
	<div class="vgl-posts vgl-container">
		<h2 class="posts-heading" v-if="heading != ' '">{{ heading }}</h2>
		<masonry :cols="colCount" :gutter="30" v-if="gridStyle == 'masonry'">
			<div v-for="post in updatedPosts" :key="post.id" class="vgl-post">
				<img :src="post.featured_url">
				<div class="vgl-post-info">
					<h3 class="title" v-html="post.title"></h3>
					<span><b>by</b> {{ post.authorName }} | {{ post.category }}</span>
					<a :href="post.permalink">READ MORE</a>
				</div>
			</div>
		</masonry>
		<div v-else-if="gridStyle == 'list'">
			<div v-for="post in updatedPosts" :key="post.id" class="vgl-post">
				<div class="featured-image">
					<div :style="{ 'background-image': 'url(' + post.featured_url + ')' }"></div>
				</div>
				<div class="post-info">
					<p class="title" v-html="post.title"></p>
					<p class="excerpt"></p>
					<span class="name_category"><b>by</b> {{ post.authorName }} | {{ post.category }}</span>
					<a :href="post.permalink">READ MORE</a>
				</div>
			</div>
		</div>
		<a class="vgl-loadmorebtn" v-if="showLoadMore" @click="loadMoreClicked()" :class="[{'active': isActive}]">{{ loadMoreText }}</a>
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
			startIndex: {
				type: Number,
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
			},
			showLoadMore: {
				type: Boolean,
				required: false
			},
			loadMoreText: {
				type: String,
				required: false
			},
			order: {
				type: String,
				required: false
			},
			orderBy: {
				type: String,
				required: false
			}
		},
		data: function() {
			return {
				index: this.startIndex + this.count,
				updatedPosts: this.posts,
				isActive: false,
				loadMorePostCount: 12
			}
		},
		methods: {
			loadMoreClicked: function() {
				this.isActive = true;

				window.jQuery.post( 
					window.ajaxurl,
					{
						action: 'vgl_loadmore_posts',
						data: {
							startIndex: this.index,
							order: this.order,
							orderBy: this.orderBy,
							count: this.loadMorePostCount
						}
					},
					{
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
							'Accept': 'text/html, */*; q=0.01'
						}
					}
				)
				.success( response => { JSON.parse(response).forEach( ele => this.updatedPosts.push(ele) ); this.index = this.index + this.loadMorePostCount; });
			}
		},
		computed: {

		},
		mounted: function() {

			if ( this.showLoadMore ) {
				console.log(this.loadMoreText);
				console.log(this.startIndex);
				console.log(this.count);
				console.log(this.index);
			}
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

	.vgl-posts {
		.vgl-loadmorebtn {
			font-family: SportingGrotesque;
			font-size: 24px;
			font-weight: normal;
			font-stretch: normal;
			font-style: normal;
			line-height: 24px;
			letter-spacing: normal;
			text-align: center;
			color: #000000;
			border: solid 1px #000000;
			background-color: #fff1d6;
			display: block;
			padding: 20px 30px 15px 30px;
			margin-left: auto;
			margin-right: auto;
			cursor: pointer;
			max-width: 400px;
			box-shadow: 5px 5px 0px #000;
			transition: all ease-in-out .2s;

			&.active {
				background-color: #fff;
			}
		}
	}

</style>