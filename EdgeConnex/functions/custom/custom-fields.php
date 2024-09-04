<?php
// // load acf
// include_once('custom-fields/acf/acf.php');

// Load an options page
include_once('custom-fields/options-init.php' );

function ec_acf_google_map_api( $api ){
// 	$api['key'] = 'AIzaSyAwjkOKYgtCigEsxTXzjMLJOC6uyoOkZSs';
	$api['key'] = 'AIzaSyB13lGW3rgS7_scG2DmYRRk_zWHguh2iSs';
	return $api;
}
add_filter('acf/fields/google_map/api', 'ec_acf_google_map_api');

// // load style
// add_filter('acf/settings/path', 'ec_acf_settings_path');
// function ec_acf_settings_path( $path ) {
//   $path = get_stylesheet_directory() . '/functions/custom/custom-fields/acf/';
//   return $path;
// }

// // load settings
// add_filter('acf/settings/dir', 'ec_acf_settings_dir');
// function ec_acf_settings_dir( $dir ) {
//   $dir = get_stylesheet_directory_uri() . '/functions/custom/custom-fields/acf/';
//   return $dir;
// }


//  custom save point
add_filter('acf/settings/save_json', 'ec_acf_json_save_point');
function ec_acf_json_save_point( $path ) {
  // update path
  $path = get_stylesheet_directory() . '/functions/custom/custom-fields/json';
  // return
  return $path;
}

// custom load path
add_filter('acf/settings/load_json', 'ec_acf_json_load_point');
function ec_acf_json_load_point( $paths ) {
  // remove original path (optional)
  unset($paths[0]);
  // append path
  $paths[] = get_stylesheet_directory() . '/functions/custom/custom-fields/json';
  // return
  return $paths;
}


// confirm row delete for acf
function ec_acf_confirm_row_delete() { ?>
    <script type="text/javascript">
    (function($) {

        acf.add_action('ready', function(){

            $('body').on('click', 'li.acf-fc-show-on-hover a.acf-icon.-minus.small', function( e ){

                return confirm("Do you really want to delete this row?");

            });

        });

    })(jQuery);
    </script>

    <?php
}
add_action('acf/input/admin_head', 'ec_acf_confirm_row_delete');
