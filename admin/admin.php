<?php
//////////////////////////////////////////////////////////////////////////////
// Custom Admin message 
//////////////////////////////////////////////////////////////////////////////
function tfs_show_admin_message($message, $errormsg = false)
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
add_action('admin_notices', 'tfs_check_wordpress_version', 9);

function tfs_check_wordpress_version(){
	global $wp_version;
	
	$msg =  sprintf( __( '<strong>Twitter Feeds %1$s</strong> requires WordPress %2$s or higher. Please <a href="%3$s">Update WordPress</a> first.', 'tfs' ), TFS_VERSION, TFS_REQUIRED_WP_VERSION, admin_url( 'update-core.php' ) );
		
	if(version_compare($wp_version, TFS_REQUIRED_WP_VERSION, '<'))
	{
		tfs_show_admin_message($msg, true);
	}
}
//////////////////////////////////////////////////////////////////////////////
// Check setting fiels are empty ? yes! then show notification
//////////////////////////////////////////////////////////////////////////////
add_action('admin_notices', 'tfs_check_settings', 9);

function tfs_check_settings(){
	global $settings;
	$msg =  sprintf( __( 'Twitter requires authentication by OAuth. You will need to <a href="%1$s">update your settings</a> to complete installation of <strong>Twitter Feeds.</strong>', 'tfs' ), menu_page_url( 'twitter-feeds', false ) );
		
	if($settings['color'])
	{
		tfs_show_admin_message($msg, true);
	}
}
//////////////////////////////////////////////////////////////////////////////
// Dispaly Setting Link on plugin page
//////////////////////////////////////////////////////////////////////////////
add_filter( 'plugin_action_links', 'tfs_plugin_action_links', 10, 2 );

function tfs_plugin_action_links( $links, $file ) {
	if ( $file != TFS_PLUGIN_BASENAME )
		return $links;

	$settings_link = '<a href="' . menu_page_url( 'twitter-feeds', false ) . '">'
		. esc_html( __( 'Settings', 'tfs' ) ) . '</a>';

	array_unshift( $links, $settings_link );

	return $links;
}

//////////////////////////////////////////////////////////////////////////////
// Dispaly only twitter-feeds page 
//////////////////////////////////////////////////////////////////////////////
add_action( 'admin_enqueue_scripts', 'tfs_admin_enqueue_scripts' );

function tfs_admin_enqueue_scripts( $hook ) {
	if ( false === strpos( $hook, 'twitter-feeds' ) )
		return;
	// css files	
    wp_register_style('tfs-admin-css', TFS_PLUGIN_URL.'/admin/css/styles.css','',TFS_VERSION, 'all');
	wp_enqueue_style(array( 'tfs-admin-css' ));
	// js files
    wp_register_script('tfs-admin-script', TFS_PLUGIN_URL.'/admin/js/script.js','',TFS_VERSION, false);
	wp_enqueue_script(array( 'jquery','tfs-admin-script' ));
	

}
