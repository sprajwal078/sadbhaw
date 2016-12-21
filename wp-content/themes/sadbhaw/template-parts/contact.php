  <?php
  /*
  *Template name: Contact Sadbhaw
  */
  get_header(); ?>
<div class="container downloads contact mb">
  <!-- Google Maps Section Start -->
  <div class="col-md-10 col-md-offset-1">
    <!-- Heading -->
    <div class="iw-heading style1 center-text">
      <h3 class="iwh-title" style="font-size:40px">Our Location</h3>
    </div>

    <!-- Map -->
    <div class="contact-map mt row">
      <div class="map-contain" data-title="inwavethemes" data-image="http://inwavethemes.com/wordpress/incharity/wp-content/uploads/2015/10/map-maker.png" data-lat="40.6700" data-long="-73.9400" data-zoom="11" data-info="">
          <div class="map-view map-frame" style="height:330px">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d28253.60137753605!2d85.3406408!3d27.7265422!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb198a307baabf%3A0xb5137c1bf18db1ea!2sKathmandu+44600!5e0!3m2!1sen!2snp!4v1472621645651" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
      </div>
    </div><!-- Google Maps Section Ends -->
    <div class="row flex-row align-stretch form-basic clearfix mb">
      <div class="col-md-6 row-left">
        <!-- Payment Select Form Starts -->
        <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="post">
          <input type="hidden" name="action" value="payment_method"/>
          <div class="">
              <!-- Form Title -->
              <div class="form-title">
                <h2>Write Us a Message</h2>
              </div>
              <!-- Form Body -->
              <div class="form-body">
                <!-- Full name -->
                <div class="form-row">
                    <label>
                      <input placeholder="Your Name" type="text" name="name" required>
                      <span>Full Name *</span>
                    </label>
                </div>

                <!-- Email -->
                <div class="form-row">
                    <label>
                      <input placeholder="Your Email" type="email" name="email" required>
                      <span>Email *</span>
                    </label>
                </div>

                <!-- Message -->
                <div class="form-row">
                    <label>
                      <textarea placeholder="Your Message" name="message" required rows="7"></textarea>
                      <span>Message *</span>
                    </label>
                </div>

                <div class="form-row">
                  <button type="submit">Send</button>
                </div>
              </div>
          </div>
        </form><!-- Payment Select Form Ends -->
      </div>
      <div class="col-md-6 row-right" style="border-left: 1px solid rgba(0,0,0,.2)">
        <!-- Direct Deposit Section Starts -->
        <div class="">
            <?php
              $args = array('post_type' =>  'page',
                            'p'         =>  139,
                            'showposts' =>1
                          );
              $contactQuery = new WP_Query($args);
              if ( $contactQuery->have_posts() ):
                while( $contactQuery->have_posts() ): $contactQuery->the_post();
            ?>
            <!-- Form Title -->
            <div class="form-title">
              <h2>Contact Us</h2>
            </div>
            <!-- address -->
            <div class="form-row">
              <p><strong><i class="fa fa-map-marker"></i> ADDRESS</strong></p>
              <p><?php the_field('address'); ?></p>
            </div>
            <br>

            <!-- phone -->
            <div class="form-row">
              <p><strong><i class="fa fa-phone"></i> PHONE</strong></p>
              <p><?php the_field('telephone'); ?></p>
            </div>
            <br>

            <!-- email -->
            <div class="form-row">
              <p><strong><i class="fa fa-envelope-o"></i> EMAIL</strong></p>
              <p><?php the_field('email'); ?></p>
            </div>

            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
      </div>
    </div>
    <!-- Write Us a message section Starts
    <div class="col-md-6">
      <div class="iw-heading style1 center-text">
        <h3 class="iwh-title" style="font-size:40px">Write Us a Message</h3>
      </div>
      <div class="in-volunteer-contact mt">
        <?php
          //Get contact form
          //  echo do_shortcode('[contact-form-7 id="1988" title="Contact Us"]');
        ?>
      </div>
    </div>Write Us a message section Ends -->
  </div>
</div>



<style>
  p{
    font-weight: normal;
  }
</style>
<?php
  get_footer();