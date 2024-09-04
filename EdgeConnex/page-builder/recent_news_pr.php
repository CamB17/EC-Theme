<div class="shape">
    <div class="row heading">
        <div class="column title">
            <h2>
                <? if ( get_sub_field('title_override') ) : ?>
                    <?= get_sub_field('title_override'); ?>
                <? else : ?>
                    Recent News
                <? endif; ?>
                
            </h2>
        </div>
        <div class="column cta shrink">
            <a href="/news/press-releases/" class="button primary">
                View All News
            </a>
        </div>
    </div>
</div>
<div class="row articles">
    <?
    $num = 3;
    $queryArray = array(
        'post_type' => 'news',
        'posts_per_page' => $num
    );
  
    ?>
    
    <? $loop = new WP_Query( $queryArray ); ?>
    
    <? if ( $loop->have_posts() ) : ?>
        
        <? while ( $loop->have_posts() ) : $loop->the_post(); ?>
            
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
    
        <? endwhile; ?>
       
    <? endif; ?>

<? wp_reset_postdata(); ?>
</div>
