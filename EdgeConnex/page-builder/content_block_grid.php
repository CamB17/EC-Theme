<img class='pattern' src="<?= get_template_directory_uri(); ?>/img/intro_area_motion_grid.svg" alt="" role="presentation" />
<div class='row'>
    <? if (get_sub_field('left_blocks')): ?>
        <? while(has_sub_field('left_blocks')): 
                $headline = get_sub_field('headline');
                $content = get_sub_field('content');
                $buttons = get_sub_field('buttons');
                ?>
                <div class='columns small-12 medium-6 left_blocks'>
                    <div class='block'>
                        <? if($headline) : ?>
                            <h2><?= $headline; ?></h2>
                        <? endif; ?>
                        <? if($content) : ?>
                            <?= $content; ?>
                        <? endif; ?>
                        <? if(!empty($buttons)) : ?>
                            <div class='buttons'>
                                <? foreach($buttons as $button) {
                                    ec_button($button['button_color'], $button['button_text'], $button['open_in_a_new_tab'], $button['auto_download_parameter'], $button['button_size'], $button['url_type'], $button['url'], $button['wordpress_content'], $button['media']);
                                } ?>
                            </div>
                        <? endif; ?>
                    </div>
                </div>
            <? endwhile; ?>
    <? endif; ?>
</div>