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
                            <div class="error">
                              <?php if (isset($_GET['submit']) && $_GET['submit'] == 'false'): ?>
                                <div class="alert alert-warning">
                                  Fields marked * are required.
                                </div>
                              <?php elseif (isset($_GET['submit']) && $_GET['submit'] == 'true'): ?>
                                <div class="alert alert-success">
                                  Your details have been sent to the admin.
                                </div>
                              <?php endif; ?>
                            </div>
                            <!-- Form Body -->
                            <div class="form-body">
                              <!-- First name -->
                              <div class="form-row">
                                <label>
                                  <input placeholder="First Name" type="text" name="first-name" required>
                                  <span>First Name *</span>
                                </label>
                              </div>
                              <!-- Last name -->
                              <div class="form-row">
                                <label>
                                  <input placeholder="Last Name" type="text" name="last-name" required>
                                  <span>Last Name *</span>
                                </label>
                              </div>
                              <!-- Email -->
                              <div class="form-row">
                                <label>
                                  <input placeholder="Your Email" type="email" name="email" required>
                                  <span>Email *</span>
                                </label>
                              </div>
                              <!-- Address -->
                              <div class="form-row">
                                <label>
                                  <input placeholder="Address" type="text" name="address">
                                  <span>Address</span>
                                </label>
                              </div>
                              <!-- City/State/Zip -->
                              <div class="form-row">
                                <label>
                                  <input placeholder="City/State/Zip" type="text" name="city">
                                  <span>City/State/Zip</span>
                                </label>
                              </div>
                              <!-- Telephone -->
                              <div class="form-row">
                                <label>
                                  <input placeholder="Telephone" type="text" name="phone">
                                  <span>Telephone</span>
                                </label>
                              </div>
                              <!-- Gender -->
                              <div class="form-row">
                                <label>
                                  Male<input type="radio" name="gender" value="male">
                                  Female<input type="radio" name="gender" value="female">
                                  <span>Gender</span>
                                </label>
                              </div>
                              <!-- Education -->
                              <div class="form-row">
                                <label>
                                  1-5<input type="radio" name="education" value="1-5">
                                  6-9<input type="radio" name="education" value="6-9">
                                  11-12<input type="radio" name="education" value="11-12">
                                  College<input type="radio" name="education" value="College">
                                  Business<input type="radio" name="education" value="Business">
                                  Graduate School<input type="radio" name="education" value="Graduate School">
                                  Technical/Vocational<input type="radio" name="education" value="Graduate School">
                                  <span>Education</span>
                                </label>
                              </div>
                              <!-- Skills -->
                              <div class="form-row">
                                <label>
                                  <span>Skill</span>
                                  <div class="form-element">
                                    1.<input placeholder="Skill Name" type="text" name="skill[0][name]" >
                                    Proficiency:
                                    Skilled<input type="radio" name="skill[0][proficiency]" value="Skilled" >
                                    Can Teach<input type="radio" name="skill[0][proficiency]" value="Can Teach" >
                                    Amateur<input type="radio" name="skill[0][proficiency]" value="Amateur" >
                                  </div>
                                  <div class="form-element">
                                    2.<input placeholder="Skill Name" type="text" name="skill[1][name]" >
                                    Proficiency:
                                    Skilled<input type="radio" name="skill[1][proficiency]" value="Skilled" >
                                    Can Teach<input type="radio" name="skill[1][proficiency]" value="Can Teach" >
                                    Amateur<input type="radio" name="skill[1][proficiency]" value="Amateur" >
                                  </div>
                                  <div class="form-element">
                                    3.<input placeholder="Skill Name" type="text" name="skill[2][name]" >
                                    Proficiency:
                                    Skilled<input type="radio" name="skill[2][proficiency]" value="Skilled" >
                                    Can Teach<input type="radio" name="skill[2][proficiency]" value="Can Teach" >
                                    Amateur<input type="radio" name="skill[2][proficiency]" value="Amateur" >
                                  </div>
                                </label>
                              </div>
                              <!-- Languages -->
                              <div class="form-row">
                                <label>
                                  <span>Languages</span>
                                  <div class="form-element">
                                    1.<input placeholder="Language Name" type="text" name="language[0][name]" >
                                    Proficiency:
                                    Fluent<input type="radio" name="language[0][proficiency]" value="Fluent" >
                                    Read<input type="radio" name="language[0][proficiency]" value="Read" >
                                    Write<input type="radio" name="language[0][proficiency]" value="Write" >
                                  </div>
                                  <div class="form-element">
                                    2.<input placeholder="Language Name" type="text" name="language[1][name]" >
                                    Proficiency:
                                    Fluent<input type="radio" name="language[1][proficiency]" value="Fluent" >
                                    Read<input type="radio" name="language[1][proficiency]" value="Read" >
                                    Write<input type="radio" name="language[1][proficiency]" value="Write" >
                                  </div>
                                </label>
                              </div>
                              <!-- Volunteer Availability -->
                              <div class="form-row">
                                <label>
                                  <span>Volunteer Availability</span>
                                  <div class="form-element">
                                    Number of Days per week
                                    1<input type="radio" name="availability[no_of_days]" value="1">
                                    2<input type="radio" name="availability[no_of_days]" value="2">
                                    3<input type="radio" name="availability[no_of_days]" value="3">
                                    4<input type="radio" name="availability[no_of_days]" value="4">
                                    5<input type="radio" name="availability[no_of_days]" value="5">
                                  </div>
                                  <div class="form-element">
                                    Monday<input type="checkbox" name="availability[days][Monday]">
                                    Tuesday<input type="checkbox" name="availability[days][Tuesday]">
                                    Wednesday<input type="checkbox" name="availability[days][Wednesday]">
                                    Thursday<input type="checkbox" name="availability[days][Thursday]">
                                    Friday<input type="checkbox" name="availability[days][Friday]">
                                    No Preference<input type="checkbox" name="availability[days][No Preference]">
                                  </div>
                                </label>
                              </div>
                              <!-- Transportation -->
                              <div class="form-row">
                                <label>
                                  <span>Transportation(How you will get to your assignment)</span>
                                  Public Trans.<input type="radio" name="transportation" value="Public">
                                  Walk<input type="radio" name="transportation" value="Walk">
                                  Motorcycle<input type="radio" name="transportation" value="Motorcycle">
                                </label>
                              </div>
                              <!-- Emergency -->
                              <div class="form-emergency">
                                <span>In case of emergency, notify</span>
                                <div class="form-row">
                                  <label>
                                    <span>First Name</span>
                                    <input type="text" name="emergency[first_name]" placeholder="First Name">
                                  </label>
                                </div>
                                <div class="form-row">
                                  <label>
                                    <span>Last Name</span>
                                    <input type="text" name="emergency[last_name]" placeholder="Last Name">
                                  </label>
                                </div>
                                <div class="form-row">
                                  <label>
                                    <span>Address</span>
                                    <input type="text" name="emergency[address]" placeholder="Address">
                                  </label>
                                </div>
                                <div class="form-row">
                                  <label>
                                    <span>City</span>
                                    <input type="text" name="emergency[city]" placeholder="City/State/Zip">
                                  </label>
                                </div>
                                <div class="form-row">
                                  <label>
                                    <span>Phone</span>
                                    <input type="text" name="emergency[phone]" placeholder="Telephone">
                                  </label>
                                </div>
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