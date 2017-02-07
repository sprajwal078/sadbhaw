<?php
/*
*Template name: Donate Sadbhaw
*/
session_start();
get_header();
?>
<div class="container downloads">
  <div class="iw-heading   style1  center-text">
    <h3 class="iwh-title" style="font-size:40px"><?php the_title(); ?></h3>
  </div>
  <div class="col-md-10 col-md-offset-1 mt">
    <!-- Featured Image -->
    <div class="vc_row wpb_row vc_row-fluid volunteer-contact-intro vc_custom_1453711736106" style="background-image: url('<?php the_post_thumbnail_url()?>') !important; background-size: 100% !important; padding-bottom: 15px;">
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
    </div> <!-- ./ Featured Image -->

    <!-- Form Section -->
    <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="post">
     <input type="hidden" name="action" value="donate_us"/>
      <!-- Form section -->
      <div class="form-basic clearfix row">
        <div class="col-md-8 col-md-offset-2">
          <!-- Form Title -->
          <div class="form-title">
            <h2>Contact Information</h2>
          </div>
          <!-- Form Body -->
          <div class="form-body">
            <!-- Full name -->
            <div class="form-row">
                <label>
                  <input placeholder="Your Name" type="text" value="<?php if(isset($_SESSION['prev_values'])) echo $_SESSION['prev_values']['donate']['name'];  ?>" name="donate[name]" required>
                  <span>Full Name *</span>
                </label>
                <span class="error"><?php if(isset($_SESSION['error']) && in_array('name_empty',$_SESSION['error'])) echo "Name Field is required"  ?></span>
            </div>

            <!-- Email -->
            <div class="form-row">
                <label>
                  <input placeholder="Your Email" type="email" value="<?php if(isset($_SESSION['prev_values'])) echo $_SESSION['prev_values']['donate']['email'];  ?>" name="donate[email]" required>
                  <span>Email *</span>
                </label>
                <span class="error"><?php if(isset($_SESSION['error']) && in_array('email_empty',$_SESSION['error'])) echo "Email Field is required"  ?></span>
            </div>

            <!-- Address -->
            <div class="form-row">
                <label>
                  <input placeholder="Address" type="text" value="<?php if(isset($_SESSION['prev_values'])) echo $_SESSION['prev_values']['donate']['address'];  ?>" name="donate[address]">
                  <span>Address</span>
                </label>
            </div>

            <!-- City/Zip -->
            <div class="form-row">
                <label>
                  <input placeholder="City,Zip Code" type="text" value="<?php if(isset($_SESSION['prev_values'])) echo $_SESSION['prev_values']['donate']['city'];  ?>" name="donate[city]">
                  <span>City,Zip</span>
                </label>
            </div>

            <!-- Contact -->
            <div class="form-row">
                <label>
                  <input placeholder="Contact Number" type="number" value="<?php if(isset($_SESSION['prev_values'])) echo $_SESSION['prev_values']['donate']['phone'];  ?>" name="donate[phone]">
                  <span>Contact *</span>
                </label>
            </div>

            <!-- Agreement -->
            <div class="form-row">
                <label>
                  <textarea readonly><?php the_field('terms_of_agreement') ?></textarea>
                  <span>Agreement</span>
                </label>
            </div>

            <?php
              //Get the donation plans added in the donate us section to display as dropdown
              $donation_plans = get_field('donation_plans');
            ?>
            <!-- Sponsor -->
            <div class="form-row">
                <label>
                  <select name="donate[sponsor]" required>
                    <option value="" disabled selected>Select one</option>
                    <?php foreach ($donation_plans as $plan) : ?>
                      <option value="<?php echo $plan['amount'] ?>" ><?php echo $plan['plan'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span>I would like to sponsor *</span>
                </label>
                <span class="error"><?php if(isset($_SESSION['error']) && in_array('sponsor_empty',$_SESSION['error'])) echo "Please select a sponsor"  ?></span>
            </div>

            <!-- Decline/Accept -->
            <div class="form-row inline">
                <label for="accept">
                  I accept the agreement
                  <input id="accept" type="checkbox" name="terms">
                </label>
                <span class="error"><?php if(isset($_SESSION['error']) && in_array('terms_not_accepted',$_SESSION['error'])) echo "Please accept the agreement"  ?></span>
            </div>

            <!-- Submit -->
            <div class="form-row">
              <button type="submit" name="submit" value="Donate">Donate</button>
              <button type="submit" name="submit" value="I Pledge">I Pledge</button>
              <?php
                // Ensure form is submitted before taking to payment section / thank you page
                wp_nonce_field('donation_verify','_donation_nonce');
              ?>
            </div>
          </div>
        </div>
      </div>

<!--      <div class="in-volunteer-contact">
        <h3 class="title-contact-form">Contact Information</h3>
        <div class="in-contact-field">
         <label class="label_field">Name*</label>
         <div class="input-field">
          <span class="wpcf7-form-control-wrap">
            <input class="" placeholder="Name" type="text" value="<?php if(isset($_SESSION['prev_values'])) echo $_SESSION['prev_values']['donate']['name'];  ?>" name="donate[name]"/>
            <span class="error"><?php if(isset($_SESSION['error']) && in_array('name_empty',$_SESSION['error'])) echo "Name Field is required"  ?></span>
          </span>
         </div>
        </div>
        <div class="in-contact-field">
         <label class="label_field">Email*</label>
         <div class="input-field">
          <span class="wpcf7-form-control-wrap">
          <input class="" placeholder="Email" type="email" value="<?php if(isset($_SESSION['prev_values'])) echo $_SESSION['prev_values']['donate']['email'];  ?>" name="donate[email]"/>
          <span class="error"><?php if(isset($_SESSION['error']) && in_array('email_empty',$_SESSION['error'])) echo "Email Field is required"  ?></span>
          </span>
         </div>
        </div>
        <div class="in-contact-field">
         <label class="label_field">Address</label>
         <div class="input-field">
          <span class="wpcf7-form-control-wrap">
          <input class="" placeholder="Address" type="text" value="<?php if(isset($_SESSION['prev_values'])) echo $_SESSION['prev_values']['donate']['address'];  ?>" name="donate[address]"/> </span>
         </div>
        </div>
        <div class="in-contact-field">
         <label class="label_field">Contact Number</label>
         <div class="input-field">
          <span class="wpcf7-form-control-wrap">
          <input class="" placeholder="Contact Number" type="text" value="<?php if(isset($_SESSION['prev_values'])) echo $_SESSION['prev_values']['donate']['phone'];  ?>" name="donate[phone]"/> </span>
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
            <select name="donate[sponsor]">
              <option value="" disabled selected>Select one</option>
              <?php foreach ($donation_plans as $plan) : ?>
              <option value="<?php echo $plan['plan'] ?>" ><?php echo $plan['plan'] ?></option>
            <?php endforeach; ?>
            </select>
            <span class="error"><?php if(isset($_SESSION['error']) && in_array('sponsor_empty',$_SESSION['error'])) echo "Please select a sponsor"  ?></span>
          </span>
         </div>
        </div>
        <div class="in-contact-field">
         <label class="label_field">Agreement*</label>
         <div class="input-field"><span class="wpcf7-form-control-wrap your-message"><textarea name="donate[aggrement]" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" disabled><?php the_field('terms_of_agreement') ?></textarea></span> </div>
        </div>
        <div class="in-contact-field">
         <label class="label_field"> </label>
         <div class="input-field">
            <span class="wpcf7-form-control-wrap your-message">
              <label><input type="radio" name="terms" value="decline" > Decline </label>
              <label><input type="radio" name="terms" value="accept">  Accept </label>
              <span class="error"><?php if(isset($_SESSION['error']) && in_array('terms_not_accepted',$_SESSION['error'])) echo "Please accept the agreement"  ?></span>
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
     </div> -->
    </form>
  </div>
</div>
<?php
  if(isset($_SESSION['error'])) unset($_SESSION['error']);
  if(isset($_SESSION['prev_values'])) unset($_SESSION['prev_values']);
?>
<?php get_footer()?>
