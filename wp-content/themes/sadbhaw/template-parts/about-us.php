  <?php
  /*
  *Template name: About Sadbhaw
  */
  get_header(); ?>

  <div class="page-heading">
   <div class="container">
    <div class="page-title">
     <div class="iw-heading-title"><h1>About Us</h1></div> </div>
   </div>
  </div>

  <div class="container">
      <div class="vc_row wpb_row vc_row-fluid missions" style="">

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
                                      $args = array('post_type'=>'team',
                                          'showposts'=> -1,
                                          'order' => 'ASC');
                                      $teamQuery = new WP_Query($args);
                                      if( $teamQuery->have_posts() ):
                                      while( $teamQuery->have_posts() ): $teamQuery->the_post();
                                          $teamImage = get_field('member_image');
                                      ?>
                                      <div class="profile-box theme-bg item item0  style5 ">
                                          <div class="profile-image"><img src="<?php echo $teamImage['url']?>" alt="<?php echo $teamImage['alt']?>"></div>
                                          <div class="profile-info theme-bg">
                                              <h3 class="name"><?php the_title();?></h3>
                                              <div class="description"><?php the_content();?></div>
                                          </div>
                                      </div>
                                      <?php endwhile; wp_reset_postdata(); else:
                                      ?>
                                          Please add team member
                                      <?php endif;?>
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
