<?php
 $rand = rand(0,99999);
 $video = get_sub_field('video_embed_url');
 $image = get_sub_field('video_thumbnail_image');
?>

<section class="video-holder">
  <img src="<?php echo $image['url'];; ?>" data-video="<?php echo $video; ?>?autoplay=1" title="Play Video" id="video-embed-<?php echo $rand; ?>" class="video__placeholder" alt="<?= $image['alt']; ?>"/>
    <button class="video__button" id="video-button-<?php echo $rand; ?>">Watch Video</button>
</section>

<script>
    $('#video-embed-<?php echo $rand; ?>, #video-button-<?php echo $rand; ?>').on('click', function() {
  if ( !$('#video-player').length ) {
    var video = '<iframe id="video-player" src="' + $('#video-embed-<?php echo $rand; ?>').attr('data-video') + '" frameborder="0" allowfullscreen wmode="opaque" autoplay="1"></iframe>';
    $(video).insertAfter( $('#video-embed-<?php echo $rand; ?>') );
    $('#video-button-<?php echo $rand; ?>').addClass('is-playing');
    setTimeout(function(){
      $('#video-player').click();
    }, 300);
  } else {
    $('#video-button-<?php echo $rand; ?>').removeClass('is-playing');
    $('#video-player').remove();
  }
});
</script>