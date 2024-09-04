<?
// this is where we put custom functions for this specific build

function displayResources(
    $custom = 0, 
    $customTitle = null, 
    $customLinkText = null, 
    $customLinkURL = null, 
    $type = null, 
    $industry = null, 
    $solution = null,
    $specificResources = null
    ) { 
    
    
    ?>
    
    <div class="row heading">
        <div class="column title">
            <h2>
                <? if ( $custom && $customTitle ) : ?>
                    <?= $customTitle; ?>
                <? else : ?>
                    Recent Resources
                <? endif; ?>
            </h2>
        </div>
        <div class="column shrink cta">
            <? if ( $custom && ( $customLinkText || $customLinkURL ) ) : ?>
                <? if ( $customLinkURL ) : ?>
                    <a href="<?= $customLinkURL; ?>" class="button primary">
                <? else : ?>
                    <a href="/resources/" class="button primary">
                <? endif; ?>
                    <? if ( $customLinkText) : ?>
                        <?= $customLinkText; ?>
                    <? else : ?>
                        View All Resources
                    <? endif; ?>
            <? else : ?>
                <a href="/resources/" class="button primary">
                    View All Resources
            <? endif; ?>
            </a>
        </div>
    </div>
    <div class="row results">

        <?
        $queryArray = array(
            'post_type' => 'resource',
            'posts_per_page' => 3,
        );
        
        if ( $specificResources ) :
            
            // $queryArray = array(
            //     'post_type' => 'resource',
            //     'posts_per_page' => -1,
            //     'post__in'      => $specificResources
            // );
         
            
            foreach ( $specificResources as $resource_id ) {
                
                displaySingleResource($resource_id); 
            }
            
            
        else :
            
            if ( $type !== "all" ) :
            
                $metaQuery = array(
                    'relation' => 'AND',
                    array(
                        'key'     => 'resource_type',
                        'value'   => $type,
                        'compare' => '=',
                    ),
                    array(
                        'key'     => 'resource_type',
                        'value'   => 'success-story',
                        'compare' => '!=',
                    ),
                );
                
                $queryArray['meta_query'] = $metaQuery;
                
            else :
                
                $metaQuery = array(
                    array(
                        'key'     => 'resource_type',
                        'value'   => 'success-story',
                        'compare' => '!=',
                    ),
                );
                
                $queryArray['meta_query'] = $metaQuery;
                
                
            endif;
            
            if ( $custom && ($industry !== "none" || $solution == "none") ) :
                
                $taxQuery = array(
                    'relation' => 'AND'
                );
                
                
            endif;
            
            if ( $custom && $industry ) :
                
                $taxQuery[] = array(
                    'taxonomy'         => 'Industry',
                    'terms'            => array($industry),
                    'field'            => 'term_id',
                    'operator'         => 'IN',
                    'include_children' => true,
                );
     
            endif;
            
            if ( $custom && $solution ) :
                
                $taxQuery[] = array(
                    'taxonomy'         => 'Solution',
                    'terms'            => array($solution),
                    'field'            => 'term_id',
                    'operator'         => 'IN',
                    'include_children' => true,
                );
                
            endif;
            
     
            if ( $custom ) :
                $queryArray['tax_query'] = $taxQuery;
            endif;
            
            $loop = new WP_Query( $queryArray ); ?>
        
            <? if ( $loop->have_posts() ) : ?>
                
           
                
                    <? while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    
                        <? displaySingleResource(get_the_ID()); ?>
                
                    <? endwhile; ?>
                    
             
            <? endif; ?>
            
            <? wp_reset_postdata(); ?>
            
            
        <? endif; ?>
        
        
      
        
        
    </div>
    
<?
}

