<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Sadbhaw
 * @since Sadbhaw 1.0
 */
?>
    <footer class="page-footer">
        <div class="iw-footer-v2-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <p>Copyright 2015 © <a href='#' class='theme-color'>InCharity</a>. All rights reserved. Made with<i class="fa fa-heart theme-color"></i>by <a href='#' class='theme-color'>Inwavethemes</a></p>
                    </div>
                    <div class="col-md-6 col-sm-6 back-to-top-container">
                        <nav class="iw-main-nav">
                            <ul id="menu-footer-menu" class="menu">
                                <li id="menu-item-475" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-475"><a href="#">Home</a></li>
                                <li id="menu-item-476" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-476"><a href="#">Terms of Use</a></li>
                                <li id="menu-item-477" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-477"><a href="#">Privacy Policy</a></li>
                                <li id="menu-item-479" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-479"><a href="#">Disclaimer</a></li>
                            </ul>
                        </nav>
                        <div class="back-to-top"><a href="#page-top" title="Back to top" class="button-effect3"><i class="fa fa-arrow-up"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </div>

    <script type="text/javascript">
        function revslider_showDoubleJqueryError(sliderID){
            var errorMessage="Revolution Slider Error: You have some jquery.js library include that comes after the revolution files js include.";errorMessage+="<br> This includes make eliminates the revolution slider libraries, and make it not work.";errorMessage+="<br><br> To fix it you can:<br>&nbsp;&nbsp;&nbsp; 1. In the Slider Settings -> Troubleshooting set option:  <strong><b>Put JS Includes To Body</b></strong> option to true.";errorMessage+="<br>&nbsp;&nbsp;&nbsp; 2. Find the double jquery.js include and remove it.";errorMessage="<span style='font-size:16px;color:#BC0C06;'>"+errorMessage+"</span>";jQuery(sliderID).show().html(errorMessage);
        }
    </script>
    <script src="<?php echo site_url()?>/wp-content/plugins/infunding/assets/js/infunding_script.js"></script>
    <script src="<?php echo site_url()?>/wp-content/plugins/iw_composer_addons/assets/js/iw-server-location.js"></script>
    <script src="<?php echo site_url()?>/wp-content/plugins/iw_composer_addons/assets/js/iw-shortcodes.js"></script>


    <script src="<?php echo site_url()?>/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js"></script>
    <script src="<?php echo site_url()?>/wp-content/plugins/woocommerce/assets/js/jquery-cookie/jquery.cookie.min.js"></script>

    <script src="<?php echo site_url()?>/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.js"></script>
    <script src="<?php echo site_url()?>/wp-content/plugins/woocommerce/assets/js/prettyPhoto/jquery.prettyPhoto.min.js"></script>


    <script src="<?php echo site_url()?>/wp-content/plugins/yith-woocommerce-wishlist/assets/js/jquery.yith-wcwl.js"></script>
    <script src="<?php echo site_url()?>/wp-content/themes/incharity/js/bootstrap.min.js"></script>

    <script src="<?php echo site_url()?>/wp-content/themes/incharity/js/template.js"></script>
    <script src="<?php echo site_url()?>/wp-content/themes/incharity/js/panel-settings.js"></script>
    <script src="<?php echo site_url()?>/wp-includes/js/wp-embed.min.js"></script>
    <script src="<?php echo site_url()?>/wp-content/plugins/js_composer/assets/js/dist/js_composer_front.min.js"></script>
    <script src="<?php echo site_url()?>/wp-content/plugins/iw_composer_addons/assets/js/jquery.parallax-1.1.3.js"></script>
    <script src="<?php echo site_url()?>/wp-content/plugins/iw_composer_addons/assets/js/jquery.gallery.js"></script>
    <script src="<?php echo site_url()?>/wp-content/plugins/infunding/assets/js/owl.carousel.min.js"></script>
<style>
    .tp-thumbs{
        display: none;
    }
</style>
<?php wp_footer(); ?>
</body>
