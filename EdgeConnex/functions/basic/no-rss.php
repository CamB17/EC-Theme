<?php
// no rss feed for static sites
function ec_disable_feed() {
  wp_die( __('No feed available,please visit our <a href="'. get_bloginfo('url') .'">homepage</a>!') );
}

add_action('do_feed', 'ec_disable_feed', 1);
add_action('do_feed_rdf', 'ec_disable_feed', 1);
add_action('do_feed_rss', 'ec_disable_feed', 1);
add_action('do_feed_rss2', 'ec_disable_feed', 1);
add_action('do_feed_atom', 'ec_disable_feed', 1);
