<?
$sharing_icons = get_field('sharing_icons', 'options');
?>
<div class="social-share">
	<ul class="social-list">
		<? if(is_array($sharing_icons)) : ?>
			<? if (in_array('twitter', $sharing_icons)) : ?>
				<li><a href="https://twitter.com/intent/tweet/?text=<?php echo the_title(); ?> <?php the_permalink(); ?>" target="_blank" title="Tweet"><img src="<?php echo get_template_directory_uri(); ?>/img/icon-social-twitter-blue.svg" alt="share on twitter" /></a></li>
			<? endif; ?>
			<? if (in_array('linkedin', $sharing_icons)) : ?>
			    <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&source=<?php the_permalink(); ?>" target="_blank" title="Share on Linked In" ><img src="<?php echo get_template_directory_uri(); ?>/img/icon-social-linkedin-blue.svg" alt="share on linkedin" /></a></li>
			<? endif; ?>
			<? if (in_array('facebook', $sharing_icons)) : ?>
				<li><a href="https://www.facebook.com/sharer/sharer.php?t=" title="Share on Facebook" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;"><img src="<?php echo get_template_directory_uri(); ?>/img/icon-social-facebook-blue.svg" alt="share on facebook" /></a></li>
			<? endif; ?>
		<? endif; ?>
	</ul>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		  var $sidebar = $(".social-share");
		  var unstick = $sidebar.position().top - 150;
		  var $footer = $("footer");
		  var $header = $("header");

		  $(window).scroll(function() {
		    var scrollTop = $(window).scrollTop();
		    var topPosition = $sidebar.position().top - $header.outerHeight() - 20;
		    var bottomPosition = $footer.offset().top - $sidebar.outerHeight(true) - 175;
		    var footerHeight = $footer.outerHeight(true);
		    if ((scrollTop > topPosition && scrollTop < bottomPosition) && (scrollTop > unstick)) {
		      $sidebar.addClass("stuck");
		      $sidebar.removeClass("bottom");
		    } else {
		    	if(scrollTop < unstick) {
			      $sidebar.removeClass("stuck");
		    	} else {
			      $sidebar.addClass("bottom");
		    	}
		    }
		  });
		  adjust_share_box();
		  function adjust_share_box() {
			var contentPos = $('.post_content').position().left;
			var contentwidth = $('.post_content').outerWidth();
			var totaloffset = contentwidth + contentPos;
			$('.social-share').css('left', totaloffset + 'px');
		  }
  		  $(window).on('resize', function() {
  		  	if($(window).width() > 1500) {
  		  		adjust_share_box();
  		  	} else {
				$('.social-share').css('left', 'auto');
  		  	}
		  })
	});
</script>