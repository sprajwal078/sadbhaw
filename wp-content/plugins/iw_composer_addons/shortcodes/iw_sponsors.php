<?php

/*
 * Inwave_Sponsors_Slider for Visual Composer
 */
if (!class_exists('Inwave_Sponsors_Slider')) {

    class Inwave_Sponsors_Slider {

        private $params;
        private $params1;
        private $count;

        function __construct() {
            $this->initParams();
            // action init
            add_action('vc_before_init', array($this, 'sponsors_init'));

            // action shortcode
            add_shortcode('inwave_sponsors_slider', array($this, 'inwave_sponsors_slider_shortcode'));
            add_shortcode('inwave_sponsors', array($this, 'inwave_sponsors_item_shortcode'));
        }

        function initParams() {
            global $iw_shortcodes;
            $this->count = 0;
            $this->params = array(
                "name" => __("Inwave Sponsors Slider", 'inwavethemes'),
                "base" => "inwave_sponsors_slider",
                "content_element" => true,
                'category' => 'Custom',
                'icon' => 'iw-default',
                "description" => __("Add a set of sponsors and give some custom style.", "inwavethemes"),
                "as_parent" => array('only' => 'inwave_sponsors'),
                "show_settings_on_create" => true,
                "js_view" => 'VcColumnView',
                "params" => array(
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
                        "heading" => "Style",
                        "param_name" => "style",
                        "value" => array(
                            "Style 1" => "style1",
                            "Style 2" => "style2",
                            "Style 3" => "style3"
                        )
                    )
                )
            );
            $this->params1 = array(
                "name" => __("Inwave Sponsors", 'inwavethemes'),
                "base" => "inwave_sponsors",
                "class" => "inwave_sponsors",
                'icon' => 'iw-default',
                'category' => 'Custom',
                "description" => __("Add a information block and give some custom style.", "inwavethemes"),
                "show_settings_on_create" => true,
                "params" => array(
                    array(
                        'type' => 'attach_image',
                        "heading" => __("Icon Image", "inwavethemes"),
                        "param_name" => "img",
                        "description" => __("Use for style 4", "inwavethemes"),
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "class" => "",
                        "heading" => "Style",
                        "param_name" => "style",
                        "value" => array(
                            "Style 1" => "style1"
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "value" => "",
                        "description" => __("Write your own CSS and mention the class name here.", "inwavethemes"),
                    )
                )
            );
            $iw_shortcodes['inwave_sponsors_slider'] = $this->params;
            $iw_shortcodes['inwave_sponsors'] = $this->params1;
        }

        /** define params */
        function sponsors_init() {
            if (function_exists('vc_map')) {
                // Add Sponsors list
                vc_map($this->params);
                // Add Sponsors item
                vc_map($this->params1);
            }
        }

        // Shortcode handler function for list
        function inwave_sponsors_slider_shortcode($atts, $content = null) {
            $class = $style = '';
            extract(shortcode_atts(array(
                "class" => "",
                "style" => "style1"
            ), $atts));
            $this->style = $style;

            $class .= ' '. $style;

            $output = '<div class="iw-sponsors-list ' . $class . '">';
            $output .= do_shortcode($content);
            $output .= '</div>';
            return $output;
        }

        // Shortcode handler function for item
        function inwave_sponsors_item_shortcode($atts, $content = null) {

            $output = $class = $style = $img_tag = '';
            $description = preg_replace('/^\<\/p\>(.*)\<p\>$/Usi','$1',$content);
            extract(shortcode_atts(array(
                'img' => '',
                'style' => 'style1',
                'class' => ''
            ), $atts));

            if ($img) {
                $img = wp_get_attachment_image_src($img, 'large');
                $img = $img[0];
                $size = '';
                $img_tag .= '<img ' . $size . ' src="' . $img . '" alt="">';
            }
            switch ($style) {
                case 'style1':
                    $output .= '<div class="iw-sponsors-item ' . $class . '">';
                    if ($img_tag) {
                        $output .= $img_tag;
                    }
                    $output .= '</div>';
                break;

                default:

                break;
            }
            return $output;
        }
    }
}


new Inwave_Sponsors_Slider;
if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_Inwave_Sponsors_Slider extends WPBakeryShortCodesContainer {

    }

}
