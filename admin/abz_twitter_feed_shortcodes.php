<?php
// [abz_twitter_feed foo="foo-value"]
function abz_twitter_feed_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'foo' => 'something',
		'bar' => 'something else',
	), $atts ) );

	return "foo = {$foo}";
}
add_shortcode( 'abz_twitter_feed', 'abz_twitter_feed_shortcode' );
