<?php
get_header();
?>
<div class="container downloads">
    <!-- Heading Start -->
    <div class="iw-heading   style1  center-text">
        <h3 class="iwh-title" style="font-size:40px"><?php the_title(); ?></h3>
        <p class="iwh-content"><?php the_content(); ?> </p>
    </div><!-- Heading end -->
    <div class="">
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <?php if(have_posts()): while (have_posts()):the_post();?>
                    <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12 blog-content single-content">
                        <article id="post-340" class="post-340 post type-post status-publish format-gallery has-post-thumbnail hentry category-blog-listing-page category-bussiness category-charity-events category-mobile-conference tag-charity tag-conference tag-festival tag-kind post_format-post-format-gallery">
                            <div class="post-item fit-video">
                                <!-- <div class="featured-image">
                                    <img width="100%" height="380" src="<?php echo the_post_thumbnail_url()?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""/>
                                </div> -->
                                <div class="post-content">
                                    <div class="post-content-head">
                                        <div class="post-head-detail" style="margin:0;">
                                            <!-- <h3 class="post-title">
                                                <?php //the_title();?>
                                            </h3> -->
                                            <div class="post-info">
                                                <div class="post-info-date"><i class="fa fa-calendar-o"></i>Date : <span> <?php echo date('Y-m-d',strtotime(get_field('start_date'))); ?></span><span> - </span><span><?php echo date('Y-m-d',strtotime(get_field('end_date'))); ?></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-content-desc">
                                        <div class="post-text">
                                            <p><?php the_content()?><span id="more-340"></span></p>
                                            <hr/>
                                            <div class="wpb_wrapper">
                                                <div class="iw-heading   style1  center-text">
                                                    <h3 class="iwh-title" style="font-size:40px">Photos</h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                            <?php
                                                if( have_rows('gallery') ):
                                                    $i = 0;
                                                    while ( have_rows('gallery') ) : the_row();
                                                        $image = get_sub_field('image');
                                                        $i++;
                                            ?>
                                            <!-- <div id='gallery-1' class='gallery galleryid-340 gallery-columns-1 gallery-size-medium'> -->
                                                            <div class="col-md-4">
                                                                <figure class='gallery-item'>
                                                                    <div class='gallery-icon landscape'>
                                                                        <img src="<?php echo $image['url']?>" class="attachment-medium size-medium" alt="" data-toggle="modal" data-target="#image<?php echo $i ?>"/>
                                                                        <!-- Modal -->
                                                                        <div id="image<?php echo $i ?>" class="modal fade" role="dialog">
                                                                          <div class="modal-dialog modal-lg">
                                                                            <!-- Modal content-->
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                              </div>
                                                                              <div class="modal-body">
                                                                                <div class="media">
                                                                                  <img src="<?php echo $image['url']?>" >
                                                                              </div>
                                                                              <div class="modal-footer">
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div><!-- Modal Ends -->
                                                                    </div>
                                                                </figure>
                                                            </div>
                                            <?php
                                                    endwhile;
                                                else:
                                            ?>
                                                    <div class="col-md-12">No gallery added</div>
                                            <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <?php endwhile;endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();?>
