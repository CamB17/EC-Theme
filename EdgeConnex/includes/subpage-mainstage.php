<!-- temp -->
<style>
.subpage-header .slide .row .bg-pattern{
   top: 0px;
}
@media (min-width: 1200px){
   .subpage-header{
     min-height: 325px;
   }
}
</style>
<!-- /temp -->

<? 
global $post;
$current_page_post_ID = $post->ID;
// Get the author ID
$author_id = $post->post_author;
// $author_display_name = get_the_author_meta('first_name', $author_id) . " " . get_the_author_meta('last_name', $author_id);
$author_display_name = null;
$author_override = get_field('author', $current_page_post_ID);
$hide_author_information = get_field('hide_author_information', $current_page_post_ID);
if($author_override) {
   $author_display_name = $author_override;
}
if($hide_author_information) {
   $author_display_name = null;
}
if ( is_singular('data-center') || is_singular('news') || is_post_type_archive('news') || is_singular('event') || is_singular('post') || is_home() ) : 
   
      $current = $post->ID;
      $parent = $post->post_parent;
      $get_grandparent = get_post($parent);
      $grandparent = $get_grandparent->post_parent;

   ?>
<? endif; ?>

   <?php if (!is_singular('edgetv')) :
      $add_background_overlay = get_field('add_background_overlay');
      $extra_dark_background_overlay = get_field('extra_dark_background_overlay');
   if ( is_home() ) :
      $bgImage = get_field('background_image', 244);
   elseif ( is_search() ) : 
      $bgImage = get_field('default_header_image', 'options');
   elseif ( is_post_type_archive() ) :
      $add_background_overlay = true;
      if ( $postType == "news") :
         $bgImage = get_field('default_news_header_image', 'options');
      endif;
   elseif ( is_singular() ):
      $queried_object = get_queried_object();
      $postType = $queried_object->post_type;
      if ( $postType == "tribe_events" ) : 
         $bgImage = get_field('default_header_image', 'options');
      elseif ( $postType == "page" ) :
         $bgImage = get_field('background_image');
      elseif ( $postType == "event" ) :
         $bgImage = get_field('background_image');
      elseif ( $postType == "post" ) :
         $bgImage = get_field('image');
      elseif ( $postType == "data-center" ) :
         $bgImage = get_field('background_image');
         
      elseif ( $postType == "team-member" ) :
         $bgImage = get_field('default_header_image', 'options');
      elseif ( $postType == "news") :
         if ( get_field('header_image')) :
            $bgImage = get_field('header_image');
         else :
            $bgImage = get_field('default_news_header_image', 'options');
         endif;
      elseif ( $postType == "resource") :
         if ( get_field('background_image')) :
            $bgImage = get_field('background_image');
         else :
            $bgImage = get_field('default_resource_header_image', 'options');
         endif;
      endif;
   else : 
      $bgImage = get_field('default_header_image', 'options');
   endif; 
   
   if ( $bgImage == "" ) {
      $bgImage = get_field('default_header_image', 'options');
   }
   
   $remove_bottom_spacing = "";
   if(get_field('remove_bottom_spacing') || is_home()) {
      $remove_bottom_spacing = "remove_bottom_spacing";
   }
   
   $custom_background_vertical_alignment = "";
   if(get_field('custom_background_vertical_alignment')) { ?>
      <!-- <style>
         .subpage-header {
            background-position: 100% <?= get_field('custom_background_vertical_alignment'); ?>px !important;
         }
      </style> -->
   <? }
   
   if($postType == "post" || $postType == "news") {
      $column_class = "medium-10 medium-offset-1";
   } elseif($postType == "team-member" || $postType == "data-center") {
      $column_class = "medium-7";
   } else {
      $column_class = "medium-6";
   }
   
   $hide_page_headline = get_field('hide_page_headline');
   if($hide_page_headline) {
      $h1_hidden = "style='display:none'";
   }

   ?>
   <section class="subpage-header <?= $postType; ?> <?= $remove_bottom_spacing; ?>">
      <div class='background_image'>
         <?= ec_get_responsive_image($bgImage, true); ?>
      </div>
      <div class='mask'></div>
      <? if($add_background_overlay) : ?>
         <div class='dark_overlay <?= $extra_dark_background_overlay ? "extra_dark_background_overlay" : ""; ?>'></div>
      <? endif; ?>
      <div class="slides">
         <div class="slide">
            <div class="row">
               <div class="column small-12 <?= $column_class; ?> <?= $hide_page_headline ? 'h1_hidden' : '' ?>">
                  <div class='breadcrumbs'><? breadcrumbs(); ?></div>
                  <? if ( is_home() ) :

                        if ( get_field('headline_override', 244) ) :
                           echo "<h1 $h1_hidden>";
                           echo get_field('headline_override', 244);
                           echo "</h1>";
                        else :
                           echo "<h1>Blog</h1>";
                           echo "<p class='intro'>Check out our thought leadership, trend analysis, and more.</p>";
                        endif;
                  elseif ( is_search() ) : 
                  ?>
               
                        <h1 style="margin-bottom:0px;">Search</h1>
                        <h3>
                           Results for "<?= get_search_query(); ?>"
                        </h3>
                  <?
                     
                  
                  elseif ( is_post_type_archive() ) :
   
                     $postType = $wp_query->query['post_type'];
                     
                     if ( $postType == "tribe_events" ) : 
                     
                        echo "<h1>Events</h1>";
                     elseif ( $postType == "news") :
                        
                        if (get_field('news_page_title', 'options')) : ?>
                        <h1><?= get_field('news_page_title', 'options'); ?></h1>
                        <?php endif;
                        if (get_field('news_sub_headline', 'options')) : ?>
                        <p class="intro"><?= get_field('news_sub_headline', 'options'); ?></p>
                        <?php endif;
                        if (get_field('news_intro', 'options')) : ?>
                        <p><?= get_field('news_intro', 'options'); ?></p>
                        <? endif;
                        
                        
                     endif;
                  
                  elseif ( is_singular() ):
   
                     $queried_object = get_queried_object();
                     $postType = $queried_object->post_type;
            
               
                     if ( $postType == "tribe_events" ) : 
                        
                        echo "<h1 $h1_hidden>". $queried_object->post_title . "</h1>";
                         
                     elseif ( $postType == "page" ) :
                        
                        if ( get_field('headline_override') ) :
                           echo "<h1 $h1_hidden>";
                           echo get_field('headline_override');
                           echo "</h1>";
                        else :
                           echo "<h1 $h1_hidden>";
                           the_title();
                           echo "</h1>";
                        endif;
                        
                     elseif ( $postType == "event" ) :
                        
                  
                        if ( get_field('headline_override') ) :
                           echo "<h1 $h1_hidden>";
                           echo get_field('headline_override');
                           echo "</h1>";
                        else :
                           echo "<h1 $h1_hidden>";
                           the_title();
                           echo "</h1>";
                        endif;
                        echo "<p class='subpage-heading'>";
                        echo get_the_date(); 
                        echo "</p>";
                        
                     elseif ( $postType == "post") :
                        
                        if ( get_field('headline_override') ) :
                           echo "<h1 $h1_hidden>";
                           echo get_field('headline_override');
                           echo "</h1>";
                        else :
                           echo "<h1 $h1_hidden>";
                           the_title();
                           echo "</h1>";
                        endif;
                           echo "<div class='date_author'>";
                              echo "<p class='caps h5-style'>";
                                 echo get_the_date(); 
                              echo "</p>";
                              if($author_display_name) {
                                 echo "<p class='author'>";
                                    echo "Written By: " . $author_display_name;
                                 echo "</p>";
                              }
                           echo "</div>";   

                     elseif ($postType == "news") :
                        
                        if ( get_field('headline_override') ) :
                           echo "<h1 $h1_hidden>";
                           echo get_field('headline_override');
                           echo "</h1>";
                        else :
                           echo "<h1 $h1_hidden>";
                           the_title();
                           echo "</h1>";
                        endif;
                        ?>
                        <style>
                           h1 {
                               font-size: 65px;
                               font-weight: 800;
                               letter-spacing: 0;
                               line-height: 65px;
                               margin-bottom: 20px;
                           }
                           @media(max-width: 1024px) {
                              h1 {
                                   font-size: 50px;
                                   line-height: 50px;
                              }
                           }
                           @media(max-width: 640px) {
                              h1 {
                                   font-size: 40px;
                                   line-height: 40px;
                              }
                           }
                        </style>
                        <?

                     elseif ( $postType == "data-center" ) :
                        if (get_field('data_center_id')) : 
                           echo "<p class='subpage-heading'>";
                           echo get_field('data_center_id'); 
                           echo "</p>";
                        endif; 
                        if ( get_field('headline_override') ) :
                           echo "<h1 $h1_hidden>";
                           echo get_field('headline_override');
                           echo "</h1>";
                        else :
                           echo "<h1 $h1_hidden>";
                           the_title();
                           echo "</h1>";
                        endif;

                     elseif ( $postType == "team-member" ) :
                     
                        if ( get_field('headline_override') ) :
                           $title = get_field('headline_override');
                        else :
                           $title = get_the_title();
                        endif;
                      if(get_field('name_override')) {
                          $break_title = "";
                          $name_line_1 = get_field('name_line_1');
                          $name_line_2 = get_field('name_line_2');
                          if($name_line_1) {
                              $break_title .= "$name_line_1";
                          }
                          if($name_line_2) {
                              $break_title .= "<br>$name_line_2";
                          }
                      } else {
                          // Split the title into an array of words
                          $words = explode(" ", $title, 2); // the third parameter is a limit. It'll split the string into a maximum of two parts.
                          
                          // Put a break after the first word
                          $break_title = "";
                          if(count($words) > 1) { // if there's more than one word
                              $break_title = $words[0] . "<br>" . $words[1]; // Add a line break after the first word
                          } else {
                              $break_title = $words[0]; // If there's only one word, just use that.
                          }
                      }

                       echo "<h1 $h1_hidden>";
                       echo $break_title;
                       echo "</h1>";
                       echo "<h4 class='caps'>";
                       get_field('title');
                       echo "</h4>";

                     elseif ( $postType == "resource") :
                        if ( get_field('headline_override') ) :
                           echo "<h1 $h1_hidden>";
                           echo get_field('headline_override');
                           echo "</h1>";
                        else :
                           echo "<h1 $h1_hidden>";
                           the_title();
                           echo "</h1>";
                        endif;
                        
                     endif;
                     
                  elseif ( is_404() ) :
                  echo "<h1>404 Error</h1>";
                  echo "<h3>Page Not Found</h3>";
                  echo "<p class='intro'>There was an error, please check the URL and try again. <br>Or you can choose one of the following options:</p>";
                  echo '<a href="#" onclick="window.history.go(-1); return false;" class="button primary go_back" data-download_attr="">Go Back</a>';
                  echo '<a href="/" class="button primary dark" data-download_attr="">Home Page</a>';
                  echo "<div class='spacer'></div>";
                  else : 
                     if ( get_field('headline_override') ) :
                        echo "<h1 $h1_hidden>";
                        echo get_field('headline_override');
                        echo "</h1>";
                     else :
                        echo "<h1 $h1_hidden>";
                        the_title();
                        echo "</h1>";
                     endif;
                  endif; 
                  
                  
                  
                  ?>
                  <?php
                  if (get_field('sub_headline')):
                     echo "<p class='intro'>";
                     echo get_field('sub_headline');
                     echo "</p>";
                  else :
                     echo "<style>.subpage-header {min-height: 430px!important;}@media(max-width: 640px){.subpage-header {min-height: 0!important;}}</style>";
                  endif;
                  ?>
                  
                  <?php if (get_field('header_buttons')): ?> 
                  
                  	<?php while(has_sub_field('header_buttons')): ?>
                  
                        <? ec_button(); ?>
                  
                  	<?php endwhile; ?>
                  
                  <?php endif; ?>
                     
               </div>
               
               <? if($postType == "team-member") : 
                  $archive_button_override = get_field('archive_button_override');
                  $label = $archive_button_override["label"] ?: "Return to Team Members";
                  $url = $archive_button_override["url"] ?: "/company/management-team/";
                  $hide_button = $archive_button_override["hide_button"];
                  if(!$hide_button) :
               ?>
                     <div class="column small-12 medium-5 back_to">
                        <a href="<?= $url; ?>" class="button primary">
                            <?= $label; ?>
                        </a>
                     </div>
                  <? endif; ?>
               <? endif; ?>
         </div>
      </div>
   </section>
   <?php endif; ?>