<?php
/**
 * The template for displaying pages
 * @package incharity
 */

get_header();
$inwave_cfg = Inwave_Main::getConfig();
?>
<div class="contents-main" id="contents-main">
<div class="container">
    <div class="row">
        <div class="<?php echo esc_attr(inwave_get_classes('container',$inwave_cfg['sidebar-position']))?>">
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('content', 'page'); ?>
                <?php
                // If comments are open or we have at least one comment, load up the comment template
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            <?php endwhile; // end of the loop. ?>
        </div>
        <?php if ($inwave_cfg['sidebar-position']) { ?>
            <div class="<?php echo esc_attr(inwave_get_classes('sidebar',$inwave_cfg['sidebar-position']))?> default-sidebar">
                <?php get_sidebar($inwave_cfg['sidebar-name']); ?>
            </div>
        <?php } ?>
    </div>
</div>
</div>
<?php get_footer(); ?>
