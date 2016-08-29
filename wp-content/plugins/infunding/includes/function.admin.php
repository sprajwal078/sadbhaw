<?php

/*
 * @package Inwave Event
 * @version 1.0.0
 * @created May 11, 2015
 * @author Inwavethemes
 * @email inwavethemes@gmail.com
 * @website http://inwavethemes.com
 * @support Ticket https://inwave.ticksy.com/
 * @copyright Copyright (c) 2015 Inwavethemes. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */

/**
 * Description of file: File contain all function to process in admin page
 *
 * @developer duongca
 */
require 'utility.php';

//Add plugin menu to admin sidebar
function inFundingAddAdminMenu() {
    //Donor menu
    add_submenu_page('edit.php?post_type=infunding', __('Donors', 'inwavethemes'), __('Donors', 'inwavethemes'), 'manage_options', 'donor', 'inFundingDonorRenderPage');
    add_submenu_page(NULL, __('Add Donor', 'inwavethemes'), NULL, 'manage_options', 'donor/addnew', 'inFundingDonorAddNewPage');
    add_submenu_page(NULL, __('Edit Donor', 'inwavethemes'), NULL, 'manage_options', 'donor/edit', 'inFundingDonorAddNewPage');
    //Payment menu
    add_submenu_page('edit.php?post_type=infunding', __('Donates', 'inwavethemes'), __('Donates', 'inwavethemes'), 'manage_options', 'payment', 'inFundingPaymentRenderPage');
    add_submenu_page(NULL, __('Edit donate', 'inwavethemes'), NULL, 'manage_options', 'payment/edit', 'inFundingAddPaymentRenderPage');
    add_submenu_page(NULL, __('Donate detail', 'inwavethemes'), NULL, 'manage_options', 'payment/view', 'inFundingViewPaymentRenderPage');
    //Log menu
    add_submenu_page('edit.php?post_type=infunding', __('Logs', 'inwavethemes'), __('Logs', 'inwavethemes'), 'manage_options', 'logs', 'inFundingLogRenderPage');
    add_submenu_page(NULL, __('Log view', 'inwavethemes'), NULL, 'manage_options', 'log/view', 'inFundingViewLogRenderPage');
    //Settings menu
    add_submenu_page('edit.php?post_type=infunding', __('Settings', 'inwavethemes'), __('Settings', 'inwavethemes'), 'manage_options', 'settings', 'inFundingSettingsRenderPage');
}

if (!function_exists('inFundingInstall')) {
    global $inFundingVersion;
    $inFundingVersion = '1.0.0';

    /**
     *
     * @global type $wpdb
     * @global type $inFundingVersion
     */
    function inFundingInstall() {
        global $wpdb;
        global $inFundingVersion;
        $utility = new inFundingUtility();

        $charset_collate = '';
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        if (!empty($wpdb->charset)) {
            $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
        }

        if (!empty($wpdb->collate)) {
            $charset_collate .= " COLLATE {$wpdb->collate}";
        }


        $sql = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "inf_donors (
		id int(11) NOT NULL AUTO_INCREMENT,
		user_id int(11) NULL,
                field_value longtext,
                PRIMARY KEY (`id`)
	) " . $charset_collate . ";";
        dbDelta($sql);

        $sql = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "inf_orders (
		id int(11) NOT NULL AUTO_INCREMENT,
		member_id int(11) NOT NULL,
		campaign_id int(11) NOT NULL,
		note text NOT NULL,
		price int(11) NOT NULL,
		currentcy CHAR(3) NOT NULL,
		time_created int(11) NOT NULL,
		time_paymented int(11) NULL,
                payment_method varchar(50),
                status tinyint(1),
                PRIMARY KEY (`id`)
	) " . $charset_collate . ";";
        dbDelta($sql);


        $sql = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "inf_logs (
		id int(11) NOT NULL AUTO_INCREMENT,
                log_type varchar(30) NOT NULL,
                scope varchar(30) NULL,
		timestamp int(11) NOT NULL,
                message text NOT NULL,
                link varchar(255) NULL,
                PRIMARY KEY (`id`)
	) " . $charset_collate . ";";
        dbDelta($sql);

        //add $inFundingVersion table version
        add_option('inFundingVersion', $inFundingVersion);
        flush_rewrite_rules();

        //Add themes
        $utility->initPluginThemes();
    }

}

