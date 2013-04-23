<?php

class ABZ_Twitter_Timeline_Reader {

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

	public function fetch() {
		$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

		$consumer_key = 'FyMvI7VdIHa77M5YlodA';
		$consumer_secret = '5VXaEoWUQAC7Z3MkiA3fAKy0gqi1hnSoXkSUNctLA';

		$oauth_access_token = '526178478-HaGAiDnLuPOGLvqSkqXoxE6I9IICUqK2TQ8QibUf';
		$oauth_access_token_secret = 'wdLkH5TiDsXLjNcw7ILD8mU5gdK3j6IUzdN53onfA';

		$oauth = array( 'oauth_consumer_key' => $consumer_key,
						'oauth_nonce' => time(),
						'oauth_signature_method' => 'HMAC-SHA1',
						'oauth_token' => $oauth_access_token,
						'oauth_timestamp' => time(),
						'oauth_version' => '1.0');


		$base_info = ABZ_Twitter_Timeline_Reader::buildBaseString($url, 'GET', $oauth);
		$composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
		$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
		$oauth['oauth_signature'] = $oauth_signature;


		// Make Requests
		$header = array(ABZ_Twitter_Timeline_Reader::buildAuthorizationHeader($oauth), 'Expect:');
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


		$twitter_data = json_decode($json);
		
		return $twitter_data;
	}
}

	$reader = new ABZ_Twitter_Timeline_Reader();
	echo var_dump( $reader ->fetch() );

?>