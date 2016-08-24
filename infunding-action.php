<?php

/*
 * @package Inwave Booking
 * @version 1.0.0
 * @created Aug 24, 2015
 * @author Inwavethemes
 * @email inwavethemes@gmail.com
 * @website http://inwavethemes.com
 * @support Ticket https://inwave.ticksy.com/
 * @copyright Copyright (c) 2015 Inwavethemes. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */

/**
 * Description of iw-form-action
 *
 * @developer duongca
 */
require( dirname(__FILE__) . '/wp-load.php' );
require_once ABSPATH.'/'.PLUGINDIR.'/infunding/includes/function.front.php';
if (!isset($_REQUEST['action'])) {
    echo 'Invalid request';
    exit();
}
$action = $_REQUEST['action'];
switch ($action) {
    case 'infPaymentProcess':
        infPaymentProcess();
        break;
    default:
        echo 'Invalid request';
        exit();
        break;
}