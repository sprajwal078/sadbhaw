(function ($) {
	"use strict";

    window.iwOpenWindow = function (url) {
        window.open(url, 'sharer', 'toolbar=0,status=0,left=' + ((screen.width / 2) - 300) + ',top=' + ((screen.height / 2) - 200) + ',width=650,height=380');
        return false;
    }

    /** theme prepare data */

    function theme_init() {
        $('.iw-button-effect .effect').each(function () {
            $(this).attr('data-hover', $(this).text());
        });
		
		/** hash link scroll */
		$('.wrapper a').live('click',function (e) {
			var anchor = $(this).attr('href');
			if(anchor){
				anchor = anchor.substr(anchor.indexOf('#'));
				if (!$(this).hasClass('ui-tabs-anchor') && anchor.indexOf('#') >= 0 && $(anchor).length && !$(anchor).hasClass('vc_tta-panel')) {
					var top = $(anchor).offset().top;
					$('html, body').animate({
						scrollTop: top - 90
					}, 'slow','easeInOutExpo');
					e.preventDefault();
				} else {
					if (anchor == '#') {
						e.preventDefault();
					}
				}
			}
		});
    }

    /**
     * Sticky Menu
     */

    function sticky_menu(){
        var $windows_width = $(window).width();
        var $header = $(".header-sticky"),
            $clone = $header.before($header.clone().addClass("clone"));
        if($windows_width > 991){
            $(window).on("scroll", function() {
                var fromTop = $(document).scrollTop();
                $('body').toggleClass("down", (fromTop > 200));
            });
        }
    }

    /**
     * Hover item in Revolution Slider will change background
     */
    function hover_item_slider(){
        $('.slider-3-volunteer, .slider-3-bg-image, .slider-3-image-volunteer').mouseover(function(){
            $('.slider-3-volunteer').css('color','white');
            $('.slider-3-bg-image').addClass('theme-bg');
            $('.slider-3-image-volunteer img').css({'filter':'brightness(200%)','-webkit-filter':'brightness(200%)'})
        }).mouseleave(function() {
                $('.slider-3-volunteer').css('color','#838383');
                $('.slider-3-bg-image').removeClass('theme-bg');
                $('.slider-3-image-volunteer img').css({'filter':'brightness(100%)','-webkit-filter':'brightness(100%)'})
            });
        $('.slider-3-volunteer-2, .slider-3-bg-image-2, .slider-3-image-volunteer-2').mouseover(function(){
            $('.slider-3-volunteer-2').css('color','white');
            $('.slider-3-bg-image-2').addClass('theme-bg');
            $('.slider-3-image-volunteer-2 img').css({'filter':'brightness(200%)','-webkit-filter':'brightness(200%)'})
        }).mouseleave(function() {
                $('.slider-3-volunteer-2').css('color','#838383');
                $('.slider-3-bg-image-2').removeClass('theme-bg');
                $('.slider-3-image-volunteer-2 img').css({'filter':'brightness(100%)','-webkit-filter':'brightness(100%)'})
            });
        $('.slider-3-volunteer-3, .slider-3-bg-image-3, .slider-3-image-volunteer-3').mouseover(function(){
            $('.slider-3-volunteer-3').css('color','white');
            $('.slider-3-bg-image-3').addClass('theme-bg');
            $('.slider-3-image-volunteer-3 img').css({'filter':'brightness(200%)','-webkit-filter':'brightness(200%)'})
        }).mouseleave(function() {
                $('.slider-3-volunteer-3').css('color','#838383');
                $('.slider-3-bg-image-3').removeClass('theme-bg');
                $('.slider-3-image-volunteer-3 img').css({'filter':'brightness(100%)','-webkit-filter':'brightness(100%)'})
            });
    }
	/**
     * Woocommerce increase/decrease quantity function
     */
    function woocommerce_init() {
        var clickOutSite = false;

        window.increaseQty = function (el, count) {
            var $el = $(el).parent().find('.qty');
            $el.val(parseInt($el.val()) + count);
        }
        window.decreaseQty = function (el, count) {
            var $el = $(el).parent().find('.qty');
            var qtya = parseInt($el.val()) - count;
            if (qtya < 1) {
                qtya = 1;
            }
            $el.val(qtya);
        }
		
		var owl = $(".product-detail .product-essential .owl-carousel");
		owl.owlCarousel({
			direction: $('body').hasClass('rtl') ? 'rtl' : 'ltr',
			items: 5,
			itemsDesktopSmall : [979, 5],
			itemsTablet : [768, 2],
			itemsTabletSmall : false,
			itemsMobile : [479, 2],
			pagination: false,
			navigation : true,
			navigationText : ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
		});

        /** Quick view product */
        var buttonHtml = '';
        $('.quickview').on('click', function (e) {
            var el = this;
            buttonHtml = $(el).html();
            $(el).html('<i class="quickviewloading fa fa-cog fa-spin"></i>');
            var effect = $(el).find('input').val();
            Custombox.open({
                target: woocommerce_params.ajax_url + '?action=load_product_quick_view&product_id=' + el.href.split('#')[1],
                effect: effect ? effect : 'fadein',
                complete: function () {
                    $(el).html(buttonHtml);
                    var owl = $(".quickview-box .product-detail .product-essential .owl-carousel");
					owl.owlCarousel({
						direction: $('body').hasClass('rtl') ? 'rtl' : 'ltr',
						items: 5,
						itemsDesktopSmall : [979, 5],
						itemsTablet : [768, 4],
						itemsTabletSmall : false,
						itemsMobile : [479, 3],
						pagination: false,
						navigation : true,
						navigationText : ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
					});
                    $(".quickview-body .next").click(function () {
                        owl.trigger('owl.next');
                    })
                    $(".quickview-body .prev").click(function () {
                        owl.trigger('owl.prev');
                    });
                    $(".quickview-body .woocommerce-main-image").click(function (e) {
                        e.preventDefault();
                    })
                    $(".quickview-body .owl-carousel .owl-item a").click(function (e) {
                        e.preventDefault();
                        if ($(".quickview-body .woocommerce-main-image img").length == 2) {
                            $(".quickview-body .woocommerce-main-image img:first").remove();
                        }
                        $(".quickview-body .woocommerce-main-image img").fadeOut(function () {
                            $(".quickview-body .woocommerce-main-image img").stop().hide();
                            $(".quickview-body .woocommerce-main-image img:last").fadeIn();
                        });
                        $(".quickview-body .woocommerce-main-image").append('<img class="attachment-shop_single wp-post-image" style="display:none;" src="' + this.href + '" alt="">');

                    })
                },
                close: function () {
                    $(el).html(buttonHtml);
                }
            });
            e.preventDefault();

        });

/*        $('.my-cart').click(function () {
            if (!$(this).hasClass('active')) {
                $(this).addClass('active');
                $('.icon-cart .carts-store').show().animate({
                    'margin-right': 0
                }, 400, 'easeInOutExpo');
            } else {
                $(this).removeClass('active');
                $('.icon-cart .carts-store').animate({
                    'margin-right': '-280px'
                }, 400, 'easeInOutExpo', function () {
                    $('.icon-cart .carts-store').hide()
                });
            }
            clickOutSite = false;
            setTimeout(function () {
                clickOutSite = true;
            }, 100);
        });
        $('.icon-cart .carts-store').click(function () {
            clickOutSite = false;
            setTimeout(function () {
                clickOutSite = true;
            }, 100);
        });

        $('.head-login .cart-icon').hover(
            function () {
                $('.head-login .login-icon').addClass('login-icon-under');
            },
            function () {
                $('.head-login .login-icon').removeClass('login-icon-under');
            }
        )


*/


        $('.add_to_cart_button').on('click', function (e) {
            if ($(this).find('.fa-check').length) {
                e.preventDefault();
                return;
            }
            $(this).addClass('cart-adding');
            $(this).html('<i class="fa fa-cog fa-spin"></i>');

        })
        $('.add_to_wishlist').on('click', function (e) {
            if ($(this).find('.fa-check').length) {
                e.preventDefault();
                return;
            }
            $(this).addClass('wishlist-adding');
            $(this).find('i').removeClass('fa-star').addClass('fa-cog fa-spin');
        })
        $('.yith-wcwl-add-to-wishlist').appendTo('.add-to-box');
        $('.yith-wcwl-add-to-wishlist .link-wishlist').appendTo('.add-to-box form.cart');
        if ($('.variations_form .variations_button').length) {
            $('.yith-wcwl-add-to-wishlist .link-wishlist').appendTo('.variations_form .variations_button');
        }

        //trigger events add cart and wishlist
        $('body').on('added_to_wishlist', function () {
            $('.wishlist-adding').html('<i class="fa fa-check"></i>');
            $('.wishlist-adding').removeClass('wishlist-adding');
        });

        $('body').on('added_to_cart', function (e, f) {
            $('.added_to_cart.wc-forward').remove();
            // $('.cart-adding i').remove();
            //$('.cart-adding').removeClass('cart-adding');
            $('.cart-adding').html('<i class="fa fa-check"></i>');
			$('.cart-adding').addClass('cart-added');
            $('.cart-adding').removeClass('cart-adding');

        });

        /**
         * submitProductsLayout
         */
        window.submitProductsLayout = function (layout) {
            $('.product-category-layout').val(layout);
            $('.woocommerce-ordering').submit();
        }
    }

    /**
     * Carousel social footer
     */
    function carousel_init() {
        $(".owl-carousel").each(function () {
            var slider = $(this);
            var defaults = {
                direction: $('body').hasClass('rtl') ? 'rtl' : 'ltr'
            }
            var config = $.extend({}, defaults, slider.data("plugin-options"));
            // Initialize Slider
            slider.owlCarousel(config).addClass("owl-carousel-init");
        });

        $('.post-gallery .gallery,.post-text .gallery').each(function () {
            var galleryOwl = $(this);
            var classNames = this.className.toString().split(' ');
            var column = 1;
            $.each(classNames, function (i, className) {
                if (className.indexOf('gallery-columns-') != -1) {
                    column = parseInt(className.replace(/gallery-columns-/, ''));
                }
            });
            galleryOwl.owlCarousel({
                direction: $('body').hasClass('rtl') ? 'rtl' : 'ltr',
                items: column,
                singleItem: true,
                navigation: true,
                pagination: false,
                navigationText: ["<i class=\"fa fa-chevron-left\"></i>", "<i class=\"fa fa-chevron-right\"></i>"],
                autoHeight: true
            });
        });

        $(".iw-footer-social .iw-social-all").owlCarousel({

            // Most important owl features

            items : 5,
            itemsCustom : false,
            itemsDesktop : [1199,4],
            itemsDesktopSmall : [980,3],
            itemsTablet: [768,2],
            itemsTabletSmall: false,
            itemsMobile : [479,1],
            singleItem : false,
            itemsScaleUp : false,

            //Autoplay
            autoPlay : false,
            stopOnHover : false,

            // Navigation
            navigation : false,
            navigationText : ["",""],
            rewindNav : true,
            scrollPerPage : false,

            //Pagination
            pagination : false,
            paginationNumbers: false
        })
    }
	
	function navStyle4(){

			var el = $('.header-version-4 .main-menu');
			if (el.length) {
				var trigger = el.find('.nav-trigger');
				var menuItems = el.find('.iw-nav-menu > li');
				var $body = $('body');
				
				menuItems.each(function() {
					var $this = $(this);
					$this.css({
						'-webkit-transition-delay': $this.index() / 15 + 's',
						'-moz-transition-delay': $this.index() / 15 + 's',
						'transition-delay': $this.index() / 15 + 's'
					});
				});
				trigger.find('span').css({
					'-webkit-transition-delay': menuItems.length / 15 + 's, 0s' + menuItems.length/15 + 's',
					'-moz-transition-delay': menuItems.length / 15 + 's, 0s' + menuItems.length/15 + 's',
					'transition-delay': menuItems.length / 15 + 's, 0s' +	menuItems.length/15 + 's' 
				});
				el.find('.header-donate-button').css({
					'-webkit-transition-delay': (menuItems.length/2)/15 + 's',
					'-moz-transition-delay': (menuItems.length/2)/15 + 's',
					'transition-delay': (menuItems.length/2)/15 + 's'
				});
				
				trigger.on('click', function(event) {
					event.preventDefault();
					$body.toggleClass('menu-activated');
				});
			};
	};

  	/**
     parallax effect */
    function parallax_init() {
        $('.iw-parallax').each(function () {
            $(this).css({
                'background-repeat': 'no-repeat',
                'background-attachment': 'fixed',
                'background-size': '100% auto',
                'overflow': 'hidden'
            }).parallax("50%", $(this).attr('data-iw-paraspeed'));
        });
        $('.iw-parallax-video').each(function () {
            $(this).parent().css({"height": $(this).attr('data-iw-paraheight'), 'overflow': 'hidden'});
            $(this).parallaxVideo("50%", $(this).attr('data-iw-paraspeed'));
        });
    };
   /*** RUN ALL FUNCTION */
	/*doc ready*/
    $(document).ready(function () {
        woocommerce_init();
        sticky_menu();
        hover_item_slider();
        parallax_init();
        theme_init();
        carousel_init();
		navStyle4();
        /*** fit video */
        $(".fit-video").fitVids();

        $('.profile-box.style5').hover(function () {
            $('.profile-box.style5').removeClass('active');
            $(this).addClass('active');
        });
		
		$(".in-volunteer-contact select, .infunding-listing-page .filter-form select,.orderby, .widget select").select2();
		
		$('.in-volunteer-contact .wpcf7-list-item input[type=radio]').iCheck({
			radioClass: 'iradio_flat'
		});

        $('.iw-server-location-2 .map-picker .picker-icon').click(function (){
			
            var parent = $(this).parent();
			
            if (parent.hasClass('active')){
                parent.removeClass('active');
            } else {
				$('.iw-server-location-2 .map-picker').removeClass('active');
                parent.addClass('active');
            }
        });
        
		$(".iw-button-toggle-header-v4").addClass('iw-button-toggle');
		$(".icon-arrow").each(function(){
			var click_icon_arrow = true;
			$(this).on('click',function(e){
				if(click_icon_arrow){
					$(this).addClass('active_icon_menu');
					$(this).parent().parent().find('.sub-menu:first').slideDown();
					click_icon_arrow = false;
				}else{
					$(this).removeClass('active_icon_menu');
					$(this).parent().parent().find('.sub-menu').slideUp()
					click_icon_arrow = true;
				}
				e.preventDefault();
			});
		});
		var $click_button_togle = true;
		$('.iw-button-toggle').on('click',function(){
			if($click_button_togle){
				if($(window).width() < 992){
					$('.menu-default-menu-container, .menu-menu-with-icons-container').slideDown();
				}else{
					$('.menu-default-menu-container, .menu-menu-with-icons-container').show();
				}
				$(this).addClass('show_customer');
				$click_button_togle = false;
			}else{
				if($(window).width() < 992){
					$('.menu-default-menu-container, .menu-menu-with-icons-container').slideUp();
				}else{

					$('.menu-default-menu-container, .menu-menu-with-icons-container').show();

				}
				$(this).removeClass('show_customer');
				$click_button_togle = true;
			}	
		});
		$(window).on("resize",function(){	
			if($(window).width() < 992){
				if($click_button_togle){
					$('.menu-default-menu-container, .menu-menu-with-icons-container').hide();
				}
			}else{
				$('.menu-default-menu-container, .menu-menu-with-icons-container').show();
			}
			
		});       
    });
	/*window loaded */
	$(window).on('load',function(){
		parallax_init();
	})

    /**
     * Toggle button menu in mobile and table
     */

    
})(jQuery);

