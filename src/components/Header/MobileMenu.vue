<template>
	<div :class="['vgl-mobile-menu', {'active': showMobile}]">
		<div class="mobile-menu">
			<slot name="mobile-menu"></slot>
		</div>
		<div class="mobile-darkmode-container">
			<div class="mobile-darkmode-status">
				<img :src="isDarkMode == true ? darkModeActiveIcon : darkModeDeactiveIcon">
				<span>Dark Mode</span>
			</div>
			<ButtonRadio></ButtonRadio>
		</div>
		<div class="mobile-social">
			<slot name="mobile-social"></slot>
		</div>
		<slot name="mobile-middle"></slot>
		<slot name="mobile-bottom-menu"></slot>
	</div>
</template>

<script>
	import ButtonRadio from '../Minor/ButtonRadio.vue';

	export default {
		name: 'MobileMenu',
		components: {
			ButtonRadio
		},
		props: {
			darkModeActiveIcon: {
				type: String,
				required: false
			},
			darkModeDeactiveIcon: {
				type: String,
				required: false	
			}
		},
		data: function() {
			return {
				showMobile: false,
				isDarkMode: false
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
				window.jQuery('header').toggleClass('active');
				console.log(this.isDarkMode);
			}.bind(this));

			this.$eventBus.$on('radio-button-status', function(val) {
				// this.isDarkMode = !this.isDarkMode;
				this.isDarkMode = val;

				this.$cookies.set('darkMode', this.isDarkMode);

				if (this.isDarkMode) {
					document.querySelector('body').classList.add('mode-dark');
				} else {
					document.querySelector('body').classList.remove('mode-dark');
				}

			}.bind(this));

			if(this.$cookies.isKey('darkMode')) {

				if (this.$cookies.get('darkMode') == 'true') {
					this.isDarkMode = true;
					document.querySelector('body').classList.add('mode-dark');
				} else {
					this.isDarkMode = false;
					document.querySelector('body').classList.remove('mode-dark');
				}
			}

			this.$el.querySelectorAll('.mobile-menu > ul > li.menu-item-has-children').forEach( ele => ele.addEventListener('click', this.clickMenuItem) );

			this.$el.querySelector('.mobile-menu > ul > li.menu-item-has-children').classList.add('active');
			this.$el.querySelector('.mobile-menu > ul > li.menu-item-has-children > ul.sub-menu').classList.add('active');
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
			padding-left: 25px;
			padding-right: 25px;

			.mobile-menu {

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
							padding-left: 10px;
							padding-right: 10px;
						}

						ul.sub-menu {
							display: none;
							padding-top: 20px;
							padding-bottom: 20px;
							padding-left: 10px;
							padding-right: 10px;

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

			.mobile-social {
				padding-top: 10px;
				padding-bottom: 10px;
				border-bottom: 1px solid rgba(248,177,149,.47);
				display: flex;
				display: -webkit-flex;
				display: -moz-lex;
				display: -moz-flex;
				justify-content: space-between;
				-webkit-justify-content: space-between;
				-moz-justify-content: space-between;
				-ms-justify-content: space-between;
				padding-left: 10px;
				padding-right: 10px;

				.mobile-social-icon {
					font-size: 25px;
					color: #000;
				}
			}

			.mobile-darkmode-container {
				display: flex;
				display: -webkit-flex;
				display: -moz-flex;
				display: -ms-flex;
				align-items: center;
				-webkit-align-items: center;
				-moz-align-items: center;
				-ms-align-items: center;
				justify-content: space-between;
				-webkit-justify-content: space-between;
				-moz-justify-content: space-between;
				-ms-justify-content: space-between;
				padding-top: 10px;
				padding-bottom: 10px;
				border-bottom: 1px solid rgba(248,177,149,.47);
				padding-left: 10px;
				padding-right: 10px;

				.mobile-darkmode-status {
					display: flex;
					display: -webkit-flex;
					display: -moz-flex;
					display: -ms-flex;
					align-items: center;
					-webkit-align-items: center;
					-moz-align-items: center;
					-ms-align-items: center;

					> img {
						max-width: 25px;
						margin-right: 10px;
					}
				}
			}
		}
	}
</style>