<?php
//vars
$title = get_sub_field('title');
$description = get_sub_field('description');
$background_color = get_sub_field('background_color');
$show_motion_grid = get_sub_field('show_motion_grid');
?>
    <? if($show_motion_grid) : ?>
        <img class='background_pattern' src="<?= get_pattern_src($background_color); ?>" alt="background pattern" />
    <? endif; ?>
    <div class="bg-image-wrapper">
        <div class="bg-image"></div>
        <div class="row align-middle inner">
            <div class="content">
                <? if ( $title ) : ?>
                    <h2><?= get_sub_field('title'); ?></h2>
                <? endif; ?>
                <?php if ( $description ) : ?>
                    <p class='h4-style'><?= get_sub_field('description'); ?></p>
                <?php endif; ?>
            </div>
            <?php if (get_sub_field('buttons')): ?>
                <div class="buttons columns shrink">
                	<?php while(has_sub_field('buttons')): ?>
                        <? ec_button(); ?>
                	<?php endwhile; ?>
                </div>
            <?php endif; ?>
     
        </div>
    </div>
    
     <script type="text/javascript">
        jQuery(document).ready(function($){
            //Set link to entire project block, since wrapping in an <a> tag isn't accessible.
            $(".bg-image-wrapper").click(function() {
                if($(this).find("a.button").attr("href")) {
                  window.location = $(this).find("a.button").attr("href"); 
                  return false;
                }
            });
        });
    </script>
