(function($) {

    $.fn.abzTwitterFeed = function( options ) {

        // Establish our default settings
        var settings = $.extend({
            count              :3,
            page               :1,
			containerHeight    :300
        }, options);


		var 
		$container = $(this),
		$ul = $('<ul/>').appendTo($container);
		
		
        return this.each( function() { //Loop over each element in the set and return them to keep the chain alive.
			
			function makeTweet(tweet){
				var $tweetTime = parse_date(tweet.created_at);
				$('<li/>').append( $('<img>', {src:"'+tweet.user.profile_image_url+'", align:"left", alt:""}))
					.append(tweet.text)
					.append(
							$('<div>', {class:"tweet_date"}).text(relative_time($tweetTime))
						)
					.appendTo($ul);
			}
			
			function parse_date(date_str) {
				return Date.parse(date_str.replace(/^([a-z]{3})( [a-z]{3} \d\d?)(.*)( \d{4})$/i, '$1,$2$4$3'))
			}
			
			function relative_time(date) {
				var relative_to = (arguments.length > 1) ? arguments[1] : new Date(),
					delta = parseInt((relative_to.getTime() - date) / 1000, 10),
					r = '';
				if (delta < 60) {
					r = delta + ' seconds ago'
				} else if (delta < 120) {
					r = 'a minute ago'
				} else if (delta < (45 * 60)) {
					r = ((delta / 60) | 0).toString() + ' minutes ago'
				} else if (delta < (2 * 60 * 60)) {
					r = 'an hour ago'
				} else if (delta < (24 * 60 * 60)) {
					r = '' + ((delta / 3600) | 0).toString() + ' hours ago'
				} else if (delta < (48 * 60 * 60)) {
					r = 'a day ago'
				} else {
					r = ((delta / 86400, 10)  | 0).toString() + ' days ago'
				}
				return 'about ' + r
			}

			function requestViaAjax() {
				$.getJSON( urls.admin_url, { 
						action: 'abz_get_twitter_feed'
					},
					 
					function(data) {
						if(!data){
							console.log("Something went wrong!");
							return;
						}
						if (data.hasOwnProperty('status')) {
							console.log('status');
							if (data.status == 'error') {
								$container.append($(data.msg));
								return;
							}
						}
					
						$.each(data, function(i, tweet) {
							makeTweet(tweet);
						});
					});	// json request end
			}
			requestViaAjax();
			
					
        }); // this.each End

    }

}(jQuery));

jQuery(function(){
	jQuery('.abz_twitter_feed').abzTwitterFeed();
});