function displaySingleResource( $id, $description = null ) { ?>
    
    <div class="small-12 medium-6 large-4 column result">

        <div class="hold-me">
            
            <div class="image">
                <img src="<?php echo get_template_directory_uri(); ?>/img/icon-<?= get_field('resource_type', $id); ?>1.svg" alt="resource"/>
            </div>
            <div class="content">
                <div class="hold-me">
                    <div class='h4_wrap'>
                        <h4>
                            <?= get_the_title($id); ?>
                        </h4>
                    </div>
                    <div class="dl-button">
                        <?= getResourceCTA($id); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?
}
function getResourceCTA($id) { 
    
    $type = get_field('resource_type', $id);
    $external = get_field('external_link', $id);

    if ( $type == "whitepaper" ) :
        if ($external) :
            $text = "View Whitepaper";
        else: 
            $text = "Download Whitepaper";
        endif;
        $url = getResourceURL($id);
        $target = "target='_blank'";
        
    elseif ( $type == "brochure") : 
        if ($external) :
            $text = "View Brochure";
        else: 
           $text = "Download Brochure";
        endif;
        $url = getResourceURL($id);
        $target = "target='_blank'";
        
    elseif ( $type == "infographic") : 
        $text = "View Infographic";
        $url = getResourceURL($id);
        $target = "target='_blank'";
        
     elseif ( $type == "data-sheet") : 
         
        if ($external) :
            $text = "View Data Sheet";
        else: 
            $text = "Download Data Sheet";
        endif;
        
        get_field('link_to_data_center', $id) ? $url = get_field('data_sheet', get_field('link_to_data_center', $id)) : $url = getResourceURL($id);
        
        $target = "target='_blank'";
        
    elseif ( $type == "video" ) :
        if ($external) :
            $text = "View Video";
            $target = "target='_blank'";
        else: 
            $text = "Play Video";
            $target = "";
        endif;
        $url = getResourceURL($id);
        
    elseif ( $type == "success-story" ) :
        
         if ($external) :
            $target = "target='_blank'";
        else: 
            $target = "";
        endif;
        $text = "View Success Story";
        $url = getResourceURL($id);
        
    elseif ( $type == "ebook" ) :
        if ($external) :
            $text = "View Ebook";
        else: 
            $text = "Download Ebook";
        endif;
        $target = "target='_blank'";
        $url = getResourceURL($id);
        
    elseif ( $type == "solutions-brief" ) :
        if ($external) :
            $text = "View Brief";
        else: 
            $text = "Download Brief";
        endif;
        $target = "target='_blank'";
        $url = getResourceURL($id);
        
    endif; 
    ?>

    <a href="<?= $url; ?>" <?= $target; ?> class="button primary">
        <?= $text; ?>
    </a>

<?
}
function getResourceURL($id) {
    
    $type = get_field('resource_type', $id);
    $external = get_field('external_link', $id);
    
    if ( $type == "whitepaper" ) :
        
        if ( $external == true ) :
            $url = $external;
        else:
            $url = get_field('download_file', $id);
        endif;
        
    elseif ( $type == "brochure") : 
       
        if ( $external == true ) :
            $url = $external;
        else:
            $url = get_field('download_file', $id);
        endif;
        
        
    elseif ( $type == "infographic") : 
       
        if ( $external == true ) :
            $url = $external;
        else:
            $url = get_field('download_file', $id);
        endif;
        
    elseif ( $type == "data-sheet") : 
       
       if ( $external == true ) :
            $url = $external;
        else:
            $url = get_field('download_file', $id);
        endif;
        
    elseif ( $type == "video" ) :
        if ( $external == true ) :
            $url = $external;
        else:
            $url = get_the_permalink($id);
        endif;
        
        
    elseif ( $type == "success-story" ) :
        if ( $external == true ) :
            $url = $external;
        else:
            $url = get_the_permalink($id);
        endif;
        
    
    elseif ( $type == "ebook" ) :
        if ( $external == true ) :
            $url = $external;
        else:
            $url = get_field('download_file', $id);
        endif;
        
    elseif ( $type == "solutions-brief" ) :
        if ( $external == true ) :
            $url = $external;
        else:
            $url = get_field('download_file', $id);
        endif;
    
        
    endif; 
    
    return $url;
    
}

//check if page has children
function has_children() {
	global $post;
	return count( get_posts( array('post_parent' => $post->ID, 'post_type' => $post->post_type) ) );
}

// var dump better
function avd($val){
    echo '<pre>';
    var_dump($val);
    echo  '</pre>';
}

// function to organize menu into nested arrays for the supermenu
function wp_get_menu_array($current_menu) {
    $array_menu = wp_get_nav_menu_items($current_menu);
    $menu = array();
    foreach ($array_menu as $m) {
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array();
            $menu[$m->ID]['ID']      =   $m->ID;
            $menu[$m->ID]['title']       =   $m->title;
            $menu[$m->ID]['target']       =   $m->target;
            $menu[$m->ID]['url']         =   $m->url;
            $menu[$m->ID]['children']    =   array();
        }
    }
    $submenu = array();
    foreach ($array_menu as $m) {
        if ($m->menu_item_parent) {
            $submenu[$m->ID] = array();
            $submenu[$m->ID]['ID']       =   $m->ID;
            $submenu[$m->ID]['title']    =   $m->title;
            $submenu[$m->ID]['target']    =   $m->target;
            $submenu[$m->ID]['url']  =   $m->url;
            $submenu[$m->ID]['children']  =   array();
            $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
        }
    }
    foreach ($menu as &$k) {
        foreach ($k['children'] as &$child) {
            $subsubmenu = array();
            foreach ($array_menu as $o) {
                if(intval($o->menu_item_parent) == $child["ID"]) {
                    $subsubmenu[$o->ID] = array();
                    $subsubmenu[$o->ID]['ID']       =   $o->ID;
                    $subsubmenu[$o->ID]['title']    =   $o->title;
                    $subsubmenu[$o->ID]['target']    =   $o->target;
                    $subsubmenu[$o->ID]['url']  =   $o->url;
                    $child["children"] = $subsubmenu;
                }
            }
        }
    }
    return $menu;
}

