<?php
$video = get_field('background_video');
$image = get_field('background_image');
$title = get_field('headline_override');
$subtitle = get_field('sub_headline');
?>


<section class="mainstage-home">
    <div class="inner row">
        <div class="columns small-12 meduim-7 large-7">
            <div class="content">
                <?php if ($title) : ?>
                    <h1><?php echo $title; ?></h1>
                <?php endif; ?>
                <?php if ($subtitle) : ?>
                    <p class="intro"><?php echo $subtitle; ?></p>
                <?php endif; ?>
                <?php if (get_sub_field('buttons')): ?> 
                	<?php while(has_sub_field('buttons')): ?>
                
                        <? ec_button(); ?>
                
                	<?php endwhile; ?>
                
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="bg-video">
        <video fetchpriority="high" preload="auto" id="video--bg" loop="" autoplay="" muted="" webkit-playsinline="" poster="<?= $image['url']; ?>" style="">
            <source type="video/mp4" src="<?php echo $video['url']; ?>">
        </video>
    </div>
    <div class="bg-overlay"></div>
</section>