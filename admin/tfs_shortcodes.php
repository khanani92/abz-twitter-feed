<?php
// [twitter-feeds foo="foo-value"]
function tfs_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'foo' => 'something',
		'bar' => 'something else',
	), $atts ) );

	return "foo = {$foo}";
}
add_shortcode( 'twitter-feeds', 'tfs_shortcode' );
