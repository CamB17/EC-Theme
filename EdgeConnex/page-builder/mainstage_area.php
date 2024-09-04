<?php if (get_sub_field('slides')): ?> 
    <div class="slides">
	<?php while(has_sub_field('slides')): ?>

        <div class="slide">
            <div class="row wow bounceInUp">
                 <div class="column">
                <? if ( get_sub_field('headline') ) : ?>
                    <h1><?= get_sub_field('headline'); ?></h1>
                <? endif; ?>
                <? if ( get_sub_field('sub_headline') ) : ?>
                    <p class="intro"><?= get_sub_field('sub_headline'); ?></p>
                <? endif; ?>
                <?php if (get_sub_field('buttons')): ?> 
                	<?php while(has_sub_field('buttons')): ?>
                
                        <? ec_button(); ?>
                
                	<?php endwhile; ?>
                
                <?php endif; ?>
                </div>
                <div class="bg-pattern" style="background-image:url('<?= get_sub_field('background_image')['sizes']['mainstage-image']; ?>');">
                    <div class="hold-me">
                        <video fetchpriority="high" preload="auto" id="video--bg" loop="" autoplay="" muted="" webkit-playsinline="" poster="<?= get_sub_field('background_image')['sizes']['mainstage-image']; ?>" style="">
                            <source type="video/mp4" src="<?= get_sub_field('background_video'); ?>">
                        </video>
                    </div>
                </div>
            </div>
        </div>

	<?php endwhile; ?>
    </div>
<?php endif; ?>

<? if ( count(get_sub_field('slides') ) > 1 ) : ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
    
            $('.slides').slick({
                arrows:true,
                autoplay:false,
                autoplaySpeed:3000,
                dots:true
            });
    
        });
    </script>
<? endif; ?>