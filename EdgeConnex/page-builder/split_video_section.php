<?php
 $rand = rand(0,99999);
 $video = get_sub_field('video_embed_url');
 $image = get_sub_field('video_thumbnail_image');
 $layout = get_sub_field('layout') ? get_sub_field('layout') : "video_right_content_left";
?>

    <div class="row <?= $layout; ?>">
        <div class="columns small-12 medium-5 content">
            <div class="hold-me">
                <?= get_sub_field('title'); ?>
            </div>
        </div>
        <div class="columns small-12 medium-7 video">
        <div class="video-holder">
            <img src="<?php echo $image['url']; ?>" alt="<?= $image['alt']; ?>" data-video="<?php echo $video; ?>?autoplay=1" title="Play Video" id="video-embed-<?php echo $rand; ?>" class="video__placeholder" />
            <button class="video__button" id="video-button-<?php echo $rand; ?>">Watch Video</button>
        </div>
    
        </div>
    </div>



<script>
    $('#video-embed-<?php echo $rand; ?>, #video-button-<?php echo $rand; ?>').on('click', function() {
  if ( !$('#video-player').length ) {
    var video = '<iframe id="video-player" src="' + $('#video-embed-<?php echo $rand; ?>').attr('data-video') + '" frameborder="0" allowfullscreen wmode="opaque" "?autoplay=1></iframe>';
    $(video).insertAfter( $('#video-embed-<?php echo $rand; ?>') );
    $('#video-button-<?php echo $rand; ?>').addClass('is-playing');
  } else {
    $('#video-button-<?php echo $rand; ?>').removeClass('is-playing');
    $('#video-player').remove();
  }
});
</script>
