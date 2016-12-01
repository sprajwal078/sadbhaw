  <?php
  /*
  *Template name: Contact Sadbhaw
  */
  get_header(); ?>
<div class="container downloads contact mb">
  <div class="wpb_wrapper">
    <div class="vc_row wpb_row vc_inner vc_row-fluid">
      <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner vc_custom_1451981561873">
          <div class="wpb_wrapper">
            <!-- Google Maps Section Start -->
            <div class="col-md-12">
              <div class="iw-heading style1 center-text">
                <h3 class="iwh-title" style="font-size:40px">Our Location</h3>
              </div>
              <div class="contact-map mt">
                <div class="map-contain" data-title="inwavethemes" data-image="http://inwavethemes.com/wordpress/incharity/wp-content/uploads/2015/10/map-maker.png" data-lat="40.6700" data-long="-73.9400" data-zoom="11" data-info="">
                    <div class="map-view map-frame" style="height:610px"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d28253.60137753605!2d85.3406408!3d27.7265422!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb198a307baabf%3A0xb5137c1bf18db1ea!2sKathmandu+44600!5e0!3m2!1sen!2snp!4v1472621645651" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe></div>
                </div>
              </div>
            </div><!-- Google Maps Section Ends -->
            <!-- Write Us a message section Starts -->
            <div class="col-md-6">
              <div class="iw-heading style1 center-text">
                <h3 class="iwh-title" style="font-size:40px">Write Us a Message</h3>
              </div>
              <div class="in-volunteer-contact mt">
                <?php
                  //Get contact form
                  echo do_shortcode('[contact-form-7 id="1988" title="Contact Us"]');
                ?>
              </div>
            </div><!-- Write Us a message section Ends -->
            <!-- Contact Us Section Starts -->
            <div class="col-md-6">
              <div class="iw-heading style1 center-text">
                <h3 class="iwh-title" style="font-size:40px">Contact Us</h3>
              </div>
              <?php
                $args = array('post_type' =>  'page',
                              'p'         =>  139,
                              'showposts' =>1
                            );
                $contactQuery = new WP_Query($args);
                if ( $contactQuery->have_posts() ):
                  while( $contactQuery->have_posts() ): $contactQuery->the_post();
              ?>
              <div class="contact-details text-center mt">
                <div class="details">
                  <i class="fa fa-map-marker theme-color"></i> <?php the_field('address'); ?>
                  <br>
                  <i class="fa fa-envelope-o theme-color"></i><?php the_field('email'); ?>
                  <br>
                  <i class="fa fa-phone theme-color"></i><?php the_field('telephone'); ?>
                </div>

                <?php endwhile; wp_reset_postdata(); endif; ?>
              </div>
            </div><!-- Contact Us Section Ends -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  get_footer();