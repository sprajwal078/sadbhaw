<?php
/*
 * @package Inwave Inhost
 * @version 1.0.0
 * @created Apr 10, 2015
 * @author Inwavethemes
 * @email inwavethemes@gmail.com
 * @website http://inwavethemes.com
 * @support Ticket https://inwave.ticksy.com/
 * @copyright Copyright (c) 2015 Inwavethemes. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */
/**
 * Description of inhost_checkdomain
 *
 * @developer duongca
 */
if (!class_exists('Inhost_Checkdomain')) {
    class Inhost_Checkdomain
    {
        private $domains;
        private $params;
        private $scripts;

        function __construct()
        {
            $this->initParams();
            add_action('vc_before_init', array($this, 'heading_init'));
            add_shortcode('inhost_checkdomain', array($this, 'inhost_checkdomain_shortcode'));
            add_action('wp_enqueue_scripts', array($this, 'inwave_check_domain_scripts'));
            //add ajax action domain lookup
            add_action('wp_ajax_nopriv_domainLookup', array($this, 'domainLookup'));
            add_action('wp_ajax_domainLookup', array($this, 'domainLookup'));
        }

        function initParams()
        {
            global $iw_shortcodes;
            $this->scripts = array(
                'scripts' => array(
                    'custombox' => plugins_url('iw_composer_addons/assets/js/custombox.min.js'),
                    'inwave-check-domain' => plugins_url('iw_composer_addons/assets/js/inwave-check-domain.js')
                ),
                'styles' => array(
                    'custombox' => plugins_url('iw_composer_addons/assets/css/custombox.css'),
                    'inwave-check-domain' => plugins_url('iw_composer_addons/assets/css/inwave-check-domain.css')
                )
            );
            $this->params = array(
                'name' => 'Domain Checking',
                'description' => __('Create a block for checking domain', 'inwavethemes'),
                'base' => 'inhost_checkdomain',
                'category' => 'Custom',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Title", "inwavethemes"),
                        "value" => "",
                        "param_name" => "title"
                    ),
                    array(
                        'type' => 'textarea',
                        "holder" => "div",
                        "heading" => __("Description", "inwavethemes"),
                        "param_name" => "description"
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => __("Domain list", "inwavethemes"),
                        "param_name" => "domain_type",
                        "value" => ".com\n.net\n.org\n.info\n.co\n.biz",
                        "text" => 'Select Domains',
                        "description" => __('Domains to check.', "inwavethemes")
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "class" => "",
                        "heading" => "Style",
                        "param_name" => "style",
                        "value" => array(
                            "Style 1" => "style1",
                            "Style 2" => "style2"
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', "inwavethemes")
                    )
                )
            );
            $iw_shortcodes['inhost_checkdomain'] = $this->params;
            $iw_shortcodes['inhost_checkdomain_script'] = $this->scripts;
        }

        function heading_init()
        {
            if (function_exists('vc_map')) {
                // Add banner addon
                vc_map($this->params);
            }
        }

        function inhost_checkdomain_shortcode($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'title' => '',
                'description' => '',
                'domain_type' => ".com\n.net\n.org\n.info\n.co\n.biz",
                'style' => 'style1',
                'class' => ''
            ), $atts));
            return $this->htmlBoxRender($style, $title, $description, $domain_type, $class);
        }

        function htmlBoxRender($style, $title, $description, $domain_type, $class)
        {
            $domain_type = str_replace('<br />', "\n", $domain_type);
            $domain_type = explode("\n", $domain_type);
            $domains = array();
            $class .= ' ' . $style;
            foreach ($domain_type as $domain) {
                if ($domain) {
                    $domains[] = $domain;
                }
            }
            ob_start();
            ?>
        <div class="inwave-domain-check <?php echo $class; ?>">
            <div class="domain-check-inner">
            <?php
            switch ($style) {
                case 'style1':
                    ?>
                    <div class="input-search-box">
                        <div class="search-input">
                            <div class="left-col theme-bg">
                                <input type="text" name="input_domain"/>

                                <div class="list-domain-check">
                                    <ul class="domain-list">
                                        <?php
                                        foreach ($domains as $domain) {
                                            echo '<li>'
                                                . '<input name="domains[]" type="checkbox" value="' . $domain . '">'
                                                . '<span class="inwave-checkbox"><i class="fa fa-square-o"></i></span>'
                                                . $domain
                                                . '</li>';
                                        }
                                        ?>
                                    </ul>
                                    <div class="output-error-msg theme-color">
                                    </div>
                                </div>
                            </div>
                            <div class="right-col">
                                <a class="theme-bg ibutton ibutton1 ibutton-large"
                                   href="#"><span><?php _e('Search', 'inwavethemes')?></span></a>
                                        <span class="button-link theme-color"><i class="fa fa-th-list"></i><a
                                                style="text-decoration: none;"
                                                href="<?php echo esc_url(self::getWhmcsLink('domainchecker','search=bulkregister')); ?>"> <?php _e('Bulk Domain Search', 'inwavethemes'); ?></a></span>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                    <div class="output-search-box">
                        <div class="list-domain-checked">
                        </div>
                    </div>
                    <?php
                    break;
                case 'style2':
                    ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading-block">
                                        <h3 class="theme-color"><?php echo $title ?></h3>
                                        <p><?php echo $description ?></p>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="list-domain-check">
                                        <div class="input-search-box">
                                            <input type="text" name="input_domain"/>
                                            <div class="domain-select-list">
                                                <ul class="domain-list">
                                                    <?php
                    foreach ($domains as $k => $domain) {
                        if ($k == 0) {
                            $slect = $domain;
                        }
                        echo '<li>'
                            . '<input name="domains[]" type="checkbox" value="' . $domain . '" ' . ($k == 0 ? 'checked="checked"' : '') . '>'
                            . '<span class="inwave-checkbox"><i class="fa fa-check"></i></span>'
                            . $domain
                            . '</li>';
                    }
                    ?>
                                                </ul>
                                                <span class="theme-color select-domain"><i class="fa fa-check"></i> <?php echo $slect; ?></span>
                                            </div>
                                            <button type="submit" class="theme-bg ibutton ibutton1" name="seach_domain"><span><?php _e('Search', 'inwavethemes')?></span></button>
                                        </div>
                                        <div class="domain-link">
                                            <a class="inherit-color" href="<?php echo esc_url(self::getWhmcsLink('domainchecker').'#domain-pricing'); ?>"> <?php _e('View Domain Price List', 'inwavethemes'); ?></a> | 
                                            <a class="inherit-color" href="<?php echo esc_url(self::getWhmcsLink('domainchecker','search=bulkregister')); ?>"> <?php _e('Bulk Domain Search', 'inwavethemes'); ?></a> | 
                                            <a class="inherit-color" href="<?php echo esc_url(self::getWhmcsLink('domainchecker','transfer=transfer')); ?>"> <?php _e('Transfer Domain', 'inwavethemes'); ?></a>
                                        </div>
                                        <div class="output-error-msg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="output-search-box">
                                <div class="list-domain-checked">
                                </div>
                            </div>
                            <?php
                    break;
            }
            echo '</div>';
            echo '</div>';
            $html = ob_get_contents();
            ob_end_clean();
            return $html;
        }
		
		public static function getWhmcsLink($page,$action = ''){
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			$link = '#';
			if(function_exists('cc_whmcs_bridge_mainpage')){
				$link = get_the_permalink(cc_whmcs_bridge_mainpage());
			}
			if(!get_option('permalink_structure')){
				$link .= '&ccce='.$page;
				if($action){
					$link .= '&'.$action;
				}
			}
			else{
				if (get_option('cc_whmcs_bridge_permalinks') && function_exists('cc_whmcs_bridge_parser_with_permalinks')){
					$link .= $page;
					if($action){
						$link .= '?'.$action;
					}
				}else{
					$link .= '?ccce='.$page;
					if($action){
						$link .= '&'.$action;
					}
				}
			}
			
			return $link;
		}

        function inwave_check_domain_scripts()
        {
            $theme_info = wp_get_theme();
            wp_enqueue_style('custombox', plugins_url('iw_composer_addons/assets/css/custombox.css'), array(), $theme_info->get('Version'));
            wp_enqueue_script('custombox', plugins_url('iw_composer_addons/assets/js/custombox.min.js'), array('jquery'), $theme_info->get('Version'), true);
            wp_enqueue_style('inwave-check-domain', plugins_url('iw_composer_addons/assets/css/inwave-check-domain.css'), array(), $theme_info->get('Version'));
            wp_register_script('inwave-check-domain', plugins_url('iw_composer_addons/assets/js/inwave-check-domain.js'), array('jquery'), $theme_info->get('Version'), true);
            $iwConfig = array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'siteUrl' => site_url(),
                'whmcs_pageid' => get_option("cc_whmcs_bridge_pages"),
                'msg_suggest' => __('Please enter the domain name you want to register!', 'inwavethemes'),
                'msg_available' => __(' Congrast %d is available!', 'inwavethemes'),
                'msg_unavailable' => __('%d is not available!', 'inwavethemes')
            );
            wp_localize_script('inwave-check-domain', 'iwConfig', $iwConfig);
            wp_enqueue_script('inwave-check-domain');
        }

        function domainLookup()
        {
            $return = array('success' => FALSE, 'msg' => '', 'data' => '');
            $url = get_option('cc_whmcs_bridge_url') . '/includes/api.php'; # URL to WHMCS API file
            $username = get_option('cc_whmcs_bridge_admin_login'); # Admin username goes here
            $password = get_option('cc_whmcs_bridge_admin_password'); # Admin password goes here
            $postfields = array();
            $postfields["username"] = $username;
            $postfields["password"] = md5($password);
            $postfields["action"] = "domainwhois";
            $postfields["domain"] = $_POST['domain'];
            $postfields["responsetype"] = "json";
            $query_string = "";
            foreach ($postfields AS $k => $v)
                $query_string .= "$k=" . urlencode($v) . "&";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $jsondata = curl_exec($ch);
            if (curl_error($ch))
                die("Connection Error: " . curl_errno($ch) . ' - ' . curl_error($ch));
            curl_close($ch);
            $arr = json_decode($jsondata); # Decode JSON String
            $return['success'] = $arr->result == 'success' ? true : false;
            if (!$return['success']) {
                $return['msg'] = $arr->message;
            } else {
                $return['msg'] = $arr->status;
                $return['data'] = $arr->whois;
            }
            echo json_encode($return);
            exit();
        }
    }
}
new Inhost_Checkdomain();
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Inhost_Checkdomain extends WPBakeryShortCode
    {

    }
}