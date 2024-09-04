<?php
function ec_custom_images() {
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'blog-post', 600, 370, true );
  // portrait-medium is a medium sized, portrait, cropped general purpose image size
  add_image_size('portrait-medium', 420, 550, true);
  add_image_size('split-section', 940, 470, true);
  add_image_size('cta-banner', 1400, 500, true);
  add_image_size('mainstage-image', 2000, 450, true);
  add_image_size('small-square', 500, 500, true);
  add_image_size('large-square', 850, 850, true);
  add_image_size('gallery-thumbnail', 400, 300, true);
  add_image_size('full-page-gallery', 635, 420, true);
  add_image_size('resource', 515, 570, true);
}
add_action( 'after_setup_theme', 'ec_custom_images' );
