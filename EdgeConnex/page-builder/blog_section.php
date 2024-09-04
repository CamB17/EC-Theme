<div class="pb-blog_section">
    <div class="row title-area">
        <div class="column wrapper">
            <div class="row inner-row">
                <div class="small-12 medium-6 column title">
                    <h2><?= get_sub_field('title'); ?></h2>
                </div>
                <div class="small-12 medium-6 column link">
                    <a href="<?= get_sub_field('link_url'); ?>" class="button">
                        <?= get_sub_field('link_name'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row posts">
        <?
        $queryArray = array(
            'post_type' => 'post',
            'posts_per_page' => 3
        );
        ?>
        
        <? $loop = new WP_Query( $queryArray ); ?>
        
        <? if ( $loop->have_posts() ) : ?>
            
            <? while ( $loop->have_posts() ) : $loop->the_post(); ?>
                
                <div class="column post small-12 medium-4">
                    <div class="image" style="background-image:url('<?= get_field('image')['sizes']['gallery-thumbnail']; ?>');">
                        
                    </div>
                    <div class="hold-me">
                        <h4><? the_title(); ?></h4>
                        <p class="meta">By <? the_author(); ?>, <?= get_the_date(); ?></p>
                        <p class="categories">
                            <?
                            echo get_the_category_list( ', ', '', get_the_ID() );
                            ?>
                        </p>
                        <a href="<?= get_the_permalink(); ?>" class="button">
                            Learn More
                        </a>
                    </div>
                </div>
            <? endwhile; ?>
           
        <? endif; ?>
        
        <? wp_reset_postdata(); ?>
    </div>
</div>