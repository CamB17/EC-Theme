<?php
/*
Template Name: Edge TV
*/

get_template_part( 'includes/header' );

$bg_color = "default";
$changed = false;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
// WP_Query arguments
$args = array(
	'post_type'              => array( 'edgetv' ),
	'post_status'            => array( 'publish' ),
	'order'                  => 'DESC',
	'orderby'                => 'date',
	'posts_per_page'		 =>	6,
	'nopaging'				 => false,
	'paged' 				 => $paged,
);

// The Query
$query = new WP_Query( $args );
$count = 1;
?>

<?php if ( $query->have_posts() )  : ?>
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
	    <? if($changed) {
	       $bg_color = "light-gray-bg";
	       $changed = false;
	    } else {
	       $bg_color = "default";
	       $changed = true;
	    } ?>
	    <div class='edgetv_wrapper <?= $bg_color; ?> <?= $count == 1 ? "no_top_padding" : "" ?>'>
			<div class="row edgetv-row ">
			    <img class='background_pattern' src="<?= get_pattern_src($bg_color); ?>" alt="background pattern" />
				<?
				//variables
				$index = rand(0, 999);
				$title = get_the_title();
				$video = get_field('video');
				
				$video_id = explode("/embed/", $video);
				$video_id = $video_id[1];
				
			    $rand = rand(1000,9999999);
			    $content_class = "trigger-video-popup";
			    $popup_id = "split-video-" . $rand;
			    $popup_href = 'href="#' . $popup_id . '"';
				
				if (get_field('video_thumbnail')) :
					$video_thumbnail= get_field('video_thumbnail')['sizes']['split-section'];
				else:
					$video_thumbnail="https://img.youtube.com/vi/".$video_id."/mqdefault.jpg";
				endif;
			
				$content_long = get_field('description');
				$play_button_icon_color = get_field('play_button_icon_color') ?: "#FFFFFF";
				$content = wp_trim_words( $content_long, 20, '...' );
				$link = get_the_permalink();
				?>
				<div class="small-12 medium-6 columns edgetv-columns <?= $content_class; ?>" <?= $popup_href; ?>>
				    <div class="edgetv-tile" data-open="videoModal-<?php echo $index; ?>">
				        <div class="video-image <?php echo $class; ?>"  style="background-image:url('<?php echo $video_thumbnail; ?>');">
			                <div class="video-hover" >
			                    <div class="play_video">
			                    	<svg width="168px" height="168px" viewBox="0 0 168 168" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
									    <title>Fill 1</title>
									    <g id="Mockups" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									        <g id="EdgeConneX-Page-Builder---Elements-R1" transform="translate(-1312.000000, -14040.000000)" fill="<?= $play_button_icon_color; ?>">
									            <g id="Split-Section-Image-Right" transform="translate(0.000000, 13491.000000)">
									                <path d="M1396,717 C1384.5214,717 1373.6686,714.795 1363.45,710.385 C1353.2314,705.975 1344.3064,699.9564 1336.675,692.325 C1329.0436,684.6936 1323.025,675.7686 1318.615,665.55 C1314.205,655.3314 1312,644.4786 1312,633 C1312,621.3786 1314.205,610.4586 1318.615,600.24 C1323.025,590.0214 1329.0436,581.13 1336.675,573.57 C1344.3064,566.01 1353.2314,560.025 1363.45,555.615 C1373.6686,551.205 1384.5214,549 1396,549 C1407.6214,549 1418.5414,551.205 1428.76,555.615 C1438.9786,560.025 1447.87,566.01 1455.43,573.57 C1462.99,581.13 1468.975,590.0214 1473.385,600.24 C1477.795,610.4586 1480,621.3786 1480,633 C1480,644.4786 1477.795,655.3314 1473.385,665.55 C1468.975,675.7686 1462.99,684.6936 1455.43,692.325 C1447.87,699.9564 1438.9786,705.975 1428.76,710.385 C1418.5414,714.795 1407.6214,717 1396,717 L1396,717 Z M1376,669 L1432,633 L1376,597 L1376,669 Z" id="Fill-1"></path>
									            </g>
									        </g>
									    </g>
									</svg>
			                    </div>
			                </div>
			            </div>
				    </div>
				</div>
				<div class='small-12 medium-6 columns'>
			        <div class="content">
			        	<div class="inner" data-equalizer-watch>
				            <h4 class="video-title"><?php echo $title; ?></h4>
				            <?php if ($content_long) : ?><p class="video-content"><?php echo $content; ?></p><?php endif; ?>
				        </div>
				        <!--<a href="<?php echo $link; ?>" class="button tertiary">Read More</a>-->
			        </div>
				</div>
			    <div id="<?= $popup_id; ?>" class="white-popup mfp-hide iframe_wrapper">
			       <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $video_id; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
			    </div>
			    <script type="text/javascript">
			    	jQuery(document).ready(function($){
			    		
			    		jQuery('.trigger-video-popup').magnificPopup({
			              type:'inline',
			              midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
			            });
			    
			    	});
			    </script>
			</div>
	    </div>
	<?php $count++; endwhile; ?>

	<?php
	$total_pages = $query->max_num_pages;

    if ($total_pages > 1) :

        $current_page = max(1, get_query_var('paged')); ?>
        <div class="row pagination">
            <div class="small-12 columns">
				<?php
			        echo paginate_links(array(
			            'base' => get_pagenum_link(1) . '%_%',
			            'format' => '/page/%#%',
			            'current' => $current_page,
			            'total' => $total_pages,
			            'total' => $total_pages,
			            'mid_size' => 5,
				        'prev_next' => True,
				        'prev_text' => __('&laquo;'),
				        'next_text' => __('&raquo;'),
				        'type' => 'list'
			        )); ?>
			   <?php  endif; ?>   
			 </div>
			</div>
			
<?php endif;

// Restore original Post Data
wp_reset_postdata();
?>

<?php get_template_part( 'includes/footer' ); ?>
