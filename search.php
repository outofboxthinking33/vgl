<?php get_header(); ?>

	<main class="main-content" role="main">
		<!-- section -->
		<section class="vgl-results">

			<h1 class="vgl-results-title"><?php echo sprintf( __( '%s Search Results for ', 'vgl' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>

			<?php get_template_part('loop'); ?>

			<div class="vgl-results-pagination"><?php get_template_part('pagination'); ?></div>

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
