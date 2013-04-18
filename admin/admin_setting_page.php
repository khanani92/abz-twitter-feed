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
			<?php do_settings_sections( 'twitter-feeds' ); ?>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
 
add_action( 'admin_init', 'my_admin_init' );
function my_admin_init() {
	register_setting( 'tfs-settings-group', 'tfs-settings' );
 
	// Sections
	add_settings_section( 'required_settings_section', __('Required Settings', 'tfs'), 'required_settings_callback', 'twitter-feeds' );
	add_settings_section( 'general_settings_section', __('General Settings', 'tfs'), 'general_settings_callback', 'twitter-feeds' );

	// Fields
	add_settings_field( 'field_1_callback', __('Tfs fiels 1', 'tfs'), 'field_1_callback', 'twitter-feeds', 'required_settings_section' );
	add_settings_field( 'field_2_callback', __('Tfs fiels 2', 'tfs'), 'field_2_callback', 'twitter-feeds', 'required_settings_section' );
	add_settings_field( 'field_3_callback', __('Tfs fiels 3', 'tfs'), 'field_3_callback', 'twitter-feeds', 'required_settings_section' );
	add_settings_field( 'field_4_callback', __('Tfs fiels 4', 'tfs'), 'field_4_callback', 'twitter-feeds', 'required_settings_section' );
	add_settings_field( 'field_5_callback', __('Tfs fiels 5', 'tfs'), 'field_5_callback', 'twitter-feeds', 'general_settings_section' );
	add_settings_field( 'field_6_callback', __('Tfs fiels 6', 'tfs'), 'field_6_callback', 'twitter-feeds', 'general_settings_section' );
}
$settings = get_option( 'tfs-settings' );
 
function required_settings_callback() {
	printf(__('Copy and paste your <strong>Keys</strong> and <strong>Tokens</strong>.', 'tfs'));
}

function general_settings_callback() {
	printf(__('Genrel Settings Area.', 'tfs'));
}
 
function field_1_callback() {
	global $settings;
	$tfs_fiels_1 = esc_attr( $settings['tfs_fiels_1'] );
	echo "<input class='regular-text' type='text' name='tfs-settings[tfs_fiels_1]' value='$tfs_fiels_1' />";
}

function field_2_callback() {
	global $settings;
	$tfs_fiels_2 = esc_attr( $settings['tfs_fiels_2'] );
	echo "<input class='regular-text' type='text' name='tfs-settings[tfs_fiels_2]' value='$tfs_fiels_2' />";
}

function field_3_callback() {
	global $settings;
	$tfs_fiels_3 = esc_attr( $settings['tfs_fiels_3'] );
	echo "<input class='regular-text' type='text' name='tfs-settings[tfs_fiels_3]' value='$tfs_fiels_3' />";
}

function field_4_callback() {
	global $settings;
	$tfs_fiels_4 = esc_attr( $settings['tfs_fiels_4'] );
	echo "<input class='regular-text' type='text' name='tfs-settings[tfs_fiels_4]' value='$tfs_fiels_4' />";
}

function field_5_callback() {
	global $settings;
	$tfs_fiels_5 = esc_attr( $settings['tfs_fiels_5'] );
	echo "<input class='regular-text' type='text' name='tfs-settings[tfs_fiels_5]' value='$tfs_fiels_5' />";
}

function field_6_callback() {
	global $settings;
	$tfs_fiels_6 = esc_attr( $settings['tfs_fiels_6'] );
	echo "<input class='regular-text' type='text' name='tfs-settings[tfs_fiels_6]' value='$tfs_fiels_6' />";
}