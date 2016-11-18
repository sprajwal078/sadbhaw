<?php
/*
*Template name: Events Sadbhaw
*/
get_header();
?>
<div class="container">
    <div class="page-content">
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <?php if(have_posts()): while (have_posts()):the_post();?>
                    <div class="col-sm-12 col-xs-12 col-lg-9 col-md-8 blog-content single-content">
                        <article id="post-340" class="post-340 post type-post status-publish format-gallery has-post-thumbnail hentry category-blog-listing-page category-bussiness category-charity-events category-mobile-conference tag-charity tag-conference tag-festival tag-kind post_format-post-format-gallery">
                            <div class="post-item fit-video">
                                <div class="featured-image">
                                    <img width="400" height="380" src="<?php the_post_thumbnail_url();?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""/>
                                </div>
                                <div class="post-content">
                                    <div class="post-content-head">
                                        <div class="post-head-detail">
                                            <h3 class="post-title">
                                                <?php the_title();?>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="post-content-desc">
                                        <div class="post-text">
                                            <p><?php the_content()?><span id="more-340"></span></p>
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
