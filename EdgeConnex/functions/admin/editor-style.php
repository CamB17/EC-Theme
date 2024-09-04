<?php
//add_action( 'init', 'ec_add_editor_styles' );
function ec_add_editor_styles() {
  add_editor_style( get_template_directory_uri() . '/styles/style.css' );
}
