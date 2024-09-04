<?php get_template_part( 'includes/header' ); ?>
<?= get_template_part('includes/social-share'); ?>
<section class="post-single">
    <div class="row">
        <div class="post_content small-12 medium-10 medium-offset-1 columns">
        <? if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <? the_content(); ?>
        <div class="bottom-buttons">
            <a href="/news/edge-blog/" class="button primary">
                Back to Blogs
            </a>
        </div>
            <? endwhile;?>
        <? endif; ?>
        </div>
    </div>
</section>


<?php get_template_part( 'includes/footer' ); ?>
