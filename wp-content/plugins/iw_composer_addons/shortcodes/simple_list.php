<?php

/*
 * Inwave_Simple_List for Visual Composer
 */
if (!class_exists('Inwave_Simple_List')) {

    class Inwave_Simple_List {

        private $params;

        function __construct() {
            $this->initParams();
            add_action('vc_before_init', array($this, 'simple_list_init'));
            add_shortcode('inwave_simple_list', array($this, 'inwave_simple_list_shortcode'));
        }

        function initParams() {
            global $iw_shortcodes;
            $this->params = array(
                'name' => 'Simple List',
                'description' => __('Add a items list with some simple style', 'inwavethemes'),
                'base' => 'inwave_simple_list',
                'category' => 'Custom',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        'type' => 'textarea',
                        "holder" => "div",
                        "heading" => __("Content", "inwavethemes"),
                        "value" => '<ul>
    <li>Lorem ipsum dolor sit amet</li>
    <li>Lorem ipsum dolor sit amet</li>
    <li>Lorem ipsum dolor sit amet</li>
    <li>Lorem ipsum dolor sit amet</li>
    <li>Lorem ipsum dolor sit amet</li>
</ul>',
                        "description" => "Format: <br>Inactive Item: ".htmlspecialchars('<li>Lorem ipsum dolor sit amet</li>')."<br>Active Item: ".htmlspecialchars('<li class="active">Lorem ipsum dolor sit amet</li>')."",
                        "param_name" => "content"
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', "inwavethemes")
                    ),
                    array(
                        "type" => "dropdown",
                        "class" => "",

                        "heading" => "Style",
                        "param_name" => "style",
                        "value" => array(
                            "None" => "none",
                            "Check Mark" => "check-mark",
                            "Angle Right" => "angle-right",
                            "Chevron Circle Right" => "chevron-circle-right",
                            "Stars" => "stars",
                            "circle" => "circle",
							"Check Circle" => "check-circle",
                            "Numbers" => "numbers"
                        )
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
            $iw_shortcodes['inwave_simple_list'] = $this->params;
        }
        function simple_list_init() {
            if (function_exists('vc_map')) {
                // Add banner addon
                vc_map($this->params);
            }
        }
        // Shortcode handler function for list Icon
        function inwave_simple_list_shortcode($atts, $content = null) {
            $output = $class = $style = $align = $css = '';
            $content = preg_replace('/^\<\/p\>(.*)\<p\>$/Usi','$1',$content);
            extract(shortcode_atts(array(
                'style' => 'none',
                'class' => '',
                'align' => '',
                'css' => ''
                            ), $atts));
            $class .= ' '.$style.' '. vc_shortcode_custom_css_class( $css);

            if($align){
                $class.= ' '.$align.'-text';
            }

            $output .= '<div class="simple-list ' . $class . '">';


                $i = 0;
                do {
                    $i++;
                    if($style == 'none') {
                        $replacer = '<#$1><span class="list-content">';
                    }
                    else if($style == 'numbers') {
                        $replacer = '<#$1><span class="number"> '. ($i<10?'0':'') . $i . '</span><span class="list-content">';
                    }
                    else if($style == 'stars') {
                        $replacer = '<#$1> <i class="fa fa-star"></i><span class="list-content">';
                    }
					else if($style == 'check-circle') {
                        $replacer = '<#$1> <i class="fa fa-check-circle"></i><span class="list-content">';
                    }
					else if($style == 'circle') {
                        $replacer = '<#$1> <i class="fa fa-circle"></i><span class="list-content">';
                    }
                    else if($style == 'angle-right') {
                        $replacer = '<#$1> <i class="fa fa-chevron-right"></i><span class="list-content">';
                    }
                    else if($style == 'chevron-circle-right') {
                        $replacer = '<#$1> <i class="fa fa-chevron-circle-right"></i><span class="list-content">';
                    }
                    else{
                        $replacer = '<#$1> <i class="fa fa-check"></i><span class="list-content">';
                    }
                    $content = preg_replace('/\<li(.*)\>/Uis',$replacer, $content, 1, $count);
            } while ($count);
            $content = str_replace('<#','<li',$content);
            $content = str_replace('</li>','</span></li>',$content);
            $output .= $content;
            $output .= '</div>';
            return $output;
        }
    }

}

new Inwave_Simple_List;
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_Inwave_Simple_List extends WPBakeryShortCode {
        
    }

}