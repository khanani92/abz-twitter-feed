<?php
/*
Plugin Name: Twitter Feeds
Plugin URI: http://www.appbakerz.com/
Description: Just another Twitter Feeds plugin. Simple but flexible.
Author: Application Bakers
Author URI: http://www.appbakerz.com
Text Domain: tfs
Domain Path: /languages/
Version: 0.1
*/

/*  Copyright 2013 Application Bakers (email: info@appbakerz.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

define( 'TFS_VERSION', '0.1' );

define( 'TFS_REQUIRED_WP_VERSION', '3.0' );

if ( ! defined( 'TFS_PLUGIN_BASENAME' ) )
	define( 'TFS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

//if ( ! defined( 'TFS_PLUGIN_NAME' ) )
//	define( 'TFS_PLUGIN_NAME', trim( dirname( WPCF7_PLUGIN_BASENAME ), '/' ) );

if ( ! defined( 'TFS_PLUGIN_DIR' ) )
	define( 'TFS_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );

if ( ! defined( 'TFS_PLUGIN_URL' ) )
	define( 'TFS_PLUGIN_URL', untrailingslashit( plugins_url( '', __FILE__ ) ) );

if ( ! defined( 'TFS_LOAD_JS' ) )
	define( 'WPCF7_LOAD_JS', true );

if ( ! defined( 'TFS_LOAD_CSS' ) )
	define( 'TFS_LOAD_CSS', true );

if ( ! defined( 'TFS_AUTOP' ) )
	define( 'WPCF7_AUTOP', true );

if ( ! defined( 'TFS_USE_PIPE' ) )
	define( 'TFS_USE_PIPE', true );


if ( is_admin() )
	require_once TFS_PLUGIN_DIR . '/admin/admin.php';
	


/**
*
* Admin Messages 
*/
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
/**
* Check  that the current version of WordPress is current enough.
*
*
* @ return  none  exit on fail.
*/
function tfs_check_wordpress_version(){
	global $wp_version;
	
	$msg =  sprintf( __( '<strong>Twitter Feeds %1$s</strong> requires WordPress %2$s or higher. Please <a href="%3$s">Update WordPress</a> first.', 'tfs' ), TFS_VERSION, TFS_REQUIRED_WP_VERSION, admin_url( 'update-core.php' ) );
		
	if(version_compare($wp_version, TFS_REQUIRED_WP_VERSION, '<'))
	{
		tfs_show_admin_message($msg, true);
	}
}
add_action('admin_notices', 'tfs_check_wordpress_version', 9);