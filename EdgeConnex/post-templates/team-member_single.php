<?php get_template_part( 'includes/header' ); 
$archive_button_override = get_field('archive_button_override');
$label = $archive_button_override["label"] ?: "Return to Team Members";
$url = $archive_button_override["url"] ?: "/company/management-team/";
$hide_button = $archive_button_override["hide_button"];
?>

<section class="team-member-single">
    <div class="row">
        <? if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="small-12 medium-3 columns">
                <? $image = get_field('headshot'); ?>
                <div class="image">
                    <img src="<?= $image['sizes']['portrait-medium']; ?>" alt="<?= $image['alt']; ?>">
                </div>
                
            </div>
            <div class="small-12 medium-9 columns">
                <?= get_field('bio'); ?>
            </div>
            <? endwhile; ?>
        <? endif; ?>
        <? if(!$hide_button) : ?>
          <div class="column small-12 medium-5 back_to">
             <a href="<?= $url; ?>" class="button primary">
                 <?= $label; ?>
             </a>
          </div>
        <? endif; ?>
    </div>
</section>

<?php get_template_part( 'includes/footer' ); ?>
