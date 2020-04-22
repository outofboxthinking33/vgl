<footer id="footer">
	<div class="footer-container">
		<div class="footer-left">
			<?php if ( is_active_sidebar( 'footer-widget-1' ) ): ?>
				<?php dynamic_sidebar( 'footer-widget-1' ); ?>
			<?php endif; ?>
		</div>
		<div class="footer-right">
			<?php if ( is_active_sidebar( 'footer-widget-2' ) ): ?>
				<?php dynamic_sidebar( 'footer-widget-2' ); ?>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-widget-3' ) ): ?>
				<?php dynamic_sidebar( 'footer-widget-3' ); ?>
			<?php endif; ?>
		</div>
	</div>	
	<div class="footer-container">
		<div class="footer-bottom">
			<div class="footer-bottom-text"><?php echo vgl_get_theme_option('footer_bottom_text'); ?></div>
			<div class="footer-bottom-link">
				<?php if ( vgl_get_theme_option( 'footer_facebook_link' ) != '' ): ?>
					<a href="<?php echo vgl_get_theme_option( 'footer_facebook_link' ) ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
				<?php endif; ?>
				<?php if ( vgl_get_theme_option( 'footer_instagram_link' ) != '' ): ?>
					<a href="<?php echo vgl_get_theme_option( 'footer_instagram_link' ) ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer() ?>
</div>
</body>
</html>