<template>
	<div class="vgl-home-hero-grid vgl-container" :style="{ '--bordder-color': borderColor, '--border-width': borderWidth }">
		<div class="vgl-content-wrapper">
			<div v-for="post in posts" :key="post.id" class="vgl-home-hero-grid-item">
				<div class="vgl-grid-item-featured-image" v-bind:style="{ 'background-image': 'url(' + post.featured_url + ')' }">
				</div>
				<div class="vgl-grid-info">
					<h2 class="vgl-grid-title"><a :href="post.permalink">{{ post.title }}</a></h2>
					<span>by {{ post.authorName }} | {{ post.category }}</span>
					<a :href="post.permalink">READ MORE</a>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	
	export default {
		name: 'HeroBannerGrid',
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
	.vgl-home-hero-grid {
		.vgl-home-hero-grid-item,
		.vgl-content-wrapper {
			&:before,
			&:after {
				content: '';
				display: table;
				clear: both;
			}

			.vgl-grid-item-featured-image {
				width: 100%;
				padding-top: calc(100% / 16 * 3);
				background-position: center;
				background-size: cover;
				background-repeat: no-repeat;
			}

			.vgl-grid-info {
				padding-top: 15px;
				padding-bottom: 15px;

				.vgl-grid-title {

					> a {
						font-family: SportingGrotesque;
						font-size: 24px;
						color: #000;
						text-decoration: none;
					}
				}

				> span {
					font-family: Lato;
					font-size: 14px;
					line-height: 17px;
					align-items: flex-end;
					display: block;
					margin-top: 15px;
					margin-bottom: 15px;
				}

				> a {
					font-family: Lato;
					font-size: 16px;
					line-height: 19px;
					color: #000;
					font-weight: normal;
				}
			}
		}

		.vgl-home-hero-grid-item:nth-child(1) {
			margin-bottom: 30px;

			.vgl-grid-item-featured-image {
				width: calc(100% / 3 * 2 - 15px);
				float: left;
			}

			.vgl-grid-info {
				width: calc(100% / 3 + 15px);
				float: left;
				padding-left: 20px;
				padding-right: 20px;

				.vgl-grid-title > a {
					font-size: 42px;
				}
			}
		}

		.vgl-home-hero-grid-item:nth-child(n + 2) {
			width: calc(100% / 3);
			float: left;
			padding-left: 15px;
			padding-right: 15px;

			.vgl-grid-item-featured-image {
				padding-top: calc(100% / 16 * 9);
			}
		}

		.vgl-home-hero-grid-item:nth-child(2) {
			padding-left: 0 !important;
		}

		.vgl-home-hero-grid-item:nth-child(4) {
			padding-right: 0 !important;
		}

		@media screen and (max-width: 1023px) {
			.vgl-home-hero-grid-item {
				width: 100% !important;
				padding-left: 0 !important;
				padding-right: 0 !important;

				.vgl-grid-item-featured-image {
					padding-top: calc(100% / 16 * 9) !important;
				}

				.vgl-grid-item-featured-image,
				.vgl-grid-info {
					width: 100% !important;
					clear: both !important;
				}
			}
		}
	}
</style>