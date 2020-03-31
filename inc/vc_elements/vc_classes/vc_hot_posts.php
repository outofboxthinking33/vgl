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

	public function vc_html_func() {

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