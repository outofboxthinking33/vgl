<template>
	<div class="vgl-menu" :class="[menuStyle]" @click="menuClicked($event)">
		<slot name="menu"></slot>
		<ul class="vgl-sub-menus">
			<li v-for="submenu in subMenus" :key="submenu.id" v-html="submenu.item"></li>
		</ul>
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
				subMenus: []
			};
		},
		methods: {
			updateSubMenus: function() {
				const menuItem = this.$el.querySelector('ul#menu-primary-menu > .menu-item.active');
				this.subMenus = [];
				menuItem.querySelectorAll('.sub-menu > li').forEach( (ele, idx) => this.subMenus.push({ id: idx, item: ele.innerHTML }) );
			},
			menuClicked: function( event ) {
				if ( event.srcElement.nodeName.toLowerCase() == 'a' ) {
					const allMenuItems = this.$el.querySelectorAll('ul#menu-primary-menu > .menu-item');
					allMenuItems.forEach( ele => ele.classList.remove("active"));
					event.target.parentNode.classList.add("active");
					this.updateSubMenus();
				}
			}
		},
		mounted: function() {
			const firstMenuItem = this.$el.querySelector('ul#menu-primary-menu > .menu-item');
			const allMenuItems = this.$el.querySelectorAll('ul#menu-primary-menu > .menu-item');

			allMenuItems.forEach( ele => ele.classList.remove("active"));
			firstMenuItem.classList.add("active");

			this.updateSubMenus();
		}
	};
</script>
<style lang="scss">
	.vgl-menu {
		&.rectangle_menu {
			padding: 50px 40px;
			position: absolute;
			top: 0;
			right: 50px;
			background-color: #fffcf2;
			border-bottom: solid 3px #fbc6bb;
			border-right: solid 3px #fbc6bb;

			ul#menu-primary-menu{
				padding-bottom: 30px;
				border-bottom: solid 1px #fbc6bb;

				&:before,
				&:after {
					content: '';
					display: table;
					clear: both;
				}

				> li{
					display: inline-block;
					float: left;
					padding-left: 10px;
					padding-right: 10px;

					&:first-child {
						padding-left: 0;
					}

					&:last-child {
						padding-right: 0;
					}

					> a {
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
	}
</style>