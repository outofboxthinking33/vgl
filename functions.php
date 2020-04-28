<?php

function front_enqueue_scripts() {

	// enqueue style.css
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_style('app', get_template_directory_uri() . '/dist/css/app.css');

	wp_enqueue_style('chunk-vendors', get_template_directory_uri() . '/dist/css/chunk-vendors.css');

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/plugins/font-awesome-4.7.0/css/font-awesome.min.css' );

	wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js');

	wp_enqueue_script('chunk-vendors', get_template_directory_uri() . '/dist/js/chunk-vendors.js', ['wpb_composer_front_js'], false, true);
	wp_enqueue_script('app', get_template_directory_uri() . '/dist/js/app.js', ['chunk-vendors'], false, true);

}
add_action('wp_enqueue_scripts', 'front_enqueue_scripts', 1000);

/* include Custom VC Elements */
require_once(get_theme_file_path('/inc/vc_elements/vc_elements.php'));

/* include Admin Options */
require_once(get_theme_file_path('/admin/admin.php'));

/* include Footer Widget Areas */
require_once(get_theme_file_path('/inc/widgets/footer_widgets.php'));


// Remove WP Version From Styles	
add_filter( 'style_loader_src', 'sdt_remove_ver_css_js', 9999 );
// Remove WP Version From Scripts
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999 );

// Function to remove version numbers
function sdt_remove_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// Function Load More Blog Ajax 
add_action( 'wp_ajax_vgl_loadmore_blogs', 'vgl_loadmore_blogs' );
add_action( 'wp_ajax_nopriv_vgl_loadmore_blogs', 'vgl_loadmore_blogs' );

function vgl_loadmore_blogs() {
	global $post; 
	$id = $_POST['data']['theID'];
	$isNext = $_POST['data']['isNext'];

	$post = get_post( $id, OBJECT );
	setup_postdata( $post );

	if ( $isNext == 'true' ) {

		$post = get_next_post();

		setup_postdata($post);
	}

	ob_start();

	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-id="<?php the_ID(); ?>">
		<header class="entry-header">
			<?php 

				the_title( '<h1 class="entry-title">', '</h1>' );

				?>

				<div class="single-post-header">
					<div class="featured-image"><img src="<?php echo get_the_post_thumbnail_url( $post, 'full' ); ?>"></div>
					<div class="post-info">
						<?php 
							global $post;

							$authorID = get_post_field( 'post_author', $post->ID );

							$authorName = get_the_author_meta( 'user_nicename', $authorID );

							$authorAvatarUrl = get_avatar_url( $authorID, ['size' => 60] );

							$category = get_the_category()[0]->name;
						?>
						<div class="authorAvatar"><img src="<?php echo $authorAvatarUrl; ?>"></div>
						<div class="authorInfo">
							<span class="authorName">by <?php echo $authorName; ?></span>
							<span class="postDate"><?php echo get_the_date(); ?></span>
						</div>
					</div>
				</div>

				<?php

			?>
		</header>

		<div class="entry-content">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'bluemedora' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bluemedora' ),
					'after'  => '</div>',
				) );
			?>
		</div>
	</article>

	<?php

	$html = ob_get_contents();
	ob_get_clean();

	global $post;

	$data = array();

	$data[] = array(
		'id'			=> get_the_ID(),
		'featured_url'	=> get_the_post_thumbnail_url( $post, 'thumbnail' ),
		'title'			=> get_the_title( $post )
	);


	for ($i=0; $i < 3; $i++) { 

		$post = get_next_post();

		setup_postdata($post);

		$data[] = array(
			'id'			=> get_the_ID(),
			'featured_url'	=> get_the_post_thumbnail_url( $post, 'thumbnail' ),
			'title'			=> get_the_title( $post )
		);

	}
	
	wp_reset_postdata();

	$sidebar = '';
	foreach ($data as $key => $value) {
		$active = $key == 0 ? 'active' : 'last';

		$sidebar .= '<div data-id="' . $value['id'] . '" class="blog-post-individual ' . $active . '">';

		$sidebar .= '<div class="blog-post-individual-featuredimg" style="background-image:url(' . $value['featured_url'] . ')"></div>';

		$sidebar .= '<div class="blog-post-individual-title">' . $value['title'] . '</div>'; 

		$sidebar .= '</div>';
	}

	print_r(json_encode(array( 'article' => $html, 'sidebar' => $sidebar )));
	wp_die();
}