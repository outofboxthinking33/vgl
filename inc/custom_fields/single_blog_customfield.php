<?php

// Add Portfolio Custom Meta Fields

add_action( 'add_meta_boxes_post', 'post_add_meta_boxes' );
function post_add_meta_boxes( $post ){
	add_meta_box( 'vgl_post_meta_boxes', __( 'Mark Mode' ), 'vgl_post_meta_boxes', 'post', 'side', 'low' );
}

function vgl_post_meta_boxes( $post ) {

	$dark_mode  = get_post_meta( $post->ID, 'vgl_dark_mode', true );

	?>

	<div class="vgl-darkmode-wrapper">
		<select class="vgl_dark_mode" name="vgl_dark_mode">
			<option value="default" <?php selected( $dark_mode, 'default' ) ?>>Default</option>
			<option value="dark" <?php selected( $dark_mode, 'dark' ) ?>>Dark</option>
		</select>
	</div>

	<?php

}

add_action('save_post_post', 'post_save_post_meta_boxes_data', 10, 2);
function post_save_post_meta_boxes_data( $post_id ) {

	update_post_meta( $post_id, 'vgl_dark_mode', $_POST['vgl_dark_mode'] );

}
