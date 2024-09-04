<a href="#" target="_blank" class='download_new_tab' style='display: none;'>download</a>
<footer>
   <div class="main-footer">
      <div class="row top">
         <div class="columns small-12 large-5">
            <span class="footer-title">
               <a href="/contact-us/">Contact</a>
            </span>
            <div class='left'>
               <?= get_field('address','options'); ?>
            </div>
            <div class='right'>
               <?= get_field('phone','options'); ?>
               <?= get_field('email','options'); ?>
            </div>
         </div>
         <div class="columns small-12 large-6">
            <span class="footer-title">Site Map</span>
            <? ec_menu("menu-header", "menu-footer", null, "3"); ?>
         </div>
         <div class="columns small-12 large-1">
             <?php if (get_field('social_icons', 'options')): ?>
               <div class="social">
               	<?php while(has_sub_field('social_icons', 'options')): ?>
                     <a href="<?= get_sub_field('link_url', 'options'); ?>" target="_blank" class="social-link">
                        <img src="<?= get_sub_field('icon')['sizes']['thumbnail']; ?>" alt="<?= get_sub_field('icon')['alt']; ?>">
                     </a>
               	<?php endwhile; ?>
               </div>
            <?php endif; ?>
         </div>
      </div>
      <div class='row bottom'>
         <div class="columns">
            <? if ( get_field('copyright_notice','options') ) : ?>
               <? 
               $notice = get_field('copyright_notice','options'); 
               echo "<span>" . str_replace('[year]', date('Y'), $notice) . "</span>";
               ?>
            <? endif; ?>
            <?php if (get_field('sub_footer_links', 'options')): ?> 
            	<?php while(has_sub_field('sub_footer_links', 'options')): ?>
                  <a href="<?= get_sub_field('link_url'); ?>">
                     <?= get_sub_field('link_text'); ?>
                  </a>
            	<?php endwhile; ?>
            <?php endif; ?>
         </div>
      </div>
   </div>
</footer>


<? wp_footer(); ?>

<script>
   jQuery(document).ready(function($) {
      $(document).foundation();
      $('ul.menu-footer > li.menu-footer-item').each(function() {
         if($(this).find(">a.menu-footer-link").attr('href') == undefined) {
            $(this).find(">a.menu-footer-link").addClass('nonclickable')
         }
      })
   })

</script>
<script>
   /*
   DW Hates WOW and is turning it off during dev.
   var scrolled = false;
   
   $( document ).ready(function() {
      $('.wow').each(function() {
         if ($(this).visible(true)) {
            $(this).removeClass('wow');
         }
         
      });
      $(window).on('scroll', function() {
         if (!scrolled) {
            scrolled = true;
            new WOW().init();
         }
      });
   });
  */
</script>
<?= get_field('footer_code','options'); ?>
<script type="text/javascript" language="javascript">
  var sf14gv = 17774;
  (function() {
    var sf14g = document.createElement('script');
    sf14g.src = 'https://tracking.leadlander.com/lt.min.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(sf14g, s);
  })();
</script>
</body>
</html>


<script type="text/javascript">
	jQuery(document).ready(function($){
	   
	   // add hidden attribute to recaptcha textarea
      setTimeout( function() {
         $('#g-recaptcha-response').attr("aria-hidden", "true");
      }, 2);
	   
	   
	
		
      if ( window.location.hash ) scroll(0,0);
      // void some browsers issue
      setTimeout( function() { scroll(0,0); }, 1);
      
 
      $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').not('.benefit-clicky').not('.tab-anchor').not('.trigger-video-popup').click(function(e) {
          
           
        
         
         if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            e.preventDefault();
             var target = $(this.hash);
             target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
             if (target.length) {
                 $('html,body').animate({
                     scrollTop: target.offset().top - 120
                 }, 1000);
                 
             }
         }
           
   
       });
       
       // *only* if we have anchor on the url
       if(window.location.hash) {
       
           // smooth scroll to the anchor id
           $('html, body').animate({
               scrollTop: $(window.location.hash).offset().top - 150 + 'px'
           }, 1000, 'swing');
       }
     

      var getUrlParameter = function getUrlParameter(sParam) {
          var sPageURL = window.location.search.substring(1),
              sURLVariables = sPageURL.split('&'),
              sParameterName,
              i;
      
          for (i = 0; i < sURLVariables.length; i++) {
              sParameterName = sURLVariables[i].split('=');
      
              if (sParameterName[0] === sParam) {
                  return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
              }
          }
          return false;
      };

      $('a.button').each(function() {
         var btn_attr = $(this).attr('data-download_attr');
         
         if(btn_attr) {
            var param = getUrlParameter(btn_attr);
            if(param) {
               // button with auto download param on page, and param exists in URL
               var btn_attr = $(this).attr('href');
               window.location.href = btn_attr;
            }
         }
      })
      
      
      if(!$('iframe[src*="youtube"], iframe[src*="vimeo"]').parents('.post-single')) {
         $('iframe[src*="youtube"], iframe[src*="vimeo"]').wrap("<div class='iframe_wrapper'></div>");
      }

	});
</script>