<?php
//////////////////////////////////////////////////////////////////////////////
// Custom Admin message 
//////////////////////////////////////////////////////////////////////////////
function abz_twitter_feed_show_admin_message($message, $errormsg = false)
{
	if ($errormsg) {
		echo '<div id="message" class="error">';
	}
	else {
		echo '<div id="message" class="updated">';
	}

	echo "<p>$message</p></div>";
}
//////////////////////////////////////////////////////////////////////////////
// Check  that the current version of WordPress is current enough.
//////////////////////////////////////////////////////////////////////////////
add_action('admin_notices', 'abz_twitter_feed_check_wordpress_version', 9);

function abz_twitter_feed_check_wordpress_version(){
	global $wp_version;
	
	$msg =  sprintf( __( 'WORDPRESS_VERSION_ALERT_MESSAGE', 'abz_twitter_feed' ), ABZ_TWITTER_FEED_VERSION, ABZ_TWITTER_FEED_REQUIRED_WP_VERSION, admin_url( 'update-core.php' ) );
		
	if(version_compare($wp_version, ABZ_TWITTER_FEED_REQUIRED_WP_VERSION, '<'))
	{
		abz_twitter_feed_show_admin_message($msg, true);
	}
}
//////////////////////////////////////////////////////////////////////////////
// Check setting fields are empty ? yes! then show notification
//////////////////////////////////////////////////////////////////////////////
add_action('admin_notices', 'abz_twitter_feed_check_settings', 9);

function abz_twitter_feed_check_settings(){
	global $abz_twitter_feed_settings;
	$msg =  sprintf( __( 'BLANK_SETTING_ALERT_MESSAGE', 'abz_twitter_feed' ), menu_page_url( 'abz_twitter_feed', false ) );
		
	if(
		!$abz_twitter_feed_settings['consumer_key']          ||
		!$abz_twitter_feed_settings['consumer_secret']       || 
		!$abz_twitter_feed_settings['access_token']          || 
		!$abz_twitter_feed_settings['access_token_secret'] 
	)
	{
		abz_twitter_feed_show_admin_message($msg, true);
	}
}
//////////////////////////////////////////////////////////////////////////////
// Dispaly Setting Link on plugin page
//////////////////////////////////////////////////////////////////////////////
add_filter( 'plugin_action_links', 'abz_twitter_feed_plugin_action_links', 10, 2 );

function abz_twitter_feed_plugin_action_links( $links, $file ) {
	if ( $file != ABZ_TWITTER_FEED_PLUGIN_BASENAME )
		return $links;

	$settings_link = '<a href="' . menu_page_url( 'abz_twitter_feed', false ) . '">'
		. esc_html( __( 'ACTION_LINK_TITLE', 'abz_twitter_feed' ) ) . '</a>';

	array_push( $links, $settings_link );

	return $links;
}

//////////////////////////////////////////////////////////////////////////////
// Dispaly only twitter-feeds page 
//////////////////////////////////////////////////////////////////////////////
add_action( 'admin_enqueue_scripts', 'abz_twitter_feed_admin_enqueue_scripts' );

function abz_twitter_feed_admin_enqueue_scripts( $hook ) {
	if ( false === strpos( $hook, 'abz_twitter_feed' ) )
		return;
	// css files	
    wp_register_style('abz_twitter_feed-admin-css', ABZ_TWITTER_FEED_PLUGIN_URL.'/admin/css/styles.css','',ABZ_TWITTER_FEED_VERSION, 'all');
	wp_enqueue_style(array( 'abz_twitter_feed-admin-css' ));
	// js files
    wp_register_script('abz_twitter_feed-admin-script', ABZ_TWITTER_FEED_PLUGIN_URL.'/admin/js/script.js','',ABZ_TWITTER_FEED_VERSION, false);
	wp_enqueue_script(array( 'jquery','abz_twitter_feed-admin-script' ));
}
