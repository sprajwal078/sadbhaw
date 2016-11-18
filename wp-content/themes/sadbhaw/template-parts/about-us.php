  <?php
  /*
  *Template name: About Sadbhaw
  */
  get_header(); ?>
  <div class="feature_image" style="background-image: url('<?php the_post_thumbnail_url()?>'); background-size: 100%">
    <img src=""/>
  </div>
  <div class="container about-sadbhaw">
      <div class="wpb_row vc_row-fluid missions col-md-10 col-md-offset-1">

          <?php if(have_posts()): while (have_posts()):the_post();
          the_content();
          endwhile;endif;?>
      </div>
      <div class="vc_row wpb_row vc_row-fluid profile-block vc_custom_1451978423160" style="margin-left:0;margin-right:0;background-size:100% auto">
          <div class="wpb_column vc_column_container vc_col-sm-12">
              <div class="vc_column-inner vc_custom_1451903353304">
                  <div class="wpb_wrapper">
                      <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1451978364117 vc_row-has-fill">
                          <div class="wpb_column vc_column_container vc_col-sm-12">
                              <div class="vc_column-inner vc_custom_1451903364543">
                                  <div class="wpb_wrapper">
                                      <?php
                                      /*$args = array('post_type'=>'team',
                                          'showposts'=> -1,
                                          'order' => 'ASC');
                                      $teamQuery = new WP_Query($args);
                                      if( $teamQuery->have_posts() ):
                                      while( $teamQuery->have_posts() ): $teamQuery->the_post();
                                          $teamImage = get_field('member_image');*/
                                      ?>
                                      <!-- <div class="profile-box theme-bg item item0  style5 ">
                                          <div class="profile-image"><img src="<?php // echo $teamImage['url']?>" alt="<?php // echo $teamImage['alt']?>"></div>
                                          <div class="profile-info theme-bg">
                                              <h3 class="name"><?php // the_title();?></h3>
                                              <div class="description"><?php // the_content();?></div>
                                          </div>
                                      </div> -->
                                      <?php // endwhile; wp_reset_postdata(); else:
                                      ?>
                                          <!-- Please add team member -->
                                      <?php // endif;?>


                                      <div class="vc_row wpb_row vc_row-fluid vc_custom_1469676508172 vc_row-has-fill leaders-profile" style="background:none!important;position:relative;margin-left:0;margin-right:0;background-size:100% auto">
                                          <div class="container team">
                                              <div class="row">
                                                  <div class="wpb_column vc_column_container vc_col-sm-12">
                                                      <div class="center-text"><h3 class="iwh-title" style="font-size:40px">Sadhbaw's Team</h3></div>
                                                      <div class="col-md-10 col-md-offset-1 profile-wrap">
                                                          <div class="row">
                                                              <?php
                                                              $leaders = generate_query(
                                                                  array(
                                                                      'post_type' => 'team',
                                                                      'posts_per_page'  => -1,
                                                                      'orderby'   => 'menu_order',
                                                                      'order' => 'ASC')
                                                              );?>
                                                              <!-- item1 -->
                                                              <?php if( $leaders->have_posts() ) :
                                                                  while ( $leaders->have_posts() ) : $leaders->the_post();
                                                                      ?>
                                                                      <div class="col-md-6 profile-item">
                                                                          <figure>
                                                                              <img src="<?php the_post_thumbnail_url()?>" alt="img">
                                                                          </figure>
                                                                          <div class="detail">
                                                                              <h3>
                                                                                 <?php the_title()?>
                                                                                
                                                                              </h3>
                                                                              <p>
                                                                                  <?php $content = get_the_content(); echo wp_trim_words( $content, 15, '...' );?>
                                                                                  <a href="<?php the_permalink()?>"> read more</a>
                                                                              </p>
                                                                          </div>
                                                                      </div>
                                                                  <?php endwhile;wp_reset_postdata();endif;?>
                                                          </div>
                                                          <p class="text-center" style="font-size: 18px;">
                                                             <!-- Want to be an ambassador ? -->
                                                             <!-- <a href="<?php // echo site_url().'/get-engaged/'?>" class="get-engaged">Get Engaged</a> -->
                                                          </p>

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
  </div>
  <?php
  get_footer();?>