// Define a function called "post_tile" that takes several optional parameters
function post_tile($post_id = null, $intro = null, $btn_label = "Learn More", $post_type = 'post', $show_excerpt = false) {
    // Check if the post type is equal to "post"
    if($post_type == "post") { ?>
        <!-- Output the post tile HTML -->
        <div class="intro-column columns large-4 small-12 post_tile">
            <?
            // Get the post type (which may have changed from 'post')
            $post_type = get_post_type($post_id); 
            // Initialize variables for the category label and link path
            $label = "";
            $path = "";
            // Use a switch statement to set the category label and link path based on the post type
            switch ($post_type) {
                case 'news':
                    $label = "News & PR";
                    $path = "/news/press-releases/";
                    break;
                case 'post':
                    $label = "Blog";
                    $path = "/news/edge-blog/";
                    break;
                case 'page':
                    $label = "Page";
                    $path = get_permalink($post_id);
                    break;
                case 'team-member':
                    $label = "Team Member";
                    $path = get_permalink($post_id);
                    break;
                case 'data-center':
                    $label = "Data Center";
                    $path = get_permalink($post_id);
                    break;
                default:
                    $label = "Event";
                    $path = "/news/events/";
                    break;
            } ?>
            <!-- Output the post category as a link with an icon -->
            <h3 class="news_category"><a href="<?= $path; ?>"><?= $label; ?> <img src="<?= get_template_directory_uri(); ?>/img/caret.svg" alt="<?= $label; ?>" /></a></h3>
            <!-- Output the post title -->
            <div class='title_wrap'>
                <p class="post_title"><?= get_the_title($post_id); ?></p>
            </div>
            <!-- Output the post excerpt if desired -->
            <? if(get_the_excerpt($post_id) && $show_excerpt) : ?>
                <p class="post_excerpt"><?= get_the_excerpt($post_id); ?></p>
            <? elseif(get_field('short_description', $post_id) && $show_excerpt) : ?>
                <p class="post_excerpt"><?= wp_trim_words( get_field('short_description', $post_id), 15, '...' ); ?></p>
            <? endif; ?>           
            <!-- Output the "Learn More" button with a link to the full post -->
            <a href="<?= get_permalink($post_id) ?>" class="button intro_button"><?= $btn_label; ?></a>
        </div>
    <? } else { ?>
        <!-- Output a custom introduction instead of the post tile -->
        <div class="intro-column columns large-4 small-12 post_tile">
            <?= $intro ?>
        </div>
    <? }
}

/*
function post_tile($post_id = null, $intro = null, $btn_label = "Learn More", $post_type = 'post', $show_excerpt = false) {
    if($post_type == "post") { ?>
   <div class="intro-column columns large-4 small-12 post_tile">
       <? 
       $post_type = get_post_type($post_id); 
       $label = "";
       $path = "";
       switch ($post_type) {
           case 'news':
               $label = "News & PR";
               $path = "/news/press-releases/";
           break;
           case 'post':
               $label = "Blog";
               $path = "/company/blog/";
           break;
           case 'page':
               $label = "Blog";
               $path = get_permalink($post_id);
           break;
           default:
               $label = "Event";
               $path = "/news/events/";
           break;
       }?>
        <h3 class="news_category"><a href="<?= $path; ?>"><?= $label; ?> <img src="<?= get_template_directory_uri(); ?>/img/caret.svg" alt="<?= $label; ?>" /></a></h3>
        <p class="post_title"><?= wp_trim_words(get_the_title($post_id), 12, "..."); ?></p>
        <? if(get_the_excerpt($post_id) && $show_excerpt) : ?>
           <p class="post_excerpt"><?= get_the_excerpt($post_id); ?></p>
        <? elseif(get_field('short_description', $post_id) && $show_excerpt) : ?>
           <p class="post_excerpt"><?= wp_trim_words( get_field('short_description', $post_id), 15, '...' ); ?></p>
        <? endif; ?>           
        <a href="<?= get_permalink($post_id) ?>" class="button intro_button"><?= $btn_label; ?></a>
   </div>
    <? } else { ?>
       <div class="intro-column columns large-4 small-12 post_tile">
           <?= $intro ?>
       </div>
    <? }
}
*/

