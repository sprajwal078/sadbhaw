<?php
/*
*Template name: Payment Select Sadhbhaw
*/
if (isset($_GET['_donation_nonce']) && wp_verify_nonce($_GET['_donation_nonce'],'donation_verify') ):
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
                <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="post">
                  <input type="hidden" name="action" value="payment_method"/>
                  <div class="">

                      <!-- Form Title -->
                      <div class="form-title">
                        <h2>Select Payment Method</h2>
                      </div>

                      <!-- Payment Method -->
                      <div class="form-row inline text-center">
                          <label>
                            Esewa
                            <input type="radio" checked name="payment_method" value="esewa">
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
                        <button type="submit">Next</button>
                      </div>
                  </div>
                </form><!-- Payment Select Form Ends -->
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
