  <?php
  /*
  *Template name: Scholarship Sadbhaw
  */
 get_header(); 
  ?>
  <?php $args = array('post_type'=>'general-info',
                              'showposts'=> 3,
                              'order' => 'ASC') ?>

  <?php $generalQuery = new WP_Query($args); 
        if( $generalQuery->have_posts() ):
          while( $generalQuery->have_posts() ): $generalQuery->the_post();
  ?>
  <div class="page-heading">
     
   <div class="container">
    <div class="page-title">
     <div class="iw-heading-title"><h1><?php the_title(); ?></h1>
     </div> 
    </div>
  <?php the_content(); ?>
   </div>
  </div>
<?php endwhile; wp_reset_postdata(); endif;  ?>
<!-- team section start -->
<h2>TEAM MEMBERS</h2>
<?php $args = array('post_type'=>'team',
  'showposts'=> -1,
  'order' => 'ASC') ?>

<?php $teamQuery = new WP_Query($args);
if( $teamQuery->have_posts() ):
  while( $teamQuery->have_posts() ): $teamQuery->the_post(); 
?>

<?php the_title(); ?>
<?php the_content(); ?>
<?php $teamImage = get_field('member_image'); ?>
<img src="<?php echo $teamImage['url'] ?>" alt="<?php echo $teamImage['alt'] ?>">

<?php endwhile; wp_reset_postdata(); endif; ?>
<!-- team section end -->
  <?php get_footer();?>
  