<?
$image = get_sub_field('background_image');
$video_embed_code = get_sub_field('video_embed_code');
if ( $video_embed_code ) :
    $rand = rand(1000,9999999);
    $row_class .= " video ";
    $content_class = "trigger-video-popup";
    $popup_id = "split-video-" . $rand;
    $popup_href = 'href="#' . $popup_id . '"';
endif;
$include_pattern = get_sub_field('include_pattern');
$background_color = get_sub_field('background_color');
if ( get_sub_field('layout') == "image_right_content_left" ) :
    $row_class .= "content-first";
endif;
?>

<div class="row <?= $row_class; ?>">

    <? if($include_pattern) : ?>
        <img class='background_pattern' src="<?= get_pattern_src($background_color); ?>" alt="background pattern" />
    <? endif; ?>
    <div class="columns small-11 medium-6 image <?= $content_class; ?>" style="background-image:url('<?= $image['sizes']['split-section']; ?>" <?= $popup_href; ?>>
        <? if($video_embed_code) : ?>
            <div class="play_video"></div>
        <? endif; ?>
    </div>
    <div class="columns small-12 medium-6 content">
        <div class="hold-me">
            <? if ( get_sub_field('title') ) : ?>
                <h2><?= get_sub_field('title'); ?></h2>
            <? endif; ?>
            <?= get_sub_field('content'); ?>
            <?php if (get_sub_field('icons')): ?> 
                <div class="icons row">
            	<?php while(has_sub_field('icons')): ?>
                    <div class="column logo small-6 medium-4">
                    <? if ( get_sub_field('website') ) : ?>
                        
                        <a href="<?= get_sub_field('website'); ?>" target="_blank">
                    <? endif; ?>
                            <img src="<?= get_sub_field('logo')['sizes']['medium']; ?>" alt="<?= get_sub_field('logo')['alt']; ?>">
                    <? if ( get_sub_field('website') ) : ?>
                        </a>
                    <? endif; ?>
                    </div>
                
            	<?php endwhile; ?>
                </div>
            <?php endif; ?>
            <?php if (get_sub_field('buttons')): ?> 
            
            	<?php while(has_sub_field('buttons')): ?>
            
                    <? ec_button(); ?>
            
            	<?php endwhile; ?>
            
            <?php endif; ?>
        </div>
    </div>
</div>

<? if ( $video_embed_code ) : ?>

    <div id="<?= $popup_id; ?>" class="white-popup mfp-hide">
        <?= $video_embed_code; ?>
    </div>
    <script type="text/javascript">
    	jQuery(document).ready(function($){
    		
    		jQuery('.trigger-video-popup').magnificPopup({
              type:'inline',
              midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
            });
    
    	});
    </script>

<? endif; ?>