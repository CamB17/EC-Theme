<?php
$intro = get_sub_field('intro_content');
$post_one_type = get_sub_field('post_one_type');
$post_one = get_sub_field('post_one');
$post_two_type = get_sub_field('post_two_type');
$post_two = get_sub_field('post_two');
$intro_two = get_sub_field('intro_content_two');
$post_three_type = get_sub_field('post_three_type');
$post_three = get_sub_field('post_three');
$intro_content_three = get_sub_field('intro_content_three');

?>
<div class="row expanded">
    <?  
        if(($post_one_type == "text" && $intro) || ($post_one_type == "post" && $post_one)) {
            post_tile($post_one, $intro, "Learn More", $post_one_type, true);
        }
        if(($post_two_type == "text" && $intro_two) || ($post_two_type == "post" && $post_two)) {
            post_tile($post_two, $intro_two, "Learn More", $post_two_type, true);
        }
        if(($post_three_type == "text" && $intro_content_three) || ($post_three_type == "post" && $post_three)) {
            post_tile($post_three, $intro_content_three, "Learn More", $post_three_type, true);
        }
    ?>
</div> 