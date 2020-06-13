<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <div id="content" class="site-content not-found" role="main">

            <header class="page-header">
                <h1 class="page-title"><?php _e( '404', 'vgl' ); ?></h1>
            </header>

            <div class="page-wrapper">
                <div class="page-content">
                    <h2><?php _e( 'Whoops, something went wrong', 'vgl' ); ?></h2>
                    <a href="/"><?php _e( 'Home please', 'vgl' ); ?></a>
                </div><!-- .page-content -->
            </div><!-- .page-wrapper -->

        </div><!-- #content -->
    </div><!-- #primary -->

<?php get_footer(); ?>