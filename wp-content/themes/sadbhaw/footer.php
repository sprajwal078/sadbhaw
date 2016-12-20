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
            <p>Copyright <?php echo date('Y'); ?> © <a href='http://himalayanclimate.org' target="_blank" class='theme-color'>HCI</a>. All rights reserved.</p>
          </div>
          <div class="col-md-6 col-sm-6 back-to-top-container">
            <nav class="iw-main-nav">
              <ul id="menu-footer-menu" class="menu">
                <li id="menu-item-475" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-475"><a href="<?php echo site_url()?>">Home</a></li>
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
  <!-- <script src="<?php echo site_url()?>/wp-content/plugins/infunding/assets/js/infunding_script.js"></script> -->
  <script src="<?php echo site_url()?>/wp-content/plugins/iw_composer_addons/assets/js/iw-server-location.js"></script>
  <script src="<?php echo site_url()?>/wp-content/plugins/iw_composer_addons/assets/js/iw-shortcodes.js"></script>


  <script src="<?php echo site_url()?>/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js"></script>
  <script src="<?php echo site_url()?>/wp-content/plugins/woocommerce/assets/js/jquery-cookie/jquery.cookie.min.js"></script>

  <script src="<?php echo site_url()?>/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.js"></script>
  <script src="<?php echo site_url()?>/wp-content/plugins/woocommerce/assets/js/prettyPhoto/jquery.prettyPhoto.min.js"></script>


  <script src="<?php echo site_url()?>/wp-content/plugins/yith-woocommerce-wishlist/assets/js/jquery.yith-wcwl.js"></script>

  <!-- <script src="<?php echo site_url()?>/wp-content/themes/incharity/js/template.js"></script> -->
  <!-- <script src="<?php echo site_url()?>/wp-content/themes/incharity/js/panel-settings.js"></script> -->
  <script src="<?php echo site_url()?>/wp-includes/js/wp-embed.min.js"></script>
  <script src="<?php echo site_url()?>/wp-content/plugins/js_composer/assets/js/dist/js_composer_front.min.js"></script>
  <script src="<?php echo site_url()?>/wp-content/plugins/iw_composer_addons/assets/js/jquery.parallax-1.1.3.js"></script>
  <script src="<?php echo site_url()?>/wp-content/plugins/iw_composer_addons/assets/js/jquery.gallery.js"></script>
  <script src="<?php echo site_url()?>/wp-content/plugins/infunding/assets/js/owl.carousel.min.js"></script>
  <script src="<?php echo site_url()?>/wp-content/themes/sadbhaw/js/animatejs/jquery.counterup.min.js"></script>
<style>
  .tp-thumbs{
    display: none;
  }
  .style4.profile-box{
    color:black !important;
  }
</style>
<script>
  $(document).ready(function() {
    var animate_done = false;
    //for stories slider
    setInterval(function(){
      var showm_item = $('.slide-item:visible');
      if(showm_item.next().length != 0){
        // $('.slide-item:visible').hide();
        // showm_item.next().show();
        $('.slide-item:visible').hide();
        showm_item.next().fadeIn('slow');
      }else{
        // $('.slide-item:visible').hide();
        // $('.slide-item').eq(0).show();
        $('.slide-item:visible').hide();
        $('.slide-item').eq(0).fadeIn('slow');
      }
    },5000);

    $(document).on('DOMMouseScroll MouseScrollEvent MozMousePixelScroll wheel scroll', function(event) {
      if($('.rollup').length > 0 ) {
        if ($('.rollup').position().top <= $(document).scrollTop() + 450) {
          if (!animate_done) {
            animate_done = true;
            console.log("running");

            $('.Count').each(function () {
              var $this = $(this);
              jQuery({Counter: 0}).animate({Counter: $this.text()}, {
                duration: 3000,
                easing: 'swing',
                step: function () {
                  $this.text(Math.ceil(this.Counter));
                }
              });
            });
          }

        }
      }
      $('body').addClass('down');
      event.stopPropagation();
    });
});
</script>
<?php wp_footer(); ?>
</body>
