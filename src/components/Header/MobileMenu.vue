<template>
	<div :class="['vgl-mobile-menu', {'active': showMobile}]">
		<div class="mobile-menu">
			<slot name="mobile-menu"></slot>
		</div>
		<slot name="mobile-middle"></slot>
		<slot name="mobile-bottom-menu"></slot>
	</div>
</template>

<script>
	export default {
		name: 'MobileMenu',
		props: {

		},
		data: function() {
			return {
				showMobile: false
			};
		},
		methods: {
			clickMenuItem: function(event) {
				var ele = event.target.querySelector('ul.sub-menu');
				console.log(ele);
				if (ele) {
					if ( ele.classList.contains('active') ) {
						ele.classList.remove('active');	
					} else {
						ele.classList.add('active');
					}
				}

				if ( event.target.classList.contains('active') ) {
					event.target.classList.remove('active');	
				} else {
					event.target.classList.add('active');
				}
			}
		},
		mounted: function() {
			this.$eventBus.$on('mobile-hamburger-clicked', function(val) {
				this.showMobile = val;
				console.log(this.showMobile);
				window.jQuery('header').toggleClass('active');
			}.bind(this));

			this.$el.querySelectorAll('.mobile-menu > ul > li').forEach( ele => ele.addEventListener('click', this.clickMenuItem) );
		}
	};
</script>

<style lang="scss">
	.vgl-mobile-menu {
		display: none;
	}

	@media screen and (max-width: 1023px) {
		.vgl-mobile-menu.active {
			display: block;

			.mobile-menu {

				padding-left: 50px;
				padding-right: 50px;

				> ul {

					& > li {
						border-bottom: solid 1px rgba(248, 177, 149, 0.47);

						&.active{
							border-bottom: none;

							a {
								font-weight: bold;
							}
						}

						&:first-child {
							border-top: solid 1px rgba(248, 177, 149, 0.47);
						}

						& > a {
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
							padding-top: 20px;
							padding-bottom: 20px;

							&:before,
							&:after {
								content: '';
								display: table;
								clear: both;
							}

							& > li {
								width: 50%;
								float: left;
							}

							& > li > a {
								font-family: Lato;
								font-size: 18px;
								font-weight: normal;
								font-stretch: normal;
								font-style: normal;
								line-height: 2.22;
								letter-spacing: 0.79px;
								color: #000000;
								text-decoration: none;
							}

							&.active {
								display: block;
								border-bottom: solid 1px rgba(248, 177, 149, 0.47);
							}
						}

					}
				}

			}
		}
	}
</style>