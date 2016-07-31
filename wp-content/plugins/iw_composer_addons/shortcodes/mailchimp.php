<?php

/*
 * Inwave_Heading for Visual Composer
 */
if (!class_exists('Inwave_Mailchimp')) {

    class Inwave_Mailchimp {

        private $params;

        function __construct() {
            $this->initParams();
            add_action('vc_before_init', array($this, 'mailchimp_init'));
            add_shortcode('inwave_mailchimp', array($this, 'inwave_mailchimp_shortcode'));
            add_action('wp_enqueue_scripts', array($this, 'mailchimp_scripts'));
        }
        function mailchimp_scripts(){
            $theme_info = wp_get_theme();
            wp_register_script('mailchimp-script', plugins_url() . '/iw_composer_addons/assets/js/mailchimp.js', array('jquery'), $theme_info->get('Version'));
        }

        function initParams() {
            global $iw_shortcodes;
            $this->params = array(
                'name' => 'Mailchimp subscribe',
                'description' => __('Simple form for mailchimp', 'inwavethemes'),
                'base' => 'inwave_mailchimp',
                'icon' => 'iw-default',
                'category' => 'Custom',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Title", "inwavethemes"),
                        "value" => "",
                        "param_name" => "title",
						"description" => __("You can add |TEXT_EXAMPLE| to specify strong words", "inwavethemes"),
                        "dependency" => array('element' => 'style', 'value' => array('style1','style2','style4'))
                    ),
					array(
                        'type' => 'textfield',
                        "heading" => __("Description", "inwavethemes"),
                        "value" => "",
                        "param_name" => "desc",
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Action URL", "inwavethemes"),
                        "value" => "",
                        "description"=> "How to get it? Just go to your <a href='https://us11.admin.mailchimp.com/lists/' target='_blank'>Mailchimp list</a> -> \"Signup forms\" -> \"Embedded forms\" and then take form action url in <a href='http://prntscr.com/7lieht' target='_blank'>the embed code</a>",
                        "param_name" => "action"
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Show 'Your name'", "inwavethemes"),
                        "param_name" => "show_name",
                        "value" => array(
                            'No' => '0',
                            'Yes' => '1'
                        ),
                        "dependency" => array('element' => 'style', 'value' => array('style1','style2', 'style4'))
                    ),
                    array(
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => "Style",
                        "param_name" => "style",
                        "value" => array(
                            "Style 1" => "style1",
                            "Style 2" => "style2",
                            "Style 3" => "style3",
							"Style 4" => "style4",
                        )
                    ),
                )
            );
            $iw_shortcodes['inwave_mailchimp'] = $this->params;
        }

        function mailchimp_init() {
            if (function_exists('vc_map')) {
                // Add banner addon
                vc_map($this->params);
            }
        }

        // Shortcode handler function for list Icon
        function inwave_mailchimp_shortcode($atts, $content = null) {
            $output = $action = $desc = '';
            extract(shortcode_atts(array(
                'title' => '',
				'desc' => '',
                'action' => '',
                'style' => 'style1',
                'show_name' => '',
                'class' => ''
                            ), $atts));

            $response['submit'] = __('Submitting...','inwavethemes');
            $response[0] = __('We have sent you a confirmation email','inwavethemes');
            $response[1] = __('Please enter a value','inwavethemes');
            $response[2] = __('An email address must contain a single @','inwavethemes');
            $response[3] = __('The domain portion of the email address is invalid (the portion after the @: )','inwavethemes');
            $response[4] = __('The username portion of the email address is invalid (the portion before the @: )','inwavethemes');
            $response[5] = __('This email address looks fake or invalid. Please enter a real email address','inwavethemes');

            $response = json_encode($response);
            $class .= ' ' . $style;
			
			
			$title= preg_replace('/\|(.*)\|/isU','<strong>$1</strong>',$title);

            $output .= '<div class="iw-mailchimp-form '.$class.'"><form class="iw-email-notifications" action="' . $action . '" data-response="' . htmlentities($response) . '">';
            
			switch($style) {
				case 'style1':
					$output .= '<div class="ajax-overlay"><span class="ajax-loading"><i class="fa fa-spinner fa-spin fa-2x"></i></span></div>';
					if($title){
						$output .= '<h3>'.$title.'</h3>';
					}
					if($show_name){
						$output .= '<input class="mc-name" type="text" placeholder="' . esc_attr(__('Enter your name', 'inwavethemes')) . '"> &nbsp; ';
					}
					$output .= '<input class="mc-email" type="email" placeholder="' . esc_attr(__('Enter your email', 'inwavethemes')) . '">';
					$output .= '<button class="theme-bg" type="submit">' . esc_attr(__('GO', 'inwavethemes')) . '</button>';
					$output .= '<div class="response"><label></label></div>';

				break;
				case 'style2':
					$output .= '<div class="ajax-overlay"><span class="ajax-loading"><i class="fa fa-spinner fa-spin fa-2x"></i></span></div>';
					if($title){
						$output .= '<h3>'.$title.'</h3>';
					}
					if($show_name){
						$output .= '<span class="mc-name-wrap"><input class="mc-name" type="text" placeholder="' . esc_attr(__('Your name', 'inwavethemes')) . '"></span> &nbsp; ';
					}
					$output .= '<span class="mc-email-wrap"><input class="mc-email" type="email" placeholder="' . esc_attr(__('Your email', 'inwavethemes')) . '"></span>';
					$output .= '<button class="theme-bg ibutton ibutton-small" type="submit">' . esc_attr(__('Keep me updates', 'inwavethemes')) . '</button>';
					$output .= '<div class="response"><label></label></div>';
				break;
				case 'style3':
					$output .= '<div class="ajax-overlay"><span class="ajax-loading"><i class="fa fa-spinner fa-spin fa-2x"></i></span></div>';
					$output .= '<span>' . esc_attr(__('YOUR EMAIL:', 'inwavethemes')) . '</span> &nbsp; ';
					$output .= '<input class="mc-email" type="email"  placeholder="' .esc_attr(__('GET OUR NEWS UPDATE', 'inwavethemes')) .'">';
					$output .= '<button type="submit"><i class="fa fa-long-arrow-right "></i></button>';
					$output .= '<span class="response"><label></label></span>';
				break;
				case 'style4':
					$output .= '<div class="ajax-overlay"><span class="ajax-loading"><i class="fa fa-spinner fa-spin fa-2x"></i></span></div>';
					$output .= '<div class="row">';
						if($title || $desc){
							$output .= '<div class="col-md-4 col-sm-6 col-xs-12">';
								$output .= '<div class="malchimp-intro">';
									if($title){
										$output .= '<h3>'.$title.'</h3>';
									}
									if($desc){
										$output .= '<div class="malchimp-desc">'.$desc.'</div>';
									}
								$output .= '</div>';
							$output .= '</div>';
						}
						$output .= '<div class="col-md-8 col-sm-6 col-xs-12">';
							$output .= '<div class="malchimp-input">';
								$output .= '<input class="mc-name" type="text" placeholder="' . esc_attr(__('Your name', 'inwavethemes')) . '">';
								$output .= '<input class="mc-email" type="email" placeholder="' . esc_attr(__('Your email', 'inwavethemes')) . '">';
								$output .= '<button class="mc-submit-button" type="submit">' . esc_attr(__('Submit', 'inwavethemes')) . '</button>';
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="response"><label></label></div>';
				break;
			}
            
            $output .= '</form></div>';

            wp_enqueue_script('mailchimp-script');
            return $output;
        }

    }

}

new Inwave_Mailchimp;
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_Inwave_Mailchimp extends WPBakeryShortCode {
        
    }

}