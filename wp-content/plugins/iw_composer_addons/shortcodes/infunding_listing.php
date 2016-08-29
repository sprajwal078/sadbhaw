<?php

/*
 * Inwave_Event_Listing for Visual Composer
 */
if (!class_exists('InFunding_Listing')) {

    class InFunding_Listing {

        private $params;

        function __construct() {
            $this->initParams();
            add_action('vc_before_init', array($this, 'heading_init'));
            add_shortcode('infunding_listing', array($this, 'infunding_listing_shortcode'));
        }

        function initParams() {
            global $iw_shortcodes;
            $this->params = array(
                'name' => 'Crowdfunding Listing',
                'description' => __('Create a list of events', 'inwavethemes'),
                'base' => 'infunding_listing',
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
                        "heading" => "Order By",
                        "param_name" => "order_by",
                        "value" => array(
                            "Date" => "date",
                            "Title" => "title",
                            "Event ID" => "ID",
                            "Name" => "name",
                            "menu_order" => "Ordering",
                            "Random" => "rand"
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => "Order Direction",
                        "param_name" => "order_dir",
                        "value" => array(
                            "Descending" => "desc",
                            "Ascending" => "asc"
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Number of campaign per page", "inwavethemes"),
                        "param_name" => "limit",
                        "value" => 12
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
                        "heading" => "Number of description words",
                        "param_name" => "desc_text_limit",
                        "value" => '20'
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "layout",
                        "class" => "",
                        "heading" => "Style",
                        "param_name" => "style",
                        "value" => array(
                            "Style 1 - Default" => "style1",
                            "Style 2 - Row" => "style2",
                            "Slider - Slider" => "slider",
                            "Slider v2 - Slider" => "slider-v2",
                            "Slider v3 - Slider" => "slider-v3"
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "layout",
                        "class" => "",
                        "heading" => "Show page list",
                        "param_name" => "show_page_list",
                        "value" => array(
                            "Yes" => "1",
                            "No" => "0"
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "layout",
                        "class" => "",
                        "heading" => "Show Time Icon",
                        "param_name" => "show_time_icon",
                        "value" => array(
                            "Yes" => "1",
                            "No" => "0"
                        )
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
                        "type" => "dropdown",
                        "group" => "layout",
                        "class" => "",
                        "heading" => "Number of column",
                        "param_name" => "number_column",
                        "value" => array(
                            "1" => "1",
                            "2" => "2",
                            "3" => "3",
                            "4" => "4"
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "layout",
                        "class" => "",
                        "heading" => "Show filter bar",
                        "param_name" => "show_filter_bar",
                        "description" => __('Only available on default style', 'inwavethemes'),
                        "value" => array(
                            "Yes" => "1",
                            "No" => "0"
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "layout",
                        "class" => "",
                        "heading" => "Show Icon Action",
                        "param_name" => "show_icon_action",
                        "description" => __('Only available on default style', 'inwavethemes'),
                        "value" => array(
                            "Yes" => "1",
                            "No" => "0"
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "layout",
                        "class" => "",
                        "heading" => "Show Campaign Progress",
                        "param_name" => "show_progress",
                        "description" => '',
                        "value" => array(
                            "Yes" => "1",
                            "No" => "0"
                        )
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
            $iw_shortcodes['infunding_listing'] = $this->params;
        }

        function heading_init() {
            if (function_exists('vc_map')) {
                // Add banner addon
                vc_map($this->params);
            }
        }

        // Shortcode handler function for list Icon
        function infunding_listing_shortcode($atts, $content = null) {
            extract(shortcode_atts(array(
                "category" => "0",
                "ids" => '',
                "order_by" => "date",
                "order_dir" => "desc",
                "limit" => 12,
                "show_des" => '1',
                "desc_text_limit" => 20,
                "style" => 'style1',
                "show_page_list" => '1',
                "show_time_icon" => '1',
                "show_location" => '1',
                "number_column" => '3',
                "show_filter_bar" => '1',
                "show_icon_action" => '1',
                "show_progress" => '1',
                "class" => ""
                            ), $atts));

            ob_start();
            echo do_shortcode('[infunding_list category="'.$category.'"  ids="'.$ids.'" order_by="'.$order_by.'" order_dir="'.$order_dir.'" limit="'.$limit.'" show_des="'.$show_des.'" desc_text_limit="'.$desc_text_limit.'" style="'.$style.'" show_page_list="'.$show_page_list.'" show_time_icon="'.$show_time_icon.'" show_location="'.$show_location.'" number_column="'.$number_column.'" show_filter_bar="'.$show_filter_bar.'" show_icon_action="'.$show_icon_action.'" class="'.$class.'" show_progress="'.$show_progress.'"]');
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

new InFunding_Listing();
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_InFunding_Listing extends WPBakeryShortCode {
        
    }

}