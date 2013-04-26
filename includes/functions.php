<?php
//////////////////////////////////////////////////////////////////////////////
// Adding css and js files on theme
//////////////////////////////////////////////////////////////////////////////
add_action( 'wp_enqueue_scripts', 'abz_twitter_feed_enqueue_scripts' );

function abz_twitter_feed_enqueue_scripts() {
	// css files	
    wp_register_style('abz_twitter_feed-admin-css', ABZ_TWITTER_FEED_PLUGIN_URL.'/includes/css/styles.css','',ABZ_TWITTER_FEED_VERSION, 'all');
	wp_enqueue_style(array( 'abz_twitter_feed-admin-css' ));
	// js files
    wp_register_script('abz_twitter_feed-admin-script', ABZ_TWITTER_FEED_PLUGIN_URL.'/includes/js/script.js','',ABZ_TWITTER_FEED_VERSION, false);
	wp_enqueue_script(array( 'jquery','abz_twitter_feed-admin-script' ));
}

////////////////////////////////////////////////////////////////////
// Add Ajax Handler for getting twitter timeline
////////////////////////////////////////////////////////////////////
function abz_get_twitter_feed(){
	//get the data from ajax() call
	//$title = $_POST['title'];

	//TODO: Fill these values by the ones supplied on extension's settings page
	$consumer_key = '';
	$consumer_secret = '';

	$oauth_access_token = '';
	$oauth_access_token_secret = '';

	//TODO: If values missing, send an error and if admin_logged_in send actual reason 

	$oauth = array( 'oauth_consumer_key' => $consumer_key,
					'oauth_token' => $oauth_access_token,
					'oauth_consumer_secret' => $oauth_consumer_secret,
					'oauth_access_token_secret' => $oauth_access_token_secret
					);

	$reader = new ABZ_Cached_Twitter_Timeline_Reader($oauth);

	$results = $reader ->get_json();

	// Return the String
	die($results);
}
// creating Ajax call for WordPress
add_action( 'wp_ajax_nopriv_gettwitterfeed', 'abz_get_twitter_feed' );
add_action( 'wp_ajax_gettwitterfeed', 'abz_get_twitter_feed' );