function get_pattern_src($background_color = "default") {
    $src = "";
    switch ($background_color) {
        case 'default':
            $src = get_template_directory_uri() . "/img/light_bg_pattern.svg";
        break;
        case 'light-gray-bg':
            $src = get_template_directory_uri() . "/img/light_gray_bg_pattern.svg";
        break;
        default:
            $src = get_template_directory_uri() . "/img/dark_bg_pattern.svg";
        break;
    }
    return $src;
}

function displayTestimonial($id) { ?>
    <div class="column testimonial">
        <?php if (get_field('video', $id)) : ?>
        <div class="row align-middle">
            <div class="small-12 medium-9 large-10 columns">
                <p class="quote">
                    <?= get_field('description', $id); ?>
                </p>
                <div class="tagline h5-style caps">
                    <span class="name"><?= get_field('name', $id); ?></span>
                    <span class="title"><?= get_field('tagline', $id); ?></span>
                </div>
            </div>
            <div class="small-12 medium-3 large-2 columns">
                <div class="video-holder play-video" onclick="thevid=document.getElementById('thevideo'); thevid.style.display='block'; this.style.display='none'">
                    <img class="video-icon" src="<?php echo get_template_directory_uri(); ?>/img/icon-play-button.svg" alt="video play button" />
                </div>
                <div id="thevideo" style="display:none">
                <?php $video = get_field('video', $id); ?>
                <iframe id="video" width="560" height="315" src="<?php echo $video; ?>" frameborder="0" allowfullscreen></iframe>
                
                </div>
                
                <script>
                    $(document).ready(function() {
                  $('.video-icon').on('click', function(ev) {
                 
                    $("#video")[0].src += "?autoplay=1";
                    ev.preventDefault();
                 
                  });
                });
                </script>
            </div>
        </div>
        <?php else: ?>
            <p class="quote">
                <?= get_field('description', $id); ?>
            </p>
            <div class="tagline h5-style caps">
                <span class="name"><?= get_field('name', $id); ?></span>
                <span class="title"><?= get_field('tagline', $id); ?></span>
            </div>
        <?php endif; ?>
    </div>
<?  
}


function displayTestimonialNav($id) { 
    $label = get_field('label_override', $id);
    if(!$label) {
        $label = get_the_title($id);
    }
?>
   <div class="nav-item">
     <span class='button primary reversed'><?= $label; ?></span>
   </div>
<?  
}

function displayEvent($eventID, $background_color = "default") {
        unset($cssClasses);

        $tags = get_field('tags');

        $moreThanOneClass = 0;

        if ( is_array($tags) ) {
            foreach ($tags as $tag) {

                $cleanTag = str_replace(' ', '', $tag);
                $cleanTag = str_replace('/', '', $cleanTag);

                if ( $moreThanOneClass ) {
                    $cssClasses .= " ";
                }

                $cssClasses .= $cleanTag;

                $moreThanOneClass++;

            }
        }

        if ( get_field('image', $eventID )) {
            $image = get_field('image', $eventID)['sizes']['split-section'];
        } else {
            $image = get_field('default_event_post_image', $eventID, 'options')['sizes']['split-section'];
        }

    if (get_field('event_link', $eventID)) {
        $link = get_field('event_link', $eventID);
        $image_event_link = get_field('image_event_link', $eventID);
        $onclick = "";
        if($image_event_link) {
            $onclick = "javascript:window.open('$image_event_link')";
        }
    } elseif ( get_field('long_description') ) {
        $link = get_the_permalink($eventID);
    } 
    $cta_label = get_field('cta_label', $eventID) ? get_field('cta_label', $eventID) : "More Information";
    ?>
    <style type="text/css">
        .event .image.has_link:hover {
            cursor: pointer;
        }
        .event:hover {
            cursor: default;
        }
    </style>
   <div class="row event <?= $cssClasses; ?> <?= $background_color; ?>">
    <img class='background_pattern' src="<?= get_pattern_src($background_color); ?>" alt="background pattern" />
       <?php if ( get_field('image', $eventID )) { ?>
        <div class="columns small-11 medium-6 image <?= $image_event_link ? "has_link" : ""; ?>" style="background-image:url('<?= $image; ?>')"; onclick="<?= $onclick; ?>">
            <?php if ( get_field('featured', $eventID) ) { ?>
                <div class="featured">
                    Featured
                </div>
            <?php } ?>
            &nbsp;
        </div>
        <?php } ?>
        <div class="columns small-12 medium-6 content">
            <div class="hold-me">
                 <h4 class="event-date caps"><?= get_field('start_date', $eventID); ?>
                    <?php if ( get_field('end_date') ) { ?>
                        - <?= get_field('end_date', $eventID); ?>
                    <?php } ?>
                </h4>
                <h2><?= get_the_title($eventID); ?></h2>
                <h4><?= get_field('event_location', $eventID); ?></h4>
                <p><?= get_field('short_description'); ?></p>
                <?php if (get_field('event_link')) : ?>
                    <a href="<?= get_field('event_link', $eventID); ?>" target="_blank" class="button primary"><?= $cta_label; ?></a>
                <? elseif ( get_field('long_description') ) : ?>
                    <a href="<?= get_the_permalink($eventID); ?>" class="button primary" ><?= $cta_label; ?></a>
                <? endif; ?>
            </div>
        </div>
   </div>
<? }


