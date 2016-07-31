<?php
/**
 * @package incharity
 */
$inwave_smof_data = Inwave_Main::getConfig('smof');
$authordata = Inwave_Main::getAuthorData();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-item fit-video">
        <div class="featured-image">
            <?php
            $post_format = get_post_format();
            $contents = get_the_content();
            $str_regux = '';
            switch ($post_format) {
                case 'video':
                    $video = inwave_getElementsByTag('embed', $contents);
                    $str_regux = $video[0];
                    if ($video) {
                        echo apply_filters('the_content', $video[0]);
                    }
                    break;

                default:
                    if ($inwave_smof_data['featured_images_single']) {
                        the_post_thumbnail();
                    }
                    break;
            }
            ?>
        </div>
        <div class="post-content">


            <div class="post-content-head">

                <div class="post-icon theme-bg">
                    <i class="fa fa-image"></i>
                </div>
                <div class="post-head-detail">
                    <?php
                    if (is_sticky()) {
                        echo '<span class="feature-post">' . esc_html__('Feature', 'inwavathemes') . '</span>';
                    }
                    ?>
                    <?php if ($inwave_smof_data['blog_post_title']): ?>
                        <h3 class="post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title('', ''); ?></a>
                        </h3>
                    <?php endif; ?>
                    <div class="post-info">
                        <div class="post-info-date"><i class="fa fa-calendar-o"></i><?php echo get_the_date(); ?></div>
                        <?php if (comments_open()): ?>
                            <div class="post-info-comment"><i class="fa fa-comments"></i>
                                <?php
                                echo '<span class="comments-link">';
                                comments_popup_link(esc_html__('Leave a comment', 'incharity'), esc_html__('1 Comment', 'incharity'), esc_html__('% Comments', 'incharity'));
                                echo '</span>';
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($inwave_smof_data['blog_category_title'] && has_category()): ?>
                            <div class="post-info-category"><i class="fa fa-folder"></i><?php the_category(', ') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="post-content-desc">
                <div class="post-text">
                    <?php echo apply_filters('the_content', str_replace($str_regux, '', get_the_content())); ?>
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'incharity'),
                        'after' => '</div>',
                    ));
                    ?>
                </div>
            </div>

            <div class="clear"></div>
        </div>
        <?php if ($inwave_smof_data['social_sharing_box']): ?>
            <div class="share single-post-share">
                <span class="share-title"><?php echo esc_html__('Share This Post', 'incharity'); ?></span>
                <div class="social-icon">
                    <?php
                    inwave_social_sharing(get_permalink(), Inwave_Helper::substrword(get_the_excerpt(), 10), get_the_title());
                    ?>
                </div>
                <div class="clear"></div>
            </div>
        <?php endif; ?>


        <?php if ($inwave_smof_data['entry_footer']): ?>
            <footer class="entry-footer">
                <?php inwave_entry_footer(); ?>
            </footer>
        <?php endif ?>
        <!-- .entry-footer -->

        <?php if ($inwave_smof_data['author_info']): ?>
            <div class="blog-author">
                <div class="authorAvt theme-bg">
                    <div class="authorAvt-inner">
                        <?php echo get_avatar(get_the_author_meta('email'), 90) ?>
                    </div>
                </div>
                <div class="authorDetails">
                    <div class="author-title">
                        <a class="theme-color" href="<?php echo esc_url(get_author_posts_url($authordata->ID, $authordata->user_nicename)); ?>"><?php echo esc_html($authordata->display_name); ?></a>
                    </div>
                    <?php if (get_the_author_meta('description')) { ?>
                        <div class="caption-desc">
                            <?php echo get_the_author_meta('description'); ?>
                        </div>
                    <?php } ?>

                </div>
                <div class="clear"></div>
            </div>
        <?php endif ?>


        <?php if ($inwave_smof_data['related_posts']): ?>
            <div class="related-post">
                <?php get_template_part('blocks/related', 'posts'); ?>
            </div>
        <?php endif ?>
    </div>
</article><!-- #post-## -->