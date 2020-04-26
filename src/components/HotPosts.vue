<template>
	<div class="vgl-hot-posts vgl-container">
		<div class="vgl-content-wrapper">
			<h2 class="vgl-hot-post-title">{{ title }} <img src="/wp-content/themes/very-good-light/src/assets/fire.png"></h2>
			<div v-for="post in posts" :key="post.id" :class="[{ 'col-full': colCount == 1, 'col-half': colCount == 2, 'col-one-third': colCount == 3, 'col-one-fourth': colCount == 4, 'col-one-fifth': colCount == 5 }, 'vgl-hot-post']">
				<img :src="post.featured_url">
				<div>
					<span><b>by</b> {{ post.authorName }} | {{ post.category }}</span>
					<p>{{ post.title }}</p>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'HotPosts',
		props: {
			posts: {
				type: Array,
				required: true
			},
			colCount: {
				type: Number,
				required: true
			},
			title: {
				type: String,
				required: false
			}
		},
		mounted: function() {
			// console.log(this.posts);
			// console.log(this.colCount);
		}
	};
</script>

<style lang="scss">
	.vgl-hot-posts .vgl-hot-post {
		margin-top: 30px;
		margin-bottom: 30px;
	}

	.vgl-hot-posts .vgl-hot-post img {
		width: 40%;
		padding-right: 25px;
		float: left;
	}

	.vgl-hot-posts .vgl-hot-post > div {
		width: 60%;
		float: left;

		@media screen and (max-width: 1023px) {
			display: flex;
			flex-wrap: wrap;
			flex-flow: column-reverse;
		}
	}

	.vgl-hot-posts .vgl-hot-post > div > p {
		font-size: 18px;
		font-weight: 900;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		color: #000000;
		margin-top: 5px;
		margin-bottom: 5px;
	}

	.vgl-hot-posts .vgl-hot-post > div > span {
		font-size: 14px;
		font-weight: 300;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: 1px;
		color: #454545;
	}

	.vgl-hot-post-title {
		color: #454545;
		font-size: 20px;
		font-style: italic;
		position: absolute;
		left: 0;
		top: 0;
		-webkit-transform-origin: top left;
		transform: rotate(-90deg) translate(-100%, -100%);

		img {
			width: 20px;
		}
	}

	@media screen and (max-width: 1023px) {
		.vgl-hot-posts .vgl-hot-post {
			width: 100%;
		}

		.vgl-hot-post-title {
			position: relative;
			top: initial;
			left: initial;
			transform: initial;
			padding-left: 15px;
			padding-right: 15px;
		}
	}
</style>