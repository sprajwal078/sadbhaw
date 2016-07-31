<?php

/*
 * Inwave_Event_Map for Visual Composer
 */
if (!class_exists('InFunding_Map')) {

    class InFunding_Map {

        private $params;

        function __construct() {
            $this->initParams();
            add_action('vc_before_init', array($this, 'heading_init'));
            add_action('wp_enqueue_scripts', array($this, 'infunding_add_scripts'));
            add_shortcode('vc_infunding_map', array($this, 'infunding_map_shortcode'));
        }

        function initParams() {
            global $iw_shortcodes;
            $this->params = array(
                'name' => 'Project by region',
                'description' => __('Create a list of events', 'inwavethemes'),
                'base' => 'vc_infunding_map',
                'category' => 'Custom',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "inwave_select",
                        "class" => "",
                        'multiple' => 'true',
                        "heading" => "Campaign Category",
                        "param_name" => "category",
                        "data" => $this->getCampaignCategories()
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Campaign Ids", "inwavethemes"),
                        "value" => "",
                        "param_name" => "ids",
                        "description" => __('Id of posts you want to get. Separated by commas. IF this value is set, data is result value only', "inwavethemes")
                    ),
                    array(
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => "Show description",
                        "param_name" => "show_des",
                        "value" => array(
                            "Yes" => "1",
                            "No" => "0"
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => "Number of description text",
                        "param_name" => "desc_text_limit",
                        "value" => '20'
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "layout",
                        "class" => "",
                        "heading" => "Show Location",
                        "param_name" => "show_location",
                        "value" => array(
                            "Yes" => "1",
                            "No" => "0"
                        )
                    ),
                    array(
                        "type" => "iw_map",
                        "heading" => __("Map", "inwavethemes"),
                        "param_name" => "map",
                        "description" => ''
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "layout",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', "inwavethemes")
                    )
                )
            );
            $iw_shortcodes['vc_infunding_map'] = $this->params;
        }
        function infunding_add_scripts(){
            $theme_info = wp_get_theme();
            wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js', array('jquery'), $theme_info->get('Version'));
            wp_enqueue_script('infunding_map', plugins_url('iw_composer_addons/assets/js/infunding_map.js'), array('jquery'), $theme_info->get('Version'), true);
            wp_enqueue_script('markerclusterer', plugins_url('iw_composer_addons/assets/js/markerclusterer.js'), array('jquery'), $theme_info->get('Version'), true);
        }

        function heading_init() {
            if (function_exists('vc_map')) {
                // Add banner addon
                vc_map($this->params);
            }
        }

        // Shortcode handler function for list Icon
        function infunding_map_shortcode($atts, $content = null) {
            extract(shortcode_atts(array(
                "category" => "0",
                "ids" => '',
                "show_des" => '1',
                "desc_text_limit" => 20,
                "show_location" => '1',
                "map"=>'',
                "class" => ""
                            ), $atts));
            ob_start();
            echo do_shortcode('[infunding_map category="'.$category.'" map="'.$map.'"  ids="'.$ids.'" show_des="'.$show_des.'" desc_text_limit="'.$desc_text_limit.'" show_location="'.$show_location.'" class="'.$class.'"]');
            $html = ob_get_contents();
            ob_end_clean();
            return $html;
        }

        function getCampaignCategories() {
            global $wpdb;
            $categories = $wpdb->get_results('SELECT a.name, a.term_id FROM ' . $wpdb->prefix . 'terms AS a INNER JOIN ' . $wpdb->prefix . 'term_taxonomy AS b ON a.term_id = b.term_id WHERE b.taxonomy=\'infunding_category\'');
            $newCategories = array();
            $newCategories[] = array('text' => __("All", "vinasys"), 'value' => '0');
            foreach ($categories as $cat) {
                $newCategories[] = array('text' => $cat->name, 'value' => $cat->term_id);
            }
            return $newCategories;
        }

    }

}

new InFunding_Map();
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_InFunding_Map extends WPBakeryShortCode {
        
    }

}