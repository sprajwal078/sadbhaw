  <?php
  /*
  *Template name: Download Sadbhaw
  */
 get_header();
  $resource = generate_query(
      array(
          'post_type' => 'resource',
          'posts_per_page'	=> -1,
          'orderby'   => 'menu_order',
          'order' => 'ASC')
  );
  ?>
  <!-- <div class="page-heading">
   <div class="container">
    <div class="page-title">
     <div class="iw-heading-title"><h1>Downloads</h1></div> </div>
   </div>
  </div> -->
  <div class="container downloads">
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
   <div class="contents-main" id="contents-main">
    <div class="container">
     <div class="row">
      <div class="col-sm-12 col-xs-12">
       <article id="post-1438" class="post-1438 page type-page status-publish hentry">
        <div class="entry-content">
         <div class="vc_row wpb_row vc_row-fluid" style="margin-left:0;margin-right:0;background-size:100% auto">
          <div class="wpb_column vc_column_container vc_col-sm-12">
           <div class="vc_column-inner ">
            <div class="wpb_wrapper">
             <div class="infunding-listing-page ">
              <div class="filter-item">
               <div class="filter-form">
                <form id="filterForm" name="filterForm" action="#" method="get">
                 <input type="text" class="filter-field" placeholder="Enter your keywords" name="keyword" value=""/>
                 <select class="filter-field" name="category">
                  <option value="" selected="selected">All Categories</option>
                  <option value="40">Demo category</option>
                 </select>
                </form>
               </div>
               <div style="clear: both"></div>
              </div>
              <section class="campaing-listing infunding_style1">
               <div class="row">
                <?php if( $resource->have_posts() ) :
                while ( $resource->have_posts() ) : $resource->the_post();
                ?>
                <div class="col-sm-6 col-md-4 col-xs-12 post_item">
                 <div class="item-info">
                  <div class="image">
                   <img src="<?php the_field('image');?>" alt=""/>
                   <div class="control-overlay">
                   </div>
                  </div>
                  <div class="campaign-text">
                   <div class="campaign-title">
                    <div class="title">
                     <h3><a target="_blank" href="<?php the_field('download')?>"><?php the_title();?></a></h3>
                    </div>
                    <div style="clear: both;"></div>
                   </div>
                     <!-- <div class="campaign-des"><?php // the_content();?>
                     </div> -->
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
            </div>
           </div>
          </div>
         </div>
        </div>
       </article>
      </div>
     </div>
    </div>
   </div>
  </div>
<?php
get_footer();