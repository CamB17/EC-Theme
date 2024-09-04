<?
$headline = get_sub_field('headline');
$source_type = get_sub_field('source_type') ? get_sub_field('source_type') : 'manual';
if($source_type == "manual") {
    $posts = get_sub_field('newsroom_posts');
} else {
    $tag_id = get_sub_field('tag');
    $posts = array();
    $queryArray = array(
        'post_type' => array('newsroom', "news", "post"),
        'posts_per_page' => -1,
        'no_found_rows' => true,
        'orderby' => 'publish_date',
        'order' => 'DESC',
    );
    $taxQuery = array(
        array(
            'taxonomy' => 'Slider Tag',
            'field'    => 'term_id',
            'terms'    => $tag_id,
        )
    );
    $queryArray['tax_query'] = $taxQuery;
    $query = new WP_Query( $queryArray );
    if($query->have_posts()) :
        while($query->have_posts()) : $query->the_post();
            array_push($posts, get_the_ID());
        endwhile; wp_reset_postdata();
    endif;
}

$slide_count = 0;
if($posts) {
    $slide_count = count($posts);
}
$top_button = get_sub_field('top_button');

if ($posts) :  ?>
    <div class='top_area'>
        <? if($headline || $top_button) : ?>
            <div class='row'>
                <? if($headline) : ?>
                    <div class='column small-12'>
                        <h2><?= $headline; ?></h2>
                        <? if($top_button) : ?>
                            <? ec_button($top_button['button_color'], $top_button['button_text'], $top_button['open_in_a_new_tab'], $top_button['auto_download_parameter'], $top_button['button_size'], $top_button['url_type'], $top_button['url'], $top_button['wordpress_content'], $top_button['media']); ?>
                        <? endif; ?>
                    </div>
                <? endif; ?>
            </div>
        <? endif; ?>
    </div>
    <div class="newsroom_slider">
        <div class='row'>
            <? if ( $slide_count > 3 ) : ?>
                <img tabindex='1' class='slick-prev slick-arrow' src='<?= get_template_directory_uri(); ?>/img/icon_arrow_left_blue_dark.svg' alt="Previous Slide" />
                <img tabindex='1' class='slick-next slick-arrow' src='<?= get_template_directory_uri(); ?>/img/icon_arrow_right_blue_dark.svg' alt="Next Slide" />
            <? endif; ?>
            <div class='columns small-12 slide_wrap'>
            	<? foreach ($posts as $post_id) :
                    echo display_single_newsroom($post_id, false, $slide_count);
                endforeach; ?>
            </div>
        </div>
    </div>
<? endif; ?>

<? if ( $slide_count > 3 ) : ?>
    <script type="text/javascript">    
        jQuery(document).ready(function($){
            $('.slide_wrap').slick({
                arrows: true,
                autoplay: false,
                dots: false,
                slidesToShow: 3,
                slidesToScroll: 1,
                prevArrow: $('.slick-prev'),
                nextArrow: $('.slick-next'),
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 640,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
        });
    </script>
<? endif; ?>