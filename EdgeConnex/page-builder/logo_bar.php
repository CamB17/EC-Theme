<?
    $headline = get_sub_field('headline');
    $subheadline = get_sub_field('subheadline');
    $background_color = get_sub_field('background_color');
    $show_motion_grid = get_sub_field('show_motion_grid');
?>
<? if($show_motion_grid) : ?>
    <img class='background_pattern' src="<?= get_pattern_src($background_color); ?>" alt="background pattern" />
<? endif; ?>
<div class='row'>
    <div class='column small-12 text-center'>
        <? if($headline) : ?>
            <h2><?= $headline; ?></h2>
        <? endif; ?>
        <? if (get_sub_field('images')): ?>
            <div class='logo_row'>
            	<? while(has_sub_field('images')): 
            	    $image = get_sub_field('image'); 
            	    $link = get_the_permalink(get_sub_field('link'));
            	    $target = "_self";
            	    $external_link = get_sub_field('external_link'); 
            	    if($external_link) {
                	    $target = "_blank";
            	        $link = $external_link;
            	    }
            	    ?>
            	    <? if($link) : ?>
            	        <a href='<?= $link; ?>' target="<?= $target; ?>">
            	    <? endif; ?>
                    <img src="<?= $image["url"]; ?>" alt="<?= $image["alt"]; ?>" />
            	    <? if($link) : ?>
                	    </a>
            	    <? endif; ?>
            	<? endwhile; ?>
            </div>
        <? endif; ?>
        <? if($subheadline) : ?>
            <h4 class='blue'><?= $subheadline; ?></h4>
        <? endif; ?>
        <a href="/contact-us/" class='button primary'>Let's Get Started</a>
    </div>
</div>