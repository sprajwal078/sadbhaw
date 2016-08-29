<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Sadbhaw
 * @since Sadbhaw 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="xmlrpc.php">
		<script type="text/javascript">document.documentElement.className=document.documentElement.className+' yes-js js_active js'</script>
		<title>inCharity &#8211; Just another WordPress site</title>
		<style>.wishlist_table .add_to_cart,a.add_to_wishlist.button.alt{border-radius:16px;-moz-border-radius:16px;-webkit-border-radius:16px}</style>
		<script type="text/javascript">var yith_wcwl_plugin_ajax_web_url='wp-admin/admin-ajax.html';</script>
		<link rel="alternate" type="application/rss+xml" title="inCharity &raquo; Feed" href="feed/index.html"/>
		<link rel="alternate" type="application/rss+xml" title="inCharity &raquo; Comments Feed" href="comments/feed/index.html"/>
		<script type="text/javascript">window._wpemojiSettings={"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/72x72\/","ext":".png","source":{"concatemoji":"http:\/\/inwavethemes.com\/wordpress\/incharity\/wp-includes\/js\/wp-emoji-release.min.js?ver=4.5.3"}};!function(a,b,c){function d(a){var c,d,e,f=b.createElement("canvas"),g=f.getContext&&f.getContext("2d"),h=String.fromCharCode;if(!g||!g.fillText)return!1;switch(g.textBaseline="top",g.font="600 32px Arial",a){case"flag":return g.fillText(h(55356,56806,55356,56826),0,0),f.toDataURL().length>3e3;case"diversity":return g.fillText(h(55356,57221),0,0),c=g.getImageData(16,16,1,1).data,d=c[0]+","+c[1]+","+c[2]+","+c[3],g.fillText(h(55356,57221,55356,57343),0,0),c=g.getImageData(16,16,1,1).data,e=c[0]+","+c[1]+","+c[2]+","+c[3],d!==e;case"simple":return g.fillText(h(55357,56835),0,0),0!==g.getImageData(16,16,1,1).data[0];case"unicode8":return g.fillText(h(55356,57135),0,0),0!==g.getImageData(16,16,1,1).data[0]}return!1}function e(a){var c=b.createElement("script");c.src=a,c.type="text/javascript",b.getElementsByTagName("head")[0].appendChild(c)}var f,g,h,i;for(i=Array("simple","flag","unicode8","diversity"),c.supports={everything:!0,everythingExceptFlag:!0},h=0;h<i.length;h++)c.supports[i[h]]=d(i[h]),c.supports.everything=c.supports.everything&&c.supports[i[h]],"flag"!==i[h]&&(c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&c.supports[i[h]]);c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&!c.supports.flag,c.DOMReady=!1,c.readyCallback=function(){c.DOMReady=!0},c.supports.everything||(g=function(){c.readyCallback()},b.addEventListener?(b.addEventListener("DOMContentLoaded",g,!1),a.addEventListener("load",g,!1)):(a.attachEvent("onload",g),b.attachEvent("onreadystatechange",function(){"complete"===b.readyState&&c.readyCallback()})),f=c.source||{},f.concatemoji?e(f.concatemoji):f.wpemoji&&f.twemoji&&(e(f.twemoji),e(f.wpemoji)))}(window,document,window._wpemojiSettings);</script>
		<style type="text/css">img.wp-smiley,img.emoji{display:inline!important;border:none!important;box-shadow:none!important;height:1em!important;width:1em!important;margin:0 .07em!important;vertical-align:-.1em!important;background:none!important;padding:0!important}</style>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/plugins/iw_composer_addons/assets/css/font-awesome/css/font-awesome.min.css' type='text/css' media='all'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/plugins/infunding/assets/css/custombox.min.css' type='text/css' media='all'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/plugins/infunding/assets/css/iw-legacy.css' type='text/css' media='all'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/plugins/infunding/assets/css/infunding_style.css' type='text/css' media='all'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/plugins/infunding/assets/css/infunding_slider.css' type='text/css' media='all'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/plugins/infunding/assets/css/owl.carousel.css' type='text/css' media='all'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/plugins/infunding/assets/css/owl.theme.css' type='text/css' media='all'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/plugins/infunding/assets/css/owl.transitions.css' type='text/css' media='all'/>

		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/plugins/iw_composer_addons/assets/css/iw-shortcodes.css' type='text/css' media='all'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/plugins/iw_composer_addons/assets/css/iw-testimonials.css' type='text/css' media='all'/>

		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/plugins/revslider/public/assets/css/settings.css' type='text/css' media='all'/>


		<!--left here-->
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/plugins/woocommerce/assets/css/woocommerce-layout.css' type='text/css' media='all'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/plugins/woocommerce/assets/css/woocommerce-smallscreen.css' type='text/css' media='only screen and (max-width: 768px)'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/plugins/woocommerce/assets/css/woocommerce.css' type='text/css' media='all'/>
		<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto+Slab%3A100%2C300%2C400%2C700&amp;ver=1.5.0' type='text/css' media='all'/>
		<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=ABeeZee%3A100%2C300%2C400%2C700&amp;ver=1.5.0' type='text/css' media='all'/>

		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/themes/incharity/css/bootstrap.min.css' type='text/css' media='all'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/themes/incharity/css/select2.css' type='text/css' media='all'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/themes/incharity/fonts/pwsignaturetwo/stylesheet.css' type='text/css' media='all'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/themes/incharity/css/woocommece.css' type='text/css' media='all'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/themes/incharity/css/animation.css' type='text/css' media='all'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/themes/incharity/style.css' type='text/css' media='all'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/themes/incharity/css/responsive.css' type='text/css' media='all'/>

	<link rel='stylesheet' href='http://inwavethemes.com/wordpress/incharity/wp-admin/admin-ajax.php?action=inwave_color&#038;ver=1.5.0' type='text/css' media='all'/>
		<link rel='stylesheet' href='wp-admin/admin-ajaxe15b.css?action=inwave_color&amp;ver=1.5.0' type='text/css' media='all'/>
		<link rel='stylesheet' href='<?php echo site_url()?>/wp-content/plugins/js_composer/assets/css/js_composer.min.css' type='text/css' media='all'/>
		<script src="<?php echo site_url()?>/wp-content/plugins/infunding/assets/js/masonry.pkgd.min.js"></script>
		<script type='text/javascript' src='http://maps.googleapis.com/maps/api/js?key=AIzaSyAQ-kNIGl-wRlW4gbo-Se0tZKkBXnvbuT0&ver=4.5.3'></script>
		<script type='text/javascript'>var wc_add_to_cart_params={"ajax_url":"\/wordpress\/incharity\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/wordpress\/incharity\/?wc-ajax=%%endpoint%%","i18n_view_cart":"View Cart","cart_url":"http:\/\/inwavethemes.com\/wordpress\/incharity\/cart\/","is_cart":"","cart_redirect_after_add":"no"};</script>




		<!--[if lte IE 9]>
		<link rel="stylesheet" type="text/css" href="http://inwavethemes.com/wordpress/incharity/wp-content/plugins/js_composer/assets/css/vc_lte_ie9.min.css" media="screen">
		<![endif]--><!--[if IE  8]>
		<link rel="stylesheet" type="text/css" href="http://inwavethemes.com/wordpress/incharity/wp-content/plugins/js_composer/assets/css/vc-ie8.min.css" media="screen">
		<![endif]-->
		<style type="text/css" data-type="vc_shortcodes-custom-css">
			.vc_custom_1454496271895{
				margin-bottom:0!important;
				padding-top:40px!important;
				background-image:url(wp-content/uploads/2015/12/xmap-bg.png%2cqid%3d1648.pagespeed.ic.ihlo5ZPhlI.png)!important;
				background-position:center!important;background-repeat:no-repeat!important;background-size:cover!important
			}
			.vc_custom_1451359398429{
				margin-bottom:0!important
			}
			.vc_custom_1469676508172{
				background:#000 url(/wp-content/uploads/revslider/slider-3/xeducation_above_all_children.jpg,qid=1835.pagespeed.ic.u2ICBTOgXU.jpg)!important
			}
			.vc_custom_1451465602687{
				margin-bottom:115px!important
			}
			.vc_custom_1451448042960{
				margin-bottom:0!important
			}
			.vc_custom_1451450048827{
				margin-bottom:0!important;
				padding-top:100px!important;
				padding-bottom:100px!important
			}
			.vc_custom_1454588490991{
				margin-bottom:0!important
			}
			.vc_custom_1451364776558{
				margin-top:200px!important;
				margin-bottom:200px!important
			}
			.vc_custom_1451527585372{
				padding-right:0!important;
				padding-left:0!important
			}
		</style>
		<noscript>
			<style type="text/css">.wpb_animate_when_almost_visible{opacity:1}</style>
		</noscript>
	    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<script type="text/javascript" src="http://inwavethemes.com/wordpress/incharity/wp-content/plugins/revslider/public/assets/js/extensions/revolution.extension.slideanims.min.js"></script>
		<script type="text/javascript" src="http://inwavethemes.com/wordpress/incharity/wp-content/plugins/revslider/public/assets/js/extensions/revolution.extension.layeranimation.min.js"></script>
		<script type="text/javascript" src="http://inwavethemes.com/wordpress/incharity/wp-content/plugins/revslider/public/assets/js/extensions/revolution.extension.navigation.min.js"></script>
		<script type="text/javascript" src="http://inwavethemes.com/wordpress/incharity/wp-content/plugins/revslider/public/assets/js/extensions/revolution.extension.parallax.min.js"></script>
	<?php wp_head(); ?>
