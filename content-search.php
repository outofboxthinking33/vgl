<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php get_template_part( 'template-parts/loop/post', 'title' ); ?>

	<?php get_template_part( 'template-parts/loop/post', 'thumbnail' ); ?>

	<?php get_template_part( 'template-parts/loop/post', 'excerpt' ); ?>

	<?php get_template_part( 'template-parts/loop/post', 'search-footer' ); ?>

</article><!-- #post-## -->
