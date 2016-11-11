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
  <div class="page-heading">
   <div class="container">
    <div class="page-title">
     <div class="iw-heading-title"><h1>Events</h1></div> </div>
   </div>
  </div>
  <div class="container">
  <section class="campaing-listing infunding_style1">
   <div class="row">
    <?php if( $events->have_posts() ) :
      while ( $events->have_posts() ) : $events->the_post();
    ?>
    <div class="col-sm-6 col-md-4 col-xs-12 post_item events">
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
         <h3><a class="theme-color-hover" href="<?php the_permalink()?>"><?php the_title()?></a></h3>
        </div>
        <div style="clear: both;"></div>
       </div>
       <div class="campaign-des"><?php the_content()?>
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
