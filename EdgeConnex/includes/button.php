<?
function ec_button($color = "", $button_text = "", $open_in_a_new_tab = null, $auto_download_parameter = "", $button_size = "", $url_type = "", $url = "", $wordpress_content = "", $media = "") {
    
    // Use provided parameters if set, otherwise fall back to ACF fields
    $button_text = $button_text ?: get_sub_field('button_text');
    
    if (!$button_text) {
        return;
    }

    $color = $color ?: get_sub_field('button_color');
    
    $open_in_a_new_tab = $open_in_a_new_tab !== null ? $open_in_a_new_tab : get_sub_field('open_in_a_new_tab');
    $target = $open_in_a_new_tab ? "target='_blank'" : "";
    
    $auto_download_parameter = $auto_download_parameter ?: get_sub_field('auto_download_parameter');
    
    $button_size = $button_size ?: get_sub_field('button_size');
    $size = $button_size == "large" ? "large" : "";
    
    $url_type = $url_type ?: get_sub_field('url_type');

    if ($url_type == "URL") {
        $final_url = $url ?: get_sub_field('url');
    } elseif ($url_type == "wordpress_content") {
        $content_id = $wordpress_content ?: get_sub_field('wordpress_content');
        $final_url = get_the_permalink($content_id);
    } else {
        $media_field = $media ?: get_sub_field('media');
        $final_url = is_object($media_field) ? $media_field->guid : $media_field;
    }

    ?>
    <a href="<?= esc_url($final_url); ?>" class="button <?= esc_attr($size); ?> <?= esc_attr($color); ?>" <?= $target; ?> data-download_attr="<?= esc_attr($auto_download_parameter); ?>">
        <?= esc_html($button_text); ?>
    </a>
    <?php
}