</head>
<body id="page-top" class="home page page-id-725 page-parent page-template page-template-page-templates page-template-home-page page-template-page-templateshome-page-php wpb-js-composer js-comp-ver-4.12 vc_responsive">
<div class="wrapper ">
	<div class="header header-default header-sticky ">
		<div role="navigation" class="navbar navbar-default navbar-bg-light">
			<div class="container">
				<div class="row">
					<div class="col-md-2 col-sm-12 col-xs-12 no-padding">
						<h1 class="logo">
							<a href="<?php echo site_url()?>" title="inCharity">
								<img class="main-logo" src="data:image/webp;base64,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" alt="inCharity">
								<img class="sticky-logo" src="data:image/webp;base64,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" alt="inCharity">
							</a>
						</h1>
					</div>
					<div class="col-md-10 col-sm-12 col-xs-12">
						<div class="iw-menu-default main-menu nav-collapse">
							<button data-target=".nav-collapse" class="iw-button-toggle btn-navbar pull-right" type="button">
								<i class="fa fa-bars"></i>
							</button>
							<div class="menu-default-menu-container">
								<ul id="menu-main-menu" class="iw-nav-menu">
									<?php $menus = get_menu_tree('Header Sadbhaw');
									foreach ($menus as $menu){ ?>
										<li id="menu-item-611" class="menu-item menu-item-type-post_type menu-item-object-page <?php if(isset($menu->children)) echo 'menu-item-has-children'?>">
											<a href="<?php echo $menu->url;?>"><strong><?php echo $menu->title?></strong>
											</a>
											<?php if(isset($menu->children)){?>
											<ul class="sub-menu">
												<?php foreach ($menu->children as $child){?>
														<li id="menu-item-615" class="menu-item menu-item-type-post_type menu-item-object-page">
															<a href="<?php echo $child->url?>"><?php echo $child->title?>
															</a>
														</li>
												<?php }?>
											</ul>
											<?php } ?>
										</li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
