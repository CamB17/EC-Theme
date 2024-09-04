<div class="row heading">
    <? if ( get_sub_field('optional_title') ) : ?>
        <div class="column title">
            <h2><?= get_sub_field('optional_title'); ?></h2>
        </div>
    <? endif; ?>
    <div class="column cta shrink">
            <a href="/news/events/" class="button primary">
                View All Events
            </a>
        </div>
    <? if ( get_sub_field('optional_description') ) : ?>
        <div class="small-12 columns description">
            <?= get_sub_field('optional_description'); ?>
        </div>
    <? endif; ?>
</div>
<div class="row featured-events">
    <?
    $totalEvents = get_sub_field('number_of_events');
    $today = date('Y-m-d H:i:s');
    $loop = new WP_Query(
        array(
            'post_type' => 'event',
            'posts_per_page' => $totalEvents,
            'order'             => 'ASC',
            'orderby'           => 'meta_value',
            'meta_key'          => 'start_date',
            'meta_type'         => 'DATE',
            'meta_query' => array(
                'relation'      => 'AND',
                array(
                    'key'       => 'start_date',
                    'compare'   => '>=',
                    'value'     => $today,
                    'type'      => 'DATETIME'
                ),
            ),
        )
    );
    ?>

    <? if ( $loop->have_posts() ) : ?>

        <? while ( $loop->have_posts() ) : $loop->the_post(); ?>

            <?
            if ( get_field('image') ) {
                $image = get_field('image')['sizes']['blog-post'];


            } else {
                $image = get_field('default_event_image', 'options')['sizes']['blog-post'];
            }
            ?>

            <div class="small-12 medium-<?= 12 / $totalEvents; ?> columns">
                <div class="event" onclick=“javascript:window.location.href=‘<? the_permalink(); ?>’”>
                <div class="image" style="background-image:url('<?= $image; ?>'); ?>"></div>
                <div class="info">
                    <h3 class="h4-style"><? the_title(); ?></h3>
                    
                    <p class="event-date h6-style"><?= get_field('start_date', $eventID); ?>
                    <?php if ( get_field('end_date') ) { ?>
                        - <?= get_field('end_date', $eventID); ?>
                    <?php } ?>
                </p>
            
                    <a href="<? the_permalink(); ?>" class="button tertiary">
                        Read More
                    </a>
                </div>
            </div>
            </div>


        <? endwhile; ?>
            
        <? else : ?>
            <h3>Check back for upcoming events.</h3>
            
            <style>
                .button {
                    display: none;
                }
            </style>

    <? endif; ?>

    <? wp_reset_postdata(); ?>

</div>

 <script type="text/javascript">
    // jQuery(document).ready(function($){
      
    //     //Set link to entire project block, since wrapping in an <a> tag isn't accessible.
    //     $(".event").click(function() {
    //       window.location = $(this).find("a").attr("href"); 
    //       return false;
    //     });
    // });
  
</script>