<?php

class ABZ_Cached_Twitter_Timeline_Reader {

    private $oauth_credentials = null;

	public function __construct($oauth) {
		$this->oauth_credentials = $oauth;
	}

	public function get_json() {

		$cache_file = ABZ_TWITTER_FEED_PLUGIN_DIR . '/twitter.json';
		
		//TODO: The duration should be configureable from settings
		$cache_for = 5; // cache results for five minutes

		$api_cache = new API_cache ($this, $cache_for, $cache_file);
		if (!$res = $api_cache->get_api_cache())
			$res = '{"error": "Could not load cache"}';

		return $res;
	}

	/**
	* Fetches the timeline via twitter api client instance.
	* This function is called by API_Cache class when the cache is empty or expires.
	*/
	public function call_remote_api() {
		$twitter = new ABZ_Twitter_Api_Client($this->oauth_credentials);
		$res = $twitter->read_timeline();
		//var_dump($res);
		//echo "<hr>";
		return $res;
	}
}
