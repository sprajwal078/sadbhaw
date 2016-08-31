  <?php
  /*
  *Template name: Selection Sadbhaw
  */
 get_header();?>

  <div class="page-heading">
   <div class="container">
    <div class="page-title">
     <div class="iw-heading-title"><h1>Selection Process</h1></div> </div>
   </div>
  </div>
  <div class="container">
    <?php $args = array('post_type'=>'page',
                        'p'=>1826,
                        'showposts'=>1
    ) ?>
    <?php $selectionQuery = new WP_Query($args); ?>
    <?php if( $selectionQuery->have_posts() ):
          while( $selectionQuery->have_posts() ): $selectionQuery->the_post();
     ?>
      <div class="vc_row wpb_row vc_row-fluid missions" style="">
          <div class="wpb_column vc_column_container vc_col-sm-12">
              <div class="vc_column-inner ">
                  <div class="wpb_wrapper">
                      <div class="vc_row wpb_row vc_inner vc_row-fluid">
                          <div class="wpb_column vc_column_container vc_col-sm-12">
                              <div class="vc_column-inner vc_custom_1451981561873">
                                  <div class="wpb_wrapper">
                                      <div class="iw-heading   style1  center-text">
                                          <h3 class="iwh-title" style="font-size:40px"><?php the_title(); ?></h3>
                                          <p class="iwh-content"><?php the_content(); ?> </p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <hr>
               <div class="featured-image">
               <?php $infoImage = get_field('infographic'); ?>
                <img width="870" height="380" src="<?php echo $infoImage['url'] ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="<?php echo $infoImage['alt'] ?>"> </div>
              </div>
          </div>
      </div>
    <?php endwhile; wp_reset_postdata(); endif; ?>
  </div>
  <?php
  get_footer();?>