// function get_image_attributes($image_id, $width, $height) {
//     // bail if attributes params aren't provided
//     if(!$image_id || !$width || !$height) {
//         return;
//     }
    
//     $attr_html = "";
    
//     // Get the image metadata
//     $meta = wp_get_attachment_metadata( $image_id );
    
//     // Get the image source
//     $source = fly_get_attachment_image_src( $image_id, array( $width, $height ), true )['src'];
//     if($source) {
//         $attr_html .= "src='$source' ";
//     }
    
//     // Get the image alt text
//     $alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
//     if($alt) {
//         $attr_html .= "alt='$alt' ";
//     }
    
//     // Set the desired maximum width
//     $max_width = $width * 2;
    
//     // Calculate the aspect ratio
//     $aspect_ratio = $height / $width;
    
//     // Calculate the image sizes based on the aspect ratio and the desired maximum width
//     $sizes = "(max-width: {$max_width}px) 100vw, {$max_width}px";
    
//     // Calculate the crop dimensions
//     $crop = image_resize_dimensions( $width, $height, $max_width, round( $max_width * $aspect_ratio ), true );
    
//     // Get the image source set
//     $srcset = wp_get_attachment_image_srcset( $image_id, array(
//         array( $max_width, round( $max_width * $aspect_ratio ), true ),
//     ) );
//     if($srcset) {
//         $attr_html .= "srcset='$srcset' ";
//         $attr_html .= "sizes='$sizes' ";
//     }

//     // build and return attribute string
//     return $attr_html;
// }

function getFirstSentence($content) {
    // Strip all HTML tags
    $content = strip_tags($content);

    // Use regex to match the first sentence
    if (preg_match('/(.*?[.!?])/U', $content, $matches)) {
        return $matches[1];
    }

    // If no sentence ending was found, return the entire content or an empty string
    return $content;
}

function floatvalue($val){
    $val = str_replace(",",".",$val);
    $val = preg_replace('/\.(?=.*\.)/', '', $val);
    return floatval($val);
}

