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

/* include Widget Areas */
require_once(get_theme_file_path('/inc/widgets/footer_widgets.php'));
require_once(get_theme_file_path('/inc/widgets/mobile_menu_widget.php'));

/* include post custom fields */
require_once(get_theme_file_path('/inc/custom_fields/single_blog_customfield.php'));

/**
 * Custom template tags for the theme.
 */
require_once(get_theme_file_path('/inc/template-tags.php'));

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
	$loadSidebarNextArticle = $_POST['data']['loadSidebarNextArticle'];
	$data = [];

	$sidebarItemCount = 1;

	$post = get_post( $id, OBJECT );

	setup_postdata( $post );

	$post = get_previous_post();

	setup_postdata( $post );

	$data[] = array(
		'id'			=> get_the_ID(),
		'featured_url'	=> get_the_post_thumbnail_url( $post, 'thumbnail' ),
		'title'			=> get_the_title( $post ),
		'link'			=> get_the_permalink( $post )
	);

	ob_start();

	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-id="<?php the_ID(); ?>">
		<header class="entry-header">
			<?php
				global $post;

			    echo do_shortcode('[rt_reading_time label="LOOK" postfix="MINUTE READ" postfix_singular="MINUTE READ"]');

				the_title( '<h1 class="entry-title">', '</h1>' );

				?>

				<div class="single-post-header" data-post-color="<?php echo get_field('slider_bar_color', $post->ID); ?>">
					<div class="featured-image"><img src="<?php echo get_the_post_thumbnail_url( $post, 'full' ); ?>"></div>
					<div class="post-info">
						<?php						

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
		<div class="entry-main">
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
			<div class="entry-sidebar">
				<?php get_template_part( 'template-parts/blog', 'sidebar' ); ?>
			</div>
		</div>
	</article>

	<?php

	$html = ob_get_contents();
	ob_get_clean();

	$post = get_previous_post();

	setup_postdata($post);

	$data[] = array(
		'id'			=> get_the_ID(),
		'featured_url'	=> get_the_post_thumbnail_url( $post, 'thumbnail' ),
		'title'			=> get_the_title( $post ),
		'link'			=> get_the_permalink( $post )
	);
	
	wp_reset_postdata();

	$sidebar = '';
	for ($i=0; $i < count($data); $i++) { 
		$sidebar .= '<div data-id="' . $data[$i]['id'] . '" data-link=['. $data[$i]['link'] . '] class="blog-post-individual">';

		$sidebar .= '<div class="blog-post-individual-featuredimg" style="background-image:url(' . $data[$i]['featured_url'] . ')"></div>';

		$sidebar .= '<div class="blog-post-individual-title">' . $data[$i]['title'] . '</div>'; 

		$sidebar .= '</div>';
	}

	print_r(json_encode(array( 'article' => $html, 'sidebar' => $sidebar, 'status' => 'ok', 'isSidebarItem' => $loadSidebarNextArticle, 'currentPostId' => $data[0]['id'] )));
	wp_die();
}

function tn_custom_excerpt_length( $length ) {
	return 15;
}

add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );

add_theme_support( 'title-tag' );

add_image_size( 'posts-slider', 9999, 314 );

add_image_size( 'posts-slider-masonry', 9999, 848 );

add_image_size( 'posts-slider-carousel', 9999, 380 );

add_image_size( 'hot-posts', 190, 9999 );

add_image_size( 'celeb-images', 380, 380, true );