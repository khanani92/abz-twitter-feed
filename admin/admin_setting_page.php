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
	add_settings_field( 'field_1_callback', __('Consumer Key', 'tfs'), 'field_1_callback', 'twitter-feeds', 'required_settings_section' );
	add_settings_field( 'field_2_callback', __('Consumer Secret', 'tfs'), 'field_2_callback', 'twitter-feeds', 'required_settings_section' );
	add_settings_field( 'field_3_callback', __('Access Token', 'tfs'), 'field_3_callback', 'twitter-feeds', 'required_settings_section' );
	add_settings_field( 'field_4_callback', __('Access Token Secret', 'tfs'), 'field_4_callback', 'twitter-feeds', 'required_settings_section' );
	add_settings_field( 'field_5_callback', __('Tfs fiels 5', 'tfs'), 'field_5_callback', 'twitter-feeds', 'general_settings_section' );
	add_settings_field( 'field_6_callback', __('Tfs fiels 6', 'tfs'), 'field_6_callback', 'twitter-feeds', 'general_settings_section' );
}
$settings = get_option( 'tfs-settings' );
 
function required_settings_callback() { ?>
	<ol>
		<li><?php printf(__("Register this site as an application on <strong><a target='_blank' href='http://dev.twitter.com/apps/new'>Twitter's application registration page</a></strong>.", "tfs")); ?></li>	        
		<li><?php printf(__("Copy and paste your <strong>Key,Token</strong> and <strong>Secrets</strong>.", "tfs")); ?></li>
	</ol>
	
<?php }

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