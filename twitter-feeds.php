<?php
/*
Plugin Name: AppBakerz Twitter Feed
Plugin URI: http://www.appbakerz.com/
Description: Just another Twitter Feeds plugin. Simple but flexible.
Author: AppBakerz
Author URI: http://www.appbakerz.com
Text Domain: abz_twitter_feed
Domain Path: /languages/
Version: 0.1
*/

/*  Copyright 2013 AppBakerz (email: info@appbakerz.com)

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
	
// Settings and/or Configuration Details go here... 
define( 'ABZ_TWITTER_FEED_VERSION', '0.1' );

define( 'ABZ_TWITTER_FEED_REQUIRED_WP_VERSION', '3.0' );

if ( ! defined( 'ABZ_TWITTER_FEED_PLUGIN_BASENAME' ) )
	define( 'ABZ_TWITTER_FEED_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

if ( ! defined( 'ABZ_TWITTER_FEED_PLUGIN_NAME' ) )
	define( 'ABZ_TWITTER_FEED_PLUGIN_NAME', trim( dirname( ABZ_TWITTER_FEED_PLUGIN_BASENAME ), '/' ) );

if ( ! defined( 'ABZ_TWITTER_FEED_PLUGIN_DIR' ) )
	define( 'ABZ_TWITTER_FEED_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );

if ( ! defined( 'ABZ_TWITTER_FEED_PLUGIN_URL' ) )
	define( 'ABZ_TWITTER_FEED_PLUGIN_URL', untrailingslashit( plugins_url( '', __FILE__ ) ) );

// include() or require() any necessary files here... 
if ( is_admin() )
	require_once ABZ_TWITTER_FEED_PLUGIN_DIR . '/admin/admin.php';
		
require_once ABZ_TWITTER_FEED_PLUGIN_DIR . '/includes/functions.php';
require_once ABZ_TWITTER_FEED_PLUGIN_DIR . '/admin/admin_setting_page.php';
require_once ABZ_TWITTER_FEED_PLUGIN_DIR . '/admin/abz_twitter_feed_widget.php';