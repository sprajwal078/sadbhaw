  <?php
  /*
  *Template name: Download Sadbhaw
  */
  get_header();
  $args = array('post_type' => 'download',
              'posts_per_page'  => -1,
              'orderby'   => 'menu_order',
              'order' => 'ASC');
  if (isset($_GET['keyword']) && !empty($_GET['keyword'])){
    $args['s'] = $_GET['keyword'];
  }
  if (isset($_GET['category']) && !empty($_GET['category'])){
    $args['tax_query'] = array(
                          array('taxonomy' => 'download-category',
                                'terms' => $_GET['category']));
  }
  $resource = generate_query($args);
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
                 <input type="text" class="filter-field" placeholder="Enter your keywords" name="keyword" value="<?php if (isset($_GET['keyword'])) echo $_GET['keyword']; ?>"/>
                    <?php
                      $categories = get_terms(array('taxonomy' => 'download-category',
                                                        'hide_empty' => false,
                                                        'fields' => 'id=>name'));
                    ?>
                 <select class="filter-field" name="category">
                  <option value="" selected="selected">All Categories</option>
                    <?php foreach ($categories as $id => $name): ?>
                      <option value="<?php echo $id ?>" <?php if (isset($_GET['category']) && $_GET['category'] == $id) echo "selected"; ?>><?php echo $name ?></option>
                    <?php endforeach; ?>
                 </select>
                 <input type="submit" value="Filter Results" class="filter-field">
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
                     <h3><a target="_blank" href="<?php the_field('download')?>"><?php the_title();?> <i class="fa fa-download" aria-hidden="true"></i></a></h3>
                     <h6>File Type : <?php the_field('type'); ?> | Uploaded Date : <?php echo date('Y-m-d',get_field('date')); ?></h6>
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
                 No downloadable files
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