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
                        <div class="tab-content">
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
                    <?php
                        }else {
                          echo "no partners category found";
                        }
                      ?>
                    <div class="row">
                      <div class="col-md-10 col-md-offset-1">
                        <div class="become-a-partner mt mb">
                        <!-- Become a partner form starts -->
                          <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="post">
                            <input type="hidden" name="action" value="become_a_partner"/>
                            <div class="in-volunteer-contact our-partners">
                              <h3 class="title-contact-form">Become A Partner</h3>
                              <div class="in-contact-field">
                                <label class="label_field">Full Name*</label>
                                <div class="input-field">
                                  <span class="wpcf7-form-control-wrap">
                                  <input class="" placeholder="Full Name" required="required" type="text" value="" name="partner[fullname]"/> </span>
                                </div>
                              </div>
                              <div class="in-contact-field">
                                <label class="label_field">Address*</label>
                                <div class="input-field">
                                  <span class="wpcf7-form-control-wrap">
                                  <input class="" placeholder="Address" required="required" type="text" value="" name="partner[address]"/> </span>
                                </div>
                              </div>
                              <div class="in-contact-field">
                                <label class="label_field">Email*</label>
                                <div class="input-field">
                                  <span class="wpcf7-form-control-wrap">
                                  <input class="" placeholder="Email" required="required" type="email" value="" name="partner[email]"/> </span>
                                </div>
                              </div>
                              <div class="in-contact-field in-submit-field">
                                <div class="in-submit-field-inner"><input type="submit" value="Submit" class="wpcf7-form-control wpcf7-submit"/><i class="fa fa-arrow-right"></i></div>
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
