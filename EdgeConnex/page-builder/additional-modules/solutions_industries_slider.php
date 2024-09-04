<?
    $slider_title = get_sub_field('slider_title');
    $disable_main_slider = get_sub_field('disable_main_slider');
?>
<? if($slider_title) : ?>
    <div class="row industries-heading">
        <div class="small-12 columns">
            <h2>
                <?= $slider_title ?>
            </h2>
        </div>
    </div>
<? endif; ?>
<? $background_color = get_sub_field("background_color"); ?>
<? if(!$disable_main_slider) : ?>
    <img class='background_pattern' src="<?= get_pattern_src($background_color); ?>" alt="background pattern" />
<? endif; ?>
<?php if (get_sub_field('slides') && !$disable_main_slider): ?>
    <div class="solutions-slider">
    	<?php while(has_sub_field('slides')): 
    	//vars
    	$title = get_sub_field('title');
    	$description = get_sub_field('description');
    	$image = get_sub_field('image');
    	$link = get_sub_field('link');
    	$testimonial_content = get_sub_field('content');
    	$testimonial_image = get_sub_field('headshot');
    	$testimonial_credit = get_sub_field('credit');
    	?>
    	<div class="slide">
    	    <div class="row expanded">
        	    <div class="columns small-12 medium-5 content">
        	       <?php if ($title) : ?>
        	            <h2><?php echo $title; ?></h2>
        	       <?php endif; ?>
        	       <?php if ($description) : ?>
        	            <p><?php echo $description; ?></p>
        	       <?php endif; ?>
        	       <?php if ($testimonial_content) : ?>
        	       <div class="testimonial">
        	           <p class="testimonial-content"><?php echo $testimonial_content; ?></p>
        	           <?php if ($testimonial_image) : ?>
        	               <img src="<?php echo $testimonial_image['sizes']['small-square']; ?>" alt="<?php echo $testimonial_image['alt']; ?>" />
        	           <?php endif; ?>
        	           <?php if ($testimonial_credit) : ?>
        	           <span class="testimonial-credit"><?php echo $testimonial_credit; ?></span>
        	           <?php endif; ?>
        	       </div>
        	       <?php endif; ?>
        	       <?php if ($link) : ?>
        	           <a href="<?php echo $link; ?>" class="button primary">Learn More</a>
        	       <?php endif; ?>
        	    </div>
        	    <div class="columns small-12 medium-7 image" style="background-image:url('<?php echo $image['sizes']['split-section']; ?>');"> </div>
            </div>
    	</div>
    
    	<?php endwhile; ?>
    </div>
<?php endif; ?>

<?php if (get_sub_field('slides')): ?>
<div class="solutions-slider-nav <?= $background_color; ?>">
	<?php while(has_sub_field('slides')): 
	//vars
	$title = get_sub_field('title');
	$image = get_sub_field('image');
	if($disable_main_slider) {
    	$image_source = fly_get_attachment_image_src( $image["ID"], array( 500, 500 ), true )['src'];
	} else {
    	$image_source = fly_get_attachment_image_src( $image["ID"], array( 500, 500 ), true )['src'];
	}
	$link = get_sub_field('link');
	?>
	<div class="slide-nav <?= $disable_main_slider ? 'clickable' : '' ?>" data-link="<?= $link ?>">
	    <div class='wrap'>
    	    <?php if ($image) : ?>
                <img class=' <?= $disable_main_slider ? 'tall_image' : '' ?>' src="<?= $image_source; ?>" alt="<?php echo $image['alt']; ?>" />
            <?php endif; ?>
            <?php if ($title) : ?>
                <span><?php echo $title; ?></span>
            <?php endif; ?>
	    </div>
    </div>
	<?php endwhile; ?>
</div>
<?php endif; ?>

<? if ( count(get_sub_field('slides') ) > 1 ) : ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            <? if(!$disable_main_slider) : ?>
                $('.solutions-slider').slick({
                    arrows:true,
                    autoplay:false,
                    dots:false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: true,
                    asNavFor: '.solutions-slider-nav',
                    prevArrow:"<img class='slick-prev slick-arrow' src='<?php echo get_template_directory_uri(); ?>/img/icon-testimonial_left_blue.svg'>",
                    nextArrow:"<img class='slick-next slick-arrow' src='<?php echo get_template_directory_uri(); ?>/img/icon-testimonial_right_blue.svg'>",
                });
            <? endif; ?>
            
            $('.solutions-slider-nav').slick({
                arrows:true,
                autoplay:false,
                dots:false,
                slidesToShow: 5,
                slidesToScroll: 1,
                <? if(!$disable_main_slider) : ?>
                    asNavFor: '.solutions-slider',
                    focusOnSelect: true,
                <? endif; ?>
                <? if($disable_main_slider) : ?>
                    prevArrow:"<img class='slick-prev slick-arrow' src='<?php echo get_template_directory_uri(); ?>/img/chevron-arrow-left-red.svg'>",
                    nextArrow:"<img class='slick-next slick-arrow' src='<?php echo get_template_directory_uri(); ?>/img/chevron-arrow-right-red.svg'>",
                <? endif; ?>
                  responsive: [
                    {
                      breakpoint: 1024,
                      settings: {
                        arrows:false,
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                      }
                    },
                    {
                      breakpoint: 600,
                      settings: {
                        arrows:false,
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                      }
                    },
                  ]
            });
            
            <? if($disable_main_slider) : ?>
                $('.solutions-slider-nav .slick-slide').on('click', function() {
                    let link = $(this).data('link');
                    if(link) {
                        window.location = link;
                    }
                })
            <? endif; ?>
            
        //     if ( $(window).width() > 840) {
        //         var stHeight = $('.solutions-slider .slick-track').height();
        //         $('.slide .content').css('height',stHeight + 'px' );
        //     }
           
        //   var stHeight = $('.solutions-slider-nav .slick-track').height();
        //   $('.slide-nav').css('height',stHeight + 'px' );
           
    
        });
        
         //After page load, swap aria-controls title so that it actually controls something and is not flagged for ADA. 
         $(window).load(function(){
             $('.slick-dots li').each(function(){
                    var newurl = $(this).attr('aria-controls').replace('navigation','slick-slide');
                    $(this).attr('aria-controls', newurl);
                });
         });
    </script>
<? endif; ?>