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
	    				'type'					=> 'autocomplete',
	    				'heading'				=> 'Category',
	    				'param_name'			=> 'category',
	    				'settings'				=> array(
	    					'values'			=> $this->post_categories(),
	    					'multiple'			=> true
	    				),
	    				'group'					=> 'VGL'
	    			),
	    			array(
	    				'type'					=> 'textfield',
	    				'heading'				=> 'Number of blogs to show',
	    				'param_name'			=> 'blog_count',
	    				'description'			=> 'Input a Number',
	    				'dependency'			=> array(
							'element'			=> 'layout',
							'value'				=> 'slider'
	    				),
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
	    				'heading'				=> 'Bottom Border Width',
	    				'param_name'			=> 'border_width',
	    				'value'					=> '10px',
	    				'group'					=> 'VGL'
	    			),
	    			array(
	    				'type'					=> 'colorpicker',
	    				'heading'				=> 'Bottom color',
	    				'param_name'			=> 'bottom_color',
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
					'category'								=> '',
					'blog_count'							=> '',
					'order'									=> '',
					'order_by'								=> '',
					'border_width'							=> '10px',
					'bottom_color'							=> '',
					'custom_css'							=> ''
				),
				$atts
			)
		);

		ob_start();

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $custom_css, ' ' ), $this->settings['base'], $atts );

		$category = explode(',', $category);
		?>

		<?php

			if ( $layout == 'grid' ) {

				// We limit the count of post for Homebanner grid

				$blog_count = 4;

			}

			$args = array(
				'post_type'					=> 'post',
				'post_status'				=> 'publish',
				'posts_per_page'			=> $blog_count,
				'order'						=> $order,
				'order_by'					=> $order_by,
				'category__in'				=> $category
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

				$category = get_the_category()[0]->name;

				$permalink = get_the_permalink();

				$slideColor = false;
				if(get_field('slider_bar_color', $post->ID)) {
					$slideColor = get_field('slider_bar_color', $post->ID);
				}

				$data[] = array(
					'id'			=> $post->ID,
					'featured_url'	=> $featured_url,
					'title'			=> $title,
					'authorName'	=> $authorName,
					'category'		=> $category,
					'permalink'		=> $permalink,
					'slideColor'	=> $slideColor ? $slideColor : ''
				);



			}

			wp_reset_postdata();

		?>

		<?php if ( $layout == 'grid' ): ?>

			<hero-banner-grid :posts='<?php echo json_encode($data); ?>' border-color="<?php echo $bottom_color; ?>" border-width="<?php echo $border_width; ?>"></hero-banner-grid>

		<?php elseif ( $layout == 'slider' ): ?>

			<hero-banner-slider :posts='<?php echo json_encode($data); ?>' border-color="<?php echo $bottom_color; ?>" border-width="<?php echo $border_width; ?>"></hero-banner-slider>

		<?php endif; ?>

		<?php

		$html = ob_get_contents();
		ob_get_clean();

		return $html;
	}

	public function post_categories( $tax_term  = 'category' ) {
		$args = array(
			'taxonomy'			=> $tax_term,
			'orderby'			=> 'name',
			'order'				=> 'ASC'
		);

		$cats = get_categories($args);

		$results = array();

		foreach ($cats as $cat) {
			
			$results[] = array(
				'value'		=> $cat->term_id,
				'label'		=> $cat->name
			);

		}

		return $results;
	}
}

new vglHomeHero();