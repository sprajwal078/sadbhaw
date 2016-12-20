<?php
/*
*Template name: Payment Select Sadhbhaw
*/
if (isset($_GET['_donation_nonce']) && wp_verify_nonce($_GET['_donation_nonce'],'donation_verify') ):
  get_header();
?>
<div class="container downloads">
  <div class="wpb_wrapper">
    <div class="vc_row wpb_row vc_inner vc_row-fluid">
      <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner vc_custom_1451981561873">
          <div class="wpb_wrapper">
            <div class="iw-heading   style1  center-text">
              <h3 class="iwh-title" style="font-size:40px"><?php the_title(); ?></h3>
              <p class="iwh-content"><?php echo $post->post_content; ?> </p>
            </div>
            <div class="row mt">
              <div class="col-md-6">
                <!-- Payment Select Form Starts -->
                <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="post">
                  <input type="hidden" name="action" value="payment_method"/>
                  <div class="in-volunteer-contact">
                    <h3 class="title-contact-form">Online Payment</h3>
                    <div class="in-contact-field">
                      <label class="label_field">Select method</label>
                      <div class="input-field">
                        <span class="wpcf7-form-control-wrap">
                          <label class="radio-label"><input required="required" type="radio" value="esewa" name="payment_method"/> eSewa</label>
                          <label class="radio-label"><input required="required" type="radio" value="skrill" name="payment_method"/> Skrill</label>
                          <label class="radio-label"><input required="required" type="radio" value="paypal" name="payment_method"/> PayPal</label>
                        </span>
                      </div>
                      <div class="in-contact-field">
                        <div class="in-submit-field-inner text-right"><input type="submit" value="Next" class="wpcf7-form-control wpcf7-submit two-button"/></div>
                      </div>
                    </div>
                  </div>
                </form><!-- Payment Select Form Ends -->
              </div>
              <div class="col-md-6">
                <!-- Direct Deposit Section Starts -->
                <div class="direct-deposit">
                  <div class="in-volunteer-contact">
                    <h3 class="title-contact-form">Direct Deposit</h3>
                      <p><?php echo get_field('direct_deposit'); ?></p>
                  </div>
                </div><!-- Direct Deposit Section Ends -->
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
