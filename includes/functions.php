<?php
require_once ABZ_TWITTER_FEED_PLUGIN_DIR . '/lib/twitter_api_client.php';
require_once ABZ_TWITTER_FEED_PLUGIN_DIR . '/lib/API_cache.php';
require_once ABZ_TWITTER_FEED_PLUGIN_DIR . '/lib/cached_twitter_timeline_reader.php';
//////////////////////////////////////////////////////////////////////////////
// Adding css and js files on theme
//////////////////////////////////////////////////////////////////////////////
function abz_twitter_feed_register_scripts() {
	// css files
    wp_register_style('abz_twitter_feed-admin-css', ABZ_TWITTER_FEED_PLUGIN_URL.'/includes/css/styles.css','',ABZ_TWITTER_FEED_VERSION, 'all');
	// js files
    wp_register_script('abz_twitter_feed-admin-script', ABZ_TWITTER_FEED_PLUGIN_URL.'/includes/js/script.js','',ABZ_TWITTER_FEED_VERSION, false);
}
add_action('init', 'abz_twitter_feed_register_scripts');

function abz_twitter_feed_enqueue_scripts() {
	// css files
	wp_enqueue_style(array( 'abz_twitter_feed-admin-css' ));
	// js files
	wp_enqueue_script(array( 'jquery','abz_twitter_feed-admin-script' ));
}

////////////////////////////////////////////////////////////////////
// Add Ajax Handler for getting twitter timeline
////////////////////////////////////////////////////////////////////
function abz_get_twitter_feed(){
	//get the data from ajax() call
	//$title = $_POST['title'];

	//TODO: Fill these values by the ones supplied on extension's settings page
	$consumer_key = 'FyMvI7VdIHa77M5YlodA';
	$consumer_secret = '5VXaEoWUQAC7Z3MkiA3fAKy0gqi1hnSoXkSUNctLA';

	$oauth_access_token = '526178478-HaGAiDnLuPOGLvqSkqXoxE6I9IICUqK2TQ8QibUf';
	$oauth_access_token_secret = 'wdLkH5TiDsXLjNcw7ILD8mU5gdK3j6IUzdN53onfA';

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
