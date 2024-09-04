<?php
// remove version info from head and feeds
add_filter('the_generator', 'ec_complete_version_removal');
function ec_complete_version_removal() {
  return '';
}

// remove wp version param from any enqueued scripts
function at_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'at_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'at_remove_wp_ver_css_js', 9999 );

//remove pings to self
add_action( 'pre_ping', 'ec_no_self_ping' );
function ec_no_self_ping( &$links ) {
  $home = get_option( 'home' );
  foreach ( $links as $l => $link )
      if  ( 0 === strpos( $link, $home ) )
          unset($links[$l]);
}


// prevent multisite signup
function rbz_prevent_multisite_signup() {
  wp_redirect( site_url() );
  die();
}
add_action( 'signup_header', 'rbz_prevent_multisite_signup' );

// Disable ping back scanner and complete xmlrpc class.
add_filter( 'wp_xmlrpc_server_class', '__return_false' );
add_filter('xmlrpc_enabled', '__return_false');

//remove xpingback header
function remove_x_pingback($headers) {
  unset($headers['X-Pingback']);
  return $headers;
}
add_filter('wp_headers', 'remove_x_pingback');