if (!function_exists('inFundingUninstall')) {

    function inFundingUninstall() {

        global $wpdb;
        $option_names = array('inFundingVersion', 'inf_settings', 'infunding_category_children');
        $tables = array($wpdb->prefix . 'inf_donors', $wpdb->prefix . 'inf_logs', $wpdb->prefix . 'inf_orders');

        foreach ($option_names as $option) {
            delete_option($option);
            delete_site_option($option);
        }

        //drop a custom db table
        foreach ($tables as $table) {
            $wpdb->query("DROP TABLE IF EXISTS " . $table);
        }

        $posts = new WP_Query(array('post_type' => 'infunding', 'post_status' => 'any'));
        //delete all infunding post meta
        $wpdb->query("DELETE FROM {$wpdb->prefix}postmeta WHERE meta_key LIKE 'inf_%'");
        //delete all post with post type 
        $wpdb->query("DELETE FROM {$wpdb->prefix}posts WHERE post_type = 'infunding'");
        //delete all infunding category and tag
        $wpdb->query("DELETE FROM {$wpdb->prefix}term_taxonomy WHERE taxonomy LIKE 'infunding_%'");
    }

}

/**
 * Function to register Inwave Campaign Category with Wordpress
 */
function inFundingAddCategoryTaxonomy() {
    global $inf_settings;
    if ($inf_settings) {
        $general = $inf_settings['general'];
    }
    $labels = array(
        'name' => _x('Categories', 'Taxonomy General Name', 'inwavethemes'),
        'singular_name' => _x('Category', 'Taxonomy Singular Name', 'inwavethemes'),
        'menu_name' => __('Categories', 'inwavethemes'),
        'all_items' => __('All Categories', 'inwavethemes'),
        'parent_item' => __('Parent Category', 'inwavethemes'),
        'parent_item_colon' => __('Parent Category:', 'inwavethemes'),
        'new_item_name' => __('New Category Name', 'inwavethemes'),
        'add_new_item' => __('Add New Category', 'inwavethemes'),
        'edit_item' => __('Edit Category', 'inwavethemes'),
        'update_item' => __('Update Category', 'inwavethemes'),
        'separate_items_with_commas' => __('Separate categories with commas', 'inwavethemes'),
        'search_items' => __('Search categories', 'inwavethemes'),
        'add_or_remove_items' => __('Add or remove categories', 'inwavethemes'),
        'choose_from_most_used' => __('Choose from the most used categories', 'inwavethemes'),
        'not_found' => __('Not Found', 'inwavethemes'),
    );
    $rewrite = array(
        'slug' => isset($general['category_slug']) ? $general['category_slug'] : 'inf-category',
        'with_front' => true,
        'hierarchical' => true,
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => $rewrite,
    );
    register_taxonomy('infunding_category', array('infunding'), $args);
}

/**
 * Function to register Inwave Campaign Category with Wordpress
 */
function inFundingAddTagTaxonomy() {
    global $inf_settings;
    if ($inf_settings) {
        $general = $inf_settings['general'];
    }
    $labels = array(
        'name' => _x('Tags', 'Taxonomy General Name', 'inwavethemes'),
        'singular_name' => _x('Tag', 'Taxonomy Singular Name', 'inwavethemes'),
        'menu_name' => __('Tags', 'inwavethemes'),
        'all_items' => __('All Tags', 'inwavethemes'),
        'parent_item' => __('Parent Tag', 'inwavethemes'),
        'parent_item_colon' => __('Parent Tag:', 'inwavethemes'),
        'new_item_name' => __('New Tag Name', 'inwavethemes'),
        'add_new_item' => __('Add New Tag', 'inwavethemes'),
        'edit_item' => __('Edit Tag', 'inwavethemes'),
        'update_item' => __('Update Tag', 'inwavethemes'),
        'separate_items_with_commas' => __('Separate tags with commas', 'inwavethemes'),
        'search_items' => __('Search tags', 'inwavethemes'),
        'add_or_remove_items' => __('Add or remove tags', 'inwavethemes'),
        'choose_from_most_used' => __('Choose from the most used tags', 'inwavethemes'),
        'not_found' => __('Not Found', 'inwavethemes'),
    );
    $rewrite = array(
        'slug' => isset($general['tag_slug']) ? $general['tag_slug'] : 'inf-tag',
        'with_front' => true,
        'hierarchical' => true,
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => $rewrite,
    );
    register_taxonomy('infunding_tag', array('infunding'), $args);
}

/**
 * Function to register Inwave Funding Post_type with Wordpress
 */
