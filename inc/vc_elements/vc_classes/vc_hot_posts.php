<?php

/**
 * Hot POSTS
 */
class VglHotPosts extends WPBakeryShortCode
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
					'columns'				=> '1',
					'hot_posts' 			=> ''
				),
				$atts
			)
		);

		$hot_posts = explode(',', $hot_posts);

		ob_start();

		$data = array();

		foreach ($hot_posts as $hot_post) {
			
			$featured_url = get_the_post_thumbnail_url( $hot_post, 'full' );

			$title = get_the_title( $hot_post );

			$category = get_the_category( $hot_post )[0]->name;

			$permalink = get_the_permalink( $host_post );

			$data[] = array(
				'id'			=> $hot_post,
				'featured_url'	=> $featured_url,
				'title'			=> $title,
				'category'		=> $category,
				'permalink'		=> $permalink
			);
		}

		?>

		<hot-posts :posts='<?php echo json_encode($data); ?>' col-count='<?php echo $columns; ?>'></hot-posts>

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

new VglHotPosts();