function breadcrumbs() {
	
	// Set to true if the breadcrumbs on this site should start with a link to home
	$display_home = true;
	$breadcrumbs = [];
	if ( $display_home ) {
		$breadcrumbs[] = array(
			'title' => 'Home', 
			'url' => '/'
		);
	}
	
	// Setup variables
	$separator = " » ";
	$post_ID = get_the_ID();
	$post_type = get_post_type();

	// get the archive page IDs
	$post_archive_page_ID = get_option( 'page_for_posts' );
	
	
	if ( $post_type == "page" ) {
		$breadcrumbs = ec_get_page_ancestors($post_ID, $breadcrumbs);
		$breadcrumbs[] = array(
			'title' => get_the_title($post_ID),
			'url' => get_permalink( $post_ID )
		);
	}
	elseif ( is_search() ) { }
	elseif ( is_404() ){ }
	elseif ( $post_type == "team-member" ) {
		// get the ancestors of this page
		$breadcrumbs = ec_get_page_ancestors($post_ID, $breadcrumbs);
		$breadcrumbs[] = array(
			'title' => "Management Team",
			'url' => "/company/management-team/"
		);
		$breadcrumbs[] = array(
			'title' => get_the_title($post_ID),
			'url' => get_permalink( $post_ID )
		);
	}
	elseif ( $post_type == "news" ) {
		// get the ancestors of this page
		$breadcrumbs = ec_get_page_ancestors($post_ID, $breadcrumbs);
		$breadcrumbs[] = array(
			'title' => "News & PR",
			'url' => "/news/press-releases/"
		);
		if(!is_archive()) {
    		$breadcrumbs[] = array(
    			'title' => get_the_title($post_ID),
    			'url' => get_permalink( $post_ID )
    		);
		}
	}
	elseif ( $post_type == "post" ) {
		// get the ancestors of this page
		$breadcrumbs = ec_get_page_ancestors($post_ID, $breadcrumbs);
		$breadcrumbs[] = array(
			'title' => "Edge Blog",
			'url' => "/news/edge-blog/"
		);
		if(!is_home()) {
    		$breadcrumbs[] = array(
    			'title' => get_the_title($post_ID),
    			'url' => get_permalink( $post_ID )
    		);
		}
	}
	elseif ( $post_type == "data-center" ) {
		// get the ancestors of this page
		$breadcrumbs = ec_get_page_ancestors($post_ID, $breadcrumbs);
		$location = get_field('region', $post_ID);
		$region_slug = "";
		$region_label = "";
		switch ($location) {
		    case 'north-america':
		    case 'south-america':
		        $region_slug = "/americas/";
		        $region_label = "Americas";
	        break;
	        
		    case 'china':
		    case 'india':
		    case 'asia-pacific':
		        $region_slug = "/asia-pacific/";
		        $region_label = "Asia Pacific";
	        break;
	        
		    case 'europe':
		    case 'middle-east':
		        $region_slug = "/emea/";
		        $region_label = "EMEA";
	        break;
	        	 
		    default:
		        $region_slug = "/global-map/";
		        $region_label = "Global Map";
	        break;
		}
		$breadcrumbs[] = array(
			'title' => "$region_label",
			'url' => "$region_slug"
		);
		$breadcrumbs[] = array(
			'title' => get_the_title($post_ID),
			'url' => get_permalink( $post_ID )
		);
	}

	// output the breadcrumbs
	$counter = 1;
	$total_breadcrumbs = count($breadcrumbs);
	if($total_breadcrumbs > 1) {
		foreach ( $breadcrumbs as $breadcrumb ) {
			if ( !$breadcrumb['url'] ) {
				if ( $breadcrumb['title'] != "Home") {
					echo "&nbsp;&nbsp;&nbsp;<span class='no_link'></span>&nbsp;&nbsp;&nbsp;";
				}	
			} elseif ( !$breadcrumb['url'] && $total_breadcrumbs == 0 ) {
	
			} elseif ( $counter > 1 ) {
				if ( $breadcrumb['title'] != "Home") {
				    echo "&nbsp;&nbsp;<span class='breadcrumb'>/</span>&nbsp;&nbsp;";
				}
			}
			
			
			if ( $breadcrumb['url'] ) {
				echo "<a href='{$breadcrumb['url']}' class='breadcrumb'>{$breadcrumb['title']}</a>";
			} elseif ( $total_breadcrumbs == 1 ) {
				if ( $breadcrumb['title'] != "Home") {
    				echo "<span class='title only_one'>{$breadcrumb['title']}</span>";
				}
			} else {
				if ( $breadcrumb['title'] != "Home") {
    				echo "<span class='title'>{$breadcrumb['title']}</span>";
				}
			}
			$counter++;
		}
	}
}

function ec_get_page_ancestors( $page_id, $breadcrumbs = [] ) {

	$ancestors = array_reverse(get_ancestors($page_id, 'page'));
	foreach ( $ancestors as $ancestor_ID ) {
		$breadcrumbs[] = array(
			'title'	=> get_the_title($ancestor_ID),
			'url' => get_the_permalink($ancestor_ID)
		);
	}
	return $breadcrumbs;
}

