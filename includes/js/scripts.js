(function($) {

    $.fn.abzTwitterFeed = function( options ) {

        // Establish our default settings
        var settings = $.extend({
            count              :   3,
            page               :   1,
			containerHeight    :   300
        }, options);


		var 
		$container = $(this),
		$ul = $('<ul/>').appendTo($container);
		
		
        return this.each( function() { //Loop over each element in the set and return them to keep the chain alive.
			
			function requestViaAjax() {
				$.getJSON( urls.admin_url, { 
					action: 'abz_get_twitter_feed'
					 },
					 
				function(data) {
					if(data){
						makeTweet(data);
						console.log(data);
					}
					else {
						alert('Somethig went wrong!');
					}					
				});	// json request end
			}
			requestViaAjax();
			
			function makeTweet(data){
				$.each(data, function(i, tweet) {
					$tweetTime = parse_date(tweet.created_at)
					$('<li/>').append('<img src="'+tweet.user.profile_image_url+'" align="left" alt=""/>')
					.append(tweet.text)
					.append('<div class="tweet_date">'+relative_time($tweetTime)+'</div>')
					.appendTo($ul);
				});
			}
			
			function parse_date(date_str) {
				return Date.parse(date_str.replace(/^([a-z]{3})( [a-z]{3} \d\d?)(.*)( \d{4})$/i, '$1,$2$4$3'))
			}
			
			function relative_time(date) {
				var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
				var delta = parseInt((relative_to.getTime() - date) / 1000, 10);
				var r = '';
				if (delta < 60) {
					r = delta + ' seconds ago'
				} else if (delta < 120) {
					r = 'a minute ago'
				} else if (delta < (45 * 60)) {
					r = (parseInt(delta / 60, 10)).toString() + ' minutes ago'
				} else if (delta < (2 * 60 * 60)) {
					r = 'an hour ago'
				} else if (delta < (24 * 60 * 60)) {
					r = '' + (parseInt(delta / 3600, 10)).toString() + ' hours ago'
				} else if (delta < (48 * 60 * 60)) {
					r = 'a day ago'
				} else {
					r = (parseInt(delta / 86400, 10)).toString() + ' days ago'
				}
				return 'about ' + r
			}
					
        }); // this.each End

    }

}(jQuery));

jQuery(function(){
	jQuery('.abz_twitter_feed').abzTwitterFeed();
});