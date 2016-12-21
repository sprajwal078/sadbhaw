<?php
/*
*Template name: Our Partners Sadbhaw
*/
get_header();
?>
<div class="container downloads ">
  <div class="wpb_wrapper partners">
      <div class="vc_row wpb_row vc_inner vc_row-fluid">
          <div class="wpb_column vc_column_container vc_col-sm-12">
              <div class="vc_column-inner vc_custom_1451981561873">
                  <div class="wpb_wrapper">
                      <!-- Heading Start -->
                      <div class="iw-heading   style1  center-text">
                          <h3 class="iwh-title" style="font-size:40px"><?php the_title(); ?></h3>
                          <p class="iwh-content"><?php the_content(); ?> </p>
                      </div><!-- Heading end -->
                      <!--get the category of partners-->
                      <?php
                        $categories = list_terms_by_post_type('partner-cat','our-partner');
                        if(!empty($categories)){
                      ?>
                      <!-- nav tabs -->
                      <div class="col-md-10 col-md-offset-1">
                        <ul class="nav nav-tabs nav-justified mt" role="tablist">
                          <?php
                            //Counter for making the first tab as active
                            $i=1;
                            //Loop through the partner category names
                            foreach ($categories as $cat){
                          ?>
                           <li role="presentation" class="<?php if($i == 2) echo "active" ?>">
                            <a href="#partner<?php echo $i?>" aria-controls="partner<?php echo $i ?>" role="tab" data-toggle="tab">
                              <?php echo $cat->name ?>
                            </a>
                          </li>
                          <?php
                            $i++;
                            }
                          ?>
                        </ul>
                        <!-- Tab panes -->
                        <div class="col-md-12">
                          <div class="tab-content row">
                            <?php
                              $i=1;
                              foreach ($categories as $cat){
                            ?>
                              <div role="tabpanel" class="tab-pane <?php if($i == 2) echo "active" ?>" id="partner<?php echo $i ?>">
                                <?php
                                  //Get partner details
                                  $partners = generate_query(array( 'post_type'       => 'our-partner',
                                                                    'orderby'         => 'menu_order',
                                                                    'order'           => 'ASC',
                                                                    'posts_per_page'  => 3,
                                                                    'tax_query'       => array(
                                                                          array(
                                                                            'taxonomy' => 'partner-cat',
                                                                            'field' => 'id',
                                                                            'terms' => $cat->term_id
                                                                          ),
                                                                        )
                                                                  )
                                                            );
                                  if( $partners->have_posts() ) :
                                    while ( $partners->have_posts() ) : $partners->the_post();
                                      $image = get_field('logo');
                                  ?>
                                      <figure>
                                        <img style="float: left;" src="<?php echo $image['url']?>" alt="<?php echo $image['alt']?>">
                                      </figure>
                                  <?php
                                    endwhile;
                                    wp_reset_postdata();
                                  endif;
                                  $i++;
                                ?>
                              </div>
                            <?php } ?>
                          </div>
                        </div>

                      </div>
                    <?php
                        }else {
                          echo "no partners category found";
                        }
                      ?>
                    <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                        <div class="become-a-partner mt mb">
                        <!-- Become a partner form starts -->
                          <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="post">
                            <input type="hidden" name="action" value="become_a_partner"/>
                            <!-- Form section -->
                            <div class="form-basic clearfix">
                              <div class="col-md-8 col-md-offset-2">
                                <!-- Form Title -->
                                <div class="form-title">
                                  <h2>Become a Partner</h2>
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
                          </form><!-- Become a partner form ends -->
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
