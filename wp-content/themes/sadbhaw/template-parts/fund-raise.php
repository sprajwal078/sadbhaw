<?php
/*
*Template name: Fund Raise Sadbhaw
*/
get_header();
$cam = generate_query(
    array(
        'post_type' => 'campaign',
        'posts_per_page'	=> -1,
        'orderby'   => 'menu_order',
        'order' => 'ASC')
);
?>
<div class="container funding downloads">
 <div class="wpb_wrapper">
  <div class="vc_row wpb_row vc_inner vc_row-fluid">
   <div class="wpb_column vc_column_container vc_col-sm-12">
    <div class="vc_column-inner vc_custom_1451981561873">
     <div class="wpb_wrapper">
      <div class="iw-heading   style1  center-text">
       <h3 class="iwh-title" style="font-size:40px">Campaigns</h3>
      </div>
     </div>
    </div>
   </div>
  </div>
  <br>
 </div>
 <section class="campaing-listing infunding_style2">
  <?php if( $cam->have_posts() ) :
  while ( $cam->have_posts() ) : $cam->the_post();
  ?>
  <div class="post_item">
   <div class="item-info">
    <div class="row campaing-info">
     <!-- <div class="col-md-4 col-sm-12 col-xs-12">
     </div> -->
     <div class="col-md-12 col-sm-12 col-xs-12 campaign-text row">
      <div class="col-md-4">
        <div class="image">
         <img src="<?php echo the_post_thumbnail_url()?>" alt=""/>
        </div>
      </div>
      <div class="col-md-8">
        <div class="campaign-title">
         <div class="title">
          <h3><a class="theme-color-hover" href="<?php the_permalink()?>"><?php the_title()?></a></h3>
         </div>
         <div class="donate-btn iw-button-effect">
          <div class="donate-btn-effect">
            <button data-id="389" onclick="window.location='<?php echo site_url().'/get-engaged/'?>';"  data-external-link="<?php echo site_url().'/donate/'?>" class="iw-capital donate theme-bg enable"><span data-hover="Donate" class="effect">Join Us</span></button>
          </div>
         </div>
         <div style="clear: both;"></div>
        </div>
        <div class="campaign-des">
          <?php $content = get_the_content(); echo wp_trim_words( $content, 70, '...' );?>
          <a href="<?php the_permalink()?>"> read more</a>
        </div>
      </div>
     </div>
    </div>
   </div>
  </div>
  <?php endwhile;
  else:?>
      No campaign found ! please add campaign.
  <?php endif;?>
 </section>
</div>
<?php
get_footer();?>
