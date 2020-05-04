<template>
	<div class="vgl-menu" :class="[{'active': hover}, menuStyle]" @mouseleave="hover = false">
		<div class="menu-container">
			<slot name="menu"></slot>
			<transition name="fade">
				<ul class="vgl-sub-menus" v-show="hover">
					<li v-for="submenu in subMenus" :key="submenu.id" v-html="submenu.item"></li>
				</ul>
			</transition>
		</div>
	</div>
</template>
<script>
	export default {
		name: 'RectangleMenu',
		props: {
			menuStyle: {
				type: String,
				required: true
			}
		},
		data: function() {
			return {
				subMenus: [],
				hover: false
			};
		},
		methods: {
			updateSubMenus: function() {
				const menuItem = this.$el.querySelector('ul#menu-primary-menu > .menu-item.active');
				this.subMenus = [];
				menuItem.querySelectorAll('.sub-menu > li').forEach( (ele, idx) => this.subMenus.push({ id: idx, item: ele.innerHTML }) );
			},
			mouseOver: function( event ) {
				if ( event.srcElement.nodeName.toLowerCase() == 'a' ) {
					const allMenuItems = this.$el.querySelectorAll('ul#menu-primary-menu > .menu-item');
					allMenuItems.forEach( ele => ele.classList.remove("active"));
					event.target.parentNode.classList.add("active");
					this.updateSubMenus();
					this.hover = true;
				}
			}
		},
		mounted: function() {
			this.$el.querySelectorAll('ul#menu-primary-menu > .menu-item.menu-item-has-children > a').forEach( ele => ele.addEventListener('mouseover', this.mouseOver) );

			const firstMenuItem = this.$el.querySelector('ul#menu-primary-menu > .menu-item');
			const allMenuItems = this.$el.querySelectorAll('ul#menu-primary-menu > .menu-item');

			allMenuItems.forEach( ele => ele.classList.remove("active"));
			firstMenuItem.classList.add("active");

			this.updateSubMenus();
		}
	};
</script>
<style lang="scss">
	@media screen and (min-width: 1024px) {
		.vgl-menu {
			.menu-container {
				height: 100%;
			}

			&.rectangle_menu {
				height: 100%;
				position: absolute;
				top: 0;
				right: 50px;

				ul.vgl-sub-menus {
					// display: none;
					background-color: transparent;
					opacity: 0;
					min-height: 50px;
					padding: 0 40px 40px 40px;
					position: absolute;
					top: calc(100% - 0px);
					width: 100%;
				}

				ul#menu-primary-menu{
					height: 100%;
					width: 100%;
					padding: 0 40px;
					display: flex;
					display: -webkit-flex;
					display: -moz-flex;
					display: -ms-flex;
					align-items: center;
					-webkit-align-items: center;
					-moz-algin-items: center;
					-ms-aligin-items: center;
					transition: background-color ease-in-out .3s;

					&:before,
					&:after {
						content: '';
						display: table;
						clear: both;
					}

					> li{
						display: inline-block;
						float: left;
						margin-left: 10px;
						margin-right: 10px;
						position: relative;

						&:first-child {
							margin-left: 0;
						}

						&:last-child {
							margin-right: 0;
						}

						&.active:before,
						&.active:focus {
							background-color: #fbc6bbff;
						}

						&.active:before,
						&.active:focus {
							content: '';
							position: absolute;
							top: 50%;
							bottom: 0;
							left: 0;
							right: 0;
							background-color: transparent;
							z-index: 1;
							transition: all ease-in-out .2s;
							-webkit-transition: all ease-in-out .2s;
						}

						&:hover:before,
						&:focus:before {
							background-color: #fbc6bbff;
							z-index: 1;
						}

						> a {
							position: relative;
							z-index:10;
							font-size: 16px;
							font-weight: 500;
							font-stretch: normal;
							font-style: normal;
							line-height: normal;
							letter-spacing: 0.7px;
							text-align: center;
							color: #000000;
							text-transform: uppercase;
							text-decoration: none;
						}
					}
				}

				ul.sub-menu {
					display: none;
				}

				ul.active {
					// display: block;
				}

				.vgl-sub-menus li {
					padding-top: 30px;
					width: 50%;
					float: left;

					> a{
						font-size: 16px;
						font-weight: 300;
						font-stretch: normal;
						font-style: normal;
						line-height: 1.94;
						letter-spacing: 0.7px;
						color: #000000;
						text-decoration: none;
					}
				}
			}

			&.rectangle_menu.active {

				ul#menu-primary-menu {
					background-color: #fffcf2;
					border-right: 3px solid #fbc6bb;
				}

				.vgl-sub-menus {
					display: block;
					width: 100%;
					background-color: #fffcf2;
					border-bottom: 3px solid #fbc6bb;
					border-right: 3px solid #fbc6bb;
					opacity: 1;


					&:before {
						content: '';
						background-color: #fbc6bb;
						position: absolute;
						top: 0;
						left: 40px;
						right: 40px;
						height: 1px;
					}

					&:after {
						content: '';
						display: table;
						clear: both;
					}
				}
			}
		}
	}

	@media screen and (max-width: 1023px) {
		.vgl-menu {
			&.rectangle_menu {
				display: none;
			}
		}
	}

	.fade-enter,
	.fade-leave-to {
		opacity: 0;
		background-color: transparent !important;
	}

	.fade-enter-active,
	.fade-leave-active {
		transition: all ease-in-out .3s;
	}

	.fade-leave-active {

	}
</style>