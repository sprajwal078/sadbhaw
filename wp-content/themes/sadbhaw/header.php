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
		<title>Sadhbhaw</title>
		<!--[if lte IE 9]>
		<link rel="stylesheet" type="text/css" href="http://inwavethemes.com/wordpress/incharity/wp-content/plugins/js_composer/assets/css/vc_lte_ie9.min.css" media="screen">
		<![endif]--><!--[if IE  8]>
		<link rel="stylesheet" type="text/css" href="http://inwavethemes.com/wordpress/incharity/wp-content/plugins/js_composer/assets/css/vc-ie8.min.css" media="screen">
		<![endif]-->
	    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<?php wp_head(); ?>
</head>
<body id="page-top" class="home page page-id-725 page-parent page-template page-template-page-templates page-template-home-page page-template-page-templateshome-page-php wpb-js-composer js-comp-ver-4.12 vc_responsive down">
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '253914808385791',
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div class="wrapper ">
	<div class="header header-default header-sticky clone">
		<div role="navigation" class="navbar navbar-default navbar-bg-light">
			<div class="container">
				<div class="row">
					<div class="col-md-2 col-sm-12 col-xs-12 no-padding">
						<h1 class="logo">
							<a href="<?php echo site_url()?>" title="inCharity">
								<img class="main-logo" src="<?php echo get_template_directory_uri().'/images/logos/logo_big.png'?>" alt="inCharity">
								<img class="sticky-logo" src="<?php echo get_template_directory_uri().'/images/logos/logo_small.png'?>" alt="inCharity">
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
									$title = get_the_title();
									foreach ($menus as $menu){
										if($menu->title == $title){$class = "active";} else{$class = "";}
										 if(isset($menu->children)){
											 $child_menus = array();
												foreach ($menu->children as $child){
													$child_menus[] = $child->title;
												}
											 if(in_array($title, $child_menus)){$class="active";}
											}
										?>
										<li id="menu-item-611" class="<?php echo $class?> menu-item menu-item-type-post_type menu-item-object-page <?php if(isset($menu->children)) echo 'menu-item-has-children'?>">
											<a href="<?php if(isset($menu->children)){echo '#';} else {echo $menu->url;}?>"><strong><?php echo $menu->title?></strong>
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
