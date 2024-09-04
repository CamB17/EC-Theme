<? 
$display_mode = get_sub_field('display_mode');
$slide_count = count(get_sub_field('slides'));
if (get_sub_field('slides')) : $rand = rand(99,9999); ?>
    <div class="featured_content_slider <?= $display_mode ?> r_<?= $rand; ?>">
        <div class='row extended' data-color="">
            <img tabindex='1' class='slick-prev slick-arrow r_<?= $rand; ?>' data-color="white" src='<?= get_template_directory_uri(); ?>/img/icon-testimonial_left.svg' alt="Previous Slide" />
            <img tabindex='1' class='slick-next slick-arrow r_<?= $rand; ?>' data-color="white" src='<?= get_template_directory_uri(); ?>/img/icon-testimonial_right.svg' alt="Next Slide" />
            <img tabindex='1' class='slick-prev slick-arrow r_<?= $rand; ?>' data-color="solid_yellow" src='<?= get_template_directory_uri(); ?>/img/icon-testimonial-left_blue.svg' alt="Previous Slide" />
            <img tabindex='1' class='slick-next slick-arrow r_<?= $rand; ?>' data-color="solid_yellow" src='<?= get_template_directory_uri(); ?>/img/icon-testimonial-right_blue.svg' alt="Next Slide" />
            <div class='columns small-12 slide_wrap r_<?= $rand; ?>'>
            	<? while(has_sub_field('slides')): 
            	//vars
            	$mode = get_sub_field('mode');
            	$color_combinations = get_sub_field('color_combinations');
            	if(!$color_combinations) {
            	    $color_combinations = "dark_blue";
            	}
                
                if($color_combinations == "solid_yellow") {
                	$image_arrow = "<img src='" . get_template_directory_uri() . "/img/icon-side_caret-blue.svg' alt='Post' />";
                } else {
                	$image_arrow = "<img src='" . get_template_directory_uri() . "/img/icon-side_caret.svg' alt='Post' />";
                }
            	
            	if($mode == "post_content") {
            	    // post content
            	    $post_id = get_sub_field('post_content');
            	    $post_type = get_post_type($post_id);
            	    $title = get_the_title($post_id);
            	    $permalink = get_the_permalink($post_id);
            	    $open_in_a_new_tab = false;
            	    $button_text = "Get Started";
            	    switch ($post_type) {
            	        case 'team-member':
            	            $post_type_label = "Team Member $image_arrow";
            	            $bg_image = get_field('headshot', $post_id);
                    	    $content =  getFirstSentence(get_field('bio', $post_id));
        	            break;
            	        case 'resource':
            	            $post_type_label = "Resource $image_arrow";
            	            $bg_image = get_field('cover_image', $post_id);
                    	    $content =  getFirstSentence(get_field('description', $post_id));
        	            break;
            	        case 'news':
            	            $post_type_label = "News $image_arrow";
            	            $bg_image = array();
            	            $post = get_post($post_id);
                    	    $content =  getFirstSentence($post->post_content);
        	            break;
            	        case 'data-center':
            	            $post_type_label = "Data Center $image_arrow";
            	            $bg_image = get_field('background_image', $post_id);
                    	    $content =  getFirstSentence(get_field('sub_headline', $post_id));
        	            break;
            	        case 'page':
            	            $post_type_label = "Page $image_arrow";
            	            $bg_image = get_field('background_image', $post_id);
                    	    $content =  getFirstSentence(get_field('sub_headline', $post_id));
        	            break;
            	        case 'event':
            	            $post_type_label = "Event $image_arrow";
            	            $bg_image = get_field('image', $post_id);
                    	    $content =  getFirstSentence(get_field('short_description', $post_id));
        	            break;
            	        case 'edgetv':
            	            $post_type_label = "EdgeTV $image_arrow";
            	            $bg_image = get_field('video_thumbnail', $post_id);
                    	    $content =  getFirstSentence(get_field('description', $post_id));
        	            break;
            	        case 'post':
            	            $post_type_label = "Post $image_arrow";
            	            $bg_image = get_field('image', $post_id);
            	            $post = get_post($post_id);
                    	    $content =  getFirstSentence($post->post_content);
        	            break;
            	    }
            	    wp_reset_postdata();
                	$image_source = fly_get_attachment_image_src( $bg_image["ID"], array( 2480, 1200 ), true )['src'];
            	} else {
            	    // custom content
            	    $custom_content = get_sub_field('custom_content');
            	    $post_type_label = $custom_content["slide_label"] ? $custom_content["slide_label"] . $image_arrow : null;
            	    $title = $custom_content["title"];
            	    $content = $custom_content["content"];
            	    $button_text = $custom_content["button_text"];
            	    $open_in_a_new_tab = $custom_content["open_in_a_new_tab"];
            	    $url_type = $custom_content["url_type"];
            	    if($url_type == "wordpress_content") {
            	        $permalink = $custom_content["wordpress_content"];
            	    } elseif($url_type == "URL") {
            	        $permalink = $custom_content["url"];
            	    }
            	}
            	$target = $open_in_a_new_tab ? "target='_blank'" : "";
        	   // $button_color = "secondary";
            	$override_background_image = get_sub_field('background_image');
            	if($override_background_image) {
                	$image_source = fly_get_attachment_image_src( $override_background_image["ID"], array( 2480, 1200 ), true )['src'];
            	}
        	    $button_color = "tertiary";
        	    if($color_combinations == "solid_yellow") {
            	    $button_color = "primary";
        	    }
    	        $col_class = "columns small-12";
    	        if($color_combinations == "orange_red" || $color_combinations == "blue_red" || $color_combinations == "solid_yellow") {
        	        $col_class .= " large-7 large-offset-5";
    	        }
            	?>
            	<div class="slide <?= $color_combinations; ?>" data-color="<?= $color_combinations; ?>" style='background-image: url(<?= $image_source ?>)'>
            	    <div class='content_wrap'>
                	    <div class="content <?= $col_class; ?>">
                	       <? if($post_type_label) : ?>
                	           <span class='post_type_label'><?= $post_type_label; ?></span>
                	       <? endif; ?>
                	       <? if ($title) : ?>
                	            <h2><?= $title; ?></h2>
                	       <? endif; ?>
                	       <? if ($content) : ?>
                	           <div class='description'><?= $content; ?></div>
                	       <? endif; ?>
                	       <? if ($permalink) : ?>
        	                  <a href="<?= $permalink; ?>" class="button <?= $button_color; ?>" <?= $target; ?>>
                                 <?= $button_text; ?>
                              </a>
                	       <? endif; ?>
                	       <div class='slick_dots_custom'>
                	           <? for ($i = 0; $i < $slide_count; $i++) { ?>
                	               <span class='dot <?= $i == 0 ? "active" : ""; ?>' data-slide=""></span>
                	           <? } ?>
                	       </div>
                	    </div>
            	    </div>
            	    <div class="image" style="background-image:url('<?= $image_source; ?>');"> </div>
            	</div>
            	<? endwhile; ?>
            </div>
        </div>
    </div>
