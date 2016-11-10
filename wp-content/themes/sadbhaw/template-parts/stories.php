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
  <div class="page-heading">
   <div class="container">
    <div class="page-title">
     <div class="iw-heading-title"><h1>Stories</h1></div> </div>
   </div>
  </div>
  <div class="container">
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
      <div class="post_item">
       <div class="item-info">
        <div class="row">
         <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="image">
           <?php $image = get_field('image');?>
           <img src="<?php echo $image['url']?>" alt=""/>
          </div>
         </div>
         <div class="col-md-8 col-sm-12 col-xs-12">
          <div class="campaign-info">
           <div class="campaign-text">
            <div class="campaign-title">
             <div class="title">
              <h3><a class="theme-color-hover" href="<?php the_permalink()?>"><?php the_title()?></a></h3>
             </div>
             <div class="donate-btn iw-button-effect">
              <div class="donate-btn-effect">
               <button data-id="389" data-external-link="" class="iw-capital donate theme-bg enable"><span data-hover="Join Us" class="effect">Join Us</span></button>
              </div>
             </div>
             <div style="clear: both;"></div>
            </div>
            <div class="campaign-des"><?php the_content()?>
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
