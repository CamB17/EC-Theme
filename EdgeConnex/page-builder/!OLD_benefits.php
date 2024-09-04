<?php
//vars
$title = get_sub_field('section_title');
$content = get_sub_field('section_content');
$random = rand(10000,100000);
?>
<?php if ($title || $content) : ?>
<div class="row section-title">
    <div class="small-12 medium-7 large-6 columns">
        <?php if ($title) : ?>
            <h2><?php echo $title; ?></h2>
        <?php endif; ?>
        <?php if ($content) : ?>
            <p><?php echo $content; ?></p>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<div class="row expanded">
     <div class="small-12 large-6 columns benefit-panel">
        <?php if (get_sub_field('benefit')): ?> 
        <div class="tabs-content" data-tabs-content="example-tabs-<?= $random; ?>">
            <?
            $counter = 1;
            ?>
    	    <?php while(has_sub_field('benefit')):
    	    $title = get_sub_field('title');
    	    $content = get_sub_field('content');
    	    $image= get_sub_field('image');
    	    ?>
          <div class="tabs-panel  <? if ( $counter == 1 ) : echo "is-active"; endif; ?>" id="benefit-panel-<?= $random; ?>-<?= $counter; ?>">
            <div class="row align-top">
                <?php if ( $image) : ?>
                <div class="small-12 medium-4 columns image-wrap">
                    <div class="image">
                        <img src="<?php echo $image['sizes']['small-square']; ?>" alt="<?php echo $image['alt']; ?>" />
                    </div>
                </div>
                <?php endif; ?>
                <div class="small-12 medium-8 columns">
                    <div class="content">
                        
                    <h3 class="panel-title"><?php echo $title; ?></h3>
                    <?php if ($content) : ?>
                        <p><?php echo $content; ?></p>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
          </div>
            <? $counter++; ?>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="small-12 large-6 columns benefit-tab">
        <?php if (get_sub_field('benefit')): ?> 
        <ul class="tabs" data-tabs id="example-tabs-<?= $random; ?>">
            <?
            $counter = 1;
            $total_count = count(get_sub_field('benefit'));
            ?>
    	    <?php while(has_sub_field('benefit')):
    	    $title = get_sub_field('title');
    	    $icon = get_sub_field('icon');
    	    
    	    if ( $total_count == 1 || $total_count == 2 || $total_count == 4 ) {
    	        $class = "two-per";
    	    } else {
    	        $class = "three-per";
    	    }
    	    ?>
                <li class="tabs-title <?= $class; ?> <? if ( $total_count == 2 ) : echo 'has-2'; endif; ?> <? if ( $counter == 1 ) : echo "is-active"; endif; ?>">
                    <a href="#benefit-panel-<?= $random; ?>-<?= $counter; ?>" aria-selected="true" class="benefit-clicky">
                        <?php if ( $icon) : ?>
                            <img class="icon" src="<?php echo $icon['sizes']['small-square']; ?>" alt="<?php echo $icon['alt']; ?>" />
                        <?php endif; ?>
                        <? if ( $title ) : ?>
                            <span class="title"><?php echo $title; ?></span>
                        <? endif; ?>
                    </a>
                </li>
            <? $counter++; ?>
            <?php endwhile; ?>
        
        </ul>
        <?php endif; ?>
    </div>
</div>