function inFundingCreatePostType() {
    global $inf_settings;
    if ($inf_settings) {
        $general = $inf_settings['general'];
    }
    $labels = array(
        'name' => _x('Campaigns', 'Post Type General Name', 'inwavethemes'),
        'singular_name' => _x('Campaign', 'Post Type Singular Name', 'inwavethemes'),
        'menu_name' => __('Crowdfunding', 'inwavethemes'),
        'parent_item_colon' => __('Parent Campaign:', 'inwavethemes'),
        'all_items' => __('All Campaigns', 'inwavethemes'),
        'view_item' => __('View Campaign', 'inwavethemes'),
        'add_new_item' => __('Add New Campaign', 'inwavethemes'),
        'add_new' => __('Add New', 'inwavethemes'),
        'edit_item' => __('Edit Item', 'inwavethemes'),
        'update_item' => __('Update Item', 'inwavethemes'),
        'search_items' => __('Search Item', 'inwavethemes'),
        'not_found' => __('Not found', 'inwavethemes'),
        'not_found_in_trash' => __('Not found in Trash', 'inwavethemes'),
    );
    $rewrite = array(
        'slug' => isset($general['funding_slug']) ? $general['funding_slug'] : 'campaign',
        'with_front' => false,
        'pages' => true,
        'feeds' => true,
    );
    $args = array(
        'label' => __('infunding', 'inwavethemes'),
        'description' => __('Inwave Crowdfunding', 'inwavethemes'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'comments'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-calendar-alt',
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'rewrite' => $rewrite,
        'capability_type' => 'page',
    );
    register_post_type('infunding', $args);
}

/**
 * Function to add script for admin page
 */
function inFundingAdminAddScript() {
    wp_enqueue_style('font-awesome', plugins_url('/infunding/assets/css/font-awesome/css/font-awesome.min.css'));
    wp_enqueue_style('select2', plugins_url('/infunding/assets/css/select2.min.css'));
    wp_enqueue_style('infadmin-style', plugins_url('/infunding/assets/css/infunding_admin.css'));
    wp_enqueue_script('select2', plugins_url() . '/infunding/assets/js/select2.min.js', array('jquery'), '1.0.0', true);
    wp_register_script('infadmin-script', plugins_url() . '/infunding/assets/js/infunding_admin.js', array('jquery'), '1.0.0', true);
    wp_localize_script('infadmin-script', 'inFundingCfg', array('siteUrl' => site_url(), 'adminUrl' => admin_url(), 'ajaxUrl' => admin_url('admin-ajax.php')));
    wp_enqueue_media();
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('infadmin-script');
}

function inFundingFilter() {
    $link = filter_input(INPUT_SERVER, 'HTTP_REFERER');
    $link_param = parse_url($link);
    $q_vars = array();
    parse_str($link_param['query'], $q_vars);
    $post = filter_input_array(INPUT_POST);
    unset($post['action']);
    $query_vars = array_merge($q_vars, $post);
    $new_params = array();
    foreach ($query_vars as $key => $value) {
        if ($value) {
            $new_params[$key] = $value;
        }
    }

    $params = http_build_query($new_params);
    wp_redirect($link_param['scheme'] . '://' . $link_param['host'] . $link_param['path'] . '?' . $params);
}

/* * *********************************************************
 * ******** CODE CAMPAIGN PAGE POST ********
 * ******************************************************** */

//Add metabox
function inFundingAddMetaBox() {
    new inFundingMetaBox();
}

function inFundingHeaderColumnsHeader($columns) {
    $columns = array('cb' => '<input type="checkbox" />',
        'title' => __('Title', 'inwavethemes'),
        'taxonomy-infunding_category' => __('Categories', 'inwavethemes'),
        'current_goal' => __('Funded', 'inwavethemes'),
        'date' => __('Date', 'inwavethemes'),
        'inf_status' => __('Status', 'inwavethemes')
    );
    return $columns;
}

function inFundingColumnsContent($column_name, $post_ID) {
    $utility = new inFundingUtility();
    $campaign = $utility->getCampaignInfo($post_ID);
    if ($column_name == 'current_goal') {
        if ($campaign->goal) {
            echo '<span title="' . $campaign->current . '/' . $campaign->goal . '">' . $campaign->percent . '%</span>';
        } else {
            echo '<span title="' . __('Unlimited Goal', 'inwavethemes') . '">' . __('Unlimited', 'inwavethemes') . '</span>';
        }
    }
    if ($column_name == 'inf_status') {
        echo ($campaign->status ? __('In Progress', 'inwavethemes') : ($campaign->days_to_start > 0 ? __('Upcoming', 'inwavethemes') : __('Ended', 'inwavethemes')));
    }
}

//function inFundingColumnSortable($columns) {
//    $columns['status'] = 'status';
//    $columns['funded'] = 'funded';
//    return $columns;
//}
//
//function inFundingEditLoad() {
//    add_filter('request', 'inFundingSortCustomColumns');
//}
//
///* Sorts the movies. */
//
//function inFundingSortCustomColumns($vars) {
//
//    /* Check if we're viewing the 'infunding' post type. */
//    if (isset($vars['post_type']) && 'infunding' == $vars['post_type']) {
//
//        /* Check if 'orderby' is set to 'status'. */
//        if (isset($vars['orderby']) && 'status' == $vars['orderby']) {
//
//            /* Merge the query vars with our custom variables. */
//            $vars = array_merge(
//                    $vars, array(
//                'meta_key' => 'inf_current',
//                'orderby' => 'meta_value_num'
//                    )
//            );
//        }
//        /* Check if 'orderby' is set to 'funded'. */
//        if (isset($vars['orderby']) && 'funded' == $vars['orderby']) {
//
//            /* Merge the query vars with our custom variables. */
//            $vars = array_merge(
//                    $vars, array(
//                'meta_key' => 'inf_current',
//                'orderby' => 'meta_value_num'
//                    )
//            );
//        }
//    }
//
//    return $vars;
//}

/* * **************************************************
 * ************ CODE SETTINGS PAGE ****************
 * ************************************************** */

function inFundingSettingsRenderPage() {
    include_once 'views/settings.php';
}

function infSaveSettings() {
    $data = $_POST;
    $form_field = $data['inf_settings']['register_form_fields'];
    $fields = array();
    if (!empty($form_field['label'])) {
        foreach ($form_field['label'] as $key => $value) {
            $field = array();
            $field['label'] = $value;
            $field['name'] = $form_field['name'][$key];
            $field['group'] = $form_field['group'][$key];
            $field['type'] = $form_field['type'][$key];
            if ($field['type'] == 'select') {
                $options = explode("\n", $form_field['values'][$key]);
                $dataf = array();
                foreach ($options as $option) {
                    $op = explode('|', $option);
                    $dataf[] = array('value' => $op[0], 'text' => $op[1]);
                }
                $field['values'] = $dataf;
            } else {
                $field['values'] = $form_field['values'][$key];
            }
            $field['default_value'] = $form_field['default_value'][$key];
            $field['show_on_list'] = $form_field['show_on_list'][$key];
            $field['require_field'] = $form_field['require_field'][$key];
            $fields[] = $field;
        }
    }

    $data['inf_settings']['register_form_fields'] = $fields;
    update_option('inf_settings', serialize($data['inf_settings']));
    wp_redirect(admin_url('edit.php?post_type=infunding&page=settings'));
}

/* * **************************************************
 * ************ CODE MEMBER PAGE ****************
 * ************************************************** */

function inFundingDonorRenderPage() {
    $member = new inFundingMember();
    $paging = new inFundingPaging();
    $start = $paging->findStart(INF_LIMIT_ITEMS);
    $count = $member->getCountMember();
    $pages = $paging->findPages($count, INF_LIMIT_ITEMS);
    $members = $member->getMembers($start, INF_LIMIT_ITEMS);

    $member_list = $member->getMemberRowData($members);

    include_once 'views/member.list.php';
}

function inFundingDonorAddNewPage() {
    $utility = new inFundingUtility();
    $id = $_GET['id'];
    $member = new inFundingMember();
    if ($id) {
        $member = $member->getMember($id);
        if (!$member->getId()) {
            echo $utility->getMessage(sprintf(__('No Member found with id = <strong>%d</strong>', 'inwavethemes'), $id), 'notice');
        } else {
            $member_data = $member->getMemberRowData($id, true);
            include_once 'views/member.edit.php';
        }
    } else {
        echo $utility->getMessage(__('No id set or id invalid', 'inwavethemes'), 'error');
    }
}

function inFundingSaveMember() {
    $member = new inFundingMember();
    $utility = new inFundingUtility();
    $member->setId($_REQUEST['id']);
    if (isset($_REQUEST['user_id'])) {
        $member->setUser_id($_REQUEST['user_id']);
    }
    $member->setField_value(serialize($utility->prepareMemberFieldValue($_REQUEST['member'])));
    if ($member->getId()) {
        $updateMember = unserialize($member->editMember($member));
    } else {
        $updateMember = unserialize($member->addMember($member));
    }
    if ($updateMember['success']) {
        $_SESSION['bt_message'] = $utility->getMessage(__(sprintf('%s', $updateMember['msg']), 'inwavethemes'));
    } else {
        $_SESSION['bt_message'] = $utility->getMessage(__('Can\'t update member: ', 'inwavethemes') . '<br/>' . __($updateMember['msg'], 'inwavethemes'));
    }
    wp_redirect($_SERVER['HTTP_REFERER']);
}

/**
 * Delete single type on list
 */
function inFundingDeleteMember() {
    $id = $_GET['id'];
    $utility = new inFundingUtility();
    $member = new inFundingMember();
    if ($id && is_numeric($id)) {
        $del = unserialize($member->deleteMember($id));
        if (!$del['success']) {
            $_SESSION['bt_message'] = $utility->getMessage($del['msg'], 'error');
        } else {
            $_SESSION['bt_message'] = $utility->getMessage(__('Donor has been remove', 'inwavethemes'));
        }
    } else {
        $_SESSION['bt_message'] = $utility->getMessage(__('No id set or id invalid', 'inwavethemes'), 'error');
    }
    wp_redirect(admin_url('edit.php?post_type=infunding&page=donor'));
}

/**
 * Delete multiple Location type (selected Location types) on list
 */
function inFundingDeleteMembers() {
    $utility = new inFundingUtility();
    if (isset($_POST['fields']) && !empty($_POST['fields'])) {
        $member = new inFundingMember();
        $ids = $_POST['fields'];
        $msg = $member->deleteMembers($ids);
        if (isset($msg['error']) && isset($msg['success'])) {
            $_SESSION['bt_message'] = $utility->getMessage(__($msg['error'] . $msg['success']), 'notice');
        } elseif (isset($msg['error']) && !isset($msg['success'])) {
            $_SESSION['bt_message'] = $utility->getMessage(__($msg['error']), 'error');
        } elseif (!isset($msg['error']) && isset($msg['success'])) {
            $_SESSION['bt_message'] = $utility->getMessage(__($msg['success']));
        } else {
            $_SESSION['bt_message'] = $utility->getMessage(__('Unknown error', 'inwavethemes'));
        }
    } else {
        $_SESSION['bt_message'] = $utility->getMessage(__('Please select row(s) to delete', 'inwavethemes'), 'error');
    }
    wp_redirect(admin_url('edit.php?post_type=infunding&page=donor'));
}

/* * **************************************************
 * ************ CODE PAYMENT PAGE ****************
 * ************************************************** */

function inFundingPaymentRenderPage() {
    $utility = new inFundingUtility();
    $filter = '';
    $orderby = '';
    $request = filter_input_array(INPUT_GET);
    if (isset($request['status']) && $request['status']) {
        if ($filter) {
            $filter .= ' AND status=' . $request['status'];
        } else {
            $filter .= ' status=' . $request['status'];
        }
    }
    if (isset($request['campaign']) && $request['campaign']) {
        if ($filter) {
            $filter .= ' AND campaign_id=' . $request['campaign'];
        } else {
            $filter .= ' campaign_id=' . $request['campaign'];
        }
    }
    if (isset($request['keyword']) && $request['keyword']) {
        if ($filter) {
            $filter .= ' AND (note LIKE \'%' . htmlspecialchars($request['keywork']) . '%\' OR field_value LIKE \'%' . htmlspecialchars($request['keywork']) . '%\' OR post_title LIKE \'%' . htmlspecialchars($request['keywork']) . '%\') AND p.post_type=\'infunding\'';
        } else {
            $filter .= '  (note LIKE \'%' . htmlspecialchars($request['keywork']) . '%\' OR field_value LIKE \'%' . htmlspecialchars($request['keywork']) . '%\' OR post_title LIKE \'%' . htmlspecialchars($request['keywork']) . '%\') AND p.post_type=\'infunding\'';
        }
    }

    if (isset($request['orderby']) && $request['orderby']) {
        if ($request['orderby'] == 'campaign') {
            $orderby .= ' ORDER BY p.post_title ';
        } else {
            $orderby .= ' ORDER BY o.' . $request['orderby'] . ' ';
        }
        $orderby.=($request['dir'] ? $request['dir'] : 'asc');
    }

    $server_data = filter_input_array(INPUT_SERVER);
    parse_str($server_data['QUERY_STRING'], $server_data['query']);
    unset($server_data['query']['dir']);
    unset($server_data['query']['orderby']);
    $order_link = $server_data['REQUEST_SCHEME'] . '://' . $server_data['HTTP_HOST'] . $server_data['SCRIPT_NAME'] . '?' . http_build_query($server_data['query']);
    $order = new inFundingOrder();
    $paging = new inFundingPaging();
    $start = $paging->findStart(INF_LIMIT_ITEMS);
    $count = $order->getCountOrder($filter);
    $pages = $paging->findPages($count, INF_LIMIT_ITEMS);
    $orders = $order->getOrders($start, INF_LIMIT_ITEMS, $filter, $orderby);
    $order_dir = (filter_input(INPUT_GET, 'dir') == 'asc');
    $sorted = filter_input(INPUT_GET, 'orderby');
    include_once 'views/payment.list.php';
}

function inFundingViewPaymentRenderPage() {
    $id = $_GET['id'];
    $utility = new inFundingUtility();
    if ($id && is_numeric($id)) {
        $order = new inFundingOrder();
        $order = $order->getOrder($id);
        include_once 'views/payment.view.php';
    } else {
        $_SESSION['bt_message'] = $utility->getMessage(__('No id set or id invalid', 'inwavethemes'), 'error');
        wp_redirect(admin_url('edit.php?post_type=infunding&page=payment'));
    }
}

/**
 * Function to render Addnew or Edit Payment page
 */
function inFundingAddPaymentRenderPage() {
    $utility = new inFundingUtility();
    $id = $_GET['id'];
    $order = new inFundingOrder();
    if ($id) {
        $order = $order->getOrder($id);
        if (!$order->getId()) {
            echo $utility->getMessage(sprintf(__('No Order found with id = <strong>%d</strong>', 'inwavethemes'), $id), 'notice');
        } else {
            include_once 'views/payment.edit.php';
        }
    } else {
        echo $utility->getMessage(__('No id set or id invalid', 'inwavethemes'), 'error');
    }
}

function inFundingUpdateOrderInfo() {
    $data = $_REQUEST;
    $log = new inFundingLog();
    $utility = new inFundingUtility();
    $member = new inFundingMember();
    $orderobj = new inFundingOrder();
    $order = $orderobj->getOrder($data['order_id']);

    if ($order->getMember()->getId()) {
        $member->setId($data['order_member']);
        $member->setField_value(serialize($utility->prepareMemberFieldValue($data['member'])));
        $updateMember = unserialize($member->editMember($member));
        $order->setMember($data['order_member']);
    } else {
        $order->setMember(0);
        $updateMember['success'] = true;
    }

    $order->setNote($data['order_note']);
    if ($data['order_time_paymented']) {
        $order->setTime_paymented($data['order_time_paymented']);
    } else {
        $order->setTime_paymented(time());
    }
    $order->setStatus($data['new_order_status']);
    $update = unserialize($orderobj->editOrder($order));

    if ($update['success'] && $data['new_order_status'] != $data['order_status']) {
        $current = htmlspecialchars(get_post_meta($order->getCampaign(), 'inf_current', true));
        if (($data['order_status'] == 1 || $data['order_status'] == 3 || $data['order_status'] == 4) && $data['new_order_status'] == 2) {
            update_post_meta($order->getCampaign(), 'inf_current', $current + $order->getSum_price());
        }
        if ($data['order_status'] == 2) {
            update_post_meta($order->getCampaign(), 'inf_current', $current - $order->getSum_price());
        }
        if (isset($data['sendmail_to_cutommer'])) {
            $mail_param = array(
                'customer_name' => $data['member']['full_name'],
                'order_id' => $order->getOrderCode($data['order_id']),
                'new_status'=>$data['new_order_status']
            );
            $sendmail = unserialize($utility->sendEmail($data['member']['email'], $mail_param, 'order_change_status'));
            if ($sendmail['success']) {
                $log->addLog(new inFundingLog(NULL, 'success', time(), $sendmail['message']), $order->getLink($data['order_id'], 'View order'));
            } else {
                $log->addLog(new inFundingLog(NULL, 'error', time(), $sendmail['message'], $order->getLink($data['order_id'], 'View order')));
            }
        }
    }

    if ($update['success'] && $updateMember['success']) {
        $_SESSION['bt_message'] = $utility->getMessage(__('Update order ' . $order->getOrderCode($data['order_id']) . ' success'), 'success');
        $log->addLog(new inFundingLog(NULL, 'success', time(), __('Update order ' . $order->getOrderCode($data['order_id']) . ' success', 'inwavethemes'), $order->getLink($data['order_id'], 'View order')));
    } elseif ($update['success'] && !$updateMember['success']) {
        $_SESSION['bt_message'] = $utility->getMessage(__('Order ' . $order->getOrderCode($data['order_id']) . ' update success but member error: ' . $updateMember['msg'], 'inwavethemes'), 'notice');
        $log->addLog(new inFundingLog(NULL, 'notice', time(), __('Order ' . $order->getOrderCode($data['order_id']) . ' update success but member error: ' . $updateMember['msg'], 'inwavethemes'), $order->getLink($data['order_id'], 'View order')));
    } elseif (!$update['success'] && $updateMember['success']) {
        $_SESSION['bt_message'] = $utility->getMessage(__('Order ' . $order->getOrderCode($data['order_id']) . ' update error: ' . $update['msg'], 'inwavethemes'), 'notice');
        $log->addLog(new inFundingLog(NULL, 'notice', time(), __('Order ' . $order->getOrderCode($data['order_id']) . ' update error: ' . $update['msg'], 'inwavethemes'), $order->getLink($data['order_id'], 'View order')));
    } else {
        $_SESSION['bt_message'] = $utility->getMessage(__('Can\'t update order ' . $order->getOrderCode($data['order_id']) . ': ' . $update['msg'] . '<br/>' . $updateMember['msg'], 'inwavethemes'), 'error');
        $log->addLog(new inFundingLog(NULL, 'error', time(), __('Can\'t update order ' . $order->getOrderCode($data['order_id']) . ': ' . $update['msg'] . '<br/>' . $updateMember['msg'], 'inwavetenes'), $order->getLink($data['order_id'], 'View order')));
    }
    wp_redirect($order->getLink($data['order_id']));
}

function orderResendEmail() {
    $utility = new inFundingUtility();
    $order = new inFundingOrder();
    $order = $order->getOrder($_REQUEST['id']);
    $member = unserialize($order->getMember()->getField_value());
    foreach ($member as $field) {
        switch ($field['name']) {
            case 'full_name':
                $customer_name = $field['value'];
                break;
            case 'email':
                $customer_email = $field['value'];
                break;
            default:
                break;
        }
    }
    $mail_param = array(
        'custome_name' => $customer_name,
    );
    $sendmail = unserialize($utility->sendEmail($customer_email, $mail_param, 'order_info'));
    if ($sendmail['success']) {
        $_SESSION['bt_message'] = $utility->getMessage($sendmail['message']);
    } else {
        $_SESSION['bt_message'] = $utility->getMessage($sendmail['message'], 'error');
    }
    wp_redirect($order->getLink($order->getId()));
}

function inFundingClearOrderExpired() {
    global $inf_settings;
    $utility = new inFundingUtility();
    $timeKill = $inf_settings['general']['order_time_expired'];
    if (!$timeKill) {
        $timeKill = 2;
    }

    $order_time_kill = time() - $timeKill * 3600;
    $order = new inFundingOrder();
    $kills = $order->killOrderExpired($order_time_kill);
    if ($kills > 0) {
        $_SESSION['bt_message'] = $utility->getMessage('Have ' . $kills . ' orders killed');
    } else {
        $_SESSION['bt_message'] = $utility->getMessage(__('No order math to kill', 'inwavethemes'));
    }
    wp_redirect(admin_url('edit.php?post_type=infunding&page=payment'));
}

/**
 * Delete single order on list
 */
function inFundingDeleteOrder() {
    $id = $_GET['id'];
    $utility = new inFundingUtility();
    $order = new inFundingOrder();
    if ($id && is_numeric($id)) {
        $order->deleteOrder($id);
        $_SESSION['bt_message'] = $utility->getMessage(__('Order has been remove', 'inwavethemes'));
    } else {
        $_SESSION['bt_message'] = $utility->getMessage(__('No id set or id invalid', 'inwavethemes'), 'error');
    }
    wp_redirect(admin_url('edit.php?post_type=infunding&page=payment'));
}

/**
 * Delete multiple orders (selected order) on list
 */
function inFundingDeleteOrders() {
    $utility = new inFundingUtility();
    if (isset($_POST['fields']) && !empty($_POST['fields'])) {
        $order = new inFundingOrder();
        $ids = $_POST['fields'];
        $order->deleteOrders($ids);
        $_SESSION['bt_message'] = $utility->getMessage(__('All selected order(s) has been delete', 'inwavethemes'));
    } else {
        $_SESSION['bt_message'] = $utility->getMessage(__('Please select row(s) to delete', 'inwavethemes'), 'error');
    }
    wp_redirect(admin_url('edit.php?post_type=infunding&page=payment'));
}

/* * **************************************************
 * ************ CODE LOG PAGE ****************
 * ************************************************** */

function inFundingLogRenderPage() {
    $utility = new inFundingUtility();
    $paging = new inFundingPaging();
    $logs = new inFundingLog();
    $start = $paging->findStart(INF_LIMIT_ITEMS);
    $count = count($logs->getAllLogs());
    $pages = $paging->findPages($count, INF_LIMIT_ITEMS);
    $logOnPage = $logs->getLogsPerPage($start, INF_LIMIT_ITEMS);
    include_once 'views/logs.list.php';
}

function inFundingViewLogRenderPage() {
    $id = $_GET['id'];
    $utility = new inFundingUtility();
    if ($id && is_numeric($id)) {
        $log = new inFundingLog();
        $log = $log->getLog($id);
        include_once 'views/logs.view.php';
    } else {
        $_SESSION['bt_message'] = $utility->getMessage(__('No id set or id invalid', 'inwavethemes'), 'error');
        wp_redirect(admin_url('edit.php?post_type=infunding&page=logs'));
    }
}

function inFundingDeleteLog() {
    $id = $_GET['id'];
    $utility = new inFundingUtility();
    $log = new inFundingLog();
    if ($id && is_numeric($id)) {
        $del = unserialize($log->deleteLog($id));
        if (!$del['success']) {
            $_SESSION['bt_message'] = $utility->getMessage($del['msg'], 'error');
        } else {
            $_SESSION['bt_message'] = $utility->getMessage(__('Log has been remove', 'inwavethemes'));
        }
    } else {
        $_SESSION['bt_message'] = $utility->getMessage(__('No id set or id invalid', 'inwavethemes'), 'error');
    }
    wp_redirect(admin_url('edit.php?post_type=infunding&page=logs'));
}

function inFundingDeleteLogs() {
    $utility = new inFundingUtility();
    if (isset($_POST['fields']) && !empty($_POST['fields'])) {
        $log = new inFundingLog();
        $ids = $_POST['fields'];
        $msg = $log->deleteLogs($ids);
        if (isset($msg['error']) && isset($msg['success'])) {
            $_SESSION['bt_message'] = $utility->getMessage(__($msg['error'] . $msg['success']), 'notice');
        } elseif (isset($msg['error']) && !isset($msg['success'])) {
            $_SESSION['bt_message'] = $utility->getMessage(__($msg['error']), 'error');
        } elseif (!isset($msg['error']) && isset($msg['success'])) {
            $_SESSION['bt_message'] = $utility->getMessage(__($msg['success']));
        } else {
            $_SESSION['bt_message'] = $utility->getMessage(__('Unknown error', 'inwavethemes'));
        }
    } else {
        $_SESSION['bt_message'] = $utility->getMessage(__('Please select row(s) to delete', 'inwavethemes'), 'error');
    }
    wp_redirect(admin_url('edit.php?post_type=infunding&page=logs'));
}

function inFundingClearLog() {
    $utility = new inFundingUtility();
    $log = new inFundingLog();
    $msg = $log->emptyLog();
    if (isset($msg['error']) && isset($msg['success'])) {
        $_SESSION['bt_message'] = $utility->getMessage(__($msg['error'] . $msg['success']), 'notice');
    } elseif (isset($msg['error']) && !isset($msg['success'])) {
        $_SESSION['bt_message'] = $utility->getMessage(__($msg['error']), 'error');
    } elseif (!isset($msg['error']) && isset($msg['success'])) {
        $_SESSION['bt_message'] = $utility->getMessage(__($msg['success']));
    } else {
        $_SESSION['bt_message'] = $utility->getMessage(__('Unknown error', 'inwavethemes'));
    }
    wp_redirect(admin_url('edit.php?post_type=infunding&page=logs'));
}
