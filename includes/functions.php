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