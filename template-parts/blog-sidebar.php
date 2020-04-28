<div class="blog-post-sidebar">
	<?php 
		global $post;

		$featured_url = get_the_post_thumbnail_url( $post, 'thumbnail' );

		$title = get_the_title( $post );
	?>
	<div class="blog-post-individual active" data-id="<?php echo get_the_ID(); ?>">
		<div class="blog-post-individual-featuredimg" style="background-image: url(<?php echo $featured_url ?>)"></div>
		<div class="blog-post-individual-title"><?php echo $title; ?></div>
	</div>

	<?php 

	for ($i=0; $i < 3; $i++) { 

		$post = get_next_post();

		setup_postdata($post);

		$featured_url = get_the_post_thumbnail_url( $post, 'thumbnail' );

		$title = get_the_title( $post );

	?>

		<div class="blog-post-individual last" data-id="<?php echo get_the_ID(); ?>">
			<div class="blog-post-individual-featuredimg" style="background-image: url(<?php echo $featured_url ?>)"></div>
			<div class="blog-post-individual-title"><?php echo $title; ?></div>
		</div>

	<?php
	} 

	wp_reset_postdata();

	?>
</div>