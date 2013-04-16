<?php
add_action( 'admin_menu', 'my_admin_menu' );
function my_admin_menu() {
	add_options_page( __('Twitter Feeds', 'tfs'), __('Twitter Feeds', 'tfs'), 'manage_options', 'twitter-feeds', 'tfs_options_page' );
}
 
function tfs_options_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __('Twitter Feeds Options', 'tfs') ) ?></h2>
		<form action="options.php" method="POST">
			<?php settings_fields( 'tfs-settings-group' ); ?>
			<?php do_settings_sections( 'tfs-plugin' ); ?>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
 
add_action( 'admin_init', 'my_admin_init' );
function my_admin_init() {
	register_setting( 'tfs-settings-group', 'tfs-settings' );
 
	// Sections
	add_settings_section( 'section-one', __('Section One', 'tfs'), 'section_one_callback', 'tfs-plugin' );
 
	// Fields
	add_settings_field( 'field-one', __('Field One', 'tfs'), 'field_one_callback', 'tfs-plugin', 'section-one' );
	add_settings_field( 'field-two', __('Field Two', 'tfs'), 'field_two_callback', 'tfs-plugin', 'section-one' );
}
$settings = get_option( 'tfs-settings' );
 
function section_one_callback() {
	printf(__('Some help text goes here. ', 'tfs'));
}
 
function field_one_callback() {
	global $settings;
	$color = esc_attr( $settings['color'] );
	echo "<input class='regular-text' type='text' name='tfs-settings[color]' value='$color' />";
}

function field_two_callback() {
	global $settings;
	$size = esc_attr( $settings['size'] );
	echo "<input class='regular-text' type='text' name='tfs-settings[size]' value='$size' />";
}