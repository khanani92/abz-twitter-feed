<?php
require_once ABZ_TWITTER_FEED_PLUGIN_DIR . '/lib/twitter_api_client.php';
require_once ABZ_TWITTER_FEED_PLUGIN_DIR . '/lib/API_cache.php';
require_once ABZ_TWITTER_FEED_PLUGIN_DIR . '/lib/cached_twitter_timeline_reader.php';
//////////////////////////////////////////////////////////////////////////////
// Adding css and js files on theme
//////////////////////////////////////////////////////////////////////////////
function abz_twitter_feed_register_scripts() {
    wp_register_style('abz_twitter_feed-css', ABZ_TWITTER_FEED_PLUGIN_URL.'/includes/css/styles.css','',ABZ_TWITTER_FEED_VERSION, 'all');
    wp_register_script('abz_twitter_feed_script', ABZ_TWITTER_FEED_PLUGIN_URL.'/includes/js/scripts.js','',ABZ_TWITTER_FEED_VERSION, false);
}
add_action('init', 'abz_twitter_feed_register_scripts');

function abz_twitter_feed_enqueue_scripts() {
	wp_enqueue_style(array( 'abz_twitter_feed-css' ));// css files
	wp_enqueue_script(array( 'jquery','abz_twitter_feed_script' ));// js files
	$urls = array( 'admin_url' => admin_url('admin-ajax.php'), 'pluginUrl' => ABZ_TWITTER_FEED_PLUGIN_URL  );
	wp_localize_script( 'abz_twitter_feed_script', 'urls', $urls );
}

////////////////////////////////////////////////////////////////////
// Add Ajax Handler for test Settings 
////////////////////////////////////////////////////////////////////
function abz_test_oauth_settings(){
	//get the data from ajax() call
	global $abz_twitter_feed_settings;
	
	//TODO: Fill these values by the ones supplied on extension's settings page
	$consumer_key = 'dasdarewefs';
	$consumer_secret = $abz_twitter_feed_settings['consumer_secret'];

	$oauth_access_token = $abz_twitter_feed_settings['access_token'];
	$oauth_access_token_secret = $abz_twitter_feed_settings['access_token_secret'];

	//TODO: If values missing, send an error and if admin_logged_in send actual reason 

	$oauth = array( 'oauth_consumer_key' => $consumer_key,
					'oauth_token' => $oauth_access_token,
					'oauth_consumer_secret' => $consumer_secret,
					'oauth_access_token_secret' => $oauth_access_token_secret
					);

	$reader = new ABZ_Twitter_Api_Client($oauth);

	$results = $reader ->read_timeline();

	// Return the String
	die($results);
}
// creating Ajax call for WordPress
add_action( 'wp_ajax_nopriv_abz_test_oauth_settings', 'abz_test_oauth_settings' );
add_action( 'wp_ajax_abz_test_oauth_settings', 'abz_test_oauth_settings' );

////////////////////////////////////////////////////////////////////
// Add Ajax Handler for getting twitter timeline
////////////////////////////////////////////////////////////////////
function abz_get_twitter_feed(){
	//get the data from ajax() call
	global $abz_twitter_feed_settings;
	
	//TODO: Fill these values by the ones supplied on extension's settings page
	$consumer_key = $abz_twitter_feed_settings['consumer_key'];
	$consumer_secret = $abz_twitter_feed_settings['consumer_secret'];

	$oauth_access_token = $abz_twitter_feed_settings['access_token'];
	$oauth_access_token_secret = $abz_twitter_feed_settings['access_token_secret'];

	//TODO: If values missing, send an error and if admin_logged_in send actual reason 

	$oauth = array( 'oauth_consumer_key' => $consumer_key,
					'oauth_token' => $oauth_access_token,
					'oauth_consumer_secret' => $consumer_secret,
					'oauth_access_token_secret' => $oauth_access_token_secret
					);

	$reader = new ABZ_Cached_Twitter_Timeline_Reader($oauth);

	$results = $reader ->get_json();

	// Return the String
	die($results);
}
// creating Ajax call for WordPress
add_action( 'wp_ajax_nopriv_abz_get_twitter_feed', 'abz_get_twitter_feed' );
add_action( 'wp_ajax_abz_get_twitter_feed', 'abz_get_twitter_feed' );
