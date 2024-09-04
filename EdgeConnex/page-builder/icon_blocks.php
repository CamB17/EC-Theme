<?
$background_color = get_sub_field('background_color');
$show_motion_grid = get_sub_field('show_motion_grid');
$smaller_icons = get_sub_field('smaller_icons');
?>
<? if($show_motion_grid) : ?>
    <img class='background_pattern' src="<?= get_pattern_src($background_color); ?>" alt="background pattern" />
<? endif; ?>
<? if ( get_sub_field('title') ) : ?>
    <div class="row title">
        <div class="column">
            <? if ( get_sub_field('title') ) : ?>
                <h2>
                    <?= get_sub_field('title'); ?>
                </h2>
            <? endif;
            ?>
            <? if ( get_sub_field('description') ) : ?>
            <p><?= get_sub_field('description'); ?></p>
            <? endif; ?>
        </div>
    </div>
<? endif; ?>

<?php if (get_sub_field('icons')): 
    $tile_count = count(get_sub_field('icons'));
    if($tile_count == 4) {
        $col_class = "large-3";
    } else {
        $col_class = "large-4";
    }
?>
    <div class="row icons <?= $smaller_icons ? 'smaller_icons' : '' ?>">
    <?php while(has_sub_field('icons')): 
        $internal_link = get_sub_field('link');
        $external_link = get_sub_field('external_link');
        if($external_link) {
            $link = $external_link;
            $target = "_blank";
        } else {
            $link = $internal_link;
            $target = "_self";
        }
    ?>
        <div class="small-12 medium-6 <?= $col_class; ?> column content-icons">
            <div class='border'></div>
            
            <?php if ($link) : ?>
                <a href="<?= $link; ?>" target="<?= $target; ?>">
            <?php endif; ?>
            <? if(get_sub_field('image')['sizes']['small-square']) : ?>
                <img class='top_img <?= get_sub_field('contain_image') ? "contain_image" : ""; ?>' style="max-width: 100%;" src="<?= get_sub_field('contain_image') ? get_sub_field('image')["url"] : get_sub_field('image')['sizes']['small-square']; ?>" alt="<?= get_sub_field('image')['alt']; ?>">
            <? endif; ?>
            
            <? if ( get_sub_field('title') ) : ?>
                <h3><?= get_sub_field('title'); ?></h5>
            <? endif; ?>
            
            <? if ( get_sub_field('description') ) : ?>
                <?= get_sub_field('description'); ?>
            <? endif; ?>
        <?php if ($link) : ?>
            </a>
        <?php endif; ?>
    
        </div>
        
    <?php endwhile; ?>
    </div>
<?php endif; ?>

