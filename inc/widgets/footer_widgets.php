<?php

function footer_widgets() {
	register_sidebar( array(
		'name'			=> 'Footer Widget 1',
		'id'			=> 'footer-widget-1',
		'before_widget'	=> '<div class="footer-widget footer-widget-1">',
		'after_widget'	=> '</div>',
	) );

	register_sidebar( array(
		'name'			=> 'Footer Widget 2',
		'id'			=> 'footer-widget-2',
		'before_widget'	=> '<div class="footer-widget footer-widget-2">',
		'after_widget'	=> '</div>'
	) );

	register_sidebar( array(
		'name'			=> 'Footer Widget 3',
		'id'			=> 'footer-widget-3',
		'before_widget'	=> '<div class="footer-widget footer-widget-3">',
		'after_widget'	=> '</div>'
	) );
}
add_action( 'widgets_init', 'footer_widgets' );