<template>
	<div class="vgl-hot-posts vgl-container">
		<div v-for="post in posts" :key="post.id" :class="[{ 'col-full': colCount == 1, 'col-half': colCount == 2, 'col-one-third': colCount == 3, 'col-one-fourth': colCount == 4, 'col-one-fifth': colCount == 5 }, 'vgl-hot-post']">
			<img :src="post.featured_url">
			<div>
				<span>{{ post.category }}</span>
				<p>{{ post.title }}</p>
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
			}
		},
		mounted: function() {
			// console.log(this.posts);
			// console.log(this.colCount);
		}
	};
</script>

<style>
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
		margin-bottom: 0;
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
</style>