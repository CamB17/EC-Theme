<? $random = rand(10000,100000); 
    $background_color = get_sub_field('background_color');
    $show_motion_grid = get_sub_field('show_motion_grid');
?>
<? if($show_motion_grid) : ?>
    <img class='background_pattern' src="<?= get_pattern_src($background_color); ?>" alt="background pattern" />
<? endif; ?>
<script src="<?php echo get_template_directory_uri(); ?>/scripts/vendor/jquery.pietimer.min.js"></script>
<div class="testimonials-wrap">
    <? if(get_sub_field('testimonial_headline')) : ?>
        <h2><?= get_sub_field('testimonial_headline'); ?></h2>
    <? endif; ?>
    <div class="testimonials-holder holder-<?= $random; ?>">
        <?php
            if ( get_sub_field('choose_testimonials') ) : 
                
                $posts = get_sub_field('choose_testimonials');
    
                foreach( $posts as $postID ): 
                    displayTestimonial($postID);
                endforeach;
                    
            else :
                $queryArray = array(
                    'post_type' => 'testimonial',
                    'posts_per_page' => 3,
                    //'orderby' => 'rand'
                );
                $loop = new WP_Query( $queryArray );
                if ( $loop->have_posts() ) :
                    while ( $loop->have_posts() ) : $loop->the_post();
                    
                        displayTestimonial(get_sub_field(get_the_ID()));
                
                    endwhile;
                endif;
                wp_reset_postdata();
            endif;
    
        ?>
    </div>  
    <div class='arrows r-<?= $random; ?>'>
        <div class='wrap'>
            <? if($background_color == "dark-gray-bg" || $background_color == "dark-blue-bg" ) : ?>
                <img class='slick-prev slick-arrow' src='<?php echo get_template_directory_uri(); ?>/img/icon-testimonial_left.svg' />
                <img class='slick-next slick-arrow' src='<?php echo get_template_directory_uri(); ?>/img/icon-testimonial_right.svg' />
            <? else : ?>
                <img class='slick-prev slick-arrow' src='<?php echo get_template_directory_uri(); ?>/img/icon-testimonial_left_blue.svg' />
                <img class='slick-next slick-arrow' src='<?php echo get_template_directory_uri(); ?>/img/icon-testimonial_right_blue.svg' />
            <? endif; ?>
        </div>
    </div>
    <?php
        if ( get_sub_field('choose_testimonials') ) : 
            $posts = get_sub_field('choose_testimonials');
            $count = 0;
            ?>
            <div class="testimonials-nav nav-<?= $random; ?> <?php if ($total_count == 1 ) : ?>nav-one<?php endif; ?>">
                <?
                foreach( $posts as $postID ):  
                    displayTestimonialNav($postID);
                $count++;
                endforeach; ?>
            </div>
        <?php else :
            $queryArray = array(
                'post_type' => 'testimonial',
                'posts_per_page' => 3,
                'orderby' => 'rand'
            );
            $loop = new WP_Query( $queryArray );
            if ( $loop->have_posts() ) :
                $total_count = $queryArray->post_count;
                $count = 0; ?>
                <div class="testimonials-nav nav-<?= $random; ?> <?php echo $total_count ;  if ($total_count == 1 ) : ?>nav-one<?php endif; ?>">
                <?php
                while ( $loop->have_posts() ) : $loop->the_post(); 
                
                displayTestimonialNav(get_sub_field(get_the_ID()));
            
                $count++;
                endwhile; ?>
            </div>
        <?php endif; wp_reset_postdata(); endif;
    ?>
</div>
<?php if ($count > 1 ) : $slide_show = $count; ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
    
            $('.holder-<?= $random; ?>').slick({
                asNavFor: '.nav-<?= $random; ?>',
                arrows:true,
                adaptiveHeight: true,
                fade: true,
                autoplay:false,
                autoplaySpeed:10000,
                dots:true,
                slidesToShow: 1,
                centerMode: true,
                infinite: true,
                prevArrow: $('.arrows.r-<?= $random; ?> .slick-prev'),
                nextArrow: $('.arrows.r-<?= $random; ?> .slick-next')
            })
            
            .on('afterChange', function( e, slick, currentSlide ) {
                  $('.slick-slide canvas').remove();
                  $('.slick-current .pietimer').pietimer({
                    seconds: 10,
                    color: '#de3439',
                    height: 114,
                    width: 114
                  });
                  $('.slick-current .pietimer').pietimer('start');
                });
                
            $('.nav-<?= $random; ?>').slick({
              slidesToShow: <?php echo $slide_show; ?>,
              asNavFor: '.holder-<?= $random; ?>',
              vertical: false,
              dots: false,
              autoplay:false,
              arrows: false,
              centerMode: false,
              focusOnSelect: true,
              infinite: false,
              responsive: [
                {
                  breakpoint: 640,
                  settings: {
                    vertical: false,
                  }
                },
            ],
            });
            

            
            
            $('.slick-current .pietimer').pietimer({
            seconds: 10,
            color: '#de3439',
            height: 114,
            width: 114
          });
          $('.slick-current .pietimer').pietimer('start');
            
    
        });
    </script>
    
    
<?php endif; ?>