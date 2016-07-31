<?php
/*
 * @package Inwave Percentage
 * @version 1.0.0
 * @created October 8, 2015
 * @author Inwavethemes
 * @email inwavethemes@gmail.com
 * @website http://inwavethemes.com
 * @support Ticket https://inwave.ticksy.com/
 * @copyright Copyright (c) 2015 Inwavethemes. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */

/**
 * Description of athlete_map
 *
 * @Developer duongca
 */
if (!class_exists('Inwave_Text_Box')) {

    class Inwave_Text_Box {

        private $params;
        private $scripts;

        function __construct() {
            $this->initParams();

            add_action('vc_before_init', array($this, 'heading_init'));
            add_shortcode('inwave_text_box', array($this, 'inwave_text_box_shortcode'));
        }

        function initParams() {
            global $iw_shortcodes;
            $this->params = array(
                'name' => 'Text_box',
                'description' => __('Inwave Text Box', 'inwavethemes'),
                'base' => 'inwave_text_box',
                'icon' => 'iw-default',
                'category' => 'Custom',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "span",
                        "heading" => __("Title", "inwavethemes"),
                        "description" => __("You can add |TEXT_EXAMPLE| to specify strong words, {TEXT_EXAMPLE} to specify colorful words", "inwavethemes"),
                        "value" => "",
                        "param_name" => "title"
                    ),
                    array(
                        "type" => "iwicon",
                        "class" => "",
                        "heading" => __("Select Icon", "inwavethemes"),
                        "param_name" => "icon",
                        "value" => "",
                        "admin_label" => true,
                        "description" => __("Click and select icon of your choice. You can get complete list of available icons here: <a target='_blank' href='http://fortawesome.github.io/Font-Awesome/icons/'>Font-Awesome</a>", "inwavethemes"),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Icon Size", "inwavethemes"),
                        "param_name" => "icon_size",
                        "description" => __("Example: 70", "inwavethemes"),
                        "value" => "70"
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "value" => "",
                        "description" => __("Write your own CSS and mention the class name here.", "inwavethemes"),
                    ),
                )
            );
            $iw_shortcodes['inwave_text_box'] = $this->params;
        }

        function heading_init() {

            // Add banner addon
            if (function_exists('vc_map')) {
                vc_map($this->params);
            }
        }

        function inwave_text_box_shortcode($atts, $content = null) {
            $output = $title = $icon = $icon_size = $class = '';
            $content = preg_replace('/^\<\/p\>(.*)\<p\>$/Usi','$1',$content);
            extract(shortcode_atts(array(
                'title' => '',
                'icon' => '',
                'icon_size' => '70',
                'class' => ''
            ), $atts));
            if ($icon_size) {
                $size = 'style="width:' . $icon_size . 'px!important;"';
            }
            $extracss = '';
            $title= preg_replace('/\|(.*)\|/isU','<strong>$1</strong>',$title);
            $title= preg_replace('/\{(.*)\}/isU','<span class="theme-color">$1</span>',$title);
            $output .= '<div class="iw-text-box ' . $class . '">';
            if ($title) {
                $output .= '<div class="iw-text-box-title">' . $title . '</div>';
            }
            if ($icon) {
                $output .= '<div class="icon"><i style="font-size:'.$icon_size.'px" class="' . $icon . '"></i></div>';
            }
            $output .= '</div>';
            return $output;
        }

    }

}
new Inwave_Text_Box;
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_Inwave_Text_Box extends WPBakeryShortCode {

    }

}