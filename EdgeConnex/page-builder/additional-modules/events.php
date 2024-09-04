<?php
$foundTags = array();
$loop = new WP_Query( array( 'post_type' => 'event', 'posts_per_page' => '-1' ) );
if ( $loop->have_posts() ) :
    while ( $loop->have_posts() ) : $loop->the_post();
        $tags = get_field('tags');
        if ( is_array($tags) ) {
            foreach ( $tags as $tag ) {
                if ( !in_array($tag, $foundTags) ) {
                    $foundTags[] = $tag;
                }
            }
        }
    endwhile;
endif;
wp_reset_postdata();
$bg_color = "default";
$changed = false;
if (get_sub_field('no_events_message')): ?>
    <div class="row no-events" style="max-width: 75rem;">
        <h3>There are currently no events</h3>
    </div>
<? endif; ?>

<div class="section-container">
    <div class="event-container">
        <?
        $loop = new WP_Query(
            array(
                'post_type'         => 'event',
                'posts_per_page'    => '10',
                'meta_query'        => array(
                    array(
                        'key'           => 'featured',
                        'compare'       => '=',
                        'value'         => '1',
                    )
                )
            )
        );
        ?>

        <?php if ( $loop->have_posts() ) : ?>

            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

                <?php displayEvent(get_the_ID(), $bg_color); ?>

            <?php endwhile; ?>

        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

        <?php
        $today = date('Y-m-d H:i:s');
        $loop = new WP_Query(array(
        'post_type'         => 'event',
        'posts_per_page'    => '-1',
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
            array(
                'relation'  => 'OR',
                array(
                    'key'       => 'featured',
                    'compare'   => '!=',
                    'value'     => '1'
                ),
                array(
                    'key'       => 'featured',
                    'compare'   => 'NOT EXISTS'
                )
            )
        ),
        ));
        $totalPosts = $loop->post_count;

        if ( $loop->have_posts() ) : 
            while ( $loop->have_posts() ) : $loop->the_post();
                if($changed) {
                   $bg_color = "light-gray-bg";
                   $changed = false;
                } else {
                   $bg_color = "default";
                   $changed = true;
                }
                displayEvent(get_the_ID(), $bg_color);
            endwhile; endif; wp_reset_postdata(); ?>
    </div>
</div>