<?php
/*
*Template name: Stories Sadbhaw
*/
get_header();
//Get page number for pagination
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
//Get all stories limiting 5 in one page
$stories = generate_query(array('post_type'      => 'story',
                                'posts_per_page' => 5,
                                'paged'          => $paged));
?>
<div class="container stories-list">
 <div class="wpb_wrapper">
  <div class="vc_row wpb_row vc_inner vc_row-fluid">
   <div class="wpb_column vc_column_container vc_col-sm-12">
    <div class="vc_column-inner vc_custom_1451981561873">
     <div class="wpb_wrapper">
      <div class="iw-heading   style1  center-text">
       <h3 class="iwh-title" style="font-size:40px">Stories</h3>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
 <section class="campaing-listing infunding_style2">
  <?php if( $stories->have_posts() ) :
     while ( $stories->have_posts() ) : $stories->the_post();
      ?>
    <div class="post_item col-md-10 col-md-offset-1">
     <div class="item-info">
      <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12 ">
        <div class="campaign-info">
         <div class="campaign-text">
            <div class="col-md-1 story-type-container">
              <div class="story-type">Beneficiary</div>
            </div>
            <div class="col-md-8">
              <div class="campaign-title">
               <div class="title" style="width: auto;">
                <h3><a class="theme-color-hover" href="<?php the_permalink()?>"><?php the_title()?></a></h3>
               </div>
               <div class="donate-btn iw-button-effect">
                <div class="donate-btn-effect pull-right">
                 <button data-id="389" onclick="window.location='<?php echo site_url().'/donate/'?>';"  data-external-link="<?php echo site_url().'/donate/'?>" class="iw-capital donate theme-bg enable"><span data-hover="Donate" class="effect">Donate</span></button>
                </div>
               </div>
               <div style="clear: both;"></div>
              </div>
              <div class="campaign-des">
                <?php $content = get_the_content(); echo wp_trim_words( $content, 70, '... ' );?>

                <a class="read-more" href="<?php the_permalink()?>"> read more</a>
              </div>
            </div>

            <div class="col-md-3">
              <div class="image">
               <?php $image = get_field('image');?>
               <img src="<?php echo $image['url']?>" alt=""/>
              </div>
            </div>

         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
  <?php endwhile; ?>
    <div class="col-md-10 col-md-offset-1">
      <!-- Pagination. -->
      <div class="btn btn-default nav-previous alignright"><?php next_posts_link( 'Next', $stories->max_num_pages ); ?></div>
      <div class="btn btn-default nav-next alignleft"><?php previous_posts_link( 'Previous' ); ?></div>
    </div>
  <?php else: ?>
   No stories found ! please add stories.
  <?php endif;?>
 </section>
</div>
<script type="text/javascript">
  $(document).ready(function() {
      var h = $('.item-info').height();
      $('.story-type-container').height(h);
  });
</script>
<?php
get_footer();?>
