<?php
/*
Title		: SMOF
Description	: Slightly Modified Options Framework
Version		: 1.5.1
Author		: Syamil MJ
Author URI	: http://aquagraphite.com
License		: GPLv3 - http://www.gnu.org/copyleft/gpl.html

Credits		: Thematic Options Panel - http://wptheming.com/2010/11/thematic-options-panel-v2/
		 	  Woo Themes - http://woothemes.com/
		 	  Option Tree - http://wordpress.org/extend/plugins/option-tree/

Contributors: Syamil MJ - http://aquagraphite.com
			  Andrei Surdu - http://smartik.ws/
			  Jonah Dahlquist - http://nucleussystems.com/
			  partnuz - https://github.com/partnuz
			  Alex Poslavsky - https://github.com/plovs
			  Dovy Paukstys - http://simplerain.com
*/

/**
 * Definitions
 *
 * @since 1.4.0
 */
$theme_version = '';
$inwave_smof_output = '';
	    
if( function_exists( 'wp_get_theme' ) ) {
	if( is_child_theme() ) {
		$temp_obj = wp_get_theme();
		$theme_obj = wp_get_theme( $temp_obj->get('Template') );
	} else {
		$theme_obj = wp_get_theme();    
	}

	$theme_version = $theme_obj->get('Version');
	$theme_name = $theme_obj->get('Name');
	$theme_uri = $theme_obj->get('ThemeURI');
	$author_uri = $theme_obj->get('AuthorURI');
} else {
	$theme_data = wp_get_theme( get_template_directory().'/style.css' );
	$theme_version = $theme_data['Version'];
	$theme_name = $theme_data['Name'];
	$theme_uri = $theme_data['ThemeURI'];
	$author_uri = $theme_data['AuthorURI'];
}

if( !defined('INWAVE_ADMIN_PATH') )
	define( 'INWAVE_ADMIN_PATH', get_template_directory() . '/admin/' );
if( !defined('INWAVE_ADMIN_DIR') )
	define( 'INWAVE_ADMIN_DIR', get_template_directory_uri() . '/admin/' );

define( 'INWAVE_ADMIN_IMAGES', INWAVE_ADMIN_DIR . 'assets/images/' );

define( 'INWAVE_LAYOUT_PATH', INWAVE_ADMIN_PATH . 'layouts/' );
define( 'INWAVE_THEMENAME', $theme_name );
/* Theme version, uri, and the author uri are not completely necessary, but may be helpful in adding functionality */
define( 'INWAVE_THEMEVERSION', $theme_version );
define( 'INWAVE_THEMEURI', $theme_uri );
define( 'INWAVE_THEMEAUTHORURI', $author_uri );

define( 'INWAVE_BACKUPS','backups' );

/**
 * Required action filters
 *
 * @uses add_action()
 *
 * @since 1.0.0
 */

add_action('admin_head', 'inwave_of_admin_message');
add_action('admin_init','inwave_of_admin_init');
add_action('admin_menu', 'inwave_of_add_admin');

/**
 * Required Files
 *
 * @since 1.0.0
 */ 
require_once ( INWAVE_ADMIN_PATH . 'functions/functions.load.php' );
require_once ( INWAVE_ADMIN_PATH . 'classes/class.options_machine.php' );

/**
 * AJAX Saving Options
 *
 * @since 1.0.0
 */
add_action('wp_ajax_of_ajax_post_action', 'inwave_of_ajax_callback');
