<template>
	<div class="vgl-woo-product-slider vgl-container">
		
	</div>
</template>

<script>
	import VueSlickCarousel from 'vue-slick-carousel';

	export default {
		name: 'WooProductSlider',
		components: {
			VueSlickCarousel
		},
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

<style>
	
</style>