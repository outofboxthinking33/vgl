<?php

/**
 * 
 */
class vglWooProductSlider extends WPBakeryShortCode
{
	
	function __construct()
	{
		add_action( 'init', array($this, 'vc_map_fuc') );
		add_shortcode( 'vgl_woo_product_slider', array($this, 'vc_html_func') );
	}

	public function vc_map_fuc() {
		// Stop all if VC is not enabled
	    if ( !defined( 'WPB_VC_VERSION' ) ) {
	            return;
	    }

	    vc_map(
	    	array(
	    		'name'				=> 'Woo Product Slider',
	    		'base'				=> 'vgl_woo_product_slider',
	    		'description'		=> 'Woo Product Slider',
	    		'category'			=> 'VGL',
	    		'params'			=> array(
	    			array(
	    				'type'			=> 'textfield',
	    				'heading'		=> 'Heading',
	    				'param_name'	=> 'heading',
	    				'description'	=> 'Heading',
	    				'admin_label'	=> false,
	    				'group'			=> 'VGL'
	    			),
	    			array(
	    				'type'					=> 'textfield',
	    				'heading'				=> 'Number of Products to show',
	    				'param_name'			=> 'product_count',
	    				'description'			=> 'Input a Number',
	    				'admin_label'			=> false,
	    				'group'					=> 'VGL'
	    			),
	    			array(
	    				'type'					=> 'dropdown',
	    				'heading'				=> 'Order',
	    				'param_name'			=> 'order',
	    				'value'					=> array(
	    					'ASC'				=> 'ASC',
	    					'DESC'				=> 'DESC'
	    				),
	    				'save_always'			=> true,
	    				'group'					=> 'VGL'
	    			),
	    			array(
	    				'type'					=> 'dropdown',
	    				'heading'				=> 'Order by',
	    				'param_name'			=> 'order_by',
	    				'value'					=> array(
	    					'Title'				=> 'title',
	    					'Date'				=> 'date',
	    					'ID'				=> 'id'
	    				),
	    				'save_always'			=> true,
	    				'group'					=> 'VGL'
	    			),
	    			array(
	    				'type'					=> 'textfield',
	    				'heading'				=> 'Desktop Slide Count',
	    				'param_name'			=> 'desktop_slide_count',
	    				'admin_label'			=> false,
	    				'group'					=> 'VGL'
	    			),
	    			array(
	    				'type'					=> 'textfield',
	    				'heading'				=> 'Mobile Slide Count',
	    				'param_name'			=> 'mobile_slide_count',
	    				'admin_label'			=> false,
	    				'group'					=> 'VGL'
	    			),
	    			array(
	    				'type'					=> 'css_editor',
	    				'heading'				=> 'CSS',
	    				'param_name'			=> 'custom_css',
	    				'group'					=> 'Design options'
	    			)
	    		)
	    	)
	    );
	}


	public function vc_html_func( $atts, $content ) {
		// Params extraction
		extract(
			shortcode_atts(
				array(
					'heading'				=> '',
					'product_count'			=> '',
					'order'					=> '',
					'order_by'				=> '',
					'desktop_slide_count'	=> '',
					'mobile_slide_count'	=> '',
					'custom_css'			=> ''
				),
				$atts
			)
		);
	}
}

new vglWooProductSlider();