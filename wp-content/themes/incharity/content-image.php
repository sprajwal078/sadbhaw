<?php
/**
 * The default template for displaying content video
 * @package incharity
 */
$inwave_smof_data = Inwave_Main::getConfig('smof');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-item">
        <div class="featured-image">
            <?php  the_post_thumbnail(); ?>
        </div>
        <div class="post-content">
            <div class="post-content-head">
				
                <div class="post-icon theme-bg">
                    <i class="fa fa-image"></i>
				</div>
				<div class="post-head-detail">
					<?php if (is_sticky()){echo '<span class="feature-post">'.esc_html__('Feature', 'inwavathemes').'</span>';} ?>
					<h3 class="post-title">
						<a href="<?php the_permalink(); ?>"><?php the_title('', ''); ?></a>
					</h3>
					<div class="post-info">
						<div class="post-info-date"><i class="fa fa-calendar-o"></i> <?php echo get_the_date(); ?></div>
						<?php
						if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
							echo '<div class="post-info-comment"><i class="fa fa-comments"></i><span class="comments-link">';
							comments_popup_link(esc_html__('Leave a comment', 'incharity'), esc_html__('1 Comment', 'incharity'), esc_html__('% Comments', 'incharity'));
							echo '</span></div>';
						}
						?>
						<?php if($inwave_smof_data['blog_category_title_listing']): ?>
							<div class="post-info-category"><i class="fa fa-folder"></i><?php the_category(', ') ?></div>
						<?php endif; ?>
					</div>
                </div>
				<div class="clear"></div>
            </div>
            <div class="post-content-desc">
				
                <div class="post-text fit-video">
                    <?php /* translators: %s: Name of current post */
                    the_excerpt();
                    wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'incharity') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>'));
                    ?>
                </div>
                <div class="clear"></div>
                <?php if ($inwave_smof_data['entry_footer_category']): ?>
                    <?php inwave_entry_footer(); ?>
                <?php endif ?>
            </div>
			<div class="post-content-footer">
				<?php echo '<a class="more-link" href="' . get_the_permalink() . '#more-' . get_the_ID() . '"> <i class="fa fa-arrow-circle-right"></i>' . esc_html__('Read more', 'incharity') . '</a>'; ?>
				<?php if($inwave_smof_data['social_sharing_box_category']): ?>
                    <div class="post-share-buttons">
						<span class="post-share-text"><?php echo esc_html__('Share this', 'inwavathemes') ?></span>
                        <?php
							inwave_social_sharing(get_permalink(), Inwave_Helper::substrword(get_the_excerpt(), 10), get_the_title());
                        ?>
                    </div>
                <?php endif; ?>
			<div class="clear"></div>
			</div>
			
			
        </div>
    </div>
</article><!-- #post-## -->