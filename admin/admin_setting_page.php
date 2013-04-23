<?php
add_action( 'admin_menu', 'ABZ_Twitter_Feed_Admin::do_admin_menu' );
add_action( 'admin_init', 'ABZ_Twitter_Feed_Admin::do_admin_init' );
 
$settings = get_option( 'abz-twitter-feed-settings' );
 
class ABZ_Twitter_Feed_Admin {

	/**
	* Handles admin_menu action
	*/
	public static function do_admin_menu() {
		add_options_page( __('Twitter Feeds', 'tfs'), __('Twitter Feeds', 'tfs'), 'manage_options', 'twitter-feeds', 'ABZ_Twitter_Feed_Admin::do_options_page' );
	}

	/**
	* Handles admin_init action
	*/
	public static function do_admin_init() {
		register_setting( 'abz-twitter-feed-settings-group', 'abz-twitter-feed-settings' );
	 
		// Sections
		add_settings_section( 'required_settings_section', __('Required Settings', 'tfs'), 'ABZ_Twitter_Feed_Admin::do_required_settings', 'twitter-feeds' );
		add_settings_section( 'general_settings_section', __('General Settings', 'tfs'), 'ABZ_Twitter_Feed_Admin::do_general_settings', 'twitter-feeds' );

		// Fields - Required Settings section
		add_settings_field( 'ABZ_Twitter_Feed_Admin::do_consumer_key', __('Consumer Key', 'tfs'), 'ABZ_Twitter_Feed_Admin::do_consumer_key', 'twitter-feeds', 'required_settings_section' );
		add_settings_field( 'ABZ_Twitter_Feed_Admin::do_consumer_secret', __('Consumer Secret', 'tfs'), 'ABZ_Twitter_Feed_Admin::do_consumer_secret', 'twitter-feeds', 'required_settings_section' );
		add_settings_field( 'ABZ_Twitter_Feed_Admin::do_access_token', __('Access Token', 'tfs'), 'ABZ_Twitter_Feed_Admin::do_access_token', 'twitter-feeds', 'required_settings_section' );
		add_settings_field( 'ABZ_Twitter_Feed_Admin::do_access_token_secret', __('Access Token Secret', 'tfs'), 'ABZ_Twitter_Feed_Admin::do_access_token_secret', 'twitter-feeds', 'required_settings_section' );
		
		// Fields - General Settings section
		add_settings_field( 'ABZ_Twitter_Feed_Admin::do_tweet_count', __('Tweet Count', 'tfs'), 'ABZ_Twitter_Feed_Admin::do_tweet_count', 'twitter-feeds', 'general_settings_section' );
		//add_settings_field( 'ABZ_Twitter_Feed_Admin::do_field_6', __('Tfs fiels 6', 'tfs'), 'ABZ_Twitter_Feed_Admin::do_field_6', 'twitter-feeds', 'general_settings_section' );
	}
 
	public static function do_options_page() {
		?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h2><?php printf( __('Twitter Feeds Options', 'tfs') ) ?></h2>
			<form action="options.php" method="POST">
				<?php settings_fields( 'abz-twitter-feed-settings-group' ); ?>
				<?php do_settings_sections( 'twitter-feeds' ); ?>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

	public static function do_required_settings() { 
	?>
		<ol>
			<li><?php printf(__("Register this site as an application on <strong><a target='_blank' href='http://dev.twitter.com/apps/new'>Twitter's application registration page</a></strong>.", "tfs")); ?></li>	        
			<li><?php printf(__("Copy and paste your <strong>Key, Token</strong> and <strong>Secrets</strong>.", "tfs")); ?></li>
		</ol>
		
	<?php }

	public static function do_general_settings() {
		printf(__('General Settings Area.', 'tfs'));
	}


	private static function do_textbox($field_name) {
		global $settings;
		$field = esc_attr( $settings[$field_name] );
		echo "<input class='regular-text' type='text' name='abz-twitter-feed-settings[$field_name]' value='$field' />";
	}

	public static function do_consumer_key() {
		ABZ_Twitter_Feed_Admin::do_textbox( 'consumer_key' );
	}

	public static function do_consumer_secret() {
		ABZ_Twitter_Feed_Admin::do_textbox( 'consumer_secret' );
	}

	public static function do_access_token() {
		ABZ_Twitter_Feed_Admin::do_textbox( 'access_token' );
	}

	public static function do_access_token_secret() {
		ABZ_Twitter_Feed_Admin::do_textbox( 'access_token_secret' );
	}

	public static function do_tweet_count() {
		ABZ_Twitter_Feed_Admin::do_textbox( 'tweet_count' );
	}

	public static function do_field_6() {
		ABZ_Twitter_Feed_Admin::do_textbox( 'field_6' );
	}
}