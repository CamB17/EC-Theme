<?php

$content = get_sub_field('content');
$content_button = get_sub_field('content_button');
$image = get_sub_field('image');
$button_cta_label = get_sub_field('button_cta_label');

?>
<img class='pattern' src="<?= get_template_directory_uri(); ?>/img/intro_area_motion_grid.svg" alt="" role="presentation" />
<div class='row'>
    <div class='columns small-12 <?= $image ? 'large-7 medium-6' : '' ?> content'>
        <? if($content) : ?>
            <?= $content; ?>
        <? endif; ?>
        <? if($content_button) {
            ec_button($content_button['button_color'], $content_button['button_text'], $content_button['open_in_a_new_tab'], $content_button['auto_download_parameter'], $content_button['button_size'], $content_button['url_type'], $content_button['url'], $content_button['wordpress_content'], $content_button['media']);
        } ?>
    </div>
    <? if($image) : ?>
        <div class='columns small-12 medium-6 large-5 image'>
            <div class='wrap'>
                <img src='<?= $image['url']; ?>' alt='<?= $image['alt']; ?>' />
                <? if($button_cta_label) {
                    echo "<span>$button_cta_label</span>";
                } ?>
            </div>
        </div>
    <? endif; ?>
</div>