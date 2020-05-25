<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<div class="vgl-article-wrapper">
		<!-- article -->
		<article class="vgl-article" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- post thumbnail -->
			<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
				<a class="vgl-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail('full'); // Declare pixel size you need inside the array ?>
				</a>
			<?php endif; ?>
			<!-- /post thumbnail -->

			<!-- post title -->
			<h2 class="vgl-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h2>
			<!-- /post title -->

			<!-- post details -->
			<div class="vgl-meta">
				<span class="vgl-date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
				<span class="vgl-author"><?php _e( 'Published by', 'vgl' ); ?> <?php the_author_posts_link(); ?></span>
				<span class="vgl-comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'vgl' ), __( '1 Comment', 'vgl' ), __( '% Comments', 'vgl' )); ?></span>
			</div>
			<!-- /post details -->

			<?php vgl_excerpt('tn_custom_excerpt_length'); // Build your custom callback length in functions.php ?>

			<?php edit_post_link(); ?>

		</article>
		<!-- /article -->
	</div>
	<div class="zigzag"></div>
<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'vgl' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
