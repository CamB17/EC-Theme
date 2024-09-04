<?php
/*
this is a function that serves as a very quick way to set up a new post type with some default settings. to use it, uncomment the action below. for more customization, create a new function based on the function below called ec_add_advanced_post_type
*/

function ec_custom_post_init() {
  ec_add_simple_post_type("Team Member", "Team Members", "team-member", "company/management-team", false, false);
  ec_add_simple_post_type("Testimonial", "Testimonials", "testimonial", "testimonials", false, false);
  ec_add_simple_post_type("Resource", "Resources", "resource", "resource", false, false);
  ec_add_simple_post_type("News", "News", "news", "news/press-releases", true, false);
  ec_add_simple_post_type("Newsroom", "Newsroom", "newsroom", "news/newsroom", false, false);
  //use this commented out code when we push the new data centers
  ec_add_simple_post_type("Data Center", "Data Centers", "data-center", "locations/%location_category%", false, true);
  //ec_add_simple_post_type("Data Center", "Data Centers", "data-center", "data-center", false);
  ec_add_simple_post_type("Success Story", "Success Stories", "success-story", "success-story", false, false);
  ec_add_simple_post_type("Event", "Events", "event", "event", false, false);
  ec_add_simple_post_type("EdgeTV Video", "EdgeTV", "edgetv", "edgetv", false, false);
}
add_action('init', 'ec_custom_post_init');


function ec_add_simple_post_type($singular, $plural, $post_type_name, $slug, $archive, $hierarchical) {

  if ( $slug == null ) {
    $slug = $post_type_name;
  }

  $labels = array(
    'name' => $singular,
    'singular_name' => $singular,
    'menu_name' => $plural,
    'add_new' => 'Add ' . $singular . '',
    'add_new_item' => 'Add New ' . $singular . '',
    'edit' => 'Edit',
    'edit_item' => 'Edit ' . $singular . '',
    'new_item' => 'New ' . $singular . '',
    'view' => 'View ' . $singular . '',
    'view_item' => 'View ' . $singular . '',
    'search_items' => 'Find ' . $plural . '',
    'not_found' => 'No ' . $plural . ' Found',
    'not_found_in_trash' => 'No ' . $plural . ' Found in Trash',
    'parent' => 'Parent ' . $singular . '',
  );

  $args = array( 'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => $slug,
      'with_front' => false),
    'capability_type' => 'post',
    'hierarchical' => $hierarchical,
    'has_archive' => $archive,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'revisions' )
  );

  register_post_type( $post_type_name , $args );
  flush_rewrite_rules();
}

/*
use the following function to add a customized post type

function ec_add_advanced_post_type()) {

  $singuler = "Example";
  $plural = "Examples";
  $post_type_name = "example"

  $labels = array(
    'name' => $singular,
    'singular_name' => $singular,
    'menu_name' => $singular,
    'add_new' => 'Add ' . $singular . '',
    'add_new_item' => 'Add New ' . $singular . '',
    'edit' => 'Edit',
    'edit_item' => 'Edit ' . $singular . '',
    'new_item' => 'New ' . $singular . '',
    'view' => 'View ' . $singular . '',
    'view_item' => 'View ' . $singular . '',
    'search_items' => 'Add ' . $plural . '',
    'not_found' => 'No ' . $plural . ' Found',
    'not_found_in_trash' => 'No ' . $plural . ' Found in Trash',
    'parent' => 'Parent ' . $singular . '',
  );

  $args = array( 'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title' )
  );

  register_post_type( $post_type_name , $args );
  flush_rewrite_rules();

}
add_action('init', 'ec_add_advanced_post_type');
*/


//uncomment this when we push the new data center pages

/**
* Add rewrite for datacenter location taxonomy
*/
function datacenter_location_taxonomy_post_link( $post_link, $id = 0 ){
    $post = get_post($id);  
        $terms = wp_get_object_terms( $post->ID, 'Location' );
        if( !empty($terms) && !is_wp_error($terms) ){
            return str_replace( '%location_category%' , $terms[0]->slug , $post_link );
} else {
    return str_replace( '%location_category%/' , '' , $post_link );
}
 
    return $post_link;  
}
add_filter( 'post_type_link', 'datacenter_location_taxonomy_post_link', 1, 3 );


function datacenter_location_archive_rewrite_rules() {
    add_rewrite_rule(
        '^locations/(.*)/(.*)/?$',
        'index.php?post_type=data-center&name=$matches[2]',
        'top'
    );
    flush_rewrite_rules(); // use only once
}

add_action( 'init', 'datacenter_location_archive_rewrite_rules' );