<? endif; ?>

<? if ( get_sub_field('slides') ) : ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            // Variable to keep track of the last focused dot's index
            var lastFocusedDotIndex = 0;
            
            // Update lastFocusedDotIndex whenever any dot receives focus
            $(document).on('focus', '.slick_dots_custom .dot', function() {
                lastFocusedDotIndex = $(this).data('slide');
            });
            
            // Make slider arrows focusable
            setTimeout(function(){
                $('.slick-arrow').attr('tabindex', '0');
                
                // Initially make all dots unfocusable
                $('.slick_dots_custom .dot').attr('tabindex', '-1');
            
                // Make dots of the active slide focusable
                $('.slick-active .slick_dots_custom .dot').attr('tabindex', '0');
            
                // Listen for the afterChange event to update tabindex
                // $('.slide_wrap.r_<?= $rand; ?>').on('afterChange', function(event, slick, currentSlide) {
                //     // Make all dots unfocusable
                //     $('.slick_dots_custom .dot').attr('tabindex', '-1');
            
                //     // Make dots of the current active slide focusable
                //     var $currentSlideDots = $('.slick-slide[data-slick-index="' + currentSlide + '"] .slick_dots_custom .dot');
                //     $currentSlideDots.attr('tabindex', '0');
            
                //     // Set focus to the corresponding dot of the new active slide, based on the last focused dot index
                //     if ($currentSlideDots.eq(lastFocusedDotIndex).length) {
                //         $currentSlideDots.eq(lastFocusedDotIndex).focus();
                //     }
                // });
                
                // Listen for the afterChange event to update tabindex
                $('.slide_wrap.r_<?= $rand; ?>').on('afterChange', function(event, slick, currentSlide) {
                    // Make all dots unfocusable
                    $('.slick_dots_custom .dot').attr('tabindex', '-1');
            
                    // Make dots of the current active slide focusable
                    $('.slick-slide[data-slick-index="' + currentSlide + '"] .slick_dots_custom .dot').attr('tabindex', '0');
                });
            }, 500);
        
            // Bind keypress event to slider arrows
            $('.slick-prev, .slick-next').on('keypress', function(e) {
                if (e.which == 13) { // Enter key
                    if ($(this).hasClass('slick-prev')) {
                        $('.slide_wrap.r_<?= $rand; ?>').slick('slickPrev');
                    } else if ($(this).hasClass('slick-next')) {
                        $('.slide_wrap.r_<?= $rand; ?>').slick('slickNext');
                    }
                }
            });
        
            // Bind keypress event to slider dots
            $('.slick_dots_custom .dot').on('keypress', function(e) {
                if (e.which == 13) { // Enter key
                    $(this).click();
                }
            });
        });
    
        jQuery(document).ready(function($){
            $('.slide_wrap.r_<?= $rand; ?>').slick({
                arrows:true,
                autoplay: false,
                dots: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                prevArrow: $('.slick-prev.r_<?= $rand; ?>'),
                nextArrow: $('.slick-next.r_<?= $rand; ?>'),
                adaptiveHeight: true
            });
            
                function updateArrowColorClass(slideElement) {
                    // Get the essential classes
                    var prevArrowClasses = $('.slick-prev.r_<?= $rand; ?>').attr('class').split(/\s+/).filter(cls => cls.startsWith("slick-") || cls.startsWith("r_")).join(' ');
                    var nextArrowClasses = $('.slick-next.r_<?= $rand; ?>').attr('class').split(/\s+/).filter(cls => cls.startsWith("slick-") || cls.startsWith("r_")).join(' ');
    
                    // Get the data-color value
                    var colorValue = $(slideElement).data('color');
            
                    // Set the new classes
                    $('.slick-prev.r_<?= $rand; ?>').attr('class', prevArrowClasses).addClass(colorValue);
                    $('.slick-next.r_<?= $rand; ?>').attr('class', nextArrowClasses).addClass(colorValue);
                }
            
                updateArrowColorClass('.slick-slider.r_<?= $rand; ?> .slick-current');
                // addFadingStyling('.slick-slider.r_<?= $rand; ?> .slick-current');
                
                // function addFadingStyling(slideElement) {
                //     if($(slideElement).hasClass('enable_background_color_fading')) {
                //         var color = $(slideElement).data("color");
                //         $('.featured_content_slider.r_<?= $rand; ?> > .row').attr('data-color', color);
                //     } else {
                //         $('.featured_content_slider.r_<?= $rand; ?> > .row').attr('data-color', "");
                //     }
                // }
                
          var $slider = $('.slide_wrap.r_<?= $rand; ?>');
          // Slick 'beforeChange' event
          $slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
            // Update custom dots across all slides
            $('.slick_dots_custom').each(function() {
              $('span', this).removeClass('active'); // Remove 'active' class from all dots
              $('span', this).eq(nextSlide).addClass('active'); // Add 'active' class to the corresponding dot in each set
            });
          });
          
          $slider.on('afterChange', function(event, slick, currentSlide, nextSlide){
            updateArrowColorClass('.slick-slider.r_<?= $rand; ?> .slick-current');
          });
        
          // Click event on custom dots
          $('.slick_dots_custom .dot').click(function() {
            var slideIndex = $(this).index(); // Get the index of the clicked dot
            var $allDots = $('.slick_dots_custom').find('.dot').filter(function() {
              return $(this).index() === slideIndex;
            });
        
            // Remove 'active' from all dots and add 'active' to the clicked dot's counterparts
            $('.slick_dots_custom .dot').removeClass('active');
            $allDots.addClass('active');
        
            $slider.slick('slickGoTo', slideIndex); // Go to the slide that matches the dot index
          });
        });
    </script>
<? endif; ?>