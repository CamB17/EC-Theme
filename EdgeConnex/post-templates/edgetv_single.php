<?php get_template_part( 'includes/header' ); ?>

<section class="edgetv-single">
    <div class="row">
        <div class="small-12 columns">
            <? if ( have_posts() ) : while ( have_posts() ) : the_post(); 
            //variables
        	$title = get_the_title();
        	$video = get_field('video');
        	$content_long = get_field('description');
        	$content = wp_trim_words( $content_long, 20, '...' );
            ?>
            <h6><a href="/news/edgetv/">EdgeTV</a></h6>
            <h1><?php echo $title; ?></h1>
             <div class="video-embed">
	            <?php echo $video; ?>
	        </div>
	        <div class="content">
	        	<div class="inner">
		            <?php if ($content_long) : ?><p><?php echo $content_long ; ?></p><?php endif; ?>
		        </div>
		        <!--<a href="<?php echo $link; ?>" class="button tertiary">Read More</a>-->
	        </div>

      
                <div class="bottom-buttons">
                    <a href="/news/edgetv/" class="button secondary">
                        Back to EdgeTV
                    </a>
                </div>
            <? endwhile; else : ?>

            <? endif; ?>
        </div>
    </div>


</section>


<?php get_template_part( 'includes/footer' ); ?>
