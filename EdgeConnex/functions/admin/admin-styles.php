<?php
add_action('admin_head', 'ec_custom_admin_styles');
function ec_custom_admin_styles() {
  echo '<link rel="stylesheet" type="text/css" href="'.get_template_directory_uri().'/styles/wp-admin.css">';
  echo '<script src="'.get_template_directory_uri().'/scripts/wp-admin.js"></script>';
}
