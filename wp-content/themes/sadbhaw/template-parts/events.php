<?php
/*
*Template name: Events Sadbhaw
*/
get_header();
$events = generate_query(
    array(
        'post_type' => 'event',
        'posts_per_page'	=> -1,
        'orderby'   => 'menu_order',
        'order' => 'ASC')
  );
?>
<div class="container events">
<section class="campaing-listing infunding_style1">
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
  <br>
 <div class="row">
  <?php if( $events->have_posts() ) :
    while ( $events->have_posts() ) : $events->the_post();
  ?>
  <div class="col-sm-6 col-md-4 col-xs-12 post_item">
   <div class="item-info">
    <div class="image">
     <img src="<?php echo the_post_thumbnail_url();?>" alt=""/>
     <div class="iw-icon-action">
      <div class="icon-detail"><a class="theme-color-hover" href="<?php the_permalink()?>"><i class="fa fa-arrow-right"></i></a></div>
     </div>
    </div>
    <div class="campaign-text">
     <div class="campaign-title">
      <div class="title">
       <h3><a class="theme-color-hover" href="<?php the_permalink()?>"><strong><?php the_title()?></a> </strong></h3>
       <h4><i class="fa fa-calendar-o"></i><span> <?php echo date('Y-m-d',strtotime(get_field('start_date'))); ?></span><span> - </span><span><?php echo date('Y-m-d',strtotime(get_field('end_date'))); ?></span></h4>
      </div>
      <div style="clear: both;"></div>
     </div>
     <div class="campaign-des">
      <?php $content = get_the_content(); echo wp_trim_words( $content, 50, '... ' );?>
      <a class="read-more" href="<?php the_permalink()?>">read more</a>
     </div>
    </div>
   </div>
  </div>
  <?php endwhile;
  else:?>
      No Events Found ! please add events.
  <?php endif;?>
 </div>
</section>
 </div>
<?php
get_footer();?>
