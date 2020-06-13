<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-id="<?php the_ID(); ?>">
	<header class="entry-header">
		<?php 
		
		if ( is_single() ) :
            
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
						<span class="authorName">by <span class="author"><?php echo $authorName; ?></span></span>
						<span class="postDate"><?php echo get_the_date(); ?></span>
					</div>
				</div>
			</div>

			<?php

		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		?>
		<div class="social_share">
			<p class="social_share_heading">Share</p>
			<a class="social_share_icon first" href="<?php echo vgl_get_theme_option('social_share_facebook'); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			<a class="social_share_icon" href="<?php echo vgl_get_theme_option('social_share_twitter'); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
			<a class="social_share_icon last" href="<?php echo vgl_get_theme_option('social_share_pinterest'); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
		</div>
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
			<?php if('post' == get_post_type()): ?>
				<?php get_template_part( 'template-parts/blog', 'sidebar' ); ?>
			<?php endif; ?>
		</div>
	</div>
</article>