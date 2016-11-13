  <?php
  /*
  *Template name: Stories Sadbhaw
  */
  get_header();
  $stories = generate_query(
      array(
          'post_type' => 'story',
          'posts_per_page'	=> -1,
          'orderby'   => 'menu_order',
          'order' => 'ASC')
  );
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
         <div class="col-md-12 col-sm-12 col-xs-12 row">
          <div class="campaign-info">
           <div class="campaign-text row">
              <div class="col-md-3">
                <div class="image">
                 <?php $image = get_field('image');?>
                 <img src="<?php echo $image['url']?>" alt=""/>
                </div>
              </div>
              <div class="col-md-9">
                <div class="campaign-title">
                 <div class="title">
                  <h3><a class="theme-color-hover" href="<?php the_permalink()?>"><?php the_title()?></a></h3>
                 </div>
                 <div class="donate-btn iw-button-effect">
                  <div class="donate-btn-effect">
                   <button data-id="389" onclick="window.location='<?php echo site_url().'/donate/'?>';"  data-external-link="<?php echo site_url().'/donate/'?>" class="iw-capital donate theme-bg enable"><span data-hover="Donate" class="effect">Donate</span></button>
                  </div>
                 </div>
                 <div style="clear: both;"></div>
                </div>
                <div class="campaign-des">
                  <?php $content = get_the_content(); echo wp_trim_words( $content, 85, '...' );?>
                  <a href="<?php the_permalink()?>"> read more</a>
                </div>
              </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
     <?php endwhile;
    else:?>
     No stories found ! please add stories.
    <?php endif;?>
   </section>
  </div>
  <?php
  get_footer();?>
