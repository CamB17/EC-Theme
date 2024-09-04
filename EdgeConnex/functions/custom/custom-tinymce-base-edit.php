<?php
add_filter( 'mce_buttons', 'ec_mce_buttons_1' );
function ec_mce_buttons_1( $buttons ) {
  $buttons = array( 'styleselect', 'bold', 'italic', 'blockquote', 'link', 'unlink', 'bullist', 'numlist', 'alignleft', 'superscript', 'subscript', 'aligncenter', 'alignright', 'hr', 'removeformat', 'charmap', 'fullscreen' );
  return $buttons;
}

add_filter( 'mce_buttons_2', 'ec_mce_buttons_2' );
function ec_mce_buttons_2( $buttons ) {
  $buttons = array();
  return $buttons;
}

add_filter( 'tiny_mce_before_init', 'ec_mce_init' );
function ec_mce_init( $args ) {
  $style_formats = array(
    array(
      'title' => 'Header 1',
      'format' => 'h1'
    ),
    array(
      'title' => 'Header 2',
      'format' => 'h2'
    ),
    array(
      'title' => 'Header 3',
      'format' => 'h3'
    ),
    array(
      'title' => 'Header 4',
      'format' => 'h4'
    ),
    array(
      'title' => 'Header 4 Caps',
      'block' => 'h4',
      'classes' => 'caps'
    ),
    array(
      'title' => 'Header 5',
      'format' => 'h5'
    ),
    array(
      'title' => 'Header 5 Caps',
      'block' => 'h5',
      'classes' => 'caps'
    ),
    array(
      'title' => 'Header 6',
      'format' => 'h6'
    ),
    array(
      'title' => 'Header 6 Caps',
      'block' => 'h6',
      'classes' => 'caps'
    ),
    array(
      'title' => 'Paragraph',
      'format' => 'p'
    ),
    array(
      'title' => 'Large Paragraph',
      'block' => 'span',
      'classes' => 'large',
      'wrapper' => true,
      ),
    array(
      'title' => 'Small Paragraph',
      'block' => 'span',
      'classes' => 'small',
      'wrapper' => true,
      ),
    array(
      'title' => 'Blockquote',
      'format' => 'blockquote',
      'icon' => 'blockquote'
    )
  );

  // Special custom filter to add text styles from a theme's functions.php file
  $text_styles = array();
  $text_styles = apply_filters( 'ec_mce_text_style', $text_styles );
  if( !empty( $text_styles) ) {
    $text_styles = array(
      'title' => 'Text Styles',
      'items' => $text_styles
    );
    // put style formats second-to-last
    $other_formats = array_pop( $style_formats );
    $style_formats = array_merge( $style_formats, array( $text_styles ), array( $other_formats ) );
  }

  // Last minute filter for anything more complicated before json_encoded
  $style_formats = apply_filters( 'ec_mce_style_formats', $style_formats );

  $args['style_formats'] = json_encode( $style_formats );

  return $args;
}
