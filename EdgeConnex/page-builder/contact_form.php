<?php

if (get_sub_field('override_content')) :
    $header = get_sub_field('form_header');
    $content = get_sub_field('form_content');
else:
    $header = get_field('default_contact_form_header', 'options');
    $content = get_field('default_contact_form_content', 'options');
endif;

if (get_sub_field('override_background_color')) :
    $form_background_color = get_sub_field('form_background_color') ?: "white";
else:
    $form_background_color = get_field('default_form_background_color', 'options') ?: "white";
endif;

if (get_sub_field('override_form')) :
    $id = get_sub_field('form_id');
else:
    $id = get_field('default_contact_form_id', 'options');
endif;

if (get_sub_field('override_contact_person')) :
    $headshot= get_sub_field('headshot');
    $info = get_sub_field('contact_info');
else:
    $headshot= get_field('default_contact_person_headshot', 'options');
    $info = get_field('default_contact_person_info', 'options');
endif;
switch ($form_background_color) {
    case 'white':
        $pattern_source = get_template_directory_uri() . "/img/form_pattern_white.svg";
    break;
    case 'gray':
        $pattern_source = get_template_directory_uri() . "/img/form_pattern_gray.svg";
    break;
    case 'blue':
        $pattern_source = get_template_directory_uri() . "/img/form_pattern_blue.svg";
    break;
}
?>
<div class='contact_form_wrapper <?= $pattern_position; ?> <?= $form_background_color; ?>' id="pb_contact_form">
    <img class='bg_pattern' src="<?= $pattern_source; ?>" alt="Presentation" role="presentation" />
    <div class="row" id="contact">
        <div class="small-12 columns">
            <div class="contact-info">
                <div class="contact-content" id="contact">
                    <?php if ($header) : ?>
                        <h3><?= $header; ?></h3>
                    <?php endif; ?>
                    <?php if ($content) : ?>
                        <?= $content; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="small-12 columns">
            <div class="contact-form">
                <?= gravity_form($id, false, false, false, '', true, ''); ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var found = false;
        setTimeout(function(){
            $('.gform_wrapper').each(function() {
                if(!found) {
                    found = true;
                } else {
                    if(!$(this).find(".gfield--type-captcha iframe").length) {
                        $(this).find('.gform_footer').addClass('no_iframe');
                    }
                }
            })
        }, 1000);
    })
</script>