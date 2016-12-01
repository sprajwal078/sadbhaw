<?php
/*
*Template name: Donate Sadbhaw
*/
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
            </div>
            <div class="contents-main" id="contents-main">
              <div class="vc_row wpb_row vc_row-fluid volunteer-contact-intro vc_custom_1453711736106">
               <div class="container">
                <div class="row">
                 <div class="wpb_column vc_column_container vc_col-sm-12">
                  <div class="vc_column-inner ">
                   <div class="wpb_wrapper">
                    <div class="vc_row wpb_row vc_inner vc_row-fluid">
                     <div class="wpb_column vc_column_container vc_col-sm-12">
                      <div class="vc_column-inner ">
                       <div class="wpb_wrapper donate_us">
                        <div class="iw-testimonial-item  layout3 vc_custom_1453710551682">
                         <div class="content">
                          <div class="iw-testimonial-info">
                           <div class="testi-text"><?php echo $post->post_content ?></div>
                          </div>
                         </div>
                         <div style="clear: both;"></div>
                        </div>
                       </div>
                      </div>
                     </div>
                    </div>
                    <div class="wpb_text_column wpb_content_element  vc_custom_1453710569576">
                     <div class="wpb_wrapper">
                      <p><a class="become-volunteer-button" href="#">Fill the form to donate <i class="fa fa-arrow-right"></i></a></p>
                     </div>
                    </div>
                   </div>
                  </div>
                 </div>
                </div>
               </div>
              </div>
              <div class="vc_row wpb_row vc_row-fluid">
               <div class="container">
                <div class="row">
                 <div class="wpb_column vc_column_container vc_col-sm-12">
                  <div class="vc_column-inner ">
                   <div class="wpb_wrapper">
                    <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="post">
                     <input type="hidden" name="action" value="donate_us"/>
                     <div class="in-volunteer-contact">
                        <h3 class="title-contact-form">Contact Information</h3>
                        <div class="in-contact-field">
                         <label class="label_field">Name</label>
                         <div class="input-field">
  												<span class="wpcf7-form-control-wrap">
  												<input class="" placeholder="Name" type="text" value="" name="donate[name]"/> </span>
                         </div>
                        </div>
                        <div class="in-contact-field">
                         <label class="label_field">Email</label>
                         <div class="input-field">
  												<span class="wpcf7-form-control-wrap">
  												<input class="" placeholder="Email" type="email" value="" name="donate[email]"/> </span>
                         </div>
                        </div>
                        <div class="in-contact-field">
                         <label class="label_field">Address</label>
                         <div class="input-field">
                          <span class="wpcf7-form-control-wrap">
                          <input class="" placeholder="Address" type="text" value="" name="donate[address]"/> </span>
                         </div>
                        </div>
                        <div class="in-contact-field">
                         <label class="label_field">Contact Number</label>
                         <div class="input-field">
  												<span class="wpcf7-form-control-wrap">
  												<input class="" placeholder="Contact Number" type="text" value="" name="donate[phone]"/> </span>
                         </div>
                        </div>
                        <?php
                          //Get the donation plans added in the donate us section to display as dropdown
                          $donation_plans = get_field('donation_plans');
                        ?>
                        <div class="in-contact-field">
                         <label class="label_field">I would like to sponsor *</label>
                         <div class="input-field">
  												<span class="wpcf7-form-control-wrap">
  													<select name="donate[sponsor]" required>
  														<option value="" disabled selected>Select one</option>
                              <?php foreach ($donation_plans as $plan) : ?>
  														<option value="<?php echo $plan['plan'] ?>"><?php echo $plan['plan'] ?></option>
                            <?php endforeach; ?>
  													</select>
  												</span>
                         </div>
                        </div>
                        <div class="in-contact-field">
                         <label class="label_field">Agreement</label>
                         <div class="input-field"><span class="wpcf7-form-control-wrap your-message"><textarea name="donate[aggrement]" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" disabled><?php the_field('terms_of_agreement') ?></textarea></span> </div>
                        </div>
                        <div class="in-contact-field">
                         <label class="label_field"> </label>
                         <div class="input-field">
                            <span class="wpcf7-form-control-wrap your-message">
                              <label><input type="radio" name="terms" value="decline"> Decline </label>
                              <label><input type="radio" name="terms" value="accept"> Accept </label>
                            </span>
                         </div>
                        </div>
                        <div class="in-contact-field in-submit-field">
                          <div class="in-submit-field-inner">
                            <input type="submit" name="submit" value="Donate" class="wpcf7-form-control wpcf7-submit two-button"/>
                            <input type="submit" name="submit" value="I Pledge" class="wpcf7-form-control wpcf7-submit two-button"/>
                            <?php
                              // Ensure form is submitted before taking to payment section / thank you page
                              wp_nonce_field('donation_verify','_donation_nonce');
                            ?>
                          </div>
                        </div>
                     </div>
                    </form>
                   </div>
                  </div>
                 </div>
                </div>
               </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer()?>
