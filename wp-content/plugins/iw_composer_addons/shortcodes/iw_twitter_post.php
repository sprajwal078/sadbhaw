<?php

/*
 * Inwave_Heading for Visual Composer
 */
if (!class_exists('Inwave_Twitter_Post')) {

    class Inwave_Twitter_Post {

        private $params;

        function __construct() {
            $this->initParams();
            add_action('vc_before_init', array($this, 'twitter_init'));
            add_shortcode('inwave_twitter_post', array($this, 'inwave_twitter_shortcode'));
        }

        function initParams() {
            global $iw_shortcodes;
            $this->params = array(
                'name' => 'Inwave Twitter Post',
                'description' => __('Show Lastest Post Twitter', 'inwavethemes'),
                'base' => 'inwave_twitter_post',
                'category' => 'Custom',
                'icon' => 'iw-default',
                'params' => array(
                    array(
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => "Style",
                        "param_name" => "style",
                        "value" => array(
                            "Style 1" => "style1",
                            "Style 2" => "style2"
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Twitter number post", "inwavethemes"),
                        "value" => "3",
                        "param_name" => "twitter_number_post",
                        'description' =>  __( 'Enter Twitter number post to display', 'inwavethemes' )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Account:", "inwavethemes"),
                        "value" => "",
                        "param_name" => "twitter_account",
                        'description' =>  __( 'Your Twitter account', 'inwavethemes' ) .  __( ' and You can create a new ', 'inwavethemes' ) . '<a href="https://twitter.com/settings/widgets" target="_blank">' . __( 'Twitter widget.', 'inwavethemes' ) . '</a>'

                ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Twitter Data Widget ID:", "inwavethemes"),
                        "value" => "",
                        "param_name" => "twitter_widget_id",
                        'description' =>  __( 'Enter your Twitter  widgets, ex:657020480394674176', 'inwavethemes' )
                    ),
                )
            );
            $iw_shortcodes['inwave_twitter_post'] = $this->params;
        }

        function twitter_init() {
            if (function_exists('vc_map')) {
                // Add banner addon
                vc_map($this->params);
            }
        }

        // Shortcode handler function for list Icon
        function inwave_twitter_shortcode($atts, $content = null) {

            $output = $style = $twitter_number_post = $twitter_account = $twitter_widget_id = '';

            extract(shortcode_atts(array(
                'style'                 => 'style1',
                'twitter_number_post'   => '3',
                'twitter_account'       => '',
                'twitter_widget_id'     => ''
            ), $atts));

                $output .= '<div class="twitter_lastest_post">';
                if($style == 'style1'){
                    $output .= '<a class="twitter-timeline" data-chrome="noheader" data-tweet-limit= "' . $twitter_number_post . '" data-dnt=true href="https://twitter.com/'.$twitter_account.'" data-widget-id="'. $twitter_widget_id.'"></a>';
                }else{
                    $output .= '<a class="twitter-timeline" data-chrome="noheader noborders nofooter noscrollbar transparent" data-tweet-limit= "' . $twitter_number_post . '" data-dnt=true href="https://twitter.com/'.$twitter_account.'" data-widget-id="'. $twitter_widget_id.'"></a>';

                }
                echo '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
                $output .= '</div>';

            return $output;
        }

    }

}

new Inwave_Twitter_Post;
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_Inwave_Twitter_Post extends WPBakeryShortCode {

    }

}