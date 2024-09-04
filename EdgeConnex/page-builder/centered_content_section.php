<?php
$intro = get_sub_field('title');
$content = get_sub_field('content');
?>

    
<? if (get_sub_field('colored_motion_grid')) :	?>
	<div class="left-colored<?php echo $folder; ?>">
		<img src="<?php echo get_template_directory_uri(); ?>/img/gm-sep-1-colored-1.svg" alt="" role="presentation">
	</div>
	<div class="title-motion-grid-map-colored <?php echo $folder; ?>">
 		<img src="<?php echo get_template_directory_uri(); ?>/img/gm-sep-2-color.svg" alt="" role="presentation">
	</div>
    <div class="headline row">
        <div class="column title small-12" >
            <h2><?php echo get_sub_field('title'); ?></h2>
            <?php echo get_sub_field('content'); ?>
        </div>
    </div>
			
<? else: ?>
			
	<div class="title-motion-grid-left<?php echo $folder; ?>">
		<img src="<?php echo get_template_directory_uri(); ?>/img/gm-sep-1.svg" alt="" role="presentation">
	</div>
	<div class="title-motion-grid-map <?php echo $folder; ?>">
 		<img src="<?php echo get_template_directory_uri(); ?>/img/gm-sep-2.svg" alt="" role="presentation">
	</div>
	<div class="headline row">
        <div class="column title small-12" >
            <h2><?php echo get_sub_field('title'); ?></h2>
            <?php echo get_sub_field('content'); ?>
        </div>
    </div>
    
<? endif;?>