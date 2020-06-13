<div class="blog-post-sidebar sticky_block">
	<?php 
		global $post;

		$prev_post = get_previous_post();

		$featured_url = get_the_post_thumbnail_url( $post, 'thumbnail' );

		$title = get_the_title( $post );
	?>
	<div class="blog-post-individual prev" data-id="<?php echo $prev_post->ID; ?>" data-link="<?php echo get_the_permalink($prev_post->ID) ?>">
		<div class="blog-post-individual-featuredimg" style="background-image: url(<?php echo get_the_post_thumbnail_url( $prev_post->ID, 'thumbnail' ) ?>)"></div>
		<div class="blog-post-individual-title"><?php echo $prev_post->post_title; ?></div>
	</div>
	<div class="blog-post-individual active" data-id="<?php echo get_the_ID(); ?>" data-link="<?php echo get_the_permalink() ?>">
		<div class="blog-post-individual-featuredimg" style="background-image: url(<?php echo $featured_url ?>)"></div>
		<div class="blog-post-individual-title"><?php echo $title; ?></div>
	</div>

	<?php 

	get_next_post();

	for ($i=0; $i < 3; $i++) { 

		$post = get_next_post();

		setup_postdata($post);

		$featured_url = get_the_post_thumbnail_url( $post, 'thumbnail' );

		$title = get_the_title( $post );

	?>

		<div class="blog-post-individual last" data-id="<?php echo get_the_ID(); ?>" data-link="<?php echo get_the_permalink() ?>">
			<div class="blog-post-individual-featuredimg" style="background-image: url(<?php echo $featured_url ?>)"></div>
			<div class="blog-post-individual-title"><?php echo $title; ?></div>
		</div>

	<?php
	} 
	?>
</div>