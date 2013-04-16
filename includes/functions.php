<?php
//////////////////////////////////////////////////////////////////////////////
// Adding css and js files on theme
//////////////////////////////////////////////////////////////////////////////
add_action( 'wp_enqueue_scripts', 'tfs_enqueue_scripts' );

function tfs_enqueue_scripts() {
	// css files	
    wp_register_style('tfs-admin-css', TFS_PLUGIN_URL.'/includes/css/styles.css','',TFS_VERSION, 'all');
	wp_enqueue_style(array( 'tfs-admin-css' ));
	// js files
    wp_register_script('tfs-admin-script', TFS_PLUGIN_URL.'/includes/js/script.js','',TFS_VERSION, false);
	wp_enqueue_script(array( 'jquery','tfs-admin-script' ));
}