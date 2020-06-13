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

    <?php if(is_front_page()): ?>
    	<script src="<https://htlbid.com/v3/verygoodlight.com/htlbid.js>"></script>
		<script>
			var htlbid = htlbid || {};
			htlbid.cmd = htlbid.cmd || [];

			htlbid.cmd.push(function() {
		            // Change layout depending on the query string variable. 
		            let params = new URLSearchParams(location.search);
		            if (params.get('environment') === 'dev') {
		                htlbid.layout('homepage_redesign');
		                htlbid.setTargeting('is_testing', 'yes'); // required for testing.
		            } else {
		                htlbid.layout(homepage);
		            }
		        });
		</script>
    <?php elseif(is_home()): ?>
	    <script src="<https://htlbid.com/v3/verygoodlight.com/htlbid.js>"></script>
		<script>
			var htlbid = htlbid || {};
			htlbid.cmd = htlbid.cmd || [];

			htlbid.cmd.push(function() {
		            // Change layout depending on the query string variable. 
		            let params = new URLSearchParams(location.search);
		            if (params.get('environment') === 'dev') {
		                htlbid.layout('post_redesign');
		                htlbid.setTargeting('is_testing', 'yes'); // required for testing.
		            } else {
		                htlbid.layout(post);
		            }
		            // rest of targeting settings. 
		        });
		</script>
	<?php endif; ?>
</head>

<body <?php body_class(); ?>>
	<div id="app">
		<header class="header">
			<div class="main-header">
				<div class="search-bar">
					<?php get_search_form(array( 'echo' => true )) ?>
				</div>
				<a class="search-mobile">
						<svg xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
  <path d="M15.853 16.56A9.458 9.458 0 019.5 19C4.257 19 0 14.743 0 9.5S4.257 0 9.5 0 19 4.257 19 9.5c0 2.442-.923 4.67-2.44 6.353l7.44 7.44-.707.707-7.44-7.44zM9.5 1C14.191 1 18 4.809 18 9.5S14.191 18 9.5 18 1 14.191 1 9.5 4.809 1 9.5 1z"/>
</svg>
				</a>
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
						<?php echo wp_nav_menu( array( 'menu' => '22196', 'menu_class' => '', 'container' => 'ul', 'depth' => 2 ) ); ?>
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
						<?php echo wp_nav_menu( array( 'menu' => '22196', 'menu_class' => '', 'container' => 'ul', 'depth' => 2 ) ); ?>
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