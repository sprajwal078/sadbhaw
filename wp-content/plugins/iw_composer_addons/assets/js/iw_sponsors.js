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

    function iw_sponsors_slider() {

        // Campaigns slider //
        $(document).ready(function () {
            $(".iw-sponsors-list").owlCarousel({
                // Most important owl features
                direction: $('body').hasClass('rtl') ? 'rtl' : 'ltr',
                items: 5,
                itemsCustom: false,
                itemsDesktop: [1199, 1],
                itemsDesktopSmall: [980, 1],
                itemsTablet: [768, 1],
                itemsTabletSmall: false,
                itemsMobile: [479, 1],
                singleItem: false,
                itemsScaleUp: false,
                //Autoplay
                autoPlay: false,
                stopOnHover: false,
                // Navigation
                navigation: true,
                navigationText: ["", ""],
                rewindNav: true,
                scrollPerPage: false,
                //Pagination
                pagination: false,
                paginationNumbers: false
            })
        });
    }
    /*** RUN ALL FUNCTION */
    $(document).ready(function () {
        // run function here:
        iw_sponsors_slider();
    });

})(jQuery);
