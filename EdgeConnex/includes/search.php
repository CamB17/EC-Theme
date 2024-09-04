<?php get_template_part( 'includes/header' ); ?>

<section class="search-results">
    <div class="row small-up-1 medium-up-2 large-up-3">

        <?php
        global $post;
        if ( have_posts() ) : while ( have_posts() ) : the_post();
        
            if ($post->post_type == 'resource'):
                continue;
            endif;
            
            $post_id = get_the_ID();
            $btn_label = "Read More";
            post_tile($post_id, null, $btn_label);
            
            $url = ''; 
        endwhile; ?>
        
        </div>
                
        <?php else : ?>
        
        <h3>Sorry, there were no search results.</h3>

        <?php endif; ?>
        <?php
        // Restore original Post Data
        wp_reset_postdata();
        ?>

    </div>
</section>

<?php get_template_part( 'includes/footer' ); ?>