function display_single_newsroom($post_ID, $hide_tile_snippets = false, $slide_count = 1) {
    if(!$post_ID) return;
    $post_type = get_post_type($post_ID);
    $external_url = get_field('external_article_url', $post_ID);
    if($external_url) {
        $url = $external_url;
        $target = "target='_blank'";
    } else {
        $url = get_the_permalink($post_ID);
        $target = "";
    }

    $cta_label = "Read More";

    $col_classes = "column";
    if($slide_count < 4) {
        $col_classes .= " small-12 medium-6 large-4";
    }
    
    $image_obj = match($post_type) {
        "newsroom" => get_field('background_image', $post_ID),
        "news" => get_field('post_image', $post_ID),
        "post" => get_field('image', $post_ID),
        "event" => get_field('image', $post_ID),
        "edgetv" => get_field('video_thumbnail', $post_ID),
    };

    if(!$image_obj) {
        $image_obj = match($post_type) {
            "newsroom" => get_field('default_header_image', 'options'),
            "news" => get_field('default_news_header_image', 'options'),
            "post" => get_field('default_blog_header_image', 'options'),
            "event" => get_field('default_event_tile_image', 'options'),
            "edgetv" => get_field('default_edgetv_tile_image', 'options'),
        };
    }

    $post_type_label = match($post_type) {
        "newsroom" => "Newsroom",
        "news" => "News",
        "post" => "Blog",
        "event" => "Event",
        "edgetv" => "EdgeTV"
    };

    $final_image_url = $image_obj['url'];
    
    $final_image_alt = $image_obj['alt'];
        
    $logo_class = get_field('is_logo', $post_ID) ? "is_logo" : "not_logo";
    $date = get_the_date('F j, Y', $post_ID);
    $tile_snippet = get_field('tile_snippet', $post_ID);
    $date_class = $hide_tile_snippets ? "no_snippet" : "";

    if($post_type == "event") {
        $start_date = get_field('start_date', $post_ID);
        $end_date = get_field('end_date', $post_ID);
        if($end_date) {
            $date = "$start_date - $end_date";
        } else {
            $date = $start_date;
        }
        $event_location = get_field('event_location', $post_ID);
        $tile_snippet = "";
        if($event_location) {
            $tile_snippet .= "$event_location";
        }
        $short_description = get_field('short_description', $post_ID);
        if($short_description) {
            $short_description = getFirstSentence($short_description);
            $tile_snippet .= "<br><br>$short_description";
        }
        $event_link = get_field('event_link', $post_ID);
        if($event_link) {
            $url = $event_link;
            $target = "target='_blank'";
        }
        $cta_label = get_field('cta_label', $post_ID) ? get_field('cta_label', $post_ID) : "Read More";
    }


    $content_class = "";
    $play_button_icon_color = "#FFFFFF";

    if($post_type == "edgetv") {
        $video = get_field('video', $post_ID);
        $description = get_field('description', $post_ID);
        if($description) {
            $tile_snippet = getFirstSentence($description);
        }
        $play_button_icon_color = get_field('play_button_icon_color', $post_ID) ?: "#FFFFFF";
        $cta_label = get_field('tile_cta_override', $post_ID) ?: "Watch Now";

        $index = rand(0, 999);
        
        $video_id = explode("/embed/", $video);
        $video_id = $video_id[1];
        
        $rand = rand(1000,9999999);
        $content_class = "trigger-video-popup";
        $popup_id = "split-video-" . $rand;
        $url = "#" . $popup_id;
    }

    $html = "";

    $html = "<div class='$col_classes newsroom_tile'>";
        $html .= "<a href='$url' $target class='hold_me $content_class'>";
            if($final_image_url) {
                $html .= "<div class='image $logo_class'>";
                    $html .= "<img src='$final_image_url' class='$logo_class' alt='$final_image_alt' />";
                    if($post_type == "edgetv") {
                        $html .= "<div class='play_video'>
                            <svg width='168px' height='168px' viewBox='0 0 168 168' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'>
                                <title>Fill 1</title>
                                <g id='Mockups' stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
                                    <g id='EdgeConneX-Page-Builder---Elements-R1' transform='translate(-1312.000000, -14040.000000)' fill='$play_button_icon_color'>
                                        <g id='Split-Section-Image-Right' transform='translate(0.000000, 13491.000000)'>
                                            <path d='M1396,717 C1384.5214,717 1373.6686,714.795 1363.45,710.385 C1353.2314,705.975 1344.3064,699.9564 1336.675,692.325 C1329.0436,684.6936 1323.025,675.7686 1318.615,665.55 C1314.205,655.3314 1312,644.4786 1312,633 C1312,621.3786 1314.205,610.4586 1318.615,600.24 C1323.025,590.0214 1329.0436,581.13 1336.675,573.57 C1344.3064,566.01 1353.2314,560.025 1363.45,555.615 C1373.6686,551.205 1384.5214,549 1396,549 C1407.6214,549 1418.5414,551.205 1428.76,555.615 C1438.9786,560.025 1447.87,566.01 1455.43,573.57 C1462.99,581.13 1468.975,590.0214 1473.385,600.24 C1477.795,610.4586 1480,621.3786 1480,633 C1480,644.4786 1477.795,655.3314 1473.385,665.55 C1468.975,675.7686 1462.99,684.6936 1455.43,692.325 C1447.87,699.9564 1438.9786,705.975 1428.76,710.385 C1418.5414,714.795 1407.6214,717 1396,717 L1396,717 Z M1376,669 L1432,633 L1376,597 L1376,669 Z' id='Fill-1'></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>";
                    }
                    $html .= "<div class='post_type_label'><span>$post_type_label</span></div>";
                $html .= "</div>";
            }
            $html .= "<div class='content'>";
                $html .= "<span class='h4-style'>";
                    $html .= get_the_title($post_ID);
                $html .= "</span>";
                $html .= "<span class='date $date_class'>$date</span>";
                if($tile_snippet && !$hide_tile_snippets) {
                    $html .= "<span class='snippet'>$tile_snippet</span>";
                }
                $html .= "<span class='read_more'>";
                    $html .= "$cta_label";
                    $html .= '<svg width="24px" height="24px" viewBox="0 0 24 24" style="cursor:pointer"><g stroke-width="2.1" stroke="#019CDB" fill="none" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 13.5 17 19.5 5 19.5 5 7.5 11 7.5"></polyline><path d="M14,4.5 L20,4.5 L20,10.5 M20,4.5 L11,13.5"></path></g></svg>';
                $html .= "</span>";
            $html .= "</div>";
        $html .= "</a>";
    $html .= "</div>";
    if($post_type == "edgetv") {
        $html .= "<div id='$popup_id' class='white-popup mfp-hide iframe_wrapper'>";
            $html .= "<div class='video-container'>";
                $html .= "<iframe width='560' height='315' src='https://www.youtube.com/embed/$video_id' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
            $html .= "</div>";
        $html .= "</div>";
        
    $html .= "<script type='text/javascript'>
            jQuery(document).ready(function($){
                jQuery('.trigger-video-popup').magnificPopup({
                    type:'inline',
                    midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
                });
            });
        </script>";
    }

    return $html;
}

