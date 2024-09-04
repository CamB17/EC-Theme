<?php get_template_part('includes/header'); 
$bg_color = "default";
$changed = false;
?>

<?php if ( have_posts() ) : ?>
    <section class="blog-archive">
        <?php while ( have_posts() ) : the_post(); ?>
            <?
            if($changed) {
               $bg_color = "light-gray-bg";
               $changed = false;
            } else {
               $bg_color = "default";
               $changed = true;
            }
            if ( get_field('image') ) {
                $image = get_field('image')['sizes']['split-section'];
            } else {
                $image = get_field('default_news_header_image', 'options')['sizes']['split-section'];
            }
            ?>
            <div class="row blog-post <?= $bg_color; ?>">
                <img class='background_pattern' src="<?= get_pattern_src($bg_color); ?>" alt="background pattern" />
                <div class="columns small-11 medium-6 image" style="background-image:url('<?= $image; ?>');"> </div>
                <div class="columns small-12 medium-6 content" >
                    <div class="hold-me">
                        <a href="<? the_permalink(); ?>">
                            <h2><? the_title(); ?></h2>
                        </a>
                        <h4 class='caps'><?= get_the_date(); ?>
                        <?
                        echo get_field('author') ? " by " . get_field('author') : null;
                        ?>
                        </h4>
                        <p>
                            <?
                            // echo wp_trim_words($post->post_content, 40, '...');
                            the_excerpt();
                            ?>
                        </p>
                        <a href="<? the_permalink(); ?>" class="button primary">Read More</a>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>

        <div class="row pagination">
            <div class="small-12 columns">
                <? ec_archive_pagination(); ?>
            </div>
        </div>

    </section>

<?php endif; ?>

<?php get_template_part('includes/footer'); ?>
