<?php
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

/**
* A simple twitter api client using oauth authentication
*/

class ABZ_Twitter_Api_Client {

    public static $timeline_url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
    private $oauth_credentials = null;
	
	/**
	* Creates a new instance of this class.
	*
	* @param $oauth Array containing 4 values:
	*				oauth_consumer_key, 
	*				oauth_token, 
	*				oauth_consumer_secret,
	*				oauth_access_token_secret
	*/
	public function __construct($oauth) {
		$oauth['oauth_signature_method'] = 'HMAC-SHA1';
		$oauth['oauth_version'] = '1.0';
		$this->oauth_credentials = $oauth;
	}

	private static function buildBaseString($baseURI, $method, $params) {
		$r = array();
		ksort($params);
		foreach($params as $key=>$value){
			$r[] = "$key=" . rawurlencode($value);
		}
		return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
	}


	private static function buildAuthorizationHeader($oauth) {
		$r = 'Authorization: OAuth ';
		$values = array();
		foreach($oauth as $key=>$value)
			$values[] = "$key=\"" . rawurlencode($value) . "\"";
		$r .= implode(', ', $values);
		return $r;
	}

	/**
	* Returns the timeline from twitter api.
	*/
    public function read_timeline() {
        return $this->fetch(self::$timeline_url);
    }

	static function array_remove_keys($array, $keys = array(), $callback=null) {
		if(empty($array) || (! is_array($array))) {
			return $array;
		}

		if(is_string($keys) && !is_array($keys=explode(',',$keys)))
		{
			return $array;
		}
	   
		foreach($keys as $key) {
			$key=trim($key,' ');
			if(!$callback || !$callback($array[$key],$key))
				unset($array[$key]);
		}
		return $array;
	}
	
	private function fetch($url) {

		// Make a copy of credentials array by removing secrets
        $oauth = self::array_remove_keys($this->oauth_credentials, array('oauth_consumer_secret','oauth_access_token_secret'));
		
		// add additional oauth parameters
		$oauth['oauth_nonce'] = time();
		$oauth['oauth_timestamp'] = time();

		$consumer_secret = $this->oauth_credentials['oauth_consumer_secret'];
		$oauth_access_token_secret = $this->oauth_credentials['oauth_access_token_secret'];

		$base_info = self::buildBaseString($url, 'GET', $oauth);
		
		
		$composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
		$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
		$oauth['oauth_signature'] = $oauth_signature;


		// Make Requests
		$header = array(self::buildAuthorizationHeader($oauth), 'Expect:');
		$options = array( CURLOPT_HTTPHEADER => $header,
						  //CURLOPT_POSTFIELDS => $postfields,
						  CURLOPT_HEADER => false,
						  CURLOPT_URL => $url,
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_SSL_VERIFYPEER => false);


		$feed = curl_init();
		curl_setopt_array($feed, $options);
		$json = curl_exec($feed);
		curl_close($feed);

		return $json;
	}
}