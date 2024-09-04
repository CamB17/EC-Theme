<?php get_template_part('includes/header'); ?>

<?php if ( have_posts()  ) : $counter = 1; ?>
    <section class="news-archive">
        <?php while ( have_posts() ) : the_post(); ?>
            <? if($counter == 1) : ?>
                <div class='group_wrapper'>
                    <div class="row">
            <? endif; ?>
                    <div class="small-12 medium-4 large-4 columns blog_post_tile" >
                        <div class="hold-me">
                            <a href="<? the_permalink(); ?>" class='title'>
                                <h4><? the_title(); ?></h4>
                            </a>
                            <h5 class="caps"><?= get_the_date(); ?></h5>
                            <p>
                                <?
                                $original_string = strip_tags($post->post_content);
                                $max_length = 250; // Maximum length of the truncated string
                                
                                if (strlen($original_string) > $max_length) {
                                    $truncated_string = substr($original_string, 0, $max_length) . "...";
                                } else {
                                    $truncated_string = $original_string;
                                }
                                
                                echo $truncated_string;
                                ?>
                            </p>
                            <a href="<? the_permalink(); ?>" class="button primary">Read More</a>
                        </div>
                    </div>
            <? if($counter == 3) : ?>
                    </div>
                </div>
            <? endif; ?>
        <?php if($counter == 3) { $counter = 1; } else { $counter++; } endwhile; ?>
        <div class="row pagination">
            <div class="small-12 columns">
                <? ec_archive_pagination(); ?>
            </div>
        </div>
    </section>

<?php endif; ?>

<?php get_template_part('includes/footer'); ?>
