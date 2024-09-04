<div class="row">
    <?php if (get_sub_field('navigation_items')): ?> 

    	<?php while(has_sub_field('navigation_items')): ?>
    
            <div class="item column">
                <a href="#<?= get_sub_field('element_id'); ?>">
                    <?= get_sub_field('display_text'); ?>
                </a>
            </div>
    
    	<?php endwhile; ?>
    
    <?php endif; ?>
</div>
<script>
// Create a clone of the menu, right next to original.
$('.pb-in-page_navigation').addClass('original').clone().insertAfter('.pb-in-page_navigation').addClass('cloned').css('position','fixed').css('top','120').css('z-index','500').removeClass('original').hide();

scrollIntervalID = setInterval(stickIt, 10);


function stickIt() {

  var orgElementPos = $('.original').offset();
  orgElementTop = orgElementPos.top;
  
   headerHeight = $('header').outerHeight();
   adminBarHeight = $('#wpadminbar').outerHeight();
   
   totalHeight = headerHeight + adminBarHeight;

  if ($(window).scrollTop() >= (orgElementTop - totalHeight)) {
        // scrolled past the original position; now only show the cloned, sticky element.
    
        // Cloned element should always have same left position and width as original element.     
        orgElement = $('.original');
        coordsOrgElement = orgElement.offset();
        leftOrgElement = coordsOrgElement.left;  
        widthOrgElement = orgElement.css('width');
        $('.cloned').css('left',leftOrgElement+'px').css('top',0).css('width',widthOrgElement).show();
        $('.original').css('visibility','hidden');
      } else {
        // not scrolled past the menu; only show the original menu.
        $('.cloned').hide();
        $('.original').css('visibility','visible');
      }
}

</script>
