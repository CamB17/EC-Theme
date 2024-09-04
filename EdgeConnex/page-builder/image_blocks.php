<? if ( get_sub_field('title') ) : ?>
<!--<img src="<?php echo get_template_directory_uri(); ?>/img/motion-grid/<?php echo $folder; ?>/motion_grid_new.png)" class='' alt="grid">-->
    <div class="row title">
        <div class="column small-12 <?php if (get_sub_field('show_motion_grid')) : ?>medium-8 large-7<?php else: ?>medium-12<?php endif; ?>">
            <? if ( get_sub_field('title') ) : ?>
                <h2 class='h2_title_ani'>
                    <?= get_sub_field('title'); ?>
                </h2>
            <? endif;
            ?>
            <? if ( get_sub_field('description') ) : ?>
            <p><?= get_sub_field('description'); ?></p>
            <? endif; ?>
        </div>
        <div class='column small-12 large-5 text-right'>
            <!--<a href="/solution" class="button solutions_button"> See All Solutions </a>-->
        </div>
    </div>
<? endif; ?>
<?
    $column_type = get_sub_field('logo_columns');
?>

<?php if (get_sub_field('image_block')): $count = 1;?>
    <div class="row image-blocks" style="justify-content: center;" data-equalizer data-equalize-by-row="true" data-equalize-on="medium">
    <?php while(has_sub_field('image_block')): 
    //vars
    $title = get_sub_field('title');
    $content = get_sub_field('description');
    $image = get_sub_field('image');
    $icon = get_sub_field('icon');
    $link = get_sub_field('link');
    $showExternal = get_sub_field('show_external_link');
    $external = get_sub_field('external_link');
    ?>
        <div class="small-12 medium-12 columns block_<?= $count; ?> <? echo $column_type; ?>">
            <div class="image-block <?= $link ? 'is_link' : '' ?>">
                <?php if ($title || $content) : ?>
                    <div onclick="<?= $link ? "location.href='$link';" : "" ?>" class="content <?= $link ? "is_link" : "" ?>" style="background: linear-gradient(180deg, rgba(255,255,255,0.1) 0%, rgba(38,1,32,1) 70%), url('<?php echo $image['sizes']['gallery-thumbnail']; ?>');">
                        <?php if ($title) : ?>
                            <h4 class='tile_content_<?= $count; ?>'>
                               <? echo $title; ?>
                            </h4>
                        <?php endif; ?>
                        
                        <?php if ($content) : ?>
                        <div class="content_holder" data-equalizer-watch>
                            <div class='tile_content_<?= $count; ?>'>
                                <?php echo $content; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ($icon) : ?>
                            <img src="<?php echo $icon['sizes']['thumbnail']; ?>" class="icon ani_icon_<?= $count; ?>" alt="<?= $icon['alt']; ?>">
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
              <!--  <div class="image" style="background-image: url('<?php echo $image['sizes']['gallery-thumbnail']; ?>'); ?>">
                </div> -->
            </div>
        </div>
    <?php $count++; endwhile; ?>
    </div>
<?php endif; ?>

<script type="text/javascript">
	jQuery(document).ready(function($){

    const postCells = document.querySelectorAll('.image-block');
    Array.prototype.forEach.call(postCells, postCell => {
        let down, up, link = postCell.querySelector('.link');
        postCell.onmousedown = () => down = +new Date();
        postCell.onmouseup = () => {
            up = +new Date();
            if ((up - down) < 200) {
                link.click();
            }
        }
        postCell.style.cursor = 'pointer';
    });

	});
</script>

<? if(get_sub_field('enable_animation')) : ?>
    <script src="<?= get_template_directory_uri(); ?>/scripts/gsap/gsap.min.js"></script>
    <script src="<?= get_template_directory_uri(); ?>/scripts/gsap/ScrollTrigger.min.js"></script>
    <script type="text/javascript">
        gsap.registerPlugin(ScrollTrigger);
        
        let tl = gsap.timeline({
          scrollTrigger: {
            trigger: ".pb-image_blocks",
            start: "60% bottom", // start animation when the top % of #target hits the bottom of the viewport
            end: "top 10%", // end animation when the bottom of #target hits the center
            scrub: 1, // will take 3 seconds to catch up to the scroll position
          }
        });
        
        tl.from(".h2_title_ani", {
          x: "30px", // starting off-screen from left
          y: "20px", // starting off-screen from top
          autoAlpha: 0, // starting fully transparent
          duration: 1.5
        })
        .from(".columns.block_1", {
          x: "-150px", // starting off-screen from left
          y: "150px", // starting off-screen from top
          autoAlpha: 0, // starting fully transparent
          rotation: 20, // starting with a full 10-degree rotation
          duration: 2, // how long the animation should take
        }, "+=0.5")
        .from(".columns.block_2", {
          x: "0", // starting off-screen from right
          y: "-75px", // starting off-screen from top
          autoAlpha: 0, // starting fully transparent
          rotation: -10, // starting with a full 10-degree rotation in the opposite direction
          duration: 2, // how long the animation should take
        }, "-=1.5")
        .from(".columns.block_3", {
          x: "65px", // starting off-screen from right
          y: "-75px", // starting off-screen from top
          autoAlpha: 0, // starting fully transparent
          rotation: 10, // starting with a full 10-degree rotation in the opposite direction
          duration: 2, // how long the animation should take
        }, "-=1.5")
        .from(".ani_icon_1", {
          x: "-15px", // starting off-screen from right
          y: "20px", // starting off-screen from top
          autoAlpha: 0, // starting fully transparent
        })
        .from(".ani_icon_2", {
          x: "-15px", // starting off-screen from right
          y: "20px", // starting off-screen from top
          autoAlpha: 0, // starting fully transparent
        }, "-=0.1")
        .from(".ani_icon_3", {
          x: "-15px", // starting off-screen from right
          y: "20px", // starting off-screen from top
          autoAlpha: 0, // starting fully transparent
        }, "-=0.1")
        .from(".tile_content_1", {
          x: "15px", // starting off-screen from right
          y: "20px", // starting off-screen from top
          autoAlpha: 0, // starting fully transparent
        }, "-=0.4")
        .from(".tile_content_2", {
          x: "15px", // starting off-screen from right
          y: "20px", // starting off-screen from top
          autoAlpha: 0, // starting fully transparent
        }, "-=0.1")
        .from(".tile_content_3", {
          x: "15px", // starting off-screen from right
          y: "20px", // starting off-screen from top
          autoAlpha: 0, // starting fully transparent
        }, "-=0.1")
        .from(".tile_button_1", {
          x: "5px", // starting off-screen from right
          y: "10px", // starting off-screen from top
          autoAlpha: 0, // starting fully transparent
        }, "-=0.4")
        .from(".tile_button_2", {
          x: "5px", // starting off-screen from right
          y: "10px", // starting off-screen from top
          autoAlpha: 0, // starting fully transparent
        }, "-=0.1")
        .from(".tile_button_3", {
          x: "5px", // starting off-screen from right
          y: "10px", // starting off-screen from top
          autoAlpha: 0, // starting fully transparent
        }, "-=0.1")
    </script>
<? endif; ?>