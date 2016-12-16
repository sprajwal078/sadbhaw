<?php
/*
*Template name: Home Sadbhaw
*/
get_header();
 include(locate_template('template-parts/slider-part.php')); ?>
 <div class="contents-main home-content" id="contents-main">
  <article id="post-725" class="post-725 page type-page status-publish hentry">
   <div class="entry-content">
    <div class="vc_row wpb_row vc_row-fluid theme-bg vc_custom_1454496271895 vc_row-has-fill our-goals" style="margin-left:0;margin-right:0;background-size:100% auto">
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
           <h3 class="iwh-title" style="font-size:40px">Our Goal</h3>
           <div class="iwh-sub-title"><?php the_field('our_goals')?></div>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
    <!--get the stories post 2 for now -->
    <?php $stories = generate_query(
        array(
            'post_type' => 'story',
            'posts_per_page'	=> -1,
            'orderby'   => 'menu_order',
            'order' => 'ASC')
    );?>
    <div class="container ">
     <div class="row">
      <div class="col-md-6 col-sm-3 footer-left stories">
        <div class="center-text">
          <h3 class="iwh-title" style="font-size:40px">Stories</h3>
        </div>
        <div class="slide-wrap row">
            <div class ="slide-item">
           <?php if( $stories->have_posts() ) :
           while ( $stories->have_posts() ) : $stories->the_post();
            $image = get_field('image');
           if($stories->current_post % 3 == 0 && $stories->current_post != 0){?>
               </div>
            <div class ="slide-item" style="display: none">
           <?php }
           ?>
            <div class="">
              <div class="media">
                <div class="media-body">
                  <h3 class="media-heading"><?php the_title()?></h3>
                  <?php $content = get_the_content(); echo wp_trim_words( $content, 25, '... ' );?>
                    <a class="read-more" href="<?php the_permalink()?>">read more</a>
                </div>
                <div class="media-right hidden">
                  <a href="#">
                    <img alt="64x64" class="media-object" data-src="holder.js/64x64" src="<?php echo $image['url']?>" data-holder-rendered="true" width="100%">
                  </a>
                </div>
              </div>
            </div>
            <?php endwhile;wp_reset_postdata();endif;?>
            </div>
        </div>

      </div>
      <div class="col-md-6 col-sm-6 footer-right social-tabs">
        <div class="center-text">
          <h3 class="iwh-title" style="font-size:40px">Social Feeds</h3>
        </div>
        <!-- nav tabs -->
          <ul class="nav nav-tabs nav-justified" role="tablist">
            <li role="presentation" class="active">
              <a href="#youtube" aria-controls="youtube" role="tab" data-toggle="tab">
                <i class="fa fa-youtube"></i>
              </a>
            </li>
            <li role="presentation">
              <a href="#facebook" aria-controls="facebook" role="tab" data-toggle="tab">
                <i class="fa fa-facebook-official"></i>
              </a>
            </li>
            <li role="presentation">
              <a href="#twitter" aria-controls="twitter" role="tab" data-toggle="tab">
                <i class="fa fa-twitter"></i>
              </a>
            </li>
          </ul>

        <!-- Tab panes -->
          <div class="col-md-12">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="youtube"><?php the_field('youtube')?></div>
              <div role="tabpanel" class="tab-pane" id="facebook"><div class="fb-post" data-href="https://www.facebook.com/20531316728/posts/10154009990506729/" data-width="500" data-show-text="true"><blockquote cite="https://www.facebook.com/20531316728/posts/10154009990506729/" class="fb-xfbml-parse-ignore">Posted by <a href="https://www.facebook.com/facebook/">Facebook</a> on&nbsp;<a href="https://www.facebook.com/20531316728/posts/10154009990506729/">Thursday, August 27, 2015</a></blockquote></div>
                  <script>(function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=1519539795026213";
                          fjs.parentNode.insertBefore(js, fjs);
                      }(document, 'script', 'facebook-jssdk'));</script></div>
              <div role="tabpanel" class="tab-pane" id="twitter"><blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr">New on Amazon Alexa! Use the Twitter Reader skill to hear trends, top Tweets, notifications &amp; more! Just <a href="https://twitter.com/hashtag/AskAlexa?src=hash">#AskAlexa</a>. <a href="https://t.co/BvXRS4NiQu">pic.twitter.com/BvXRS4NiQu</a></p>&mdash; Twitter (@twitter) <a href="https://twitter.com/twitter/status/774276250407886848">September 9, 2016</a></blockquote>
                  <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script></div>
            </div>
          </div>

      </div>
     </div>
    </div>
    <div class="vc_row wpb_row vc_row-fluid vc_custom_1451359398429 our-impacts" style="margin-left:0;margin-right:0;background-size:100% auto;">
     <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
         <div class="vc_row wpb_row vc_inner vc_row-fluid">
            <div class="center-text"><h3 class="iwh-title" style="font-size:40px">Our Impact</h3></div>
            <?php if( have_rows('our_impact') ):
            while ( have_rows('our_impact') ) : the_row();$image = get_sub_field('image');?>
            <div class="wpb_column vc_column_container vc_col-sm-3">
             <div class="vc_column-inner ">
              <div class="wpb_wrapper">
               <div class="profile-box item item0  style4  center-text">
                <div class="profile-image"><img src="<?php echo $image['url']?>" alt="sarah stone"></div>
                <div class="item-info-wrap profile-info-wrap">
                 <div class="profile-info">
                  <h3 class="name Count"><?php the_sub_field('title')?></h3>
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
    </div>

       <div class="vc_row wpb_row vc_row-fluid vc_custom_1469676508172 vc_row-has-fill leaders-profile" style="background:none!important;position:relative;margin-left:0;margin-right:0;background-size:100% auto">
           <div class="container">
               <div class="row">
                   <div class="wpb_column vc_column_container vc_col-sm-12">
                       <div class="center-text"><h3 class="iwh-title" style="font-size:40px">Sadbhaw Ambassadors</h3></div>
                       <div class="col-md-10 col-md-offset-1 profile-wrap">
                           <div class="row">
                               <?php
                               $leaders = generate_query(
                                   array(
                                       'post_type' => 'leader',
                                       'posts_per_page'	=> -1,
                                       'orderby'   => 'menu_order',
                                       'order' => 'ASC')
                               );?>
                               <!-- item1 -->
                               <?php if( $leaders->have_posts() ) :
                                   while ( $leaders->have_posts() ) : $leaders->the_post();
                                       the_sub_field('location');
                                       ?>
                                       <div class="col-md-6 profile-item">
                                           <figure>
                                               <img src="<?php the_post_thumbnail_url()?>" alt="img">
                                           </figure>
                                           <div class="detail">
                                               <h3>
                                                  <?php the_title(); ?>
                                                  <small>Location: <?php the_field('location');?></small>
                                               </h3>
                                               <p>
                                                   <?php $content = get_the_content(); echo wp_trim_words( $content, 35, '...' );?>
                                                   <!-- Trigger the leader detail modal with read more link -->
                                                   <a href="#" class="leader-readmore read-more" data-toggle="modal" data-target="#leader<?php the_ID(); ?>"> read more</a>
                                                   <!-- Modal -->
                                                    <div id="leader<?php the_ID(); ?>" class="modal fade" role="dialog">
                                                      <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">
                                                              <strong><?php the_title() ?></strong>
                                                              <br>
                                                              <small>Location: <?php the_field('location');?></small>
                                                            </h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            <img align="top" src="<?php the_post_thumbnail_url()?>" alt="img" class="media-object">
                                                            <p><?php echo $content; ?></p>
                                                            <div class="clearfix"></div>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div><!-- Modal Ends -->
                                               </p>
                                           </div>
                                       </div>
                                   <?php endwhile;wp_reset_postdata();endif;?>
                           </div>
                           <p class="text-center be-ambassador">
                              <span>Want to be an Ambassador ?</span>
                              <a href="<?php echo site_url().'/get-engaged/'?>" class="get-engaged">Get Engaged</a>
                           </p>

                       </div>
                   </div>
               </div>
           </div>
       </div>

    <!-- leaders profile -->
       <div class="vc_row wpb_row vc_row-fluid vc_custom_1451359398429" style="margin-left:0;margin-right:0;background-size:100% auto;">
           <div class="vc_row wpb_row vc_inner vc_row-fluid">
               <?php  $home_donate = generate_query(array( 'post_type' => 'general-info','meta_query'	=> array(
                   array(
                       'key'		=> 'info_for',
                       'value'		=> 'homedonate',
                       'compare'	=> '='
                   )
               ),'numberposts'	=> 1, ));?>
               <?php if( $home_donate->have_posts() ) :
                   while ( $home_donate->have_posts() ) : $home_donate->the_post();?>
                       <a href="#"><img class="fill" src="<?php echo the_post_thumbnail_url();?>"/></a>
                   <?php endwhile;wp_reset_postdata();endif;?>
           </div>
       </div>

       <!-- an initiation -->
       <div class="container mb">
           <div class="row">
                <br>
               <div class="col-md-10 col-md-offset-1 text-center">
                <h4>Sadhbaw is an initiation of Himalayan Climate. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem architecto debitis sapiente alias adipisci doloremque, magnam nihil accusamus cum suscipit, placeat optio tempore, laborum sit ab esse. Magnam, necessitatibus, accusantium.</h4>
                <br>
                <a href="http://himalayanclimate.org/" targer="_blank">
                  <img src="wp-content/themes/sadbhaw/images/logos/logo_small.png" alt="HCI">
                </a>
               </div>
           </div>
       </div>
   </div>
  </article>
 </div>
<?php get_footer()?>
