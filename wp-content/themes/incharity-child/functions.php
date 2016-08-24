<?php
/**
 * InCharity-Child functions and definitions
 *
 * @package InCharity
 */

add_action( 'after_setup_theme', 'incharity_child_theme_setup' );
function incharity_child_theme_setup() {
    load_child_theme_textdomain( 'incharity', get_stylesheet_directory() . '/languages' );
}