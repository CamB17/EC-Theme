<?php get_template_part( 'includes/header' );?>
<?= get_template_part('includes/social-share'); ?>

<section class="post-single">
    <div class="row">
        <div class="post_content small-12 medium-10 medium-offset-1 columns">
            <? if ( have_posts() ) : while ( have_posts() ) : the_post();
            $pdf = get_field('pdf');
            ?>

                <? the_content(); ?>
                <div class="bottom-buttons">
                    <?php if ($pdf && 0) : ?>
                        <a href="<?php echo $pdf['url']; ?>" target="_blank" class="button pdf-btn">Download PDF</a>
                    <?php endif; ?>
                    <a href="/news/press-releases/" class="button primary">
                        Back to News
                    </a>
                </div>
            <? endwhile; else : ?>

            <? endif; ?>
        </div>
    </div>
    

	
</section>


<?php get_template_part( 'includes/footer' ); ?>
