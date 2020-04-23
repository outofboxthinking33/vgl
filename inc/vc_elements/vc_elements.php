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
			require_once(get_theme_file_path('/inc/vc_elements/vc_classes/vc_woo_product_slider.php'));

			$this->vc_addons();
		}

		public function vc_addons() {

			if( function_exists('vc_set_shortcodes_templates_dir') ){
				vc_set_shortcodes_templates_dir( get_theme_file_path('/inc/vc_elements/vc_templates'));
			}

			$attrs = array(
				array(
					'type'			=> 'colorpicker',
					'heading'		=> 'Background Gradient Start Color',
					'param_name'	=> 'gradient_start_color',
					'group'			=> 'Additional Settings'
				),
				array(
					'type'			=> 'colorpicker',
					'heading'		=> 'Background Gradient End Color',
					'param_name'	=> 'gradient_end_color',
					'group'			=> 'Additional Settings'
				)
			);

			foreach ($attrs as $attr) {
				vc_add_param('vc_row', $attr);	
			}
		}

		public function wp_enqueue_scripts_func() {

		}

	}

	new vcElements();
}