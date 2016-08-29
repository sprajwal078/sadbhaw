<?php
/*
 * @package Inwave Charity
 * @version 1.0.0
 * @created Mar 2, 2015
 * @author Inwavethemes
 * @email inwavethemes@gmail.com
 * @website http://inwavethemes.com
 * @support Ticket https://inwave.ticksy.com/
 * @copyright Copyright (c) 2015 Inwavethemes. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */

/**
 * Description of utility
 *
 * @developer duongca
 */
require_once 'classes/inFundingMetaBox.php';
require_once 'classes/inFundingOrder.php';
require_once 'classes/inFundingMember.php';
require_once 'classes/inFundingLog.php';
require_once 'classes/inFundingPaging.php';
if (!class_exists('inFundingUtility')) {

    class inFundingUtility {

        function categoryField($name, $value, $multiple = true) {
            $categories = get_terms('iwevent_category', 'hide_empty=0');
            $html = array();
            $multiselect = '';
            if ($multiple) {
                $multiselect = 'multiple="multiple"';
                $html[] = '<select id="category_field" name="' . $name . '[]" ' . $multiselect . '>';
                $html[] = '<option ' . (empty($value) ? 'selected="selected"' : '' ) . ' value="0">' . __('Select all') . '</option>';
            } else {
                $html[] = '<select id="category_field" name="' . $name . '">';
                $html[] = '<option value="0">' . __('Select category') . '</option>';
            }
            foreach ($categories as $category) {
                if (is_array($value)) {
                    if (in_array($category->term_id, $value)) {
                        $html[] = '<option value="' . $category->term_id . '" selected="selected">' . $category->name . '</option>';
                    } else {
                        $html[] = '<option value="' . $category->term_id . '">' . $category->name . '</option>';
                    }
                } else {
                    $html[] = '<option value="' . $category->term_id . '" ' . (($category->term_id == $value) ? 'selected="selected"' : '') . '>' . $category->name . '</option>';
                }
            }
            $html[] = '</select>';
            $html[] = '<script type="text/javascript">';
            $html[] = '(function ($) {';
            $html[] = '$(document).ready(function () {';
            $html[] = '$("#category_field").select2({';
            $html[] = 'placeholder: "' . __('Select category', 'inwavethemes') . '",';
            $html[] = 'allowClear: true';
            $html[] = '});';
            $html[] = '});';
            $html[] = '})(jQuery);';
            $html[] = '</script>';
            return implode($html);
        }

        /**
         * Function create select option field
         * 
         * @param type $id
         * @param String $name Name of field
         * @param String $value The value field
         * @param Array $data list data option of field
         * @param String $text Default value of field
         * @param String $class Class of field
         * @param Bool $multi Field allow multiple select of not
         * @return String Select option field
         * 
         */
        static function selectFieldRender($id, $name, $value, $data, $text = '', $class = '', $multi = true, $extra = '', $html5_data = array()) {
            $html = array();
            $multiselect = '';
//Kiem tra neu bien class ton tai thi them class vao field
            if ($class) {
                $class = 'class="' . $class . '"';
            }

            $html_data = '';
            if (!empty($html5_data)) {
                foreach ($html5_data as $key => $value) {
                    $html_data.='data-' . $key . '="' . $value . '" ';
                }
            }

//Kiem tra neu field can tao cho phep multiple
            if ($multi) {
                $multiselect = 'multiple="multiple"';
                $html[] = '<select' . ($id ? ' id="' . $id . '"' : ' ') . ($html_data ? $html_data : '') . ' ' . $class . ' name="' . $name . '[]" ' . $multiselect . ' ' . $extra . '>';
                if ($text) {
                    $html[] = '<option value="">' . __($text) . '</option>';
                }
            } else {
                $html[] = '<select ' . $class . ' name="' . $name . '" ' . ($html_data ? $html_data : '') . ($id ? ' id="' . $id . '"' : ' ') . $extra . '>';
                if ($text) {
                    $html[] = '<option value="">' . __($text) . '</option>';
                }
            }

//Duyet qua tung phan tu cua mang du lieu de tao option tuong ung
            foreach ($data as $option) {
                if (is_array($value)) {
                    if (in_array($option['value'], $value)) {
                        $html[] = '<option value="' . $option['value'] . '" selected="selected">' . $option['text'] . '</option>';
                    } else {
                        $html[] = '<option value="' . $option['value'] . '">' . __($option['text']) . '</option>';
                    }
                } else {
                    $html[] = '<option value="' . $option['value'] . '" ' . (($option['value'] == $value) ? 'selected="selected"' : '') . '>' . __($option['text']) . '</option>';
                }
            }
            $html[] = '</select>';
            if ($id) {
                $html[] = '<script type="text/javascript">';
                $html[] = '(function ($) {';
                $html[] = '$(document).ready(function () {';
                $html[] = '$("#' . $id . '").select2({';
                $html[] = 'placeholder: "' . $text . '",';
                $html[] = 'allowClear: true';
                $html[] = '});';
                $html[] = '});';
                $html[] = '})(jQuery);';
                $html[] = '</script>';
            }
            return implode($html);
        }

        function getMessage($message, $type = 'success') {
            $html = array();
            $class = 'success';
            if ($type == 'error') {
                $class = 'error';
            }
            if ($type == 'notice') {
                $class = 'notice';
            }
            $html[] = '<div class="in-message ' . $class . '">';
            $html[] = '<div class="message-text">' . $message . '</div>';
            $html[] = '</div>';
            return implode($html);
        }

        /**
         * Function check and create alias
         * @param type $title
         * @param type $isCopy
         * @return type
         */
        public static function createAlias($title, $table, $isCopy = FALSE) {
            require_once 'classes/unicodetoascii.php';
            if (class_exists('unicodetoascii')) {
                $calias = new unicodetoascii();
                $alias = $calias->asciiAliasCreate($title);
            } else {
                $alias = str_replace(' ', '-', strtolower($title));
            }
//xu ly truong hop alias duoc tao ra do copy tu 1 item khac
            if ($isCopy) {
                $newAlias = explode('-', $alias);
                if (count($newAlias) > 1 && is_numeric(end($newAlias))) {
                    unset($newAlias[count($newAlias) - 1]);
                }
                $alias = implode('-', $newAlias);
            }
            $listAlias = self::getAllAlias($alias, $table);
            $alias = self::generateAlias($alias, $listAlias);
            return $alias;
        }

        /**
         * function create alias
         * 
         * @param String $alias
         * @param Array $listAlias
         * @return string
         */
        static function generateAlias($alias, $listAlias) {
            if ($listAlias) {
                $listEndAlias = array();
                foreach ($listAlias as $value) {
                    $parseAlias = explode("-", $value['alias']);
                    if (is_numeric(end($parseAlias))) {
                        $listEndAlias[] = end($parseAlias);
                    }
                }
                if (empty($listEndAlias)) {
                    $alias = $alias . '-2';
                } else {
                    $endmax = max($listEndAlias);
                    $alias = $alias . '-' . ($endmax + 1);
                }
            }
            return $alias;
        }

        /**
         * function takes on all the alias alias similar to the present
         * @global type $wpdb
         * @param String $alias
         * @return Array list alias
         */
        static function getAllAlias($alias, $table) {
            global $wpdb;
            $listAlias = $wpdb->get_results('SELECT id, alias FROM ' . $wpdb->prefix . $table . ' WHERE alias LIKE "' . $alias . '%"');
            foreach ($listAlias as $value) {
                $rs[] = array('id' => $value->id, 'alias' => $value->alias);
            }
            return $rs;
        }

        public function MakeTree($categories, $id = 0) {
            $tree = array();
            $tree = self::TreeTitle($categories, $tree, 0);
            $tree_array = array();
            if ($id > 0) {
                $tree_sub = array();
                $id_sub = '';
                $subcategories = self::SubTree($categories, $tree_sub, 0, $id_sub);
                foreach ($subcategories as $key0 => $value0) {
                    $subcategories_array[$key0] = explode(',', $value0);
                }

                foreach ($tree as $key => $value) {

                    foreach ($categories as $key2 => $value2) {
                        $syntax_check = 1;

                        if ($id == $key) {
                            $syntax_check = 0;
                        }

                        foreach ($subcategories_array as $key3 => $value3) {
                            foreach ($value3 as $key4 => $value4) {
                                if ($value4 == $id && $key == $key3) {
                                    $syntax_check = 0;
                                }
                            }
                        }

                        if ($syntax_check == 1) {
                            if ($key == $value2->value) {
                                $tree_object = new JObject();
                                $tree_object->text = $value;
                                $tree_object->value = $key;
                                $tree_array[] = $tree_object;
                            }
                        }
                    }
                }
            } else {
                foreach ($tree as $key => $value) {
                    foreach ($categories as $key2 => $value2) {
                        if ($key == $value2->value) {
                            $tree_object = new JObject();
                            $tree_object->text = $value;
                            $tree_object->value = $key;
                            $tree_array[] = $tree_object;
                        }
                    }
                }
            }
            return $tree_array;
        }

        static function TreeTitle($data, $tree, $id = 0, $text = '') {

            foreach ($data as $key) {
                $show_text = $text . $key->text;
                if ($key->parent_id == $id) {
                    $tree[$key->value] = $show_text;
                    $tree = self::TreeTitle($data, $tree, $key->value, $text . " -- ");
                }
            }
            return ($tree);
        }

        static function SubTree($data, $tree, $id = 0, $id_sub = '') {
            foreach ($data as $key) {
                $show_id_sub = $id_sub . $key->value;
                if ($key->parent_id == $id) {
                    $tree[$key->value] = $id_sub;
                    $tree = self::SubTree($data, $tree, $key->value, $show_id_sub . ",");
                }
            }
            return ($tree);
        }

        /**
         * 
         * @param type $email
         * @param type $type: order_created, order_change_status, order_info
         * @return type
         */
        function sendEmail($email, $data, $type) {
            global $inf_settings;
            $mail_template = $inf_settings['email_template'];
            $mail_content = '';
            $mail_title = '';
            $result = array();
            $result['success'] = false;
            $admin_email = get_option('admin_email');

            switch ($type) {
                case 'order_created':
                    $mail_title = $mail_template['order_info']['title'];
                    $mail_title = str_replace('[site_name]', get_option('blogname'), $mail_title);
                    $mail_title = str_replace('[customer_name]', $data['full_name'], $mail_title);
                    $mail_title = str_replace('[order_link]', '<a href="' . site_url() . '?page_id=' . get_option('inf_order_view', 500) . '&order_id="' . $data['order_id'], $mail_title);


                    $mail_content = $mail_template['order_info']['content'];
                    $mail_content = str_replace('[site_name]', get_option('blogname'), $mail_content);
                    $mail_content = str_replace('[customer_name]', $data['full_name'], $mail_content);
                    $mail_content = str_replace('[order_link]', '<a href="' . site_url() . '?page_id=' . get_option('inf_order_view', 500) . '&order_id="' . $data['order_id'], $mail_content);
                    break;
                case 'order_change_status':
                    $mail_title = $mail_template['order_change_state']['title'];
                    $mail_title = str_replace('[site_name]', get_option('blogname'), $mail_title);
                    $mail_title = str_replace('[customer_name]', $data['full_name'], $mail_title);


                    $mail_content = $mail_template['order_change_state']['content'];
                    $mail_content = str_replace('[site_name]', get_option('blogname'), $mail_content);
                    $mail_content = str_replace('[customer_name]', $data['full_name'], $mail_content);
                    $mail_content = str_replace('[new_order_status]', $data['new_status']);
                    break;
                case 'offline_payment_notice':
                    $mail_title = __('Thanks for donate', 'inwavethemes');

                    $mail_content = "Dear ".$data['full_name']."\n\r";
                    $mail_content .= $inf_settings['inf_payment']['custom_payment']['content'];
                    break;

                default:
                    break;
            }

            $html = '
<html>
<head>
  <title>' . $mail_title . '</title>
</head>
<body>' . $mail_content . '</body>
</html>
';

// To send HTML mail, the Content-type header must be set
            $headers = 'From: <' . $admin_email . '>' . "\r\n";
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

            if (wp_mail($email, $mail_title, $html, $headers)) {
                $result['success'] = true;
            } else {
                $infLog = new inFundingLog();
                $infLog->addLog(new inFundingLog(null, 'error', time(), __('Can\'t send email to donor when donate, please check settings or code.', 'inwavethemes')));
            }
            return serialize($result);
        }

        function prepareMemberFieldValue($value) {
            global $inf_settings;
            $memberinfo = array();
            $memberFields = $inf_settings['register_form_fields'];
            foreach ($value as $k => $v) {
                foreach ($memberFields as $field) {
                    if ($k == $field['name']) {
                        $val = $v;
                        if ($field['type'] == 'select') {
                            foreach ($field['values'] as $f_val) {
                                if ($v == $f_val['value']) {
                                    $val = $f_val;
                                    break;
                                }
                            }
                        }
                        $memberinfo[] = array('name' => $k, 'label' => $field['label'], 'type' => $field['type'], 'value' => $val);
                        break;
                    }
                }
            }
            return $memberinfo;
        }

        function getIWEventcurrencies() {
            return array(
                array('value' => 'AED', 'text' => __('United Arab Emirates Dirham', 'inwavethemes')),
                array('value' => 'AUD', 'text' => __('Australian Dollars', 'inwavethemes')),
                array('value' => 'BDT', 'text' => __('Bangladeshi Taka', 'inwavethemes')),
                array('value' => 'BRL', 'text' => __('Brazilian Real', 'inwavethemes')),
                array('value' => 'BGN', 'text' => __('Bulgarian Lev', 'inwavethemes')),
                array('value' => 'CAD', 'text' => __('Canadian Dollars', 'inwavethemes')),
                array('value' => 'CLP', 'text' => __('Chilean Peso', 'inwavethemes')),
                array('value' => 'CNY', 'text' => __('Chinese Yuan', 'inwavethemes')),
                array('value' => 'COP', 'text' => __('Colombian Peso', 'inwavethemes')),
                array('value' => 'CZK', 'text' => __('Czech Koruna', 'inwavethemes')),
                array('value' => 'DKK', 'text' => __('Danish Krone', 'inwavethemes')),
                array('value' => 'DOP', 'text' => __('Dominican Peso', 'inwavethemes')),
                array('value' => 'EUR', 'text' => __('Euros', 'inwavethemes')),
                array('value' => 'HKD', 'text' => __('Hong Kong Dollar', 'inwavethemes')),
                array('value' => 'HRK', 'text' => __('Croatia kuna', 'inwavethemes')),
                array('value' => 'HUF', 'text' => __('Hungarian Forint', 'inwavethemes')),
                array('value' => 'ISK', 'text' => __('Icelandic krona', 'inwavethemes')),
                array('value' => 'IDR', 'text' => __('Indonesia Rupiah', 'inwavethemes')),
                array('value' => 'INR', 'text' => __('Indian Rupee', 'inwavethemes')),
                array('value' => 'NPR', 'text' => __('Nepali Rupee', 'inwavethemes')),
                array('value' => 'ILS', 'text' => __('Israeli Shekel', 'inwavethemes')),
                array('value' => 'JPY', 'text' => __('Japanese Yen', 'inwavethemes')),
                array('value' => 'KIP', 'text' => __('Lao Kip', 'inwavethemes')),
                array('value' => 'KRW', 'text' => __('South Korean Won', 'inwavethemes')),
                array('value' => 'MYR', 'text' => __('Malaysian Ringgits', 'inwavethemes')),
                array('value' => 'MXN', 'text' => __('Mexican Peso', 'inwavethemes')),
                array('value' => 'NGN', 'text' => __('Nigerian Naira', 'inwavethemes')),
                array('value' => 'NOK', 'text' => __('Norwegian Krone', 'inwavethemes')),
                array('value' => 'NZD', 'text' => __('New Zealand Dollar', 'inwavethemes')),
                array('value' => 'PYG', 'text' => __('Paraguayan Guaraní', 'inwavethemes')),
                array('value' => 'PHP', 'text' => __('Philippine Pesos', 'inwavethemes')),
                array('value' => 'PLN', 'text' => __('Polish Zloty', 'inwavethemes')),
                array('value' => 'GBP', 'text' => __('Pounds Sterling', 'inwavethemes')),
                array('value' => 'RON', 'text' => __('Romanian Leu', 'inwavethemes')),
                array('value' => 'RUB', 'text' => __('Russian Ruble', 'inwavethemes')),
                array('value' => 'SGD', 'text' => __('Singapore Dollar', 'inwavethemes')),
                array('value' => 'ZAR', 'text' => __('South African rand', 'inwavethemes')),
                array('value' => 'SEK', 'text' => __('Swedish Krona', 'inwavethemes')),
                array('value' => 'CHF', 'text' => __('Swiss Franc', 'inwavethemes')),
                array('value' => 'TWD', 'text' => __('Taiwan New Dollars', 'inwavethemes')),
                array('value' => 'THB', 'text' => __('Thai Baht', 'inwavethemes')),
                array('value' => 'TRY', 'text' => __('Turkish Lira', 'inwavethemes')),
                array('value' => 'UAH', 'text' => __('Ukrainian Hryvnia', 'inwavethemes')),
                array('value' => 'USD', 'text' => __('US Dollars', 'inwavethemes')),
                array('value' => 'VND', 'text' => __('Vietnamese Dong', 'inwavethemes')),
                array('value' => 'EGP', 'text' => __('Egyptian Pound', 'inwavethemes'))
            );
        }

        public static function getIWCurrencySymbol($currency) {
            switch ($currency) {
                case 'AED' :
                    $currency_symbol = 'د.إ';
                    break;
                case 'AUD' :
                case 'CAD' :
                case 'CLP' :
                case 'COP' :
                case 'HKD' :
                case 'MXN' :
                case 'NZD' :
                case 'SGD' :
                case 'USD' :
                    $currency_symbol = '&#36;';
                    break;
                case 'BDT':
                    $currency_symbol = '&#2547;&nbsp;';
                    break;
                case 'BGN' :
                    $currency_symbol = '&#1083;&#1074;.';
                    break;
                case 'BRL' :
                    $currency_symbol = '&#82;&#36;';
                    break;
                case 'CHF' :
                    $currency_symbol = '&#67;&#72;&#70;';
                    break;
                case 'CNY' :
                case 'JPY' :
                case 'RMB' :
                    $currency_symbol = '&yen;';
                    break;
                case 'CZK' :
                    $currency_symbol = '&#75;&#269;';
                    break;
                case 'DKK' :
                    $currency_symbol = 'kr.';
                    break;
                case 'DOP' :
                    $currency_symbol = 'RD&#36;';
                    break;
                case 'EGP' :
                    $currency_symbol = 'EGP';
                    break;
                case 'EUR' :
                    $currency_symbol = '&euro;';
                    break;
                case 'GBP' :
                    $currency_symbol = '&pound;';
                    break;
                case 'HRK' :
                    $currency_symbol = 'Kn';
                    break;
                case 'HUF' :
                    $currency_symbol = '&#70;&#116;';
                    break;
                case 'IDR' :
                    $currency_symbol = 'Rp';
                    break;
                case 'ILS' :
                    $currency_symbol = '&#8362;';
                    break;
                case 'INR' :
                    $currency_symbol = 'Rs.';
                    break;
                case 'ISK' :
                    $currency_symbol = 'Kr.';
                    break;
                case 'KIP' :
                    $currency_symbol = '&#8365;';
                    break;
                case 'KRW' :
                    $currency_symbol = '&#8361;';
                    break;
                case 'MYR' :
                    $currency_symbol = '&#82;&#77;';
                    break;
                case 'NGN' :
                    $currency_symbol = '&#8358;';
                    break;
                case 'NOK' :
                    $currency_symbol = '&#107;&#114;';
                    break;
                case 'NPR' :
                    $currency_symbol = 'Rs.';
                    break;
                case 'PHP' :
                    $currency_symbol = '&#8369;';
                    break;
                case 'PLN' :
                    $currency_symbol = '&#122;&#322;';
                    break;
                case 'PYG' :
                    $currency_symbol = '&#8370;';
                    break;
                case 'RON' :
                    $currency_symbol = 'lei';
                    break;
                case 'RUB' :
                    $currency_symbol = '&#1088;&#1091;&#1073;.';
                    break;
                case 'SEK' :
                    $currency_symbol = '&#107;&#114;';
                    break;
                case 'THB' :
                    $currency_symbol = '&#3647;';
                    break;
                case 'TRY' :
                    $currency_symbol = '&#8378;';
                    break;
                case 'TWD' :
                    $currency_symbol = '&#78;&#84;&#36;';
                    break;
                case 'UAH' :
                    $currency_symbol = '&#8372;';
                    break;
                case 'VND' :
                    $currency_symbol = '&#8363;';
                    break;
                case 'ZAR' :
                    $currency_symbol = '&#82;';
                    break;
                default :
                    $currency_symbol = '';
                    break;
            }

            return $currency_symbol;
        }

        /**
         * Function truncate string by number of word
         * @param string $string
         * @param type $length
         * @param type $etc
         * @return string
         */
        public function truncateString($string, $length, $etc = '...') {
            $string = strip_tags($string);
            if (str_word_count($string) > $length) {
                $words = str_word_count($string, 2);
                $pos = array_keys($words);
                $string = substr($string, 0, $pos[$length]) . $etc;
            }
            return $string;
        }

        public function inFundingAddImageSize() {
            add_image_size('infunding-large', 800, 420, 'center');
            add_image_size('infunding-thumb', 400, 250, 'center');
        }

        public function iweDisplayPagination($query = '') {
            if (!$query) {
                global $wp_query;
                $query = $wp_query;
            }

            $big = 999999999; // need an unlikely integer

            $paginate_links = paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $query->max_num_pages,
                'next_text' => '&raquo;',
                'prev_text' => '&laquo'
            ));
            // Display the pagination if more than one page is found
            if ($paginate_links) :
                ?>

                <div class="iwevent-pagination clearfix">
                    <?php echo $paginate_links; ?>
                </div>

                <?php
            endif;
        }

        public function initPluginThemes() {
            $files = array('single-infunding.php', 'taxonomy-infunding_category.php');
            $plugin_action = 'infunding-action.php';
            $template_path = get_template_directory();
            foreach ($files as $file) {
                if (!file_exists($template_path . '/' . $file)) {
                    $theme_plugin_path = WP_PLUGIN_DIR . '/infunding/includes/themes/';
                    copy($theme_plugin_path . $file, $template_path . '/' . $file);
                }
            }
            if (!file_exists(ABSPATH . '/' . $plugin_action)) {
                $action_path = WP_PLUGIN_DIR . '/infunding/includes/themes/';
                copy($action_path . $plugin_action, ABSPATH . '/' . $plugin_action);
            }
        }

        public function getTicketPriceLabel($price) {
            $iwe_settings = unserialize(get_option('iwe_settings'));
            $currency = $iwe_settings['general']['currency'];
            $currency_pos = $iwe_settings['general']['currency_pos'];
            $cSymbol = $this->getIWCurrencySymbol($currency);
            $priceLabel = __('Free', 'inwavethemes');
            if ($price) {
                switch ($currency_pos) {
                    case 'left':
                        $priceLabel = $cSymbol . $price;
                        break;
                    case 'left_space':
                        $priceLabel = $cSymbol . ' ' . $price;
                        break;
                    case 'right':
                        $priceLabel = $price . $cSymbol;
                        break;
                    case 'right_space':
                        $priceLabel = $price . ' ' . $cSymbol;
                        break;

                    default:
                        break;
                }
            }
            return $priceLabel;
        }

        public function inFundingRenderMap($options = null) {
            global $inf_settings;
            $map = json_decode($options['map']);
            $query = $this->getCampaignsList($options['cat'], $options['ids'], 'date', 'desc', '-1', true);
            $places = array();
            if ($query->have_posts()) {
                while ($query->have_posts()) :
                    $query->the_post();
                    $address = htmlspecialchars(get_post_meta(get_the_ID(), 'inf_address', true));
                    $map_pos = unserialize(get_post_meta(get_the_ID(), 'inf_map_pos', true));
                    $img = wp_get_attachment_image_src(get_post_thumbnail_id());
                    $p = new stdClass();
                    $p->id = 'pid-' . get_the_ID();
                    $p->link = get_permalink();
                    $p->readmore = __('Reard More', 'inwavethemes');
                    $p->title = get_the_title();
                    $p->image = $img[0];
                    $p->address = $address;
                    $p->latitude = $map_pos['latitude'];
                    $p->longitude = $map_pos['longitude'];
                    $p->description = $this->truncateString(get_the_excerpt(), $options['desc_text_limit']);
                    $places[] = $p;
                endwhile;
            }
            wp_reset_postdata();

            $styleObj = '[{"featureType": "landscape", "elementType": "labels", "stylers": [{"visibility": "off"}]}, {"featureType": "transit", "elementType": "labels", "stylers": [{"visibility": "off"}]}, {"featureType": "poi", "elementType": "labels", "stylers": [{"visibility": "off"}]}, {"featureType": "water", "elementType": "labels", "stylers": [{"visibility": "off"}]}, {"featureType": "road", "elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {"stylers": [{"hue": "#00aaff"}, {"saturation": -100}, {"gamma": 2.15}, {"lightness": 12}]}, {"featureType": "road", "elementType": "labels.text.fill", "stylers": [{"visibility": "on"}, {"lightness": 24}]}, {"featureType": "road", "elementType": "geometry", "stylers": [{"lightness": 57}]}]';

            $script = array();
            $script[] = 'var options = {';
            $script[] = 'mapPlaces : ' . json_encode($places) . ',';
            $script[] = 'mapProperties:{';
            $script[] = 'zoom : ' . ($map->zoomlv ? $map->zoomlv : $inf_settings['general']['map_zoom_level']) . ',';
            $script[] = 'center : new google.maps.LatLng(' . (isset($map->lat) ? $map->lat : -33.8665433) . ', ' . (isset($map->lng) ? $map->lng : 151.1956316) . '),';
            $script[] = 'zoomControl : true,';
            $script[] = 'scrollwheel : true,';
            $script[] = 'disableDoubleClickZoom : true,';
            $script[] = 'draggable : true,';
            $script[] = 'panControl : true,';
            $script[] = 'mapTypeControl : true,';
            $script[] = 'scaleControl : true,';
            $script[] = 'overviewMapControl : true,';
            $script[] = 'mapTypeId : google.maps.MapTypeId.ROADMAP,';
            $script[] = '},';
            $script[] = 'detail_page:false,';
            $script[] = 'show_location:' . ($options['show_location'] ? 'true' : 'false') . ',';
            $script[] = 'show_des:' . ($options['show_des'] ? 'true' : 'false') . ',';
            $script[] = 'spinurl:"' . site_url('wp-content/plugins/iw_composer_addons/assets/images/') . '",';
            $script[] = 'styleObj: {"name":"","override_default":"1","styles":""}';
            $script[] = '};';
            $script[] = 'jQuery(".infunding-map").infMap(options);';

            return '(function(){' . implode($script) . '})();';
        }

        public function getCampaignsList($cats, $ids, $order_by, $order_dir, $item_per_page, $filter = false, $page = 'page') {
            if ($page == 'page') {
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            } else {
                $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            }
            $terms = isset($_REQUEST['category']) ? $_REQUEST['category'] : '';
            $keyword = isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '';
            $order_byn = isset($_REQUEST['order_by']) ? $_REQUEST['order_by'] : $order_by;
            $order_dirn = isset($_REQUEST['order_dir']) ? $_REQUEST['order_dir'] : $order_dir;

            $args = array();
            if ($ids) {
                $args['post__in'] = explode(',', $ids);
                if ($terms) {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'infunding_category',
                            'terms' => array($terms),
                            'include_children' => false
                        ),
                    );
                }
            } else {
                $cat_array = explode(',', $cats);
                $new_cats = array();
                if ($terms) {
                    $new_cats[] = $terms;
                } else {
                    if (in_array('0', $cat_array) || empty($cat_array)) {
                        $res = get_terms('infunding_category');
                        foreach ($res as $value) {
                            $new_cats[] = $value->term_id;
                        }
                    } else {
                        $new_cats = $cat_array;
                    }
                }
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'infunding_category',
                        'terms' => $new_cats,
                        'include_children' => false
                    ),
                );
            }
            $args['post_type'] = 'infunding';
            $args['s'] = $keyword;
            $args['order'] = ($order_dirn) ? $order_dirn : 'desc';
            if ($order_byn == 'time_remaning') {
                $args['orderby'] = 'meta_value_num';
                $args['meta_key'] = 'inf_end_date';
            } else if ($order_byn == 'goal') {
                $args['orderby'] = 'meta_value_num';
                $args['meta_key'] = 'inf_goal';
            } else if ($order_byn == 'current') {
                $args['orderby'] = 'meta_value_num';
                $args['meta_key'] = 'inf_current';
            } else {
                $args['orderby'] = ($order_byn) ? $order_byn : 'ID';
            }
            if ($filter) {
                $args['meta_query'] = array(
                    array(
                        'key' => 'inf_end_date',
                        'value' => time(),
                        'compare' => '<',
                    )
                );
            }
            $args['post_status'] = 'publish';
            $args['posts_per_page'] = $item_per_page;
            $args['paged'] = $paged;
            $query = new WP_Query($args);
            return $query;
        }

        public function infunding_display_pagination_none($query = '') {
            $rs = array('success' => false, 'data' => '');
            if (!$query) {
                global $wp_query;
                $query = $wp_query;
            }

            $paginate_links = paginate_links(array(
                'format' => '?page=%#%',
                'current' => max(1, get_query_var('page')),
                'total' => $query->max_num_pages
            ));
            // Display the pagination if more than one page is found
            if ($paginate_links) :
                $html = array();
                $html[] = '<div class="post-pagination clearfix" style="display: none;">';
                $html[] = $paginate_links;
                $html[] = '</div>';
                $rs['success'] = true;
                $rs['data'] = implode($html);
            endif;
            return $rs;
        }

        public function infunding_display_pagination($query = '', $page = 'page') {
            $rs = array('success' => false, 'data' => '');
            if (!$query) {
                global $wp_query;
                $query = $wp_query;
            }

            $link_args = array(
                'total' => $query->max_num_pages,
                'prev_text' => __('<'),
                'next_text' => __('>'));
            if ($page == 'page') {
                $link_args['format'] = '?paged=%#%';
                $link_args['current'] = max(1, get_query_var('paged'));
            } else {
                $link_args['format'] = '?page=%#%';
                $link_args['current'] = max(1, get_query_var('page'));
            }
            $paginate_links = paginate_links($link_args);
            // Display the pagination if more than one page is found
            if ($paginate_links) :
                $html = array();
                $html[] = '<div class="post-pagination clearfix">';
                $html[] = $paginate_links;
                $html[] = '</div>';
                $rs['success'] = true;
                $rs['data'] = implode($html);
            endif;
            return $rs;
        }

        public function getInfundingFilterForm($cat) {
            $cats = explode(',', $cat);
            $html = array();
            $keyword = isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '';
            $order_by = isset($_REQUEST['order_by']) ? $_REQUEST['order_by'] : 'time_remaning';
            $order_dir = isset($_REQUEST['order_dir']) ? $_REQUEST['order_dir'] : 'desc';
            $cat_select = isset($_REQUEST['category']) ? $_REQUEST['category'] : '';
            $html[] = '<form id="filterForm" name="filterForm" action="" method="get">';
            $html[] = '<input type="text" class="filter-field" placeholder="' . __('Enter your keywords', 'inwavethemes') . '" name="keyword" value="' . $keyword . '"/>';
            if (in_array('0', $cats)) {
                $cats_data = array();
                $cat_obs = get_terms('infunding_category');
                $cats_data[] = array('text' => __('All Categories', 'inwavethemes'), 'value' => '');
                foreach ($cat_obs as $co) {
                    $cats_data[] = array('text' => $co->name, 'value' => $co->term_id);
                }
                $html[] = $this->selectFieldRender('', 'category', $cat_select, $cats_data, '', 'filter-field', FALSE);
            }

            $order_data = array(
                array('value' => 'ID', 'text' => 'ID'),
                array('value' => 'post_title', 'text' => __('Title', 'inwavethemes')),
                array('value' => 'time_remaning', 'text' => __('Remaing Day', 'inwavethemes')),
                array('value' => 'goal', 'text' => __('Goal', 'inwavethemes')),
                array('value' => 'current', 'text' => __('Funded Amount', 'inwavethemes')),
                array('value' => 'date', 'text' => __('Created', 'inwavethemes')),
                array('value' => 'modified', 'text' => __('Last Modified', 'inwavethemes')),
            );
            $html[] = $this->selectFieldRender('', 'order_by', $order_by, $order_data, '', 'filter-field', FALSE);
            $html[] = '<span class="order-dir filter-field"><i class="fa fa-sort-amount-' . $order_dir . '"></i><input type="hidden" value="' . $order_dir . '" name="order_dir"/></span>';
            $html[] = '</form>';
            return implode('', $html);
        }

        function getCampaignInfo($post) {
            if (is_numeric($post)) {
                $post = get_post($post);
            }
            $inf_cache = wp_cache_get('campaign_' . $post->ID);
            if ($inf_cache) {
                return $inf_cache;
            }
            $order = new inFundingOrder();
            $campaign = new stdClass();
            $campaign->id = $post->ID;
            $campaign->title = $post->post_title;
            $campaign->content = $post->post_content;
            $campaign->categories = wp_get_post_terms($post->ID, 'infunding_category');
            $campaign->tags = wp_get_post_terms($post->ID, 'infunding_tag');
            $campaign->images = unserialize(get_post_meta($post->ID, 'inf_image_gallery', true));
            $campaign->time_start = htmlspecialchars(get_post_meta($post->ID, 'inf_start_date', true));
            $campaign->time_end = htmlspecialchars(get_post_meta($post->ID, 'inf_end_date', true));
            $campaign->days_to_start = floor(($campaign->time_start - time()) / 86400);
            $campaign->days_to_end = floor(($campaign->time_end - time()) / 86400);
            $campaign->status = ((!$campaign->time_end && $campaign->days_to_start < 0) || ($campaign->days_to_start <= 0 && 0 <= $campaign->days_to_end));
            $campaign->address = get_post_meta($post->ID, 'inf_address', true);
            $campaign->map_pos = unserialize(get_post_meta($post->ID, 'inf_map_pos', true));
            $campaign->current = htmlspecialchars(get_post_meta($post->ID, 'inf_current', true));
            $campaign->goal = htmlspecialchars(get_post_meta($post->ID, 'inf_goal', true));
            $campaign->currency = htmlspecialchars(get_post_meta($post->ID, 'inf_currency', true));
            $campaign->external_link = htmlspecialchars(get_post_meta($post->ID, 'inf_donate_link', true));
            if ($campaign->goal) {
                $campaign->percent = ceil($campaign->current / $campaign->goal * 100);
                $campaign->p_delay = $campaign->percent;
                if ($campaign->percent >= 100) {
                    $campaign->p_delay = 100;
                }
            }
            $campaign->orders = $order->getOrderByCampaign($post->ID);

            wp_cache_set('campaign_' . $campaign->id, $campaign);
            return $campaign;
        }

        function getLocalDate($format, $timestamp) {
            $current_offset = get_option('gmt_offset');
            $date = date_i18n($format, $timestamp);
            if ($current_offset) {
                $date = date_i18n($format, $timestamp + $current_offset * 60 * 60);
            }
            return $date;
        }
        
        public function getMoneyFormated($value, $currency=''){
            global $inf_settings;
            if(!$currency){
                $currency = $inf_settings['general']['currency'];
            }
            $currency_sym = $this->getIWCurrencySymbol($currency);
            $currency_pos = $inf_settings['general']['currency_pos'];
            $result = $currency_sym.$value;
            if($currency_pos == 'left_space'){
                $result = $currency_sym.' '.$value;
            }
            if($currency_pos == 'right'){
                $result = $value.$currency_sym;
            }
            if($currency_pos == 'right_space'){
                $result = $value.' '.$currency_sym;
            }
            return $result;
        }
    }

}
