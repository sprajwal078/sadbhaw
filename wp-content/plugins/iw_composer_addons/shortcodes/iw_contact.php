<?php
/*
 * @package Inwave Athlete
 * @version 1.0.0
 * @created Mar 31, 2015
 * @author Inwavethemes
 * @email inwavethemes@gmail.com
 * @website http://inwavethemes.com
 * @support Ticket https://inwave.ticksy.com/
 * @copyright Copyright (c) 2015 Inwavethemes. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */

/**
 * Description of iw_contact
 *
 * @Developer duongca
 */
if (!class_exists('Inwave_Contact')) {

    class Inwave_Contact
    {

        private $params;

        function __construct()
        {
            $this->initParams();
            add_action('vc_before_init', array($this, 'heading_init'));
            add_shortcode('inwave_contact', array($this, 'inwave_contact_shortcode'));
            add_action('wp_ajax_nopriv_sendMessageContact', array($this, 'sendMessageContact'));
            add_action('wp_ajax_sendMessageContact', array($this, 'sendMessageContact'));
        }

        function initParams()
        {
            global $iw_shortcodes;
            $this->params = array(
                'name' => 'Contact Form',
                'description' => __('Show contact form', 'inwavethemes'),
                'base' => 'inwave_contact',
                'icon' => 'iw-default',
                'category' => 'Custom',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Receiver Email", "inwavethemes"),
                        "value" => "",
                        "param_name" => "receiver_email",
                        "description" => __('If not specified, Admin E-mail Address in General setting will be used', "inwavethemes")
                    ),
					 array(
                        'type' => 'textfield',
                        "heading" => __("Title contact form", "inwavethemes"),
                        "value" => "",
                        "param_name" => "title_contact_form"
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Button text", "inwavethemes"),
                        "value" => "",
                        "param_name" => "button_text"
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Description for support forum", "inwavethemes"),
                        "value" => "",
                        "param_name" => "description_text",
                        "dependency" => array('element' => 'style',  'value' => array('widget'))
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Show name", "inwavethemes"),
                        "param_name" => "show_name",
                        "description" => __("Show name field", 'inwavethemes'),
                        "value" => array(
                            'Yes' => 'yes',
                            'No' => 'no',
                        ),
                        "dependency" => array('element' => 'style', 'value' => array('default','underline'))
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Show email", "inwavethemes"),
                        "param_name" => "show_email",
                        "description" => __("Show email field", 'inwavethemes'),
                        "value" => array(
                            'Yes' => 'yes',
                            'No' => 'no',
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Show mobile", "inwavethemes"),
                        "param_name" => "show_mobile",
                        "description" => __("Show mobile field", 'inwavethemes'),
                        "value" => array(
                            'Yes' => 'yes',
                            'No' => 'no',
                        ),
                        "dependency" => array('element' => 'style', 'value' => array('default','underline'))
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Show website", "inwavethemes"),
                        "param_name" => "show_website",
                        "description" => __("Show website field", 'inwavethemes'),
                        "value" => array(
                            'Yes' => 'yes',
                            'No' => 'no',
                        ),
                        "dependency" => array('element' => 'style', 'value' => array('default','underline'))
                    ),

                    array(
                        "type" => "dropdown",
                        "heading" => __("Show message", "inwavethemes"),
                        "param_name" => "show_message",
                        "description" => __("Show message field", 'inwavethemes'),
                        "value" => array(
                            'Yes' => 'yes',
                            'No' => 'no',
                        ),
                        "dependency" => array('element' => 'style', 'value' => array('default','underline'))
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "class" => "",
                        "heading" => "Style",
                        "param_name" => "style",
                        "value" => array(
                            "Default" => "default",
                            "Underline" => "underline",
                            "Widget" => "widget",
                            "Sign-Up" => "sign_up"
                        ),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', "inwavethemes")
                    )
                )
            );
            $iw_shortcodes['inwave_contact'] = $this->params;
        }

        function heading_init()
        {
            if (function_exists('vc_map')) {
                // Add banner addon
                vc_map($this->params);
            }
        }

        // Shortcode handler function for list Icon
        function inwave_contact_shortcode($atts, $content = null)
        {
            $output = $receiver_email = $title_contact_form = $button_text = $show_name = $show_email = $show_website = $show_mobile = $show_message = $style = $class = '';
            extract(shortcode_atts(array(
                'receiver_email' => '',
                'button_text' => '',
                'description_text' => '',
                'show_name' => 'yes',
                'show_email' => 'yes',
                'show_mobile' => 'yes',
                'show_website' => 'yes',
                'show_message' => 'yes',
                'style' => 'default',
				'title_contact_form' => '',
                'class' => ''
            ), $atts));
            ob_start();
            $class .= ' '.$style;
            switch ($style) {
                case 'default':
                    ?>
                <div class="iw-contact iw-contact-us <?php echo $class; ?>">
                    
					<div class="ajax-overlay">
						<span class="ajax-loading"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
					</div>
					<div class="headding-bottom"></div>
					<form method="post" name="contact-form">
						<?php if ($title_contact_form){ ?>
							<div class="title_contact_form"><?php echo $title_contact_form; ?></div>
						<?php } ?>
						<div class="row">
                            <?php if ($show_name == 'yes'): ?>
                                <div class="form-group col-md-4 col-md-6 col-xs-12">
                                    <input type="text" placeholder="<?php echo __('First Name', 'inwavethemes'); ?>"
                                           required="required" class="control" name="name">
                                </div>
                            <?php
                            endif;
                            if ($show_email == 'yes'):
                                ?>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <input type="email" placeholder="<?php echo __('Email Address', 'inwavethemes'); ?>"
                                           required="required" class="control" name="email">
                                </div>
                            <?php
                            endif;
                            if ($show_mobile == 'yes'):
                                ?>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="<?php echo __('Your Mobile', 'inwavethemes'); ?>"
                                           required="required" class="control" name="mobile">
                                </div>
                            <?php
                            endif;
                            if ($show_website == 'yes'):
                                ?>
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <input type="text" placeholder="<?php echo __('Your Website', 'inwavethemes'); ?>"
                                           class="control" name="website">
                                </div>
                            <?php
                            endif;
                            if ($show_message == 'yes'):
                                ?>
                                <div class="form-group col-xs-12">
                                    <textarea placeholder="<?php echo __('Write message', 'inwavethemes'); ?>" rows="8"
                                              class="control" required="required" id="message" name="message"></textarea>
                                </div>
                            <?php endif; ?>
                            <div class="form-group form-submit col-xs-12">
                                <input name="action" type="hidden" value="sendMessageContact">
                                <input name="mailto" type="hidden" value="<?php echo $receiver_email; ?>">

                                <div class="">
                                    <button class="btn-submit theme-bg" name="submit"
                                            type="submit"><?php echo $button_text? $button_text: __('SEND MESSAGE', 'inwavethemes'); ?></button>
                                </div>
                                <!--                        --><?php //if ($style != 'widget'): ?>
                                <!--                        <div class="form-group col-xs-6">-->
                                <!--                            <button class="btn-submit btn-cancel" name="submit"-->
                                <!--                                    type="submit">--><?php //echo __('CANCEL', 'inwavethemes'); ?><!--</button>-->
                                <!--                        </div>-->
                                <!--                        --><?php //endif; ?>
                            </div>
                            <div class="form-group col-md-12 form-message"></div>
						</div>
                    </form>
                    
                </div>
                <?php break; ?>
                <?php case 'widget':?>
                <div class="iw-contact iw-contact-widget">
                    <div class="ajax-overlay">
                        <span class="ajax-loading"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
                    </div>
                    <div class="headding-bottom"></div>
                    <div class="iw-support-heading">
                        <p><?php echo esc_html($description_text); ?></p>
                    </div>
                    <form method="post" name="contact-form">
                        <?php
                        if ($show_email == 'yes'):
                            ?>
                            <input type="email" placeholder="<?php echo __('Email Address', 'inwavethemes'); ?>" required="required" class="control" name="email">
                        <?php
                        endif;
                        ?>
                        <div class="form-group form-submit">
                            <input name="action" type="hidden" value="sendMessageContact">
                            <input name="mailto" type="hidden" value="<?php echo $receiver_email; ?>">
                            <button class="btn-submit theme-bg" name="submit" type="submit"><?php echo $button_text? $button_text: __('SEND MESSAGE', 'inwavethemes'); ?></button>
                        </div>
                        <div class="form-group col-md-12 form-message"></div>
                    </form>
                </div>
                <?php break; ?>
                <?php case 'sign_up':?>
                <div class="iw-contact iw-contact-sign-up">
                    <div class="ajax-overlay">
                        <span class="ajax-loading"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
                    </div>
                    <div class="headding-bottom"></div>
                    <form method="post" name="contact-form">
                        <?php if ($show_name == 'yes'): ?>
                            <div class="form-group iw-display col-md-5 col-sm-6 col-xs-12">
                                <input type="text" placeholder="<?php echo __('Your full name', 'inwavethemes'); ?>"
                                       required="required" id="name" class="control" name="name">
                            </div>
                        <?php
                        endif;
                        if ($show_email == 'yes'):
                        ?>
                        <div class="form-group iw-display col-md-5 col-sm-6 col-xs-12">
                            <input type="email" placeholder="<?php echo __('Your email address', 'inwavethemes'); ?>"
                                   required="required" id="email" class="control" name="email">
                        </div>
                        <?php
                        endif; ?>
                        <div class="form-group form-submit col-md-2 col-sm-6 col-xs-6">
                            <input name="action" type="hidden" value="sendMessageContact">
                            <input name="mailto" type="hidden" value="<?php echo $receiver_email; ?>">
                            <button class="btn-submit theme-color-hover" name="submit" type="submit"><?php echo $button_text? $button_text: __('SEND MESSAGE', 'inwavethemes'); ?></button>
                        </div>
                    </form>
                </div>
                <?php break; ?>
            <?php case 'underline': ?>
                <div class="iw-contact iw-contact-underline">
                    <div class="row">
                        <div class="ajax-overlay">
                            <span class="ajax-loading"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
                        </div>
                        <div class="headding-bottom"></div>
                        <form method="post" name="contact-form">
                            <?php if ($show_name == 'yes'): ?>
                                <div class="form-group iw-display col-md-4 col-md-6 col-xs-12">
                                    <label class="theme-bg" for="name"><?php echo __('Your Name :', 'inwavethemes'); ?></label>
                                    <input type="text" placeholder="<?php echo __('Enter your name', 'inwavethemes'); ?>"
                                           required="required" id="name" class="control" name="name">
                                </div>
                            <?php
                            endif;
                            if ($show_email == 'yes'):
                                ?>
                                <div class="form-group iw-display col-md-4 col-sm-6 col-xs-12">
                                    <label class="theme-bg" for="email"><?php echo __('Your Email :', 'inwavethemes'); ?></label>
                                    <input type="email" placeholder="<?php echo __('Enter your email', 'inwavethemes'); ?>"
                                           required="required" id="email" class="control" name="email">
                                </div>
                            <?php
                            endif;
                            if ($show_mobile == 'yes'):
                                ?>
                                <div class="form-group iw-display col-md-4 col-sm-6 col-xs-12">
                                    <label class="theme-bg" for="mobile"><?php echo __('Your Phone :', 'inwavethemes'); ?></label>
                                    <input type="text" placeholder="<?php echo __('+84 0123 456 789', 'inwavethemes'); ?>"
                                           required="required" id="mobile" class="control" name="mobile">
                                </div>
                            <?php
                            endif;
                            if ($show_website == 'yes'):
                                ?>
                                <div class="form-group iw-display col-md-4 col-sm-12 col-xs-12">
                                    <label for="website"><?php echo __('Your Website :', 'inwavethemes'); ?></label>
                                    <input type="text" placeholder=""
                                           id="website" class="control" name="website">
                                </div>
                            <?php
                            endif;
                            if ($show_message == 'yes'):
                                ?>
                                <div class="form-group iw-display iw-textarea-form iw-float-none col-md-4 col-sm-6 col-xs-12">
                                    <label class="theme-bg" for="message"><?php echo __('Your Message :', 'inwavethemes'); ?></label>
                                    <textarea placeholder="<?php echo __('What do you think about us?', 'inwavethemes'); ?>"
                                           id="message" class="control" required="required" name="message"></textarea>
                                </div>
                            <?php endif; ?>
                            <div class="form-group form-submit">
                                <input name="action" type="hidden" value="sendMessageContact">
                                <input name="mailto" type="hidden" value="<?php echo $receiver_email; ?>">
                                    <button class="btn-submit theme-color-hover" name="submit"
                                            type="submit"><?php echo $button_text? $button_text: __('SEND MESSAGE', 'inwavethemes'); ?></button>
                            </div>
                            <div class="form-group col-md-12 form-message"></div>
                        </form>
                    </div>
                </div>
                    <?php
                    break;
            }
            $html = ob_get_contents();
            ob_end_clean();
            return $html;
        }

        //Ajax iwcSendMailTakeCourse
        function sendMessageContact()
        {
            $result = array();
            $result['success'] = false;
            $mailto = filter_input(INPUT_POST, 'mailto', FILTER_VALIDATE_EMAIL);
            if(!$mailto){
                $mailto = get_option('admin_email');
            }
            $email = isset($_POST['email'])? $_POST['email'] : '';
            $name = isset($_POST['name'])? $_POST['name'] : '';
            $mobile = isset($_POST['mobile'])? $_POST['mobile'] : '';
            $website = isset($_POST['website'])? $_POST['website'] : '';
            $message = isset($_POST['message'])? $_POST['message'] : '';
            $title = __('Email from Contact Form', 'inwavethemes') . ' ['. $email.']';

            $html = '<html><head><title>' . $title . '</title>
                    </head><body><p>' . __('Hi Admin,', 'inwavethemes') . '</p><p>' . __('This email was sent from contact form', 'inwavethemes') . '</p><table>';

            if ($name) {
                $html .= '<tr><td>' . __('Name', 'inwavethemes') . '</td><td>' . $name . '</td></tr>';
            }
            if ($email) {
                $html .= '<tr><td>' . __('Email', 'inwavethemes') . '</td><td>' . $email . '</td></tr>';
            }
            if ($mobile) {
                $html .= '<tr><td>' . __('Mobile', 'inwavethemes') . '</td><td>' . $mobile . '</td></tr>';
            }
            if ($website) {
                $html .= '<tr><td>' . __('Website', 'inwavethemes') . '</td><td>' . $website . '</td></tr>';
            }
            if ($message) {
                $html .= '<tr><td>' . __('Message', 'inwavethemes') . '</td><td>' . $message . '</td></tr>';
            }
            $html .= '</tr></table></body></html>';

            // To send HTML mail, the Content-type header must be set
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            if (wp_mail($mailto, $title, $html, $headers)) {
                $result['success'] = true;
                $result['message'] = __('Your message was sent, we will contact you soon', 'inwavethemes');
            } else {
                $result['message'] = __('Can\'t send message, please try again', 'inwavethemes');
            }
            echo json_encode($result);
            exit();
        }

    }

}

new Inwave_Contact();
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_Inwave_Contact extends WPBakeryShortCode
    {

    }

}
