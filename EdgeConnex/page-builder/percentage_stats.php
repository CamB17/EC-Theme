<?php

$headline = get_sub_field('headline');

?>
<div class='row'>
    <div class='columns small-12'>
        <? if($headline) : ?>
            <h2><?= $headline; ?></h2>
        <? endif; ?>
        <? if (get_sub_field('stat_boxes')): ?>
            <div class='boxes'>
                <? while(has_sub_field('stat_boxes')): 
                    $image = get_sub_field('image');
                    $stat_number = get_sub_field('stat_number');
                    $box_content = get_sub_field('box_content');
                ?>
                    <div class='box column'>
                        <div>
                            <? if($image) : ?>
                                <img src='<?= $image['url']; ?>' alt='<?= $image['alt']; ?>' />
                            <? endif; ?>
                            <h3><?= $stat_number; ?></h3>
                        </div>
                        <? if($box_content) : ?>
                            <span><?= $box_content; ?></span>
                        <? endif; ?>
                    </div>
                <? endwhile; ?>
            </div>
        <? endif; ?>
    </div>
</div>

<script type="text/javascript">
  function animatePercentages() {
    const $section = $('.pb-percentage_stats');
    const $boxes = $section.find('.box');

    $(window).on('scroll', function() {
      const windowHeight = $(window).height();
      const scrollTop = $(window).scrollTop();
      const sectionTop = $section.offset().top;
      const sectionHeight = $section.outerHeight();

      if (scrollTop + windowHeight >= sectionTop + sectionHeight) {
        $boxes.each(function() {
          const $box = $(this);
          $box.addClass('animate');
          const percentageText = $box.find('h3').text();
          const hasPercentSymbol = percentageText.includes('%');
          const percentage = parseInt(percentageText);
          const duration = 2500; // Animation duration in milliseconds (3 seconds)
          const startTime = performance.now();

          const tick = () => {
            const elapsedTime = performance.now() - startTime;
            const progress = Math.min(elapsedTime / duration, 1);
            const easedProgress = easeOutCubic(progress);
            const currentValue = Math.floor(easedProgress * percentage);
            $box.find('h3').text(currentValue + (hasPercentSymbol ? '%' : ''));

            if (progress < 1) {
              requestAnimationFrame(tick);
            }
          };

          requestAnimationFrame(tick);
        });

        $(window).off('scroll');
      }
    });
  }

  // Easing function for slowing down the animation towards the end
  function easeOutCubic(t) {
    return 1 - Math.pow(1 - t, 3);
  }

  // Call the function when the DOM is loaded
  $(document).ready(animatePercentages);
</script>