<?php

/*
 * @package Inwave Inhost
 * @version 1.0.0
 * @created May 5, 2015
 * @author Inwavethemes
 * @email inwavethemes@gmail.com
 * @website http://inwavethemes.com
 * @support Ticket https://inwave.ticksy.com/
 * @copyright Copyright (c) 2015 Inwavethemes. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */

/**
 * Description of testimonials
 *
 * @developer duongca
 */
if (!class_exists('Inwave_Testimonials')) {

    class Inwave_Testimonials {

        private $testimonials;
        private $testimonial_item;
        private $has_parent;
        private $scripts;

        function __construct() {
            $this->initParams();
            // action init
            add_action('vc_before_init', array($this, 'testimonials_init'));
            add_action('wp_enqueue_scripts', array($this, 'inwave_testimonials_scripts'));
            // action shortcode
            add_shortcode('inwave_testimonials', array($this, 'inwave_testimonials_shortcode'));
            add_shortcode('inwave_testimonial_item', array($this, 'inwave_testimonial_item_shortcode'));
        }

        function inwave_testimonials_scripts() {
            getShortcodeScript($this->scripts);
        }

        function initParams() {
            global $iw_shortcodes;
            $this->scripts = array(
                'scripts' => array('iw-testimonials' => plugins_url('iw_composer_addons/assets/js/iw-testimonials.js')),
                'styles' => array('iw-testimonials' => plugins_url('iw_composer_addons/assets/css/iw-testimonials.css'))
            );
            $this->testimonials = array(
                "name" => __("Testimonial Slider", 'inwavethemes'),
                "base" => "inwave_testimonials",
                "content_element" => true,
                'category' => 'Custom',
                'icon' => 'iw-default',
                "description" => __("Add a set of testimonial and give some custom style.", "inwavethemes"),
                "as_parent" => array('only' => 'inwave_testimonial_item'),
                "show_settings_on_create" => true,
                "js_view" => 'VcColumnView',
                "params" => array(

                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "class" => "iw-testimonials-style",
                        "heading" => "Style",
                        "param_name" => "layout",
                        "value" => array(
                            "Style 1" => "layout1",
                        )
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
            $this->testimonial_item = array(
                "name" => __("Testimonial Item", 'inwavethemes'),
                "base" => "inwave_testimonial_item",
                "class" => "inwave_testimonial_item",
                'icon' => 'iw-default',
                'category' => 'Custom',
                "description" => __("Add a list of testimonials with some content and give some custom style.", "inwavethemes"),
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "iw-testimonial-title iw-hidden",
                        "heading" => __("Title", "inwavethemes"),
                        "value" => "",
                        "param_name" => "title"
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Name", "inwavethemes"),
                        "value" => "This is Name",
                        "param_name" => "name"
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "class" => "iw-testimonial-position iw-hidden",
                        "heading" => __("Position", "inwavethemes"),
                        "value" => "",
                        "param_name" => "position"
                    ),
                    array(
                        "type" => "attach_image",
                        "class" => "iw-testimonial-image",
                        "heading" => __("Client Image", "inwavethemes"),
                        "param_name" => "image",
                        "value" => "",
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => "Testimonial Text Left",
                        "param_name" => "testimonial_text_left",
                        "value" => "Lorem ipsum dolor sit amet, consectetur adi sollicitudin"
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => "Testimonial Text Right",
                        "param_name" => "testimonial_text_right",
                        "value" => "Lorem ipsum dolor sit amet, consectetur adi sollicitudin"
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => "Signature",
                        "param_name" => "signature",
                        "value" => ""
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "class" => "iw-testimonials-style",
                        "heading" => "Style",
                        "param_name" => "layout",
                        "value" => array(
                            "Style 1 - content left right" => "layout1",
							"Style 2 - Signature" => "layout2",
							"Style 3 - Intro in become volunteer" => "layout3",
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "value" => "",
                        "description" => __("Write your own CSS and mention the class name here.", "inwavethemes"),
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "class" => "",
                        "heading" => __("Text align", "inwavethemes"),
                        "param_name" => "align",
                        "value" => array(
                            "Default" => "",
                            "Left" => "left",
                            "Right" => "right",
                            "Center" => "center"
                        )
                    ),
                    array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'js_composer' ),
                        'param_name' => 'css',
                        // 'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
                        'group' => __( 'Design Options', 'js_composer' )
                    )
                )
            );
            $iw_shortcodes['inwave_testimonials'] = $this->testimonials;
            $iw_shortcodes['inwave_testimonial_item'] = $this->testimonial_item;
            $iw_shortcodes['inwave_testimonial_item_script'] = $this->scripts;
        }

        /** define params */
        function testimonials_init() {
            if (function_exists('vc_map')) {
                // Add infor list
                vc_map($this->testimonials);
                // Add infor list
                vc_map($this->testimonial_item);
            }
        }

        // Shortcode handler function for list
        function inwave_testimonials_shortcode($atts, $content = null) {
            $output = $class = '';
            //$id = 'iwt-' . rand(10000, 99999);
            extract(shortcode_atts(array(
                "class" => ""
                            ), $atts));
//            $this->has_parent = true;
            $output .= '<div class="iw-testimonals ' . $class . '">';
            $matches = array();

            //$count = preg_match_all('/\[inwave_testimonial_item(?:\s+layout="([^\"]*)"){0,1}(?:\s+title="([^\"]*)"){0,1}(?:\s+name="([^\"]*)"){0,1}(?:\s+date="([^\"]*)"){0,1}(?:\s+position="([^\"]*)"){0,1}(?:\s+image="([^\"]*)"){0,1}(?:\s+rate="([^\"]*)"){0,1}(?:\s+testimonial_text="([^\"]*)"){0,1}(?:\s+class="([^\"]*)"){0,1}\]/i', $content, $matches);
            $count = preg_match_all( '/inwave_testimonial_item([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );


            if ($count) {
                $output.= '<div class="testi-owl-maincontent">';
                $items = array();

                foreach ($matches[1] as $value) {
                    $items[] = shortcode_parse_atts( $value[0] );
                }
                foreach ($items as $key => $item) {
                    $text = html_entity_decode($item['title']);
                    $output.= '<div class="iw-testimonial-item ' . ($key == 0 ? 'active' : '') . '">';
                    $output.= '<div class="testi-content">' . $text . '</div>';
                    $output.= '</div>';
                }
                $output.= '</div>';
                $output.= '<div class="testi-owl-clientinfo">';
                foreach ($items as $key => $item) {
                    $name = html_entity_decode($item['name']);
                    $position = html_entity_decode($item['position']);
                    $image = $item['image'];
                    if ($image) {
                        $img = wp_get_attachment_image_src($image);
                        $image = '<img class="grayscale" src="' . $img[0] . '" alt=""/>';
                    }
                    $output.= '<div data-item-active="' . $key . '" class="iw-testimonial-client-item ' . ($key == 0 ? 'active' : '') . '">';
                    $output.= '<div class="testi-image">' . $image . '</div>';
                    $output.= '<div class="testi-client-info">';
                    $output.= '<div class="testi-client-name">' . $name . '</div>';
                    $output.= '<div class="testi-client-position">' . $position . '</div>';
                    $output.= '</div>';
                    $output.= '</div>';
                }
                $output.= '</div>';
            }
            $output .= '</div>';
            $output .= '<div style="clear:both;"></div>';
            $output .= '<script type="text/javascript">';
            $output .= '(function ($) {';
            $output .= '$(document).ready(function () {';
            $output .= '$(".iw-testimonals").iwCarousel();';
            $output .= '});';
            $output .= '})(jQuery);';
            $output .= '</script>';

            return $output;
        }

        // Shortcode handler function for item
        function inwave_testimonial_item_shortcode($atts, $content = null) {
            $output = $layout = $title = $name = $position = $image = $testimonial_text_left = $testimonial_text_right = $signature = $class = $align = $css = '';
            extract(shortcode_atts(array(
                'layout' => 'layout1',
                'title' => '',
                'name' => '',
                'position' => '',
                'image' => '',
                'testimonial_text_left' => '',
                'testimonial_text_right' => '',
                'signature' => '',
                'align' => '',
                'css' => '',
                'class' => ''
                            ), $atts));
            $class .= ' '.$layout.' '. vc_shortcode_custom_css_class( $css);

            if($align){
                $class.= ' '.$align.'-text';
            }


            if ($this->has_parent) {
                $output .= '<div class="iw-tab-item-content iw-hidden ' . $class . '">';
                $output .= $content;
                $output .= '</div>';
            } else {
                if ($image) {
                    $img = wp_get_attachment_image_src($image);
                    $image = '<img src="' . $img[0] . '" alt=""/>';
                }
                $output .= '<div class="iw-testimonial-item ' . $class . '">';
                switch ($layout) {
                    case 'layout1':
                        $output .= '<div class="content">';
                        $output .= '<div class="testi-image">' . $image . '</div>';
                        $output .= '<div class="testi-title">' . $title . '</div>';
                        $output .= '<div class="iw-testimonial-info row">';
                        $output .= '<div class="testimonial-info-left col-sm-6 col-md-6">';
                        $output .= '<div class="testi-text-left">' . html_entity_decode($testimonial_text_left) . '</div>';
                        $output .= '</div>';
                        $output .= '<div class="testimonial-info-right col-sm-6 col-md-6">';
                        $output .= '<div class="testi-text-right">' . html_entity_decode($testimonial_text_right) . '</div>';
                        $output .= '<div class="testi-signature">' . html_entity_decode($signature) . '</div>';
                        $output .= '<div class="testi-name-position"><span class="testi-name">' . html_entity_decode($name) . '</span> - <span class="testi-client-position">' . html_entity_decode($position) . '</span></div>';
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '</div>';
                        break;
					case 'layout2':
						$output .= '<div class="content">';
						$output .= '<div class="iw-testimonial-info">';
						$output .= '<div class="testi-text-1">' . html_entity_decode($testimonial_text_left) . '</div>';
						$output .= '<div class="testi-text-2">' . html_entity_decode($testimonial_text_right) . '</div>';
						$output .= '</div>';
						$output .= '<div class="testi-signature">' . html_entity_decode($signature) . '</div>';
						$output .= '<div class="testi-name-position"><span class="testi-name">' . html_entity_decode($name) . '</span> - <span class="testi-client-position">' . html_entity_decode($position) . '</span></div>';
						
						$output .= '</div>';
					break;
					
					case 'layout3':
						$output .= '<div class="content">';
						$output .= '<div class="testi-image">' . $image . '</div>';
						$output .= '<div class="iw-testimonial-info">';
						$output .= '<div class="testi-text">' . html_entity_decode($testimonial_text_left) . '</div>';
						$output .= '</div>';						
						$output .= '</div>';
					break;
                    default:
                    break;
                }

                $output .= '<div style="clear: both;"></div>';
                $output .= '</div>';
            }
            return $output;
        }

    }

}

new Inwave_Testimonials;
if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_Inwave_Testimonials extends WPBakeryShortCodesContainer {
        
    }

}
