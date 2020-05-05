<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <script type="text/javascript">
	    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	</script>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="app">
		<header class="header">
			<div class="main-header">
				<div class="search-bar">
					<?php get_search_form(array( 'echo' => true )) ?>
					<div class="search-mobile"><i class="fa fa-search" aria-hidden="true"></i></div>
				</div>
				<div class="logo">
					<?php 
						$logo_id = vgl_get_theme_option('logo_id');
						$dark_logo_id = vgl_get_theme_option('dark_logo_id');
					?>
					<a href="<?php echo get_home_url(); ?>" class="logo-default"><img src="<?php echo wp_get_attachment_image_src( $logo_id, 'full' )[0]; ?>"></a>
					<a href="<?php echo get_home_url(); ?>" class="logo-darkmode"><img src="<?php echo wp_get_attachment_image_src( $dark_logo_id, 'full' )[0]; ?>"></a>
				</div>
				<?php if ( vgl_get_theme_option('menu_style') == 'rectangle_menu' ): ?>
				<rectangle-menu menu-style="<?php echo vgl_get_theme_option('menu_style') ?>">
					<template v-slot:menu>
						<?php echo wp_nav_menu( array( 'menu' => '3', 'menu_class' => '', 'container' => 'ul', 'depth' => 2 ) ); ?>
					</template>
				</rectangle-menu>
				<?php else: ?> 

				<?php endif; ?>
				<mobile-burger></mobile-burger>
			</div>
			<div class="mobile-menu-wrapper">
				<?php 
					$darkModeActiveIcon = vgl_get_theme_option('mobile_darkmode_icon_active');
					$darkModeDeactiveIcon = vgl_get_theme_option('mobile_darkmode_icon_deactive');
				?>
				<mobile-menu dark-mode-active-icon="<?php echo wp_get_attachment_image_src( $darkModeActiveIcon, 'full' )[0]; ?>" dark-mode-deactive-icon="<?php echo wp_get_attachment_image_src( $darkModeDeactiveIcon, 'full' )[0]; ?>">
					<template v-slot:mobile-menu>
						<?php echo wp_nav_menu( array( 'menu' => '3', 'menu_class' => '', 'container' => 'ul', 'depth' => 2 ) ); ?>
					</template>
					<template v-slot:mobile-social>
						<a class="mobile-social-icon" href="<?php vgl_get_theme_option('mobile_social_facebook'); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
						<a class="mobile-social-icon" href="<?php vgl_get_theme_option('mobile_social_instagram'); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
						<a class="mobile-social-icon" href="<?php vgl_get_theme_option('mobile_social_youtube'); ?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
						<a class="mobile-social-icon" href="<?php vgl_get_theme_option('mobile_social_twitter'); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
					</template>
					<?php if ( is_active_sidebar( 'mobile-widget-1' ) ): ?>
						<template v-slot:mobile-middle>
							<?php dynamic_sidebar( 'mobile-widget-1' ); ?>
						</template>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'mobile-widget-2' ) ): ?>
						<template v-slot:mobile-bottom-menu>
							<?php dynamic_sidebar( 'mobile-widget-2' ); ?>
						</template>
					<?php endif; ?>
				</mobile-menu>
			</div>
		</header>