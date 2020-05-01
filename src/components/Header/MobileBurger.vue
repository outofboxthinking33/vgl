<template>
	<div class="vgl-mobile-hamburger-container">
		<div class="mobile-hamburger" @click="hamburgerClicked">
			<div :class="['top-bar', { 'change': hamburgerActive }]"></div>
			<div :class="['middle-bar', { 'change': hamburgerActive }]"></div>
			<div :class="['bottom-bar', { 'change': hamburgerActive }]"></div>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'MobileBurger',
		props: {

		},
		data: function() {
			return {
				hamburgerActive: false
			};
		},
		methods: {
			hamburgerClicked: function() {
				this.hamburgerActive = !this.hamburgerActive;
				this.$eventBus.$emit('mobile-hamburger-clicked', this.hamburgerActive);
			}
		},
		mounted: function() {
			console.log("I'm mobile menu");
		}
	};
</script>

<style lang="scss">
	@media screen and (min-width: 1024px) {
		.vgl-mobile-hamburger-container {
			display: none;
		}
	}

	@media screen and (max-width: 1023px) {
		.vgl-mobile-hamburger-container {
			display: block;
			position: absolute;
			left: 0;
			right: 0;
			margin: 0 25px;
			top: 50%;
			transform: translateY(-50%);

			.mobile-hamburger {
				display: inline-block;
				float: right;

				.top-bar,
				.middle-bar,
				.bottom-bar {
					width: 30px;
					height: 2px;
					background-color: #333;
					margin: 6px 0;
					transition: all ease-in-out .3s;
				}

				.top-bar.change {
					transform: rotate(-45deg) translate(-10px, 10px);
				}

				.middle-bar.change {
					opacity: 0;
				}

				.bottom-bar.change {
					transform: rotate(45deg) translate(0px, -1px);
				}
			}

			.mobile-main-menu {
				display: none;

				&.active {
					display: block;
					position: absolute;
					top: 100%;
					left: 0;
					right: 0;

					ul > li {

						> a {
							font-family: Lato;
							font-size: 18px;
							font-weight: normal;
							font-stretch: normal;
							font-style: normal;
							line-height: 2.28;
							letter-spacing: 0.75px;
							color: #000000;
							text-decoration: none;
						}

						ul.sub-menu {
							display: none;
						}
					}
				}
			}
		}
	}
</style>