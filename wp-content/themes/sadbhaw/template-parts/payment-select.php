<?php
/*
*Template name: Payment Select Sadhbhaw
*/
//Check if nonce is valid and donator info has been added to the db
if (isset($_GET['_donation_nonce']) && wp_verify_nonce($_GET['_donation_nonce'],'donation_verify') && isset($_GET['id']) ):
  global $wpdb;
  //Get donation amount from db
  $amount = $wpdb->get_var($wpdb->prepare('SELECT donated_amount FROM wp_sadbhaw_donators WHERE id = %d', $_GET['id']));
  get_header();
?>
<div class="container downloads payment-select">
  <div class="wpb_wrapper">
    <div class="vc_row wpb_row vc_inner vc_row-fluid">
      <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner vc_custom_1451981561873">
          <div class="wpb_wrapper">
            <div class="iw-heading   style1  center-text">
              <h3 class="iwh-title" style="font-size:40px"><?php the_title(); ?></h3>
              <p class="iwh-content"><?php echo $post->post_content; ?> </p>
            </div>
            <div class="row mt flex-row align-stretch form-basic clearfix mb">
              <div class="col-md-6">
                <!-- Payment Select Form Starts -->
                <!-- <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="post"> -->
                  <!-- <input type="hidden" name="action" value="payment_method"/> -->
                  <div class="">
                      <!-- Form Title -->
                      <div class="form-title">
                        <h2>Select Payment Method</h2>
                      </div>

                      <!-- Payment Method -->
                      <div class="form-row inline text-center" id="payment-select">
                          <label>
                            Esewa
                            <input type="radio" checked name="payment_method" value="esewa" >
                          </label>
                          <label>
                            Skrill
                            <input type="radio" name="payment_method" value="skrill">
                          </label>
                          <label>
                            PayPal
                            <input type="radio" name="payment_method" value="paypal">
                          </label>
                      </div>
                      <div class="form-row text-center mt">
                        <div id="esewa">
                          <!-- Generates esewa donation form with donate button -->
                          <?php echo do_shortcode("[wpesewa-donation amount=".$amount." surl='".site_url('/donation-redirect?response=success&id=').$_GET['id']."' furl='".site_url('/donation-redirect?response=failed/')."']"); ?>
                        </div>
                        <div id="skrill" style="display: none">
                          <!-- Skrill Donate Button -->
                          <button type="button">Skrill</button>
                        </div>
                        <div id="paypal" style="display: none">
                          <!-- Paypal Donate Button -->
                          <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_donations">
                            <input type="hidden" name="business" value="6HBYSAURPWP4W">
                            <input type="hidden" name="lc" value="NP">
                            <input type="hidden" name="item_name" value="Sadbhaw Donation">
                            <input type="hidden" name="amount" value="<?php echo currencyConverter('NPR','USD',$amount); ?>">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="cn" value="Add special instructions to the seller:">
                            <input type="hidden" name="no_shipping" value="2">
                            <input type="hidden" name="rm" value="1">
                            <input type="hidden" name="return" value="<?php site_url('/donation-redirect/?response=success&id=').$_GET['id']; ?>">
                            <input type="hidden" name="cancel_return" value="<?php site_url('/donation-redirect/?response=failed') ?>">
                            <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHosted">
                            <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="width: auto;border: none">
                            <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                          </form>
                        </div>
                      </div>
                  </div>
                <!-- </form>Payment Select Form Ends -->
              </div>
              <div class="col-md-6" style="border-left: 1px solid rgba(0,0,0,.2)">
                <!-- Direct Deposit Section Starts -->
                <div class="">
                    <!-- Form Title -->
                    <div class="form-title">
                      <h2>Direct Deposit</h2>
                    </div>
                    <div class="form-row text-center">

                      <p><?php echo get_field('direct_deposit'); ?></p>
                    </div>
                </div>
              </div>
                <?php /**
                <!-- Visit Office Section Starts -->
                <div class="visit-office">
                  <div class="in-volunteer-contact">
                    <h3 class="title-contact-form">Visit our Office for Payment</h3>
                      <p><?php echo get_field('visit_office'); ?></p>
                  </div>
                </div><!-- Visit Office Section Ends -->
                <!-- We Visit You Section Starts -->
                <div class="visit-office">
                  <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="post">
                    <input type="hidden" name="action" value="we_visit_you"/>
                    <div class="in-volunteer-contact">
                      <h3 class="title-contact-form">We Visit You (Just inside Nepal)</h3>
                      <div class="in-contact-field">
                        <label class="label_field">Address to meet you</label>
                        <div class="input-field">
                          <span class="wpcf7-form-control-wrap">
                            <input class="" placeholder="Your Address" required="required" type="text" value="" name="visit[address]"/>
                          </span>
                        </div>
                      </div>
                      <div class="in-contact-field">
                        <label class="label_field">Contact Number</label>
                        <div class="input-field">
                          <span class="wpcf7-form-control-wrap">
                            <input class="" placeholder="Your Number" required="required" type="text" value="" name="visit[number]"/>
                          </span>
                        </div>
                      </div>
                      <div class="in-contact-field">
                        <label class="label_field">Specific Date to meet You</label>
                        <div class="input-field">
                          <span class="wpcf7-form-control-wrap">
                            <input class="" placeholder="YY-MM-DD" type="date" name="visit[date]"/>
                          </span>
                        </div>
                      </div>
                      <div class="in-contact-field">
                        <div class="in-submit-field-inner text-right">
                       <!--    <a href="<?php echo site_url('donate'); ?>" class="wpcf7-form-control wpcf7-submit two-button">Back</a> -->
                          <input type="submit" value="Next" class="wpcf7-form-control wpcf7-submit two-button"/>
                        </div>
                      </div>
                      </div>
                    </div>
                  </form>
                </div><!-- We Visit You Section Ends -->
                **/ ?>

              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
get_footer();
else:
  wp_redirect(site_url());
endif;
