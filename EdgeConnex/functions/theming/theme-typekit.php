<?php
$typekit = get_field('typekit_id', 'options');

if ( $typekit ) {
  function ec_typekit() {
    $typekit_code = get_field('typekit_id', 'options');
    wp_enqueue_script( 'ec_typekit', '//use.typekit.net/'.$typekit_code.'.js');
  }
  add_action( 'wp_enqueue_scripts', 'ec_typekit' );

  function ec_typekit_inline() {
    if ( wp_script_is( 'ec_typekit', 'done' ) ) { ?>
      <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
  <?php }
  }
  add_action( 'wp_head', 'ec_typekit_inline' );
}
