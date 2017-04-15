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
    <?php
      $location = get_field('location',139);
    ?>
    <div class="contact-map mt row">
      <div class="acf-map">
        <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
      </div>
    </div><!-- Google Maps Section Ends -->
    <div class="row flex-row align-stretch form-basic clearfix mb">
      <div class="col-md-6 row-left">
        <!-- Payment Select Form Starts -->
        <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="post">
          <input type="hidden" name="action" value="contact_us"/>
          <div class="">
              <!-- Form Title -->
              <div class="form-title">
                <h2>Write Us a Message</h2>
              </div>
              <div class="error">
                <?php if (isset($_GET['submit']) && $_GET['submit'] == 'false' && $_GET['form'] == 'contact'): ?>
                  <div class="alert alert-warning">
                    Fields marked * are required.
                  </div>
                <?php endif; ?>
              </div>
              <!-- Form Body -->
              <div class="form-body">
                <!-- Full name -->
                <div class="form-row">
                    <label>
                      <input placeholder="Your Name" type="text" name="full-name" required>
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