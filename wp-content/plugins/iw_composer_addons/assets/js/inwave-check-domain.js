/* 
 * @package Inwave Inhost
 * @version 1.0.0
 * @created Apr 13, 2015
 * @author Inwavethemes
 * @email inwavethemes@gmail.com
 * @website http://inwavethemes.com
 * @support Ticket https://inwave.ticksy.com/
 * @copyright Copyright (c) 2015 Inwavethemes. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */

/**
 * Description of inwave-check-domain
 *
 * @developer duongca
 */

(function ($) {
    "use strict";
    var domain_check = false,xhrlist = Array(), checkDomains = 0;
    $(document).ready(function () {
        $('.inwave-domain-check.style1 .domain-list input').removeAttr('checked');
        $('.inwave-domain-check .ibutton').click(function () {
            submitCheckDomain();
        });

        $('.inwave-domain-check.style1 input[name="input_domain"]').focus(function () {
            hideMsg();
        });

        $('.inwave-domain-check input[name="input_domain"]').keypress(function (e) {
            if (e.keyCode === 13) {
                submitCheckDomain();
            } else {
                hideMsg();
            }
        });

        $('.inwave-domain-check.style1 .inwave-checkbox i').click(function () {
            if ($(this).hasClass('fa-square-o')) {
                $(this).removeClass('fa-square-o').addClass('fa-check-square');
                $(this).parents('li').find('input').attr('checked', 'checked');
            } else {
                $(this).removeClass('fa-check-square').addClass('fa-square-o');
                $(this).parents('li').find('input').removeAttr('checked');
            }
        });

        $('.list-domain-checked a.loading').live('click', function (e) {
            e.preventDefault();
        });

        $('.list-domain-checked a.unavailable').live('click', function (e) {
            hideTip($(this));
            var target = $(this).attr('href');
            Custombox.open({
                target: target,
                effect: 'fadein',
				overlaySpeed:'100',
                speed:'200',
                width: '700'
            });
            e.preventDefault();
        });
        $('.whois-box-close').live('click', function () {
            Custombox.close();
        });

        $('.list-domain-checked a.available').live('click', function (e) {
            var domain = $(this).data('domain');
            hideTip($(this));

            $.ajax({
                url: iwConfig.homeUrl + '?page_id=' + iwConfig.whmcs_pageid,
                data: 'ccce=cart&a=add&pid=1&domainoption=register&domains[]=' + domain + '&domainsregperiod[' + domain + ']=1',
                type: "GET",
                success: function (data) {
                    location.href = iwConfig.homeUrl + '?page_id=' + iwConfig.whmcs_pageid + '&ccce=cart&a=view';
                }
            });
            e.preventDefault();
        });

        $('.list-domain-checked a.ttip').live('mouseenter', function () {
            showTip($(this));
        }).live('mouseleave', function () {
            hideTip($(this));
        });

//Style 2 script
        $('.inwave-domain-check.style2 .select-domain').click(function () {
            $(this).parent().find('.domain-list').slideToggle();
        });

        $('.inwave-domain-check.style2 .domain-list li').click(function () {
            var itemClick = $(this), items = $('.inwave-domain-check.style2 .domain-list li');
            itemClick.find('input').attr('checked', 'checked');
            $('.inwave-domain-check.style2 .select-domain').html('<i class="fa fa-check"></i>' + itemClick.find('input').val())
            $(this).parent().slideToggle();

            items.each(function () {
                if (items.index(itemClick) !== items.index($(this))) {
                    $(this).find('input').removeAttr('checked');
                }
            });

        });

        $('body').click(function (event) {
            if ($(event.target).closest('.inwave-domain-check.style2 .domain-select-list').length === 0) {
                $('.inwave-domain-check.style2 .domain-list').slideUp();
            }
        });

    });

    function showTip(e) {
        e.parent().find('.tooltip').css('opacity',1).show();
    }
    function hideTip(e) {
        e.parent().find('.tooltip').hide();
    }

    function submitCheckDomain() {
        if($('.inwave-domain-check .checking').length && $('.list-domain-checked').is(':visible')){
            return;
        }
        var domains = $('.domain-list input:checked');
        var domainName = $('input[name="input_domain"]').val();
        xhrlist = Array();

        hideMsg();
        $('.list-domain-checked').html('').show();
        if (!domainName) {
            showMsg(iwConfig.msg_suggest);
            return;
        }
        if (domains.length == 0) {
            domains = $('.domain-list input');
        }

        var dindex = 0;
        $('.output-search-box').animate({'min-height':'123px','padding-top':'10px'});

        checkDomains = setInterval(function () {
            checkDomain(domainName, domains, dindex);
            dindex++;
            if (dindex === domains.length) {
                clearInterval(checkDomains);
                $('.list-domain-checked').append('<div class="domain-item"><a href="#more" onclick="javascript: location.href=\'' + iwConfig.homeUrl + '?page_id=' + iwConfig.whmcs_pageid + '&ccce=domainchecker\'; return;" class="more theme-bg"><i class="fa fa-plus"></i></div>');
            }
        }, 300);
    }

    function showMsg(text) {
        if ($('.inwave-domain-check').hasClass('style1')) {
            $('.list-domain-check .domain-list').hide();
        }
        $('.list-domain-check .output-error-msg').html(text).show();
    }
    function hideMsg() {
        $('.list-domain-check .output-error-msg').hide().text('');
        if ($('.inwave-domain-check').hasClass('style1')) {
            $('.list-domain-check .domain-list').show();
        }
    }

    function checkDomain(dn, dts, index) {
        var dt = $(dts[index]).val(), domain = dn + dt;
		var css = 'style="animation: 1.5s ease-in-out -'+(0.3*index)+'s normal none infinite running fa-spin;"';
        var htmlitem = '<div class="domain-item"><a href="#" class="ttip"><span class="item-icon"></span><span class="item-text">' + dt + '</span></a><div '+css+' class="checking fa fa-spin"></div></div>';
        var xhr = $.ajax({
            url: iwConfig.ajaxUrl,
            data: {action: 'domainLookup', domain: domain},
            type: "post",
            beforeSend: function () {
                $('.list-domain-checked').append(htmlitem);
                htmlitem = $('.list-domain-checked').find('.domain-item:last-child a');
            },
            success: function (data) {
                var a = jQuery.parseJSON(data);
                if (a.success) {
                    $(htmlitem).addClass(a.msg).parent().find('.checking.fa.fa-spin').fadeOut(function(){
						$(this).remove();	
					});
                    if (a.msg === 'available') {
                        if (!domain_check) {
                            showMsg('<span class="available inwave-checkbox"><i class="fa fa-check-square"></i></span>' + iwConfig.msg_available.replace(/%d/,domain));
                            domain_check = true;
                        }
                        $(htmlitem).attr('href', '#order').attr('data-domain', domain).parent().append('<span class="tooltip">Order</span>');
                        $(htmlitem).find('span.item-icon').html('<i class="fa fa-check"></i>');
                    } else {
                        var whois = '<div class="whois-box" style="display:none;" id="whois-' + dn + '-' + dt.replace(/./,'') + '"><div class="whois-title"><h3>WHOIS: <a target="_blank" href="http://' + domain + '">' + domain + '</a></h3><div class="whois-box-close"><span><i class="fa fa-times"></i></span></div></div><div class="whois-content"><div class="whois-content-inner">' + a.data + '</div></div></div>';
                        $(htmlitem).attr('href', '#whois-' + dn + '-' + dt.replace(/./,'')).parent().append(whois).append('<span class="tooltip">Whois</span>');
                        $(htmlitem).find('span.item-icon').html('<i class="fa fa-times"></i>');
                    }
                    if (index === dts.length - 1) {
                        if (!domain_check) {
                            showMsg(iwConfig.msg_unavailable.replace(/%d/,dn));
                        } else {
                            domain_check = false;
                        }
                    }
                } else {
                    showMsg(a.msg);
                    clearInterval(checkDomains);
                    $('.list-domain-checked').html('').hide();
                    for(var i= 0; i < xhrlist.length;i++){
                        xhrlist[i].abort();
                    }

                }

            }
        });
        xhrlist.push(xhr);
    }

})(jQuery);

