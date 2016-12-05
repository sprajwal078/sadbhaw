<?php
get_header();
?>
<div class="container downloads">
    <!-- Heading Start -->
    <div class="iw-heading   style1  center-text">
        <h3 class="iwh-title" style="font-size:40px"><?php the_title(); ?></h3>
    </div><!-- Heading end -->
    <div class="page-content">
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <?php if(have_posts()): while (have_posts()):the_post();?>
                    <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12 blog-content single-content">
                        <article id="post-340" class="post-340 post type-post status-publish format-gallery has-post-thumbnail hentry category-blog-listing-page category-bussiness category-charity-events category-mobile-conference tag-charity tag-conference tag-festival tag-kind post_format-post-format-gallery">
                            <div class="post-item fit-video">
                                <div class="featured-image">
                                    <img src="<?php echo the_post_thumbnail_url();?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""/>
                                </div>
                                <div class="post-content">
                                    <div class="post-content-desc">
<!--                                         <div class="post-text">
                                            <p><?php the_content()?><span id="more-340"></span></p>
                                        </div> -->
                                        <div class="post-info">
                                            <div class="post-info-date"><i class="fa fa-location-arrow"></i> Venue : <?php the_field('venue') ?></div>
                                            <div class="post-info-date"><i class="fa fa-clock-o"></i> Time Period : <?php the_field('time_period') ?></div>
                                            <div class="post-info-date"><i class="fa fa-user"></i> Contact Person : <?php the_field('contact_person') ?></div>
                                            <div class="post-info-date"><i class="fa fa-phone"></i> Reach Out : <?php the_field('contact_number') ?></div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </article>
                        <div class="post-content-desc">
                            <div class="post-text">
                                <p><?php the_content()?><span id="more-340"></span></p>
                            </div> 
                        </div>
                    </div>
<!--                     <div class="col-sm-12 col-xs-12 col-lg-3 col-md-4">
                        <div id="secondary" class="widget-area" role="complementary">
                            <aside id="categories-2" class="widget widget_categories">
                                <h3 class="widget-title"><span>Details</span></h3>
                                <ul>
                                    <li><b>Venue:</b><?php the_field('venue')?></li>
                                    <li><b>Time Period:</b> <?php the_field('time_period')?></li>
                                    <li><b>Contact Person:</b> <?php the_field('contact_person')?></li>
                                    <li><b>Reach Out:</b> <?php the_field('contact_number')?></li>
                                </ul>
                            </aside>
                        </div>
                    </div> -->
                    <?php endwhile;endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();?>
