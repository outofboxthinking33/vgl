<?php

function mobile_menu_widgets() {
	register_sidebar( array(
		'name'			=> 'Mobile Menu Widget 1',
		'id'			=> 'mobile-widget-1',
		'before_widget'	=> '<div class="mobile-widget mobile-widget-1">',
		'after_widget'	=> '</div>',
	) );

	register_sidebar( array(
		'name'			=> 'Mobile Menu Widget 2',
		'id'			=> 'mobile-widget-2',
		'before_widget'	=> '<div class="mobile-widget mobile-widget-2">',
		'after_widget'	=> '</div>',
	) );
}

add_action( 'widgets_init', 'mobile_menu_widgets' );