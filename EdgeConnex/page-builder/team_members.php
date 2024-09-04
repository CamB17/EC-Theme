<?
    $headline = get_sub_field('headline');
    $use_condensed_design = get_sub_field('use_condensed_design');
?>
<? if($headline) : ?>
    <div class='row headline'>
        <div class='column small-12'>
            <h2><?= $headline; ?></h2>
        </div>
    </div>
<? endif; ?>
<div class="row team-members <?= $use_condensed_design ? 'use_condensed_design' : '' ?>">
    <?
    $type = get_sub_field('type');
    $term = get_term($type[0], 'Department');
    $sustainability = false;

    if ($term && !is_wp_error($term)) {
        $type_name = $term->name;
        if($type_name == "Sustainability") {
            $sustainability = true;
        }
    }


    $queryArray = array(
        'post_type' => 'team-member',
        'posts_per_page' => -1,
        'no_found_rows' => true,
    );
    if(!empty($type)) {
        $taxQuery = array(
        array(
                'taxonomy' => 'Department',
                'field'    => 'id',
                'terms'    => $type,
            )
        );
        $queryArray['tax_query'] = $taxQuery;
    }
    ?>
    
    <? $loop = new WP_Query( $queryArray ); ?>
    
    <? 
        $department = get_sub_field("department_type");
        $managment = get_sub_field('managment');
        $board_member = get_sub_field('board-member');
        
        
        
        
        
    
    if ( $loop->have_posts() ) : ?>
        
        <? while ( $loop->have_posts() ) : $loop->the_post(); 
            
            $mode = get_field('mode');
            if ( $mode == "bio" ) {
                $link_url = get_the_permalink();
                $link_text = "Learn More";
                $new_tab = false;
            } elseif ( $mode == "custom_link" ) {
                if (have_rows('custom_link')):
                
                	while(have_rows('custom_link')): the_row();
                
                        $link_url = get_sub_field('link_url');
                        $link_text = get_sub_field('link_text');
                        $new_tab = get_sub_field('new_tab');
                        
                	endwhile;
                
                endif;
            } elseif ( $mode == "no_link") {
                $link_url = false;
            }
        ?>
        
            <div class="team-member  columns small-12 <?= get_sub_field('team_member_columns'); ?>">
                <div class="hold-me <?= $sustainability ? 'is_sustainability' : '' ?>" 
                    <? if(!$sustainability) : ?>
                        <? if ( $new_tab && $link_url ) { ?>
                            onclick="javascript:window.open('<?= $link_url; ?>')"
                        <? } elseif ( $link_url ) { ?>
                            onclick="javascript:window.location.href='<?= $link_url; ?>'"
                        <? } else { ?>
                            style="cursor:auto;"
                        <? } ?>
                    <? endif; ?>
                >
                    <div class="image" <? ec_bg_image('headshot', 'portrait-medium', 0, 0); ?>>
                        
                    </div>
                    <div class="content" <?= $mode == "no_link" ? "style='padding-bottom:0px;'" : ""; ?>>
                        <h3>
                            <?     
                            $title = get_the_title(); 
                            echo $title;
                            if(get_field('name_override')) {
                                // $name = "";
                                // $name_line_1 = get_field('name_line_1');
                                // $name_line_2 = get_field('name_line_2');
                                // if($name_line_1) {
                                //     $name .= "$name_line_1";
                                // }
                                // if($name_line_2) {
                                    // $name .= "<br>$name_line_2";
                                // }
                                // echo $name;
                            } else {
                                // Split the title into an array of words
                                $words = explode(" ", $title, 2); // the third parameter is a limit. It'll split the string into a maximum of two parts.
                                
                                // Put a break after the first word
                                $break_title = "";
                                if(count($words) > 1) { // if there's more than one word
                                    $break_title = $words[0] . "<br>" . $words[1]; // Add a line break after the first word
                                } else {
                                    $break_title = $words[0]; // If there's only one word, just use that.
                                }
                                // echo $break_title;
                            }
                            ?>
                        </h3>
                        <p>
                            <?= get_field('title'); ?>
                        </p>
                        <? if ( $link_url && !$sustainability) { ?>
                            <a href="<?= $link_url; ?>" class="button primary" 
                                <?= $new_tab ? "target='_blank'" : ""; ?>
                            >
                                <?= $link_text; ?>
                            </a>
                        <? } ?>
                      
                    </div>
                </div>
            </div>
    
        <? endwhile; ?>
       
    <? endif; ?>
    
    
    <? wp_reset_postdata(); ?>
</div>