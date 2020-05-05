<?php

/*
 * VGL Theme Options Pannel
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists( 'vglThemeOptions' ) ) {
	class vglThemeOptions
	{
		
		function __construct()
		{
			if ( is_admin() ) {
				add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
				add_action( 'admin_init', array( $this, 'register_settings' ) );
				add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_sripts_func' ) );
			}
		}

		public function add_admin_menu() {
			add_menu_page(
				esc_html__( 'Theme Settings', 'vgl' ),
				esc_html__( 'Theme Settings', 'vgl' ),
				'manage_options',
				'theme-settings',
				array( $this, 'create_admin_page' )
			);
		}

		public function register_settings() {

			register_setting( 'theme_options', 'theme_options', array(  
				'sanitize_callback' => array($this, 'sanitize')
			) );

		}

		public function sanitize( $options ) {

			if ( $options ) {

				if ( !empty( $options['logo_id'] ) ) {

					$options['logo_id'] = sanitize_text_field( $options['logo_id'] );

				} else {

					unset( $options['logo_id'] );

				}

			}

			return $options;

		}

		public static function get_theme_options() {

			return get_option( 'theme_options' );

		}

		public static function get_theme_option( $id ) {

			$options = vglThemeOptions::get_theme_options();

			if ( isset( $options[$id] ) ) {

				return $options[$id];

			}

		}

		public function create_admin_page() {

		?>

		<div class="wrap">
			
			<h1><?php esc_html_e( 'Theme Options', 'vgl' ); ?></h1>

			<form method="post" action="options.php">

				<?php settings_fields( 'theme_options' ); ?>

				<table class="form-table vgl-theme-options-table">
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Logo Image', 'vgl' ); ?></th>
						<td>
							<?php $logo_id = vglThemeOptions::get_theme_option( 'logo_id' ); ?>
							<div class="vgl-meta-fields">
								<input type="hidden" name="theme_options[logo_id]" value="<?php echo $logo_id ?>">
							</div>
							<div class="vgl-meta-fields">
								<img src="<?php echo wp_get_attachment_image_src( $logo_id, 'full' )[0]; ?>" class="vgl-media-image <?php if ( !empty(wp_get_attachment_image_src( $logo_id, 'full' ))){
									echo 'active';	
								} ?>">
							</div>
							<a class="vgl-media-upload-btn">Upload</a>
							<a class="vgl-media-remove-btn">Remove</a>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'DarkMode Logo Image', 'vgl' ); ?></th>
						<td>
							<?php $dark_logo_id = vglThemeOptions::get_theme_option( 'dark_logo_id' ); ?>
							<div class="vgl-meta-fields">
								<input type="hidden" name="theme_options[dark_logo_id]" value="<?php echo $dark_logo_id ?>">
							</div>
							<div class="vgl-meta-fields">
								<img src="<?php echo wp_get_attachment_image_src( $dark_logo_id, 'full' )[0]; ?>" class="vgl-media-image <?php if ( !empty(wp_get_attachment_image_src( $dark_logo_id, 'full' ))){
									echo 'active';	
								} ?>">
							</div>
							<a class="vgl-media-upload-btn">Upload</a>
							<a class="vgl-media-remove-btn">Remove</a>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Menu Style', 'vgl' ); ?></th>
						<td>
							<?php $menu_style = vglThemeOptions::get_theme_option( 'menu_style' ); ?>
							<div class="vgl-meta-fields">
								<select name="theme_options[menu_style]">
									<option value="rectangle_menu" <?php if ( $menu_style == 'rectangle_menu' ){ echo 'selected'; } ?>>Rectangle Menu</option>
									<option value="inline_menu" <?php if ( $menu_style == 'inline_menu' ){ echo 'selected'; } ?>>Inline Menu</option>
								</select>
							</div>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Mobile Menu Social Links', 'vgl' ); ?></th>
						<?php 
							$mobile_social_facebook = vglThemeOptions::get_theme_option( 'mobile_social_facebook' );
							$mobile_social_instagram = vglThemeOptions::get_theme_option( 'mobile_social_instagram' );
							$mobile_social_youtube = vglThemeOptions::get_theme_option( 'mobile_social_youtube' );
							$mobile_social_twitter = vglThemeOptions::get_theme_option( 'mobile_social_twitter' );
						?>
						<td>
							<div class="vgl-meta-fields">
								<label for="social_share_label">Facebook</label>
								<input type="text" name="theme_options[mobile_social_facebook]" value="<?php echo $mobile_social_facebook; ?>" id="mobile_social_facebook">
							</div>
							<div class="vgl-meta-fields">
								<label for="social_share_label">Instagram</label>
								<input type="text" name="theme_options[mobile_social_instagram]" value="<?php echo $mobile_social_instagram; ?>" id="mobile_social_instagram">
							</div>
							<div class="vgl-meta-fields">
								<label for="social_share_label">Youtube</label>
								<input type="text" name="theme_options[mobile_social_youtube]" value="<?php echo $mobile_social_youtube; ?>" id="mobile_social_youtube">
							</div>
							<div class="vgl-meta-fields">
								<label for="social_share_label">Twitter</label>
								<input type="text" name="theme_options[mobile_social_twitter]" value="<?php echo $mobile_social_twitter; ?>" id="mobile_social_twitter">
							</div>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Blog Social Share Links', 'vgl' ) ?></th>
						<?php 
							$social_share_facebook = vglThemeOptions::get_theme_option('social_share_facebook');
							$social_share_twitter = vglThemeOptions::get_theme_option('social_share_twitter');
							$social_share_pinterest = vglThemeOptions::get_theme_option('social_share_pinterest');
						?>
						<td>
							<div class="vgl-meta-fields">
								<label for="social_share_label">Social Share Facebook</label>
								<input type="text" name="theme_options[social_share_facebook]" value="<?php echo $social_share_facebook; ?>" id="social_share_facebook">
							</div>
							<div class="vgl-meta-fields">
								<label for="social_share_label">Social Share Twitter</label>
								<input type="text" name="theme_options[social_share_twitter]" value="<?php echo $social_share_twitter; ?>" id="social_share_twitter">
							</div>
							<div class="vgl-meta-fields">
								<label for="social_share_label">Social Share Pinterest</label>
								<input type="text" name="theme_options[social_share_pinterest]" value="<?php echo $social_share_pinterest; ?>" id="social_share_pinterest">
							</div>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Footer Bottom', 'vgl' ); ?></th>
						<td>
							<?php 
								$footer_bottom_text = vglThemeOptions::get_theme_option( 'footer_bottom_text' ); 
								$footer_facebook_link = vglThemeOptions::get_theme_option( 'footer_facebook_link' );
								$footer_instagram_link = vglThemeOptions::get_theme_option( 'footer_instagram_link' );
							?>
							<div class="vgl-meta-fields">
								<label for="footer_bottom_text">Footer Bottom Text</label>
								<input type="text" name="theme_options[footer_bottom_text]" value="<?php echo $footer_bottom_text; ?>" id="footer_bottom_text">
							</div>
							<div class="vgl-meta-fields">
								<label for="footer_facebook_link">Footer Facebook Link</label>
								<input type="text" name="theme_options[footer_facebook_link]" value="<?php echo $footer_facebook_link; ?>" id="footer_facebook_link">
							</div>
							<div class="vgl-meta-fields">
								<label for="footer_instagram_link">Footer Instagram Link</label>
								<input type="text" name="theme_options[footer_instagram_link]" value="<?php echo $footer_instagram_link; ?>" id="footer_instagram_link">
							</div>
						</td>
					</tr>
				</table>

				<?php submit_button(); ?>
				
			</form>

		</div>

		<?php

		}

		public function admin_enqueue_sripts_func() {

			wp_enqueue_script( 'vgl-admin-settings-script', get_stylesheet_directory_uri() . '/admin/assets/js/admin.js', array('jquery') );

			wp_enqueue_style( 'vgl-admin-settings-style', get_stylesheet_directory_uri() . '/admin/assets/css/admin.css' );

			wp_enqueue_media();

		}
	}

	new vglThemeOptions();

	function vgl_get_theme_option( $id = '' ) {
		return vglThemeOptions::get_theme_option( $id );
	}
}