<?php
/*
Theme Name: Sadbhaw
Theme URI:
Author: Subash Basnet
Author URI: www.subashbasnet.com.np
Description: Home page
Version: 1.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: subash
Template Name: Home
This theme, like WordPress, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned with others.
*/
get_header();
$inwave_cfg = Inwave_Main::getConfig();
include(locate_template('page-templates/our-goals.php'));
include(locate_template('page-templates/our-impact.php'));?>

<?php get_footer(); ?>
