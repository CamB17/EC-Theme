<?php get_template_part( 'includes/header' );?>

<section class="post-single">
    <div class="row">
        <div class="small-12 columns">
            <? if ( have_posts() ) : while ( have_posts() ) : the_post();
          
            ?>

                <?= get_field('long_description'); ?>
                <div class="bottom-buttons" style="margin-top:30px;">
                
                    <a href="/news/events/" class="button secondary">
                        Back to Events
                    </a>
                </div>
            <? endwhile; else : ?>

            <? endif; ?>
        </div>
    </div>
    

	
</section>


<?php get_template_part( 'includes/footer' ); ?>
