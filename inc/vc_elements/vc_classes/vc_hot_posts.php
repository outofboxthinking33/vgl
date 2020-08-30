<?php

/**
 * Hot POSTS
 */
class vglHotPosts extends WPBakeryShortCode
{
	
	function __construct()
	{
		add_action( 'init', array($this, 'vc_map_fuc') );
		add_shortcode( 'vgl_hot_posts', array($this, 'vc_html_func') );
	}

	public function vc_map_fuc() {
		// Stop all if VC is not enabled
	    if ( !defined( 'WPB_VC_VERSION' ) ) {
	            return;
	    }

	    vc_map(
	    	array(
	    		'name'					=> 'VGL Hot Posts',
	    		'base'					=> 'vgl_hot_posts',
	    		'description'			=> 'VGL Hot Posts',
	    		'category'				=> 'VGL',
	    		'params'				=> array(
	    			array(
	    				'type'			=> 'textarea',
	    				'heading'		=> 'Title',
	    				'param_name'	=> 'vgl_title',
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
	    				'type'			=> 'autocomplete',
	    				'heading'		=> 'Hot Posts',
	    				'param_name'	=> 'hot_posts',
	    				'settings'		=> array(
	    					'values'	=> $this->vgl_posts(),
	    					'multiple'	=> true
	    				),
	    				'admin_label'	=> true,
	    				'group'			=> 'VGL'
	    			),
	    			array(
	    				'type'			=> 'css_editor',
	    				'heading'		=> 'CSS',
	    				'param_name'	=> 'custom_css',
	    				'group'			=> 'Design options'
	    			),
	    			array(
	    				'type'			=> 'checkbox',
	    				'heading'		=> 'Use Custom Images for posts',
	    				'param_name'	=> 'is_custom_image',
	    				'value' 		=> array( __( 'Yes', 'js_composer' ) => 'yes' ),
	    				'group'			=> 'VGL'
	    			),
	    			array(
	    				'type'			=> 'attach_images',
	    				'heading'		=> 'Attach Images',
	    				'dependency'			=> array(
    						'element'			=> 'is_custom_image',
    						'value'				=> 'yes'
	    				),
	    				'param_name'	=> 'post_images',
	    				'group'			=> 'VGL'
	    			)
	    		)
	    	)	
	    );
	}

	public function vc_html_func($atts, $content) {

		// Params extraction
		extract(
			shortcode_atts(
				array(
					'vgl_title'				=> '',
					'columns'				=> '1',
					'hot_posts' 			=> '',
					'custom_css'			=> '',
					'is_custom_image'		=> '',
					'post_images'			=> ''
				),
				$atts
			)
		);

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $custom_css, ' ' ), $this->settings['base'], $atts );

		$hot_posts = explode(',', $hot_posts);

		$post_images = explode(',', $post_images);

		ob_start();

		$data = array();

		$index = 0;

		foreach ($hot_posts as $hot_post) {
			
			if ( $is_custom_image && count($post_images) > $index ) {

				$featured_url = wp_get_attachment_image_src($post_images[$index], 'hot-posts', true)[0];

			} else {

				$featured_url = get_the_post_thumbnail_url( $hot_post, 'hot-posts' );

			}

			$index++;

			$title = get_the_title( $hot_post );

			$category = get_the_category( $hot_post )[0]->name;

			$permalink = get_the_permalink( $hot_post );

			$byline = strip_tags(get_the_term_list( $hot_post, 'byline', '', ', ', '' ));

			if(!$byline) {
				$authorID = get_post_field( 'post_author', $hot_post );
				$authorName = strip_tags(get_the_author_meta( 'display_name', $authorID ));
			}

			$excerpt = html_entity_decode(get_the_excerpt($hot_post));

			$data[] = array(
				'id'			=> $hot_post,
				'featured_url'	=> $featured_url,
				'title'			=> $title,
				'category'		=> $category,
				'permalink'		=> $permalink,
				'authorName'	=> $byline ? $byline : $authorName,
				'excerpt'		=> $excerpt
			);
		}

		?>

		<hot-posts :posts='<?php echo htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8'); ?>' col-count='<?php echo $columns; ?>' title="<?php echo $vgl_title ?>" class="<?php echo $css_class; ?>"></hot-posts>

		<?php

		$html = ob_get_contents();
		ob_get_clean();

		return $html;
	}

	public function vgl_posts( $post_type = 'post' ) {

		$args = array(
			'post_type'			=> $post_type,
			'post_status'	 	=> 'publish',
			'posts_per_page'	=> -1
		);

		$result = array();

		$query = new WP_Query($args);

		while ($query->have_posts()) {
			
			$query->the_post();

			global $post;

			$results[] = array(
				'value'		=> $post->ID,
				'label'		=> get_the_title()
			);

		}

		wp_reset_postdata();

		return $results;

	}
}

new vglHotPosts();