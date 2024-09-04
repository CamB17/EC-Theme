<?php
/*
Template Name: Page Builder
*/

get_template_part( 'includes/header' ); ?>

<?
while (have_posts()) : the_post();

    if ( ! post_password_required() ) {
       
       ec_page_builder();
    } else { ?>
        <div class="row" style="margin:20px auto 40px;">
            <div class="column small-12 medium-6 large-4">
                <? echo get_the_password_form(); ?>
            </div>
        </div>
    <? 
    }
   

endwhile;
?>


<?php get_template_part( 'includes/footer' ); ?>
