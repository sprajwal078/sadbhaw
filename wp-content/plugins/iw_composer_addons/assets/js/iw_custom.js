/* 
 * @package Inwave Event
 * @version 1.0.0
 * @created Jun 3, 2015
 * @author Inwavethemes
 * @email inwavethemes@gmail.com
 * @website http://inwavethemes.com
 * @support Ticket https://inwave.ticksy.com/
 * @copyright Copyright (c) 2015 Inwavethemes. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */

/**
 * Description of iwevent-script
 *
 * @developer duongca
 */
(function ($) {
    "use strict";

    function iw_infunding_donate() {
        $(window).on("load resize", function () {
            $(".iw-our-missions").click(function (){
                $('html, body').animate({
                    scrollTop: $(".iw-scroll-to-top").offset().top
                }, 500);
            });
        });
    }
    function tooltip(){
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    }
    /*** RUN ALL FUNCTION */
    $(document).ready(function () {
        // run function here:
        iw_infunding_donate();
        tooltip();
    });

})(jQuery);
