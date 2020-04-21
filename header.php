<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="app">
		<header class="header">
			<rectangle-menu menu-style="<?php echo vgl_get_theme_option('menu_style') ?>">
				<template v-slot:menu>
					<?php echo wp_nav_menu( array( 'menu' => 'primary', 'menu_class' => '', 'container' => 'ul', 'depth' => 2 ) ); ?>
				</template>
			</rectangle-menu>
		</header>