<template>
	<div class="vgl-home-hero-slider">
		<ul>
			<li v-for="post in posts" :key="post.title">{{ post.title }}</li>
		</ul>
	</div>
</template>

<script>
	export default {
		name: 'HeroBannerSlider',
		props: ['posts']
	};
</script>