<?
$images = get_sub_field('images');
?>

<div class="gallery_wrap">
	<? foreach ($images as $item) : 
		$image_src = $item["image"]['sizes']["full-page-gallery"];
		$add_video = $item["add_video"];
		$video_embed_code = $item["video_embed_code"];
	    $rand = rand(1000,9999999);
	    $content_class = "";
	    $popup_id = "";
	    $popup_href = "";
		if ( $video_embed_code && $add_video) :
		    $content_class = "trigger-video-popup";
		    $popup_id = "split-video-" . $rand;
		    $popup_href = 'href="#' . $popup_id . '"';
		endif;
	?>
		<div class='image r_<?= $rand; ?> <?= $content_class; ?>' style="background-image: url(<?= $image_src; ?>);" <?= $popup_href; ?>>
			<? if($video_embed_code && $add_video) : ?>
	            <div class="play_video"></div>
	        <? endif; ?>
		</div>
		<? if ( $video_embed_code ) : ?>
		    <div id="<?= $popup_id; ?>" class="white-popup mfp-hide">
		        <?= $video_embed_code; ?>
		    </div>
		<? endif; ?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				jQuery('.trigger-video-popup.r_<?= $rand; ?>').magnificPopup({
			      type:'inline',
			      midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
			    });
			});
		</script>
	<? endforeach; ?>
</div>