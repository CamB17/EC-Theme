<? 
function alert_bar() {
    $show_alert_bar = get_field('show_alert_bar', 'options');
    if($show_alert_bar) {
	    echo "<div class='alert_bar_wrap'>";
		$background_color = get_field('background_color', 'options');
		$content = get_field('ab_content', 'options');
		$link_text = get_field('link_text', 'options');
		$link_type = get_field('link_type', 'options');
		if($link_type == "url") {
			$link_url = get_field('link_url', 'options');
		} else {
			$link_url = get_the_permalink(get_field('wordpress_content', 'options'));
		}
		if($content || $link_text || $link_url) :
			if(!isset($_COOKIE['global']) && $_COOKIE['global'] != "closed") : ?>
				<div class="alert-bar global <?= $background_color; ?>">
					<div>
						<? if($content) : ?>
							<p> <?= $content; ?>
						<? endif; ?>
						<? if($link_text && $link_url) : ?>
							<a href="<?= $link_url; ?>"><?= $link_text; ?></a>
						<? endif; ?>
						<? if($content) : ?>
							</p>
						<? endif; ?>
						<span class='alert_close global'><img src="<?= get_template_directory_uri(); ?>/img/close_alert.svg" alt="close bar" /></span>
					</div>
				</div>
				<script type="text/javascript">
				jQuery(document).ready(function($) {
					$('header').addClass('has_alertbar');
					$('body > section:first-of-type').addClass('has_alertbar');
					$('.alert_close.global').on('click', function() {
					    $alert_bar = $(this).parents('.alert-bar.global');
					    $alert_bar_height = $alert_bar.outerHeight();
						$alert_bar.slideUp('fast');
						Cookies.set('global', 'closed');
						$('header').removeClass('has_alertbar');
						$('.alert_bar_wrap').addClass('hidden');
						$('body > section:first-of-type').removeClass('has_alertbar');
					})
				})
				</script>
			<? endif; endif;
	    echo "</div>";
    }
} ?>