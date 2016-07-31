<?php
/**
 * The template for displaying Category pages
 * @package incharity
 */
get_header();
$inwave_cfg = Inwave_Main::getConfig();
?>
<div class="page-content">
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="<?php echo esc_attr(inwave_get_classes('container',$inwave_cfg['sidebar-position']))?> product-content">
                    <?php
                    if ( is_singular( 'product' ) ) {
                        while ( have_posts() ) : the_post();
                            wc_get_template_part( 'content', 'single-product' );
                        endwhile;
                    } else {
                        wc_get_template_part( 'category', 'product' );
                    }
                    ?>
                </div>
                <?php if ($inwave_cfg['sidebar-position']) { ?>
                    <div class="<?php echo esc_attr(inwave_get_classes('sidebar',$inwave_cfg['sidebar-position']))?> product-sidebar">
                        <?php get_sidebar('woocommerce'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
