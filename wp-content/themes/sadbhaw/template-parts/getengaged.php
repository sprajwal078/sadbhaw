<?php
/*
*Template name: Get Engaged Sadbhaw
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
            <div class="row mt">
              <div class="col-md-3">
                <!-- Nav Pills -->
                <ul class="nav nav-pills nav-stacked" role="tablist">
                  <li role="presentation" class="active">
                    <a href="#become-volunteer" aria-controls="become-volunteer" role="tab" data-toggle="tab">Become a Volunteer</a>
                  </li>
                  <li role="presentation">
                    <a href="#become-ambassador" aria-controls="become-ambassador" role="tab" data-toggle="tab">Become an Ambassador</a>
                  </li>
                </ul>
              </div>
              <div class="col-md-9">
                <div class="tab-content">
                  <!-- Become a volunteer tab starts -->
                  <div role="tabpanel" class="tab-pane active" id="become-volunteer">
                      <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="post">
                        <input type="hidden" name="action" value="become_a_volunteer"/>
                        <div class="in-volunteer-contact two-column-form">
                          <h3 class="title-contact-form">Become a Volunteer</h3>
                          <div class="in-contact-field">
                            <label class="label_field">Full Name*</label>
                            <div class="input-field">
                              <span class="wpcf7-form-control-wrap">
                              <input class="" placeholder="Full Name" required="required" type="text" value="" name="volunteer[fullname]"/> </span>
                            </div>
                          </div>
                          <div class="in-contact-field">
                            <label class="label_field">Address*</label>
                            <div class="input-field">
                              <span class="wpcf7-form-control-wrap">
                              <input class="" placeholder="Address" required="required" type="text" value="" name="volunteer[address]"/> </span>
                            </div>
                          </div>
                          <div class="in-contact-field">
                            <label class="label_field">Email*</label>
                            <div class="input-field">
                              <span class="wpcf7-form-control-wrap">
                              <input class="" placeholder="Email" required="required" type="email" value="" name="volunteer[email]"/> </span>
                            </div>
                          </div>
                          <div class="in-contact-field in-submit-field">
                            <div class="in-submit-field-inner"><input type="submit" value="Submit" class="wpcf7-form-control wpcf7-submit"/></div>
                          </div>
                        </div>
                      </form>
                  </div><!-- Become a volunteer tab ends -->
                  <!-- Become an ambassador tab starts -->
                  <div role="tabpanel" class="tab-pane" id="become-ambassador">
                    <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="post">
                      <input type="hidden" name="action" value="become_an_ambassador"/>
                      <div class="in-volunteer-contact two-column-form">
                        <h3 class="title-contact-form">Become a Sadbhaw Ambassador</h3>
                        <div class="in-contact-field">
                          <label class="label_field">Full Name*</label>
                          <div class="input-field">
                            <span class="wpcf7-form-control-wrap">
                            <input class="" placeholder="Full Name" required="required" type="text" value="" name="ambassador[fullname]"/> </span>
                          </div>
                        </div>
                        <div class="in-contact-field">
                          <label class="label_field">Address*</label>
                          <div class="input-field">
                            <span class="wpcf7-form-control-wrap">
                            <input class="" placeholder="Address" required="required" type="text" value="" name="ambassador[address]"/> </span>
                          </div>
                        </div>
                        <div class="in-contact-field">
                          <label class="label_field">Email*</label>
                          <div class="input-field">
                            <span class="wpcf7-form-control-wrap">
                            <input class="" placeholder="Email" required="required" type="email" value="" name="ambassador[email]"/> </span>
                          </div>
                        </div>
                        <div class="in-contact-field in-submit-field">
                          <div class="in-submit-field-inner"><input type="submit" value="Submit" class="wpcf7-form-control wpcf7-submit"/></div>
                        </div>
                      </div>
                    </form>
                  </div><!-- Become an ambassador tab ends -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer();