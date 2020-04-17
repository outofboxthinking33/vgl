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

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $custom_css, ' ' ), $this->settings['base'], $atts );

		$hot_posts = explode(',', $hot_posts);

		ob_start();

		$args = array(
				'post_type'					=> 'product',
				'post_status'				=> 'publish',
				'posts_per_page'			=> $product_count,
				'order'						=> $order,
				'order_by'					=> $order_by
			);

		$query = new WP_Query($args);

		$data = [];

		while( $query->have_posts() ) {

			$query->the_post();

			global $post;

			$product = wc_get_product( $post->ID );

			$price['regular_price'] = $product->get_regular_price();
			$price['sale_price'] = $product->get_sale_price();
			$price['price'] = $product->get_price();

			$product_name = $product->get_title();

			// print_r($product_name);

			$featured_url = get_the_post_thumbnail_url( $post, 'full' );

			$data[] = array(
				'id'			=> $post->ID,
				'price'			=> $price['sale_price'],
				'currency'		=> get_woocommerce_currency_symbol(),
				'product_name'	=> htmlentities($product_name, ENT_QUOTES),
				'featured_url'	=> $featured_url
			);

		}

		wp_reset_postdata();

		?>

		<woo-product-slider :products='<?php echo json_encode($data); ?>' :product-count='<?php echo $product_count ?>' desktop-slide-count='<?php echo $desktop_slide_count ?>' mobile-slide-count='<?php echo $mobile_slide_count ?>'></woo-product-slider>

		<?php

		$html = ob_get_contents();
		ob_get_clean();

		return $html;
	}
}

new vglWooProductSlider();