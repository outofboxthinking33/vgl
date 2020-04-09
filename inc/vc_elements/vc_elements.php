<?php

/**
 * Load Custom VC Elements
 */

if ( !class_exists('vcElements') ) {
	class vcElements
	{
		
		function __construct()
		{
			add_action( 'vc_before_init', array( $this, 'vc_before_init_func' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts_func' ) );
		}

		public function vc_before_init_func() {
			require_once(get_theme_file_path('/inc/vc_elements/vc_classes/vc_home_hero.php'));
			require_once(get_theme_file_path('/inc/vc_elements/vc_classes/vc_hot_posts.php'));
			require_once(get_theme_file_path('/inc/vc_elements/vc_classes/vc_posts.php'));
		}

		public function wp_enqueue_scripts_func() {

		}
	}

	new vcElements();
}