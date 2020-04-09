<?php

/**
 * Posts
 */
class VglPosts extends WPBakeryShortCode
{
	
	function __construct()
	{
		add_action( 'init', array($this, 'vc_map_fuc') );
		add_shortcode( 'vgl_posts', array($this, 'vc_html_func') );
	}

	public function vc_map_fuc() {
		// Stop all if VC is not enabled
	    if ( !defined( 'WPB_VC_VERSION' ) ) {
	            return;
	    }

	    vc_map(
	    	array(
	    		'name'			=> 'VGL posts',
	    		'base'			=> 'vgl_posts',
	    		'description'	=> 'VGL posts',
	    		'category'		=> 'VGL',
	    		'params'		=> array(
	    			array(
	    				'type'			=> 'dropdown',
	    				'heading'		=> 'Type',
	    				'param_name'	=> 'type',
	    				'value'			=> array(
	    					'Slider'	=> 'slider',
	    					'Grid'		=> 'grid'
	    				),
	    				'admin_label'	=> true,
	    				'group'			=> 'VGL'
	    			),
	    			array(
	    				'type'			=> 'dropdown',
	    				'heading'		=> 'Style',
	    				'param_name'	=> 'style',
	    				'value'			=> array(
	    					'Style1'	=> 'style1',
	    					'Style2'	=> 'style2'
	    				),
	    				'dependency'	=> array(
    						'element'	=> 'type',
    						'value'		=> 'grid'
	    				),
	    				'admin_label'	=> true,
	    				'group'			=> 'VGL'
	    			),
	    			array(
	    				'type'			=> 'dropdown',
	    				'heading'		=> 'Columns',
	    				'param_name'	=> 'columns',
	    				'value'			=> array(
	    					'One Column'	=> '1',
	    					'Two Columns'	=> '2',
	    					'Three Columns'	=> '3',
	    					'Four Columns'	=> '4',
	    					'Five Columns'	=> '5'
	    				),
	    				'group'			=> 'VGL'
	    			),
	    			array(
	    				'type'			=> 'textfield',
	    				'heading'		=> 'Start Index',
	    				'param_name'	=> 'start_index',
	    				'description'	=> '0: First post',
	    				'admin_label'	=> false,
	    				'group'			=> 'VGL'
	    			),
	    			array(
	    				'type'			=> 'textfield',
	    				'heading'		=> 'Number of Items to show',
	    				'param_name'	=> 'item_count',
	    				'description'	=> 'Number of Items to show',
	    				'admin_label'	=> false,
	    				'group'			=> 'VGL'
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
					'type'				=> '1',
					'style' 			=> '',
					'columns'			=> 1,
					'start_index'		=> 0,
					'item_count'		=> 10,
					'order'				=> 'DES',
					'order_by'			=> 'date',
					'custom_css'		=> ''
				),
				$atts
			)
		);

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $custom_css, ' ' ), $this->settings['base'], $atts );

		$hot_posts = explode(',', $hot_posts);

		ob_start();

		$args = array(
				'post_type'					=> 'post',
				'post_status'				=> 'publish',
				'posts_per_page'			=> -1,
				'order'						=> $order,
				'order_by'					=> $order_by,
			);

		$query = new WP_Query($args);

		$data = [];

		$index = 0;

		while( $query->have_posts() ) {

			if ( $start_index <= $index && $index < $start_index + $item_count ) {

				$query->the_post();

				global $post;

				$featured_url = get_the_post_thumbnail_url( $post, 'full' );

				$title = get_the_title( $post );

				$authorID = get_post_field( 'post_author', $post->ID );

				$authorName = get_the_author_meta( 'user_nicename', $authorID );

				$category = get_the_category()[0]->name;

				$permalink = get_the_permalink();

				$data[] = array(
					'id'			=> $post->ID,
					'featured_url'	=> $featured_url,
					'title'			=> $title,
					'authorName'	=> $authorName,
					'category'		=> $category,
					'permalink'		=> $permalink
				);

				$index++;

			} else {

				break;

			}

		}

		wp_reset_postdata();

		?>

		<posts-grid :posts='<?php echo json_encode($data); ?>' :count='<?php echo $item_count; ?>' :col-count='<?php echo $columns ?>' class="<?php echo $style; ?>"></posts-grid>

		<?php

		$html = ob_get_contents();
		ob_get_clean();

		return $html;
	}
}

new VglPosts();