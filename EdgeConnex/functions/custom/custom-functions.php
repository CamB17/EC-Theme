<?
// gets ubermenu code from acf and parses it
function ec_display_ubermenu() {
    $menuCode = str_replace(array("<?php","?>"), "", get_field('main_navigation_code','options'));
    eval($menuCode);
}
/*
@description
Finds all of the values that are used for a certain checkbox field group and displays them as links in a row.

@param $categoryField
The name of the checkbox field ACF group

@param $postType
The post type we are working with
*/
function ec_display_isotope_categories( $categoryField, $postType ) {
    $categoryList = [];

    $loop = new WP_Query( array( 'post_type' => $postType, 'posts_per_page' => '-1' ) );
    if ( $loop->have_posts() ) :
        while ( $loop->have_posts() ) : $loop->the_post();

            $categories = get_field($categoryField);

            if ( is_array($categories) ) {
                foreach ( $categories as $category ) {

                    if ( !in_array($category, $categoryList) ) {

                        $categoryList[] = $category;

                    }

                }
            }

        endwhile;

    endif;
    wp_reset_postdata();
    ?>
    <li data-filter="*" class="active">All</li>
    <?

    foreach ( $categoryList as $category ) {

        ?>
        <li data-filter=".<?= onlyLetters($category); ?>"><?= $category; ?></li>
        <?
    }
}
function ec_archive_pagination() {
    global $wp_query;

    $big = 999999999; // This needs to be an unlikely integer

    $paginate_links = paginate_links( array(
        'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'mid_size' => 5,
        'prev_next' => True,
        'prev_text' => __('&laquo;'),
        'next_text' => __('&raquo;'),
        'type' => 'list'
    ) );

    // Display the pagination if more than one page is found
    if ( $paginate_links ) {
        echo $paginate_links;
    }
}
function ec_print_r($val){
        echo '<pre>';
        print_r($val);
        echo  '</pre>';
}
//this function will output an image field as a bg image at a given size
function ec_bg_image($field, $size = "medium", $sub = 0, $options = 0) {
    if ( $sub && $options ) :
        echo "Please do not choose $sub and $options";
    elseif ( $sub ) :
        echo "style='background-image:url(" . get_sub_field($field)['sizes'][$size] . ");'";
    elseif ( $options ) :
        echo "style='background-image:url(" . get_field($field, 'options')['sizes'][$size] . ");'";
    else :
        echo "style='background-image:url(" . get_field($field)['sizes'][$size] . ");'";
    endif;
    
    return;
}
// redirect attachments to the homepage
function ec_attachment_redirect(){
    global $post;
    if ( is_attachment() ) :
        wp_redirect( '/', 301 );
        exit();
        wp_reset_postdata();
    endif;
}
add_action( 'template_redirect', 'ec_attachment_redirect' );


// The following snippet will update the database's sitename if it's on c9 and if it's incorrect
$url = $_SERVER['SERVER_NAME'] . dirname(__FILE__);
$domain = explode('/',$url);
$domain = $domain[0];
$domain = explode('.',$domain);
$siteName = $domain[0];
if ( $domain[1] == "c9users") :
    if ( get_option('siteurl') !== 'http://'. $siteName .'.c9users.io') :
        update_option( 'siteurl', 'http://'. $siteName .'.c9users.io' );
        update_option( 'home', 'http://'. $siteName .'.c9users.io' );
    endif;
endif;

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
function ec_excerpt_filter( $more ) {
    return '...';
}
add_filter('excerpt_more', 'ec_excerpt_filter');

/* Changed excerpt length to 150 words*/
function ec_excerpt_length($length) {
return 15;
}
add_filter('excerpt_length', 'ec_excerpt_length');

/*
 * Blacklist email domains from form entries
 *
 * @link https://wpforms.com/developers/how-to-restrict-email-domains/
 *
*/

function wpf_blacklist_domains( $field_id, $field_submit, $form_data ) {
    $domain          = substr( strrchr( $field_submit, "@" ), 1 );
    $blacklist       = array( 'domainworld.com', 'domainregistercorp.com' );
    if( in_array( $domain, $blacklist ) ) { 
        wpforms()->process->errors[ $form_data['id'] ][ $field_id ] = esc_html__( 'This domain is not accepted', 'wpforms' );
        return;
    }
}
add_action('wpforms_process_validate_email', 'wpf_blacklist_domains', 10, 3 );


function ec_page_builder() {
    if( have_rows('page_builder') ):

      while ( have_rows('page_builder') ) : the_row();
      


         $layout = get_row_layout();

         echo "<section class='module wow bounceInUp pb-" . $layout;
         
         // if additional modules, add a class
         if ( $layout == "additional_modules" ) :
            $module = get_sub_field('module');
            echo " am-" . $module;
         endif;

         // if bg color is not default add a class
         if ( get_sub_field('background_color') !== "default" ) :
            echo " " . get_sub_field('background_color');
         endif;
         
         // if top padding is not default add a class
         if ( get_sub_field('top_padding') !== "default" ) :
            echo " " . get_sub_field('top_padding');
         endif;
         
         // if bottom padding is not default add a class
         if ( get_sub_field('bottom_padding') !== "default" ) :
            echo " " . get_sub_field('bottom_padding');
         endif;
         
         // if top margin is not default add a class
         if ( get_sub_field('top_margin') !== "default" ) :
            echo " " . get_sub_field('top_margin');
         endif;
         
         // if bottom margin is not default add a class
         if ( get_sub_field('bottom_margin') !== "default" ) :
            echo " " . get_sub_field('bottom_margin');
         endif;
         
         // if bottom margin is not default add a class
         if ( get_sub_field('custom_css_classes') ) :
            echo " " . get_sub_field('custom_css_classes');
         endif;
         
         echo "'";
         
         if ( 
            get_sub_field('top_padding') == "custom-padding-top"
            ||
            get_sub_field('bottom_padding') == "custom-padding-bottom"
            ||
            get_sub_field('top_margin') == "custom-margin-top"
            ||
            get_sub_field('bottom_margin') == "custom-margin-bottom"
            ||
            get_sub_field('custom_inline_css')
         ) :
            echo " style='";
            
            if ( get_sub_field('top_padding') == "custom-padding-top" ) :
               echo "padding-top:" . get_sub_field('custom_top_padding') . "px !important;";
            endif;
            
            if ( get_sub_field('bottom_padding') == "custom-padding-bottom" ) :
               echo "padding-bottom:" . get_sub_field('custom_bottom_padding') . "px !important;";
            endif;
            
            if ( get_sub_field('top_margin') == "custom-margin-top" ) :
               echo "margin-top:" . get_sub_field('custom_top_margin') . "px !important;";
            endif;
            
            if ( get_sub_field('bottom_margin') == "custom-margin-bottom" ) :
               echo "margin-bottom:" . get_sub_field('custom_bottom_margin') . "px !important;";
            endif;
            
            echo get_sub_field('custom_inline_css');
               
            echo "'";
         endif;
         
         if ( get_sub_field('custom_id') ) :
            echo " id='" . get_sub_field('custom_id') . "'";

         endif;
         
         
         echo ">";
         get_template_part('page-builder/' . $layout);
         echo "</section>";
         
        
      endwhile;

   endif;
}