<?php
/*
Template Name: About Template
*/

get_header(); ?>

<div id="primary" class="primary-container">
	<main id="main" class="main-content">
		<?php if ( have_posts() ): ?>
			<?php while( have_posts() ): the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</main>
</div>

<?php get_footer(); ?>