<?

$headline = get_sub_field('headline');

?>

<img class='pattern' src="<?= get_template_directory_uri(); ?>/img/intro_area_motion_grid.svg" alt="" role="presentation" />

<? if (get_sub_field('links')): ?>
    <div class='row'>
        <? if($headline) : ?>
            <div class='column small-12 headline'>
                <h2><?= $headline; ?></h2>
            </div>
        <? endif; ?>
        <? while(has_sub_field('links')): 
            $button_color = get_sub_field('button_color');
            $button_text = get_sub_field('button_text');
            $open_in_a_new_tab = get_sub_field('open_in_a_new_tab');
            $auto_download_parameter = get_sub_field('auto_download_parameter');
            $button_size = get_sub_field('button_size');
            $url_type = get_sub_field('url_type');
            $url = get_sub_field('url');
            $wordpress_content = get_sub_field('wordpress_content');
            $media = get_sub_field('media');
        ?>
            <div class='link_wrap columns small-12 medium-4'>
                <? if($button_text) {
                    ec_button($button_color, $button_text, $open_in_a_new_tab, $auto_download_parameter, $button_size, $url_type, $url, $wordpress_content, $media);
                } ?>
            </div>
        <? endwhile; ?>
    </div>
<? endif; ?>

