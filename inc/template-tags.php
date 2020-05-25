<?php


function vgl_pagination( $args = array() ) {

    global $wp_query;

    if ( empty( $wp_query->max_num_pages ) || (int) $wp_query->max_num_pages < 2 ) {

        return;

    }

    global $post;

    $post_type_labels = get_post_type_labels( get_post_type_object( $post->post_type ) );
    $post_type_label  = isset( $post_type_labels->singular_name ) ? $post_type_labels->singular_name : $post->post_type;

    /**
     * Filter the default post pagination args.
     *
     * @since 1.6.0
     *
     * @param int $current The current page number.
     * @param int $total   The total number of pages.
     *
     * @var array
     */
    $defaults = (array) apply_filters( 'primer_pagination_default_args', array(
        'prev_text'          => __( '&larr; Previous', 'primer' ),
        'next_text'          => __( 'Next &rarr;', 'primer' ),
        'screen_reader_text' => sprintf( /* translators: post type singular label */ esc_html__( '%1$s navigation', 'primer' ), esc_html( $post_type_label ) ),
    ), max( 1, get_query_var( 'paged' ) ), absint( $wp_query->max_num_pages ) );

    $args = wp_parse_args( $args, $defaults );

    the_posts_pagination( $args );

}

// Create the Custom Excerpts callback
function vgl_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}