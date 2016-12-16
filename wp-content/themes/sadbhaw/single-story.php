<?php
get_header();
?>
<div class="container story-single mb">
    <div class="downloads">
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <?php if(have_posts()): while (have_posts()):the_post();?>
                    <div class="col-sm-12 col-xs-12 col-md-10 col-md-offset-1 blog-content single-content">
                        <article id="post-340" class="post-340 post type-post status-publish format-gallery has-post-thumbnail hentry category-blog-listing-page category-bussiness category-charity-events category-mobile-conference tag-charity tag-conference tag-festival tag-kind post_format-post-format-gallery">
                            <div class="post-item fit-video">
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
                                            <?php $image = get_field('image');?>
                                            <img src="<?php echo $image['url']?>" alt="" class="pull-left"/>
                                            <p class="text-justify"><?php the_content()?><span id="more-340"></span></p>
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
