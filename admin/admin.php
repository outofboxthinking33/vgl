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