<?
if ( get_field('image') ) {
    $image = get_field('image')['sizes']['blog-post'];


} else {
    $image = get_field('default_news_header_image', 'options')['sizes']['blog-post'];
}
?>
<div class="row blog-post" >

    <div class="small-12 medium-6 columns image" style="background-image:url('<?= $image; ?>');" onclick="document.location='<?= get_the_permalink(); ?>';">

    </div>

    <div class="small-12 medium-6 columns info align-middle" >
        <div class="hold-me">
            <a href="<? the_permalink(); ?>">
                <h4><? the_title(); ?></h4>
            </a>
            <h6><?= get_the_date(); ?>
            <?
            echo get_field('author') ? " by " . get_field('author') : null;
            ?>
            </h6>
            <p>
                <?= wp_trim_words($post->post_content, 40, '...') ?>
            </p>
            <a href="<? the_permalink(); ?>" class="button">Read More &raquo;</a>
        </div>
    </div>
</div>