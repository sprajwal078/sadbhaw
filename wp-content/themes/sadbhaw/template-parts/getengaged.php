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
            <div class="row mt mb col-md-10 col-md-offset-1">
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
                        <!-- Form section -->
                        <div class="form-basic clearfix">
                          <div class="col-md-8 col-md-offset-2">
                            <!-- Form Title -->
                            <div class="form-title">
                              <h2>Become a Volunteer</h2>
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

                              <!-- Address -->
                              <div class="form-row">
                                  <label>
                                    <input placeholder="Address" type="text" name="address">
                                    <span>Address</span>
                                  </label>
                              </div>

                              <!-- Email -->
                              <div class="form-row">
                                  <label>
                                    <input placeholder="Your Email" type="email" name="email" required>
                                    <span>Email *</span>
                                  </label>
                              </div>

                              <div class="form-row">
                                <button type="submit">Submit</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                  </div><!-- Become a volunteer tab ends -->
                  <!-- Become an ambassador tab starts -->
                  <div role="tabpanel" class="tab-pane" id="become-ambassador">
                    <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="post">
                      <input type="hidden" name="action" value="become_an_ambassador"/>
                      <!-- Form section -->
                      <div class="form-basic clearfix">
                        <div class="col-md-8 col-md-offset-2">
                          <!-- Form Title -->
                          <div class="form-title">
                            <h2>Become a Sadbhaw Ambassdor</h2>
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

                            <!-- Address -->
                            <div class="form-row">
                                <label>
                                  <input placeholder="Address" type="text" name="address">
                                  <span>Address</span>
                                </label>
                            </div>

                            <!-- Email -->
                            <div class="form-row">
                                <label>
                                  <input placeholder="Your Email" type="email" name="email" required>
                                  <span>Email *</span>
                                </label>
                            </div>

                            <div class="form-row">
                              <button type="submit">Submit</button>
                            </div>
                          </div>
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