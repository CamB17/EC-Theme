<?php get_template_part( 'includes/header' ); ?>

<? $type = get_field('resource_type'); ?>  
<? if ( $type == "video" ) : ?>
    
    <section class="video-resource">
        <div class="row">
            <div class="small-12 medium-7 columns content">
                <?= get_field('description'); ?>
                <?= get_field('video_embed_code'); ?>
               
               
            </div>
        </div>
    </section>


    
  
<? elseif ( $type == "success-story" ) : ?>

    <? ec_page_builder(); ?>
    
<? else : ?>

    
<? endif; ?>



<?php get_template_part( 'includes/footer' ); ?>
