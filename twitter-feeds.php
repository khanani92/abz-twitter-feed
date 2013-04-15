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

define( 'TFS_REQUIRED_WP_VERSION', '4.0' );

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
		echo '<div id="message" class="updated fade">';
	}

	echo "<p><strong>$message</strong></p></div>";
}
/**
* Check  that the current version of WordPress is current enough.
*
*
* @ return  none  exit on fail.
*/
function tfs_check_wordpress_version(){
	global $wp_version;
	
	$msg =  sprintf( __( 'Twitter Feeds %1$s requires WordPress %2$s or higher. Please <a href="%3$s">Update WordPress</a> first.', 'tfs' ), TFS_VERSION, TFS_REQUIRED_WP_VERSION, admin_url( 'update-core.php' ) );
		
	if(version_compare($wp_version, TFS_REQUIRED_WP_VERSION, '<'))
	{
		tfs_show_admin_message($msg, true);
	}
}
add_action('admin_notices', 'tfs_check_wordpress_version', 9);