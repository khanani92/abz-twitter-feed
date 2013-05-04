jQuery(document).ready(function($) {

	$body = $('body'),
	$testButton = $('<input/>',{type:'button', class: 'button button-primary', id : 'test', value : 'Test Required Settings' }),
	$consumerKey = findInputField('consumer_key'),
	$consumerSecret = findInputField('consumer_secret'),
	$accessToken = findInputField('access_token'),
	$accessTokenSecret = findInputField('access_token_secret');
	
	insertValidateSpan('Please Enter Consumer key!', $consumerKey ),
	insertValidateSpan('Please Enter Consumer secret!', $consumerSecret ),
	insertValidateSpan('Please Enter Access token!', $accessToken ),
	insertValidateSpan('Please Enter Access token secret!', $accessTokenSecret );
	$testButton.insertBefore('#submit');
		
	function findInputField(nameKey){
		return $body.find('input[name="abz-twitter-feed-settings['+nameKey+']"]');
	}
	
	function insertValidateSpan(msg,selector){
		return $('<span/>',{class:'error',text: msg}).insertAfter(selector);
	}
	
	function checkInput(input){
		if(input.val().length == 0){ input.next('span').fadeIn();}
		else{input.next('span').fadeOut();}
	}
	
	$('#submit , #test').click(function(){
		checkInput($consumerKey),
		checkInput($consumerSecret),		
		checkInput($accessToken),
		checkInput($accessTokenSecret);
	
		if( $consumerKey.val().length == 0 || $consumerSecret.val().length == 0 || $accessToken.val().length == 0 || $accessTokenSecret.val().length == 0 )
			return false;
	});

});