<? if (get_sub_field('logo_grid')): ?>
    <div class='row'>
        <? while(has_sub_field('logo_grid')): 
            $image = get_sub_field('image');
            $content = get_sub_field('content');
            $col_class = $content ? "has_content" : "no_content";
        ?>
            <div class='<?= $col_class; ?> image_block'>
                <? if($image) : ?>
                    <div class='image'>
                        <img src='<?= $image['url']; ?>' alt='<?= $image['alt']; ?>' />
                    </div>
                <? endif; ?>
                <? if($content) : ?>
                    <div class='content'>
                        <p><?= $content; ?></p>
                    </div>
                <? endif; ?>
            </div>
        <? endwhile; ?>
    </div>
<? endif; ?>

