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
		<!-- <div class="footer-left">
			<?php if ( is_active_sidebar( 'footer-widget-1' ) ): ?>
			<?php dynamic_sidebar( 'footer-widget-1' ); ?>
			<?php endif; ?>
		</div>
		<div class="footer-right">
			<?php if ( is_active_sidebar( 'footer-widget-2' ) ): ?>
			<?php dynamic_sidebar( 'footer-widget-2' ) ?>
			<?php elseif ( is_active_sidebar( 'footer-widget-3' ) ): ?>
			<?php dynamic_sidebar( 'footer-widget-3' ) ?>
			<?php endif; ?>
		</div> -->
	</div>	
</footer>
<?php wp_footer() ?>
</div>
</body>
</html>