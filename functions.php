<?php

function front_enqueue_scripts() {

	// enqueue style.css
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_style('app', get_template_directory_uri() . '/dist/css/app.css');
	wp_enqueue_style('chunk-vendors', get_template_directory_uri() . '/dist/css/chunk-vendors.css');

	wp_enqueue_script('chunk-vendors', get_template_directory_uri() . '/dist/js/chunk-vendors.js', ['wpb_composer_front_js'], false, true);
	wp_enqueue_script('app', get_template_directory_uri() . '/dist/js/app.js', ['chunk-vendors'], false, true);

	wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js');

}
add_action('wp_enqueue_scripts', 'front_enqueue_scripts', 1000);

/* include Custom VC Elements */
require_once(get_theme_file_path('/inc/vc_elements/vc_elements.php'));

/* include Admin Options */
require_once(get_theme_file_path('/admin/admin.php'));


// Remove WP Version From Styles	
add_filter( 'style_loader_src', 'sdt_remove_ver_css_js', 9999 );
// Remove WP Version From Scripts
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999 );

// Function to remove version numbers
function sdt_remove_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}