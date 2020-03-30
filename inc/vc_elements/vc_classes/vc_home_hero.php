<?php

/**
 * VC Class: Home Hero
 */
class vglHomeHero extends WPBakeryShortCode
{
	
	function __construct()
	{
		add_action( 'init', array($this, 'vc_map_fuc') );
		add_shortcode( 'vgl_home_hero', array($this, 'vc_html_func') );
	}

	public function vc_map_fuc() {

		// Stop all if VC is not enabled
	    if ( !defined( 'WPB_VC_VERSION' ) ) {
	            return;
	    }

	    vc_map(
	    	array(
	    		'name'					=> 'VGL Home Hero',
	    		'base'					=> 'vgl_home_hero',
	    		'description'			=> 'VGL Home Hero',
	    		'category'				=> 'VGL',
	    		'params'				=> array(
	    			array(
	    				'type'					=> 'dropdown',
		    			'heading'				=> 'Layout',
		    			'param_name'			=> 'layout',
		    			'admin_label'			=> true,
		    			'value'					=> array(
		    				'Grid'				=> 'grid',
		    				'Slider'			=> 'slider'
		    			),
		    			'save_always'			=> true,
		    			'group'					=> 'VGL'
	    			),
	    			array(
	    				'type'					=> 'textfield',
	    				'heading'				=> 'Number of blogs to show',
	    				'param_name'			=> 'blog_count',
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
					'layout' 								=> '',
					'blog_count'							=> '',
					'order'									=> '',
					'order_by'								=> '',
					'custom_css'							=> ''
				),
				$atts
			)
		);

		ob_start();

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $custom_css, ' ' ), $this->settings['base'], $atts );
		?>

		<?php

			$args = array(
				'post_type'					=> 'post',
				'post_status'				=> 'publish',
				'posts_per_page'			=> $blog_count,
				'order'						=> $order,
				'order_by'					=> $order_by
			);

			$query = new WP_Query($args);

			$data = [];

			while( $query->have_posts() ) {

				$query->the_post();

				global $post;

				$featured_url = get_the_post_thumbnail_url( $post, 'full' );

				$title = get_the_title( $post );

				$authorID = get_post_field( 'post_author', $post->ID );

				$authorName = get_the_author_meta( 'user_nicename', $authorID );

				$data[] = array(
					'featured_url'	=> $featured_url,
					'title'			=> $title,
					'authorName'	=> $authorName
				);

			}

			wp_reset_postdata();

		?>

		<?php if ( $layout == 'grid' ): ?>

		<?php elseif ( $layout == 'slider' ): ?>
			<hero-banner-slider posts="[{title: 'Test title'}, {title: 'Test title 2'}]"></hero-banner-slider>
		<?php endif; ?>

		<?php

		$html = ob_get_contents();
		ob_get_clean();

		return $html;
	}
}

new vglHomeHero();