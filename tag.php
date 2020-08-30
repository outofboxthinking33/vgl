<?php get_header(); ?>

	<main class="main-content" role="main">
		<!-- section -->
		<section class="vgl-results">

        <header class="vgl-archive-header">
				<h1 class="vgl-archive-title">
				<?php
				/* translators: %s: Tag title. */
				printf( __( 'Tag Archives: %s', 'twentytwelve' ), '<span>' . single_tag_title( '', false ) . '</span>' );
				?>
				</h1>

			<?php if ( tag_description() ) : // Show an optional tag description. ?>
				<div class="archive-meta"><?php echo tag_description(); ?></div>
			<?php endif; ?>
		</header><!-- .archive-header -->

			<?php get_template_part('loop'); ?>

			<div class="vgl-results-pagination"><?php get_template_part('pagination'); ?></div>

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
