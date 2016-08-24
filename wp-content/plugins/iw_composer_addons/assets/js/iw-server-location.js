/* 
 * @package Inwave Event
 * @version 1.0.0
 * @created Jun 30, 2015
 * @author Inwavethemes
 * @email inwavethemes@gmail.com
 * @website http://inwavethemes.com
 * @support Ticket https://inwave.ticksy.com/
 * @copyright Copyright (c) 2015 Inwavethemes. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */

/**
 * Description of iw-server-location
 *
 * @developer duongca
 */

(function ($) {
    $(document).ready(function () {
        var frame;
        var fe = false;
        if ($('.iw-server-location-wrap').hasClass('site-view')) {
            fe = true;
        }
        $('.iw-server-location-wrap .controls .load-image').live('click', function () {
            // Set options
            var options = {
                state: 'insert',
                frame: 'post',
                multiple: false,
                library: {
                    type: 'image'
                }
            };

            frame = wp.media(options).open();

            // Tweak views
            frame.menu.get('view').unset('gallery');
            frame.menu.get('view').unset('featured-image');

            frame.toolbar.get('view').set({
                insert: {
                    style: 'primary',
                    text: 'Select',
                    click: function () {
                        var models = frame.state().get('selection');
                        models.each(function (e) {
                            var attm = e.toJSON();
                            var item_control = '<img src="' + attm.url + '"/>';
                            item_control += '<input type="hidden" value="' + attm.id + '" name="map_image"/>';
                            $('.iw-server-location-wrap .image-map-preview .image').html(item_control);
                        });
                        saveMapMarker();
                        frame.close();
                    }
                } // end insert
            });
        });

        //Select map marker
        $('.iw-server-location-wrap .map-picker').live('click', function () {
            var markers = $('.iw-server-location-wrap .map-picker'), item_target = $(this);
            item_target.appendTo('.iw-server-location-wrap .map-pickers');
            item_target.addClass('active');
            if (fe === true) {
                item_target.find('.tip').removeClass('hidden');
            } else {
                item_target.attr('title', 'Drag and Drop marker to your location');
                $('.iw-server-location-wrap .remove-location').removeClass('disabled');
            }
            markers.each(function () {
                if (markers.index($(this)) !== markers.index(item_target)) {
                    $(this).removeClass('active').attr('title', '');
                    if (fe === true) {
                        $(this).find('.tip').addClass('hidden');
                    }
                }
            });

            //FE
            if (fe === true) {
                $('.iw-server-location-wrap .marker-info .active').addClass('hidden').removeClass('active');
                $('.iw-server-location-wrap .marker-info .marker-info-' + item_target.data('post')).removeClass('hidden').addClass('active');
            } else {
                //BE
                $("#sel_post").select2("val", item_target.data('post'));
                $('.iw-server-location-wrap .location-list').removeClass('hidden');
            }
        });
        if (fe === false) {
            //Drag and Drop marker
            $('.iw-server-location-wrap .map-picker.active').live('mouseover', function () {
                $(this).draggable();
            });
            $('.iw-server-location-wrap .image-map-preview').live('mouseover', function () {
                $(this).droppable({
                    drop: function (event, ui) {
                        var drag_w = $('.image-map-preview').width(), drag_h = $('.image-map-preview').height();
                        $('.iw-server-location-wrap .map-picker.active').data('position', ui.position.left / drag_w + 'x' + ui.position.top / drag_h);
                        saveMapMarker();
                    }
                });
            });
        }

        //Add marker
        $('.iw-server-location-wrap .add-location').live('click', function () {
            $('.iw-server-location-wrap .image-map-preview .map-pickers').append('<span data-position="0x0" data-post="" class="map-picker"></span>');
        });
        //Remove marker
        $('.iw-server-location-wrap .remove-location').live('click', function () {
            if($(this).hasClass('disabled')){
                return;
            }
            $('.iw-server-location-wrap .image-map-preview .map-pickers').find('span.active').remove();
        });

        $("#sel_post").live("change", function () {
            var item_target = $('.iw-server-location-wrap .map-picker.active');
            item_target.data('post', $(this).val());
            saveMapMarker();
        });

        function saveMapMarker() {
            var markers = $('.iw-server-location-wrap .map-picker');
            var data = new Array();
            markers.each(function (index) {
                var marker = $(this);
                var active = 0;
                if (marker.hasClass('active')) {
                    active = 1;
                }
                data[index] = new Array(marker.data('post'), marker.data('position'), active);
            });

            $('.marker-location-data').val(base64_encode(JSON.stringify(new Array($('.iw-server-location-wrap input[name="map_image"]').val(), data))));
        }
    });
})(jQuery);