function ec_get_responsive_image($img_array, $high_priority = false, $classes = null, $alt_override = null){
    // get the image id
    $img_id = $img_array['ID'] ?? null;
    if (!$img_id) return false;

    // gather the alt and original file URL
    $img_alt = $alt_override ?: $img_array['alt'];
    $img_og_url = $img_array['url'] ?? null;

    // get the original width, height and calculate the ratio
    $og_width = $img_array['width'] ?? null;
    $og_height = $img_array['height'] ?? null;
    $ratio = $og_width / $og_height;

    // set the widths that should be generated. be careful changing this! it will make all of the images that rely on this function regenerate if changed
    $widths = array(
        2880 => "",
        2048 => "",
        1440 => "",
        1024 => "",
        640 => ""
    );

    // loop through all of the preset widths to gather/generate the correct images
    foreach ($widths as $width => $value) {
        // if the original width is smaller/equal to this preset, get rid of the preset and set the largest width to the original width of the image
        if ($og_width <= $width) {
            unset($widths[$width]);
            $width = $og_width;
        }

        // generate the height of the image by rounding down the width / ratio
        $height = floor($width / $ratio);

        // set the image url according to the width key it corresponds to
        $widths[$width] = fly_get_attachment_image_src($img_id, array($width, $height), true)['src'] ?? null;
    }

    // sort the widths from smallest to largest
    ksort($widths);

    // generate the image srcset
    $o = "<img ";

    // print the image urls with the intrinsic size
    $o .= "srcset='";
    $x = 0;
    foreach ($widths as $width => $image_url) {
        $o .= $x > 0 ? ", " : "";
        $o .= "$image_url {$width}w";
        $x++;
    }

    // print the size selectors
    $o .= "' sizes='";
    $x = 0;
    foreach ($widths as $width => $image_url) {
        $o .= $x > 0 ? ", " : "";
        $o .= "(max-width: {$width}px) {$width}px";
        $x++;
    }

    $o .= "' ";

    // add any custom classes
    $classes .= $high_priority ? " skip-lazy" : "";
    $o .= $classes ? "class='$classes' " : null;

    // close things out with the fallback image and the alt tag
    $o .= "src='$img_og_url' alt='$img_alt' ";

    $o .= $high_priority ? "fetchpriority='high' " : null;

    $o .= " />";

    return $o;
}

add_filter( 'rocket_defer_inline_exclusions', function( $inline_exclusions_list ) {
    if ( ! is_array( $inline_exclusions_list ) ) {
      $inline_exclusions_list = array();
    }
  
    // Duplicate this line if you need to exclude more
    $inline_exclusions_list[] = 'slick';
  
    return $inline_exclusions_list;
} );