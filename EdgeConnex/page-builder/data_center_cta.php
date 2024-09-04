<?php
$headline = get_sub_field('headline');
//$motion_grid_video = get_field('motion_grid_video');
$sub_headline = get_sub_field('sub_headline');
$right_label = get_sub_field('right_label');
$background_image = get_sub_field('background_image');
$button_text = get_sub_field('button_text') ? get_sub_field('button_text') : "Learn More";
if ( get_sub_field('button_text') ) :

   $target =
      get_sub_field('open_in_a_new_tab')
      ? "target='_blank'"
      : "";

   $color = get_sub_field('button_color');

   $size =
      get_sub_field('button_size') == "large"
      ? "large"
      : ""
      ;

      if(get_sub_field('url_type') == "URL"){
         $url = get_sub_field('url');

      } elseif(get_sub_field('url_type') == "wordpress_content") {
         $url = get_the_permalink(get_sub_field('wordpress_content'));

      } else {
         $url = get_sub_field('media');
         $url = $url->guid;
     }
endif;
$display_new_headline = get_sub_field('display_new_headline');
?>

<div class='background' style="background: url('<?= $background_image; ?>');"></div>
<div class="row">
    <div class="column">
       <div>
           <? if($display_new_headline) : ?>
               <h3 class="after_click_h3">NEW</h3>
           <? endif; ?>
           <h2><?= $headline; ?></h2>
       </div>
       <p class="sub_headline large"> <?= strip_tags($sub_headline); ?> </p>
       <a href="<?= $url; ?>" class="button primary"><?= $button_text; ?></a>
    </div>
</div>
 <div class="right_label_container">
     <p><?= strip_tags($right_label); ?></p>
 </div>
