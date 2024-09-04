<?php 

$images = get_sub_field('photos');

if( $images ): ?>

        <div class="photo-slider">
            <?php foreach( $images as $image ): ?>
                <div class="photo-slider-item">
                    <div class="photo-slider-item-wrap">
                        <img src="<?php echo $image['sizes']['split-section']; ?>" alt="<?php echo $image['alt']; ?>" />
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

<?php endif; ?>

<script type="text/javascript">
    jQuery(document).ready(function($){

        $('.photo-slider').slick({
            arrows:true,
            autoplay:false,
            centerMode: false,
            slidesToShow: 1,
            fade: true,
            variableWidth: false,
            dots:false,
            prevArrow:"<img class='slick-prev slick-arrow' src='<?php echo get_template_directory_uri(); ?>/img/icon-slider-left.svg'>",
            nextArrow:"<img class='slick-next slick-arrow' src='<?php echo get_template_directory_uri(); ?>/img/icon-slider-right.svg'>",
        });

    });
</script>