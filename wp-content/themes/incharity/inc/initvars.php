<?php
/***********
 * LOAD THEME CONFIGURATION FILE
 */

 // Declare variables
global $inwave_cfg, $inwave_smof_data;
$postId = get_the_ID();
$css = '';
// woo commerce shop ID
if( function_exists('is_shop') ) {
	if( is_shop() ) {
		$postId = get_option('woocommerce_shop_page_id');
	}
}
if(( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type()){
	$postId = get_option('page_for_posts');
}

// get revolution slider-id from post meta
if(function_exists('putRevSlider')){
    $inwave_cfg['slide-id'] = get_post_meta( $postId, 'inwave_slider', true );
}else{
    $inwave_cfg['slide-id'] = 0;
}

// background color
$page_bg_color = get_post_meta($postId, 'inwave_background_color_page', true);
if(isset($page_bg_color)){
    $inwave_cfg['inwave_background_color_page'] = $page_bg_color;
}
// get show or hide heading from post meta
$inwave_cfg['show-pageheading']= get_post_meta( $postId, 'inwave_show_pageheading', true );
if(!$inwave_cfg['show-pageheading']){
	$inwave_cfg['show-pageheading'] = $inwave_smof_data['show_page_heading'];
}

if($inwave_cfg['show-pageheading'] =='no' || empty($inwave_cfg['show-pageheading'])){
    $inwave_cfg['show-pageheading']= 0;
}
else{
    $inwave_cfg['show-pageheading']= 1;
}

// get heading background
$inwave_cfg['pageheading_bg'] = get_post_meta( $postId, 'inwave_pageheading_bg', true );
if($inwave_cfg['pageheading_bg']){
    $inwave_cfg['pageheading_bg']= wp_get_attachment_image_src($inwave_cfg['pageheading_bg'],'large');
    $inwave_cfg['pageheading_bg']= $inwave_cfg['pageheading_bg'][0];
}
$inwave_cfg['sidebar-position'] = $inwave_smof_data['sidebar_position'];

if(!$inwave_cfg['sidebar-position']){
    $inwave_cfg['sidebar-position'] = 'right';
}
// get sidebar position from post meta
$sliderbarPos= get_post_meta( $postId, 'inwave_sidebar_position',true);
if($sliderbarPos){
    $inwave_cfg['sidebar-position'] = $sliderbarPos;
}
if($inwave_cfg['sidebar-position']=='none'){
    $inwave_cfg['sidebar-position'] = '';
}

$inwave_cfg['sidebar-name'] = '';
if(!isset($inwave_cfg['page-classes'])){
	$inwave_cfg['page-classes'] = '';
}
if (class_exists('WooCommerce') && (is_cart() || is_checkout())) {
    $inwave_cfg['page-classes'] .= ' page-product';
    $inwave_cfg['sidebar-name'] = 'woocommerce';
}
// get sidebar name
if(get_post_meta( $postId, 'inwave_sidebar_name',true)){
    $inwave_cfg['sidebar-name'] = get_post_meta( $postId, 'inwave_sidebar_name',true);
}

// get Page Class from post meta
if(!isset($inwave_cfg['page-classes'])) {
    $inwave_cfg['page-classes'] = '';
}
$inwave_cfg['page-classes'] .= get_post_meta($postId, 'inwave_page_class', true);

// header layout
if($inwave_smof_data['header_layout']){
    $inwave_cfg['header-option'] = $inwave_smof_data['header_layout'];
}

$headerOption = get_post_meta( $postId, 'inwave_header_option',true );
if($headerOption){
    $inwave_cfg['header-option'] = $headerOption;
}

if(!isset($inwave_cfg['header-option']) || $inwave_cfg['header-option']==''){
    $inwave_cfg['header-option'] = 'default';
}

// header sticky
$inwave_cfg['header-sticky'] = $inwave_smof_data['header_sticky'];
$headerSticky = get_post_meta( $postId, 'inwave_header_sticky',true );
if($headerSticky =='no'){
	$inwave_cfg['header-sticky'] = 0;
}
if($headerSticky =='yes'){
	$inwave_cfg['header-sticky'] = 1;
}

// footer layout
if(!isset($inwave_cfg['footer-option']) || $inwave_cfg['footer-option'] == ''){
	$inwave_cfg['footer-option'] = 'default';
}
if($inwave_smof_data['footer_option']){
	$inwave_cfg['footer-option'] = $inwave_smof_data['footer_option'];
}
$footerOption = get_post_meta( $postId, 'inwave_footer_option',true );
if($footerOption){
	$inwave_cfg['footer-option'] = $footerOption;
}

/** Get quick access block control */
$inwave_cfg['show-quick-access']= get_post_meta( $postId, 'inwave_show_quick_access',true);

if(!$inwave_cfg['show-quick-access']){
    $inwave_cfg['show-quick-access'] = $inwave_smof_data['show_quick_access'];
}

/* show search form for header version 5*/
if(!isset($inwave_cfg['show_search_form'])){
    $inwave_cfg['show_search_form'] = '';
}
if($inwave_smof_data['show_search_form']){
    $inwave_cfg['show_search_form'] = $inwave_smof_data['show_search_form'];
}

/** defined primary theme menu */
$inwave_cfg['theme-menu'] = 'primary';
$inwave_cfg['theme-menu-id'] = get_post_meta( $postId, 'inwave_primary_menu',true );


/* Logo */
if(!substr_count($inwave_smof_data['logo'],'http://') && !substr_count($inwave_smof_data['logo'],'https://')){
    $inwave_smof_data['logo'] = site_url() .'/'.$inwave_smof_data['logo'];
}
if(get_post_meta( $postId, 'inwave_logo',true )){
    $inwave_smof_data['logo'] = wp_get_attachment_image_src(get_post_meta( $postId, 'inwave_logo',true ),'large');
    $inwave_smof_data['logo'] = $inwave_smof_data['logo'][0];
}

/* Logo sticky */
if($inwave_smof_data['logo_sticky'] && !substr_count($inwave_smof_data['logo_sticky'],'http://') && !substr_count($inwave_smof_data['logo_sticky'],'https://')){
    $inwave_smof_data['logo_sticky'] = site_url() .'/'.$inwave_smof_data['logo_sticky'];
}
if(!$inwave_smof_data['logo_sticky']){
    $inwave_smof_data['logo_sticky'] = $inwave_smof_data['logo'];
}
/* Logo footer */
if($inwave_smof_data['footer-logo'] && !substr_count($inwave_smof_data['footer-logo'],'http://') && !substr_count($inwave_smof_data['footer-logo'],'https://')){
    $inwave_smof_data['footer-logo'] = site_url() .'/'.$inwave_smof_data['footer-logo'];
}
if(!$inwave_smof_data['footer-logo']){
    $inwave_smof_data['footer-logo'] = $inwave_smof_data['logo'];
}
if($inwave_smof_data['footer-logo-2'] && !substr_count($inwave_smof_data['footer-logo-2'],'http://') && !substr_count($inwave_smof_data['footer-logo-2'],'https://')){
    $inwave_smof_data['footer-logo-2'] = site_url() .'/'.$inwave_smof_data['footer-logo-2'];
}
if(!$inwave_smof_data['footer-logo-2']){
    $inwave_smof_data['footer-logo-2'] = $inwave_smof_data['footer-logo'];
}

/* donate button*/
$show_donate_button = get_post_meta( $postId, 'inwave_show_donate_button',true );
if($show_donate_button){
    $inwave_smof_data['show_donate_button'] = $show_donate_button;
}

/** update cofig */
Inwave_Main::setConfig($inwave_cfg);
Inwave_Main::setConfig($inwave_smof_data,'smof');
