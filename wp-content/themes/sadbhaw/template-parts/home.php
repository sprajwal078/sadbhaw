  <?php
  /*
  *Template name: Home Sadbhaw
  */
 get_header();
   include(locate_template('template-parts/slider-part.php')); ?>
   <div class="contents-main" id="contents-main">
    <article id="post-725" class="post-725 page type-page status-publish hentry">
     <div class="entry-content">
      <div class="vc_row wpb_row vc_row-fluid theme-bg vc_custom_1454496271895 vc_row-has-fill" style="margin-left:0;margin-right:0;background-size:100% auto">
       <div class="container">
        <div class="row">
         <div class="wpb_column vc_column_container vc_col-sm-2">
          <div class="vc_column-inner ">
           <div class="wpb_wrapper"></div>
          </div>
         </div>
         <div class="wpb_column vc_column_container vc_col-sm-8">
          <div class="vc_column-inner ">
           <div class="wpb_wrapper">
            <div class="iw-heading   style4  center-text">
             <h3 class="iwh-title" style="font-size:40px">Our Goals</h3>
             <div class="iwh-sub-title"><?php the_field('our_goals')?></div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
      <div class="container">
       <div class="row">
        <div class="col-md-6 col-sm-3 footer-left">

         this is for stories section
        </div>
        <div class="col-md-6 col-sm-6 footer-right">
         social feed section
        </div>
       </div>
      </div>
      <div class="vc_row wpb_row vc_row-fluid vc_custom_1451359398429" style="margin-left:0;margin-right:0;background-size:100% auto;">
       <div class="container">
        <div class="row">
         <div class="vc_row wpb_row vc_inner vc_row-fluid">
          <div class="center-text"><h3 class="iwh-title" style="font-size:40px">Our Impact</h3></div>
          <?php if( have_rows('our_impact') ):
          while ( have_rows('our_impact') ) : the_row();$image = get_sub_field('image');?>
          <div class="wpb_column vc_column_container vc_col-sm-4">
           <div class="vc_column-inner ">
            <div class="wpb_wrapper">
             <div class="profile-box item item0  style4  center-text">
              <div class="profile-image"><img src="<?php echo $image['url']?>" alt="sarah stone"></div>
              <div class="item-info-wrap profile-info-wrap">
               <div class="profile-info">
                <h3 class="name"><?php the_sub_field('title')?></h3>
                <div class="position"></div>
                <div class="description"><?php the_sub_field('text')?></div>
               </div>
              </div>
             </div>
            </div>
           </div>
          </div>
          <?php endwhile;endif;?>
         </div>
        </div>
       </div>
      </div>
      <div class="vc_row wpb_row vc_row-fluid vc_custom_1469676508172 vc_row-has-fill" style="background:none!important;position:relative;margin-left:0;margin-right:0;background-size:100% auto">
       <div class="container">
        <div class="row">
         <div class="wpb_column vc_column_container vc_col-sm-12">
          <div class="center-text"><h3 class="iwh-title" style="font-size:40px">Leaders Profile</h3></div>
          <div class="vc_column-inner vc_custom_1451364776558">
           <div class="wpb_wrapper">
            <div class="infunding-listing-page ">
             <section class="campaing-listing infunding_slider-v2">
              <div class="iw-campaign-listing-slider iw-campaign-listing-slider-v2 owl-carousel" data-plugin-options="{&quot;items&quot;:1,&quot;itemsCustom&quot;:false,&quot;itemsDesktop&quot;:[1199,1],&quot;itemsDesktopSmall&quot;:[980,1],&quot;itemsTablet&quot;:[768,1],&quot;itemsTabletSmall&quot;:false,&quot;itemsMobile&quot;:[479,1],&quot;singleItem&quot;:false,&quot;itemsScaleUp&quot;:false,&quot;autoPlay&quot;:false,&quot;stopOnHover&quot;:false,&quot;navigation&quot;:true,&quot;navigationText&quot;:[&quot;&quot;,&quot;&quot;],&quot;rewindNav&quot;:true,&quot;scrollPerPage&quot;:false,&quot;pagination&quot;:false,&quot;paginationNumbers&quot;:false}">
               <?php
               $leaders = generate_query(
                   array(
                       'post_type' => 'leader',
                       'posts_per_page'	=> -1,
                       'orderby'   => 'menu_order',
                       'order' => 'ASC')
               );?>
               <div class="iw-campaign-slider-item">
                <div class="item-info-warp">
                 <div class="row">
                  <?php if( $leaders->have_posts() ) :
                  while ( $leaders->have_posts() ) : $leaders->the_post();
                  ?>
                  <?php if ($leaders->current_post % 3 === 0) : ?>
                  </div>
                  </div>
                  </div>
               <div class="iw-campaign-slider-item">
                <div class="item-info-warp">
                 <div class="row">
                   <?php endif; ?>
                  <div class="col-sm-6 col-md-4 col-xs-12 post_item">
                   <div class="item-info">
                    <div class="image">
                     <img src="<?php echo the_post_thumbnail_url()?>" alt=""/>
                    </div>
                    <div class="campaign-text">
                     <div class="campaign-title">
                      <div class="title">
                       <h3><?php the_title()?></h3>
                      </div>
                     </div>
                     <div class="campaign-des"><?php the_content()?>
                     </div>
                    </div>
                   </div>
                  </div>
                  <?php endwhile; wp_reset_postdata();endif;?>
                 </div>
                </div>
               </div>
              </div>
             </section>
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
      <div class="vc_row wpb_row vc_row-fluid theme-bg vc_custom_1454496271895 vc_row-has-fill" style="margin-left:0;margin-right:0;background-size:100% auto">
       <div class="container">
        <div class="row">
         <div class="wpb_column vc_column_container vc_col-sm-2">
          <div class="vc_column-inner ">
           <div class="wpb_wrapper"></div>
          </div>
         </div>
         <div class="wpb_column vc_column_container vc_col-sm-8">
          <div class="vc_column-inner ">
           <div class="wpb_wrapper">
            <div class="iw-heading   style4  center-text">
             <h3 class="iwh-title" style="font-size:40px">Our Partners</h3>
             <div class="iwh-sub-title">Partner section .. </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </article>
   </div>
   <?php get_footer()?>
