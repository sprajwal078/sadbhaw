<?php
/*
  Plugin Name: Crowdfunding
  Plugin URI: http://crowdfunding.inwavethemes.com
  Description:
  Version: 1.3.0
  Author: Inwavethemes
  Author URI: http://www.inwavethemes.com
  License: GNU General Public License v2 or later
 */

/**
 * Description of Crowdfunding
 *
 * @developer duongca
 */
if (!session_id() && !headers_sent()) {
    session_start();
}
if (!defined('ABSPATH')) {
    exit();
} // Exit if accessed directly

global $inf_settings;
$inf_settings = unserialize(get_option('inf_settings'));
if (!$inf_settings) {
    update_option('inf_settings', 'a:4:{s:7:"general";a:11:{s:8:"currency";s:3:"EUR";s:12:"currency_pos";s:4:"left";s:12:"funding_slug";s:8:"campaign";s:13:"category_slug";s:12:"inf-category";s:8:"tag_slug";s:7:"inf-tag";s:16:"inf_payment_page";s:3:"597";s:18:"payment_check_page";s:0:"";s:11:"member_page";s:3:"554";s:10:"google_api";s:0:"";s:14:"map_zoom_level";s:1:"8";s:22:"allow_anonymous_donate";s:1:"0";}s:20:"register_form_fields";a:6:{i:0;a:8:{s:5:"label";s:9:"Full Name";s:4:"name";s:9:"full_name";s:5:"group";s:0:"";s:4:"type";s:4:"text";s:6:"values";s:0:"";s:13:"default_value";s:0:"";s:12:"show_on_list";s:1:"1";s:13:"require_field";s:1:"1";}i:1;a:8:{s:5:"label";s:7:"Address";s:4:"name";s:7:"address";s:5:"group";s:0:"";s:4:"type";s:4:"text";s:6:"values";s:0:"";s:13:"default_value";s:0:"";s:12:"show_on_list";s:1:"1";s:13:"require_field";s:1:"1";}i:2;a:8:{s:5:"label";s:5:"Email";s:4:"name";s:5:"email";s:5:"group";s:0:"";s:4:"type";s:5:"email";s:6:"values";s:0:"";s:13:"default_value";s:0:"";s:12:"show_on_list";s:1:"1";s:13:"require_field";s:1:"1";}i:3;a:8:{s:5:"label";s:5:"Phone";s:4:"name";s:5:"phone";s:5:"group";s:0:"";s:4:"type";s:4:"text";s:6:"values";s:0:"";s:13:"default_value";s:0:"";s:12:"show_on_list";s:1:"1";s:13:"require_field";s:1:"1";}i:4;a:8:{s:5:"label";s:54:"I am a UK taxpayer and my gift qualifies for Gift Aid.";s:4:"name";s:8:"gift_aid";s:5:"group";s:0:"";s:4:"type";s:8:"checkbox";s:6:"values";s:0:"";s:13:"default_value";s:1:"0";s:12:"show_on_list";s:1:"1";s:13:"require_field";s:1:"0";}i:5;a:8:{s:5:"label";s:119:"Please subscribe me to InCharity\\\'s newsletter, keeping me up-to-date with the projects my donation is helping to fund.";s:4:"name";s:9:"subscribe";s:5:"group";s:0:"";s:4:"type";s:8:"checkbox";s:6:"values";s:0:"";s:13:"default_value";s:1:"1";s:12:"show_on_list";s:1:"1";s:13:"require_field";s:1:"0";}}s:11:"inf_payment";a:2:{s:6:"paypal";a:3:{s:5:"email";s:0:"";s:9:"test_mode";s:1:"1";s:6:"status";s:1:"1";}s:14:"custom_payment";a:2:{s:7:"content";s:108:"Thanks for your donation!
You can send money via bank or direct to us at Angel Building, 407 St John Street";s:6:"status";s:1:"1";}}s:14:"email_template";a:3:{s:10:"order_info";a:2:{s:5:"title";s:17:"Order email title";s:7:"content";s:167:"Hello, [customer_name]

Thanks for donation on my site.
This is the link of your donation, you can check status and info via this link: [order_link]

Thanks again";}s:13:"register_info";a:2:{s:5:"title";s:37:"Thanks for registering on [site_name]";s:7:"content";s:123:"Hi, [customer_name]

Thanks for registering on [site_name].
This is the registration info: 
[user_info]

Thanks again";}s:18:"order_change_state";a:2:{s:5:"title";s:19:"Order change status";s:7:"content";s:107:"Hi [customer_name],

Your order on [site_name] has been change to [new_order_status]

Because: [reason]";}}}');
    $inf_settings = unserialize(get_option('inf_settings'));
}

// translate plugin
add_action('plugins_loaded', 'inf_load_textdomain');

function inf_load_textdomain() {
    load_plugin_textdomain('inwavethemes', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}

if (!$inf_settings['general']['google_api']) {

    function inf_googlemap_api_required() {
        ?>
        <div class="error">
            <p><?php _e(sprintf('Please input google api in plugin settings <a href="%s">%s</a>', admin_url('edit.php?post_type=infunding&page=settings'), __('Setting Now', 'inwavethemes')), 'inwavethemes'); ?></p>
        </div>
        <?php
    }

    //add_action('admin_notices', 'inf_googlemap_api_required');
}
include_once 'includes/function.admin.php';
include_once 'includes/function.front.php';

if (!defined('INFUNDING_THEME_PATH')) {
    define('INFUNDING_THEME_PATH', WP_PLUGIN_DIR . '/infunding/themes/');
}

if (!defined('INF_LIMIT_ITEMS')) {
    define('INF_LIMIT_ITEMS', 10);
}
$utility = new inFundingUtility();


register_activation_hook(__FILE__, 'inFundingInstall');
register_uninstall_hook(__FILE__, 'inFundingUninstall');


//Add parralax menu
add_action('admin_menu', 'inFundingAddAdminMenu');

// Hook into the 'init' action
add_action('init', 'inFundingCreatePostType', 0);
add_action('init', 'inFundingAddCategoryTaxonomy', 0);
add_action('init', 'inFundingAddTagTaxonomy', 0);
add_action('init', array($utility, 'inFundingAddImageSize'));

// Add scripts
add_action('admin_enqueue_scripts', 'inFundingAdminAddScript');

//init plugin theme
add_action('after_switch_theme', array($utility, 'initPluginThemes'));
add_action('admin_post_inFundingFilter', 'inFundingFilter');

//Add metabox
if (is_admin()) {
    add_action('load-post.php', 'inFundingAddMetaBox');
    add_action('load-post-new.php', 'inFundingAddMetaBox');
    add_filter('manage_edit-infunding_columns', 'inFundingHeaderColumnsHeader');
    add_action('manage_infunding_posts_custom_column', 'inFundingColumnsContent', 10, 2);
}

//Add action to process member
add_action('admin_post_inFundingSaveMember', 'inFundingSaveMember');
add_action('admin_post_inFundingDeleteMember', 'inFundingDeleteMember');
add_action('admin_post_inFundingDeleteMembers', 'inFundingDeleteMembers');

//Add action to process Payment
add_action('admin_post_inFundingUpdateOrderInfo', 'inFundingUpdateOrderInfo');
add_action('admin_post_inFundingResendEmail', 'inFundingResendEmail');
add_action('admin_post_inFundingClearOrderExpired', 'inFundingClearOrderExpired');
add_action('admin_post_inFundingDeleteOrder', 'inFundingDeleteOrder');
add_action('admin_post_inFundingDeleteOrders', 'inFundingDeleteOrders');

//Add action to process Log
add_action('admin_post_inFundingClearLog', 'inFundingClearLog');
add_action('admin_post_inFundingDeleteLogs', 'inFundingDeleteLogs');
add_action('admin_post_inFundingDeleteLog', 'inFundingDeleteLog');

//Add action save settings
add_action('admin_post_infSaveSettings', 'infSaveSettings');



//Ajax load getScheduleDayHtml
add_action('wp_ajax_nopriv_getTicketPlanHtml', 'getTicketPlanHtml');
add_action('wp_ajax_getTicketPlanHtml', 'getTicketPlanHtml');

//Ajax load getScheduleDayHtml
add_action('wp_ajax_nopriv_getScheduleDayHtml', 'getScheduleDayHtml');
add_action('wp_ajax_getScheduleDayHtml', 'getScheduleDayHtml');

//Ajax load data for getScheduleTimeHtml
add_action('wp_ajax_nopriv_getScheduleTimeHtml', 'getScheduleTimeHtml');
add_action('wp_ajax_getScheduleTimeHtml', 'getScheduleTimeHtml');

/* ----------------------------------------------------------------------------------
  FRONTEND FUNCTIONS
  ---------------------------------------------------------------------------------- */

/**
 * Register and enqueue scripts and styles for frontend.
 *
 * @since 1.0.0
 */
//Add site script
add_action('wp_enqueue_scripts', 'inFundingAddSiteScript');

add_shortcode('infunding_list', 'infunding_list_outhtml');
add_shortcode('infunding_map', 'infunding_map_outhtml');
add_shortcode('infunding_member_page', 'infunding_member_page_outhtml');
add_shortcode('infunding_donate_form', 'infunding_donate_form_outhtml');

//Add action to save member
add_action('admin_post_iwePaymentProcess', 'iwePaymentProcess');

//Ajax load iwePaymentNotice
add_action('wp_ajax_nopriv_infPaymentNotice', 'infPaymentNotice');
add_action('wp_ajax_infPaymentNotice', 'infPaymentNotice');
