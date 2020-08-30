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
		add_action( 'wp_ajax_vgl_loadmore_posts', array($this, 'vgl_loadmore_posts') );
		add_action( 'wp_ajax_nopriv_vgl_loadmore_posts', array($this, 'vgl_loadmore_posts') );
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
	    					'Masonry'	=> 'masonry',
	    					'List'		=> 'list'
	    				),
	    				'dependency'	=> array(
    						'element'	=> 'type',
    						'value'		=> 'grid'
	    				),
	    				'save_always'	=> true,
	    				'admin_label'	=> true,
	    				'group'			=> 'VGL'
	    			),
	    			array(
	    				'type'			=> 'dropdown',
	    				'heading'		=> 'Source',
	    				'param_name'	=> 'source',
	    				'value'			=> array(
	    					'All Posts'		=> '',
	    					'Reviews'		=> 'reviews',
	    				),
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
	    				'heading'		=> 'Heading',
	    				'param_name'	=> 'heading',
	    				'admin_label'	=> false,
	    				'group' 		=> 'VGL'
	    			),
	    			array(
	    				'type'			=> 'textfield',
	    				'heading'		=> 'Desktop Slider Show',
	    				'param_name'	=> 'desktop_slider_show',
	    				'admin_label'	=> false,
	    				'dependency'	=> array(
    						'element'	=> 'type',
    						'value'		=> 'slider'
	    				),
	    				'value'			=> '4',
	    				'group' 		=> 'VGL'
	    			),
	    			array(
	    				'type'			=> 'textfield',
	    				'heading'		=> 'Mobile Slider Show',
	    				'param_name'	=> 'mobile_slider_show',
	    				'admin_label'	=> false,
	    				'dependency'	=> array(
    						'element'	=> 'type',
    						'value'		=> 'slider'
	    				),
	    				'value'			=> '1',
	    				'group' 		=> 'VGL'
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
	    				'type'					=> 'checkbox',
	    				'heading'				=> 'Show LoadMore button',
	    				'param_name'			=> 'show_loadmore',
	    				'value' 				=> array( __( 'Yes', 'js_composer' ) => 'yes' ),
	    				'group'					=> 'VGL'
	    			),
	    			array(
	    				'type'					=> 'textfield',
	    				'heading'				=> 'LoadMore button text',
	    				'param_name'			=> 'loadmore_text',
	    				'dependency'			=> array(
    						'element'			=> 'type',
    						'value'				=> 'grid'
	    				),
	    				'default'				=> 'Load More',
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
					'type'					=> 'slider',
					'style' 				=> '',
					'source'				=> '',
					'columns'				=> 1,
					'heading'				=> '',
					'desktop_slider_show' 	=> '4',
					'mobile_slider_show' 	=> '1', 
					'start_index'			=> 0,
					'item_count'			=> 10,
					'order'					=> 'DES',
					'order_by'				=> 'date',
					'show_loadmore'			=> '',
					'loadmore_text'			=> '',
					'custom_css'			=> ''
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
				'posts_per_page'			=> $item_count,
				'order'						=> $order,
				'order_by'					=> $order_by
			);

		if($source == 'reviews') {
			$args['tag'] = ['reviews', 'review'];
		}

		$query = new WP_Query($args);

		$data = [];
		$postIds = [];

		$index = 0;

		while( $query->have_posts() ) {

			$query->the_post();

			global $post;

			$attachment_id = get_post_thumbnail_id($post);

			if($type == 'grid' && $style == 'list') {
				$featured_url = get_the_post_thumbnail_url($post->ID, 'posts-slider');
			} else if ($type == 'grid' && $style == 'masonry') {
				$featured_url = get_the_post_thumbnail_url($post->ID, 'posts-slider-masonry');
			} else {
				$featured_url = get_the_post_thumbnail_url($post->ID, 'posts-slider-carousel');
			}

			$title = get_the_title( $post );

			$authorID = get_post_field( 'post_author', $post->ID );

			$authorName = strip_tags(get_the_author_meta( 'display_name', $authorID ));

			$category = get_the_category()[0]->name;

			$permalink = get_the_permalink();

			$excerpt = html_entity_decode(get_the_excerpt($hot_post));

			$postIds[] = $post->ID;

			$data[] = array(
				'id'			=> $post->ID,
				'featured_url'	=> $featured_url,
				'title'			=> $title,
				'authorName'	=> $authorName,
				'category'		=> $category,
				'permalink'		=> $permalink,
				'excerpt'		=> $excerpt
			);
		}

		wp_reset_postdata();

		?>

		<?php if ( $type == 'grid' ): ?>

		<posts-grid :posts='<?php echo htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8'); ?>' :post-ids='<?php echo json_encode($postIds); ?>' :start-index='<?php echo $start_index; ?>' :count='<?php echo $item_count; ?>' :col-count='<?php echo $columns ?>' grid-style="<?php echo $style; ?>" class="<?php echo $style; ?>" heading="<?php echo $heading; ?>" <?php if ( $show_loadmore ): ?> :show-load-more="true" load-more-text="<?php echo $loadmore_text ?>" order="<?php echo $order ?>" order-by="<?php echo $order_by ?>" <?php endif; ?>> </posts-grid>

		<?php elseif (  $type == 'slider'): ?>

		<posts-slider :posts='<?php echo htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8'); ?>' :count='<?php echo $item_count; ?>' heading='<?php echo $heading; ?>' desktop-slider-show='<?php echo $desktop_slider_show; ?>' mobile-slider-show='<?php echo $mobile_slider_show; ?>' class="<?php echo $type . " " . $css_class; ?>"></posts-slider>

		<?php endif; ?>
		<?php

		$html = ob_get_contents();
		ob_get_clean();

		return $html;
	}

	public function vgl_loadmore_posts() {
		
		$data = [];
		$cache_key = 'vgl-loadmore';
		$order = $_POST['data']['order'];
		$order_by = $_POST['data']['orderBy'];
		$count = $_POST['data']['count'];
		$start_index = $_POST['data']['startIndex'];
		$postIds = $_POST['data']['postIds'];

		$args = array(
			'post_type'					=> 'post',
			'post_status'				=> 'publish',
			'posts_per_page'			=> -1,
			'order'						=> $order,
			'order_by'					=> $order_by
		);

		if(!$data = get_transient( $cache_key )) {
			
			$query = new WP_Query($args);
			
			$index = 0;
			while( $query->have_posts() ) {
				$query->the_post();

				global $post;
				
				$featured_url = get_the_post_thumbnail_url( $post, 'posts-slider' );
				$title = get_the_title( $post );
				$authorID = get_post_field( 'post_author', $post->ID );
				$authorName = get_the_author_meta( 'user_nicename', $authorID );
				$category = get_the_category()[0]->name;
				$permalink = get_the_permalink();
				$excerpt = html_entity_decode(get_the_excerpt($hot_post));
				$data[] = array(
					'id'			=> "$post->ID",
					'featured_url'	=> $featured_url,
					'title'			=> $title,
					'authorName'	=> $authorName,
					'excerpt'		=> $excerpt,
					'category'		=> $category,
					'permalink'		=> $permalink
				);
			}

			set_transient($cache_key, $data, 86400);
		}

		// Filter existing posts
		foreach($data as $index => $post) {		
			if(in_array($post['id'], $postIds)) {
				unset($data[$index]);
			}
		}

		$data = array_values($data);

		// print_r(json_encode(array( 'order' => $order, 'order_by' => $order_by, 'start_index' => $start_index, 'count' => $count )));
		$posts = array_slice($data, $start_index , $count);

		print_r(json_encode($posts, JSON_PRETTY_PRINT));
		wp_die();
	}
}

new VglPosts();