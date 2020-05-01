<template>
	<div class="vgl-posts vgl-container">
		<h2 class="posts-heading" v-if="heading != ' '">{{ heading }}</h2>
		<masonry :cols="{default: colCount, 1023: 1}" :gutter="100" v-if="gridStyle == 'masonry'">
			<div v-for="(post, index) in updatedPosts" :key="post.id" :class="['vgl-post']">
				<div :class="['featured-image', 'index'+ index]">
					<div :style="{ 'background-image': 'url(' + post.featured_url + ')' }"><a :href="post.permalink"></a></div>
				</div>
				<div :class="['vgl-post-info', 'index' + index]">
					<a :href="post.permalink"><h3 class="title" v-html="post.title"></h3></a>
					<span><b>by</b> {{ post.authorName }} | {{ post.category }}</span>
					<a class="read_more" :href="post.permalink">READ MORE</a>
				</div>
			</div>
		</masonry>
		<div v-else-if="gridStyle == 'list'">
			<div v-for="post in updatedPosts" :key="post.id" class="vgl-post">
				<div class="featured-image">
					<div :style="{ 'background-image': 'url(' + post.featured_url + ')' }"><a :href="post.permalink"></a></div>
				</div>
				<div class="post-info">
					<a :href="post.permalink"><p class="title" v-html="post.title"></p></a>
					<p class="excerpt"></p>
					<span class="name_category"><b>by</b> {{ post.authorName }} | {{ post.category }}</span>
					<a class="read_more" :href="post.permalink">READ MORE</a>
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
				loadMorePostCount: 12,
				postIndex: 0
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
	
	.vgl-posts {
		a {
			text-decoration: none;
		}
	}

	.vgl-posts.masonry {

		.vgl-post {
			margin-bottom: 100px;

			.featured-image {
				width: 100%;

				> div {
					padding-top: calc(100% / 16 * 10);
					background-size: cover;
					background-repeat: no-repeat;
					background-position: center;

					a {
						position: absolute;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
					}
				}

				&.index0 > div {
					padding-top: 150%;
				}

				&.index1 {
					@media screen and (min-width: 1024px) {
						padding-top: 100px;
					}

					> div {
						padding-top: 100%;
					}
				}

				&.index2 > div {
					padding-top: 50%;
				}

				&.index3 > div {
					padding-top: 100%;
				}
			}

			img {
				object-fit: cover;
			}

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

				&.index0 {
					.title {
						@media screen and (min-width: 1024px) {
							font-size: 52px;
						}
					}
				}

				> span {
					font-family: Lato;
					font-size: 14px;
					font-weight: 500;
					font-stretch: normal;
					font-style: normal;
					line-height: normal;
					letter-spacing: normal;
					color: #424242;
					display: block;
					font-weight: bold;
				}

				> a.read_more {
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

			@media screen and (max-width: 768px) {
				position: relative;
				max-width: 350px;
				margin-left: auto;
				margin-right: auto;
				font-size: 42px;
				transform: none;
				text-align: center;
				margin-bottom: 50px;
			}
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
				position: relative;

				> div {
					padding-top: calc(100% / 16 * 8);
					background-size: cover;
					background-repeat: no-repeat;
					background-position: center;

					a {
						position: absolute;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
					}
				}

				@media screen and (max-width: 768px) {
					width: 100%;
					float: none;
					padding-right: 0;
				}
			}

			.post-info {
				width: 50%;
				float: left;
				padding-left: 15px;

				@media screen and (max-width: 768px) {
					width: 100%;
					float: none;
					padding-left: 0;
					padding-top: 30px;
				}

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