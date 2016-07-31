<?php

/*
 * Inwave_Event_Checkout_Block for Visual Composer
 */
if (!class_exists('Inwave_Event_Checkout_Block')) {

    class Inwave_Event_Checkout_Block {

        private $params;

        function __construct() {
            $this->initParams();
            add_action('vc_before_init', array($this, 'heading_init'));
            add_shortcode('iwe_checkout_block', array($this, 'iwe_checkout_block_shortcode'));
        }

        function initParams() {
            global $iw_shortcodes;
            $events = get_posts(array('posts_per_page' => -1, 'post_type' => 'iwevent'));
            $iwe_settings = unserialize(get_option('iwe_settings'));
            $fields = $iwe_settings['register_form_fields'];
            $field_datas = array();
            $field_datas[] = array('value' => 'all', 'text' => __('All Fields', 'inwavethemes'));
            foreach ($fields as $field) {
                $field_datas[] = array('value' => $field['name'], 'text' => $field['label']);
            }
            $value = array();
            foreach ($events as $event) {
                $value[$event->post_title] = $event->ID;
            }
            $this->params = array(
                'name' => 'IW Event Checkout',
                'description' => __('Add a event checkout block', 'inwavethemes'),
                'base' => 'iwe_checkout_block',
                'category' => 'Custom',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __("Title", 'inwavethemes'),
                        "param_name" => "title",
                        "value" => __('I am Title', 'inwavethemes')
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __("Sub Title", 'inwavethemes'),
                        "param_name" => "subtitle",
                        "value" => __('I am Subtitle', 'inwavethemes')
                    ),
                    array(
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => "Event",
                        "param_name" => "event",
                        "value" => $value
                    ),
                    array(
                        "type" => "inwave_select",
                        "heading" => __("Select field", "inwavethemes"),
                        "param_name" => "fields",
                        "multiple" => true,
                        'data' => $field_datas,
                        'value' => 'all',
                        "description" => __('Select customer field to show on checkout form.', "inwavethemes")
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', "inwavethemes")
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "class" => "",
                        "heading" => "Style",
                        "param_name" => "style",
                        "value" => array(
                            "Style 1 - Normal" => "style1",
                            "Style 2 - Normal Join Us" => "style2",
                            "Style 3 - Business Join Us" => "style3"
                        )
                    )
                )
            );
            $iw_shortcodes['iwe_checkout_block'] = $this->params;
        }

        function heading_init() {
            if (function_exists('vc_map')) {
                // Add banner addon
                vc_map($this->params);
            }
        }

        // Shortcode handler function for list Icon
        function iwe_checkout_block_shortcode($atts, $content = null) {
            extract(shortcode_atts(array(
                'title' => __('I am Title', 'inwavethemes'),
                'subtitle' => __('I am Subtitle', 'inwavethemes'),
                "event" => "",
                "fields" => "all",
                "class" => "",
                'style' => 'style1'
                            ), $atts));
            $subtitle = str_replace('{{', '<span class="theme-color">', $subtitle);
            $subtitle = str_replace('}}', '</span>', $subtitle);
            $class.=' '.$style;
            ob_start();
            echo '<div class="iwe-checkout ' . $class . '">';
            echo '<div class="iwe-title-block"><div class="iwe-title">' . $title.'</div>';
            echo '<div class="iwe-subtitle">' . $subtitle . '</div></div>';
            echo do_shortcode('[iwe_payment_page fields="' . $fields . '" style="'.$style.'" event="' . $event . '"]');
            echo '</div>';
            $html = ob_get_contents();
            ob_end_clean();
            return $html;
        }

    }

}

new Inwave_Event_Checkout_Block();
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_Inwave_Event_Checkout_Block extends WPBakeryShortCode {
        
    }

}