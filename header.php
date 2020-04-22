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
			<div class="search-bar">
				<?php get_search_form(array( 'echo' => true )) ?>
			</div>
			<div class="logo">
				<?php 
					$logo_id = vgl_get_theme_option('logo_id');
				?>
				<img src="<?php echo wp_get_attachment_image_src( $logo_id, 'full' )[0]; ?>">
			</div>
			<?php if ( vgl_get_theme_option('menu_style') == 'rectangle_menu' ): ?>
			<rectangle-menu menu-style="<?php echo vgl_get_theme_option('menu_style') ?>">
				<template v-slot:menu>
					<?php echo wp_nav_menu( array( 'menu' => '3', 'menu_class' => '', 'container' => 'ul', 'depth' => 2 ) ); ?>
				</template>
			</rectangle-menu>
			<?php else: ?> 

			<?php endif; ?>
		</header>