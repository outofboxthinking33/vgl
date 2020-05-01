<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-id="<?php the_ID(); ?>">
	<header class="entry-header">
		<?php 
		
		if ( is_single() ) :

			echo do_shortcode('[rt_reading_time label="LOOK" postfix="MINUTE READ" postfix_singular="MINUTE READ"]');

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

		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

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