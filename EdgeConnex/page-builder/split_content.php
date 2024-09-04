<?php
$background_color = get_sub_field('background_color');
$layout = get_sub_field('layout');
$image = get_sub_field('image');
$rounded_corner = get_sub_field('rounded_corner');
$content = get_sub_field('content');
$buttons = get_sub_field('buttons');

?>
<? if($background_color == 'light-gray-bg') : ?>
    <img class='pattern' src="<?= get_template_directory_uri(); ?>/img/intro_area_motion_grid.svg" alt="" role="presentation" />
<? endif; ?>
<div class='row <?= $layout; ?>'>
    <div class='columns small-12 medium-6 large-5 content'>
        <? if($content) : ?>
            <?= $content; ?>
        <? endif; ?>
        <? if(!empty($buttons)) {
            foreach($buttons as $button) {
                ec_button($button['button_color'], $button['button_text'], $button['open_in_a_new_tab'], $button['auto_download_parameter'], $button['button_size'], $button['url_type'], $button['url'], $button['wordpress_content'], $button['media']);
            }
        } ?>
    </div>
    <? if($image) : ?>
        <div class='columns small-12 large-7 medium-6 image <?= $rounded_corner ? 'rounded_corner' : '' ?>'>
            <div class='wrap'>
                <img src='<?= $image['url']; ?>' alt='<?= $image['alt']; ?>' />
            </div>
        </div>
    <? endif; ?>
</div>