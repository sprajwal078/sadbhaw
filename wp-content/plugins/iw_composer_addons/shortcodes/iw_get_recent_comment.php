<?php

/*
 * Inwave_Heading for Visual Composer
 */
if (!class_exists('Inwave_Comment_Recent')) {

    class Inwave_Comment_Recent {

        private $params;

        function __construct() {
            $this->initParams();
            add_action('vc_before_init', array($this, 'recent_comment_init'));
            add_shortcode('inwave_recent_comment', array($this, 'inwave_recent_comment_shortcode'));
        }

        function initParams() {
            global $iw_shortcodes;
            $this->params = array(
                'name' => 'Inwave Recent Comment Post',
                'description' => __('Show Recent Comment Post', 'inwavethemes'),
                'base' => 'inwave_recent_comment',
                'category' => 'Custom',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Number comment", "inwavethemes"),
                        "value" => "3",
                        "param_name" => "number_comment",
                        'description' =>  __( 'Enter number comment to display', 'inwavethemes' )
                    )
                )
            );
            $iw_shortcodes['inwave_recent_comment'] = $this->params;
        }

        function recent_comment_init() {
            if (function_exists('vc_map')) {
                // Add banner addon
                vc_map($this->params);
            }
        }

        // Shortcode handler function for list Icon
        function inwave_recent_comment_shortcode($atts, $content = null) {

            $output = $number_comment = '';

            extract(shortcode_atts(array(
                'number_comment' => '3'
            ), $atts));

            $args = array(
                'number' => $number_comment,
                'orderby' => 'post_date',
                'order' => 'DESC'
            );
            $comments = get_comments($args);
            $output .= '<div class="iw_recent_comment">';
            $output .= '<ul>';
            foreach($comments as $comment) :
                $output .= '<li><span>' . $comment->comment_author . '</span>' . '<p>' .  wp_trim_words( $comment->comment_content, 40 ) . '</p></li>';
            endforeach;
            $output .= '</ul>';
            $output .= '</div>';
            return $output;
        }

    }

}

new Inwave_Comment_Recent;
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_Inwave_Comment_Recent extends WPBakeryShortCode {

    }

}