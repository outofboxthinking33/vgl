<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header();
?>

<div id="primary" class="primary-container single-blog-container <?php $dark_mode  = get_post_meta( $post->ID, 'vgl_dark_mode', true ); echo 'mode-'.$dark_mode ?>">
	<main id="main" class="main-content">
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<!-- <header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header> -->

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

		else :

			get_template_part( 'template-parts/content' );

		endif; ?>
	</main><!-- #main -->
	<?php if ( is_single() ) : ?>
		<div class="lightening-loading" style="display: none;">
			<img src="<?php echo get_template_directory_uri() . '/assets/img/Lightning Loading.gif'; ?>">
		</div>
	<?php endif; ?>
</div><!-- #primary -->

<?php
get_footer();