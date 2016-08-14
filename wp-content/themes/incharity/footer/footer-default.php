<?php
/**
 * Created by PhpStorm.
 * User: TruongDX
 * Date: 11/10/2015
 * Time: 11:44 AM
 */
$inwave_cfg = Inwave_Main::getConfig();
$inwave_smof_data = Inwave_Main::getConfig('smof');
?>
<footer class="page-footer footer-version-1 theme-bg">
<?php if (isset($inwave_smof_data['footer_social_links']) && $inwave_smof_data['footer_social_links']): ?>
        <div class="iw-footer-social">
            <?php get_template_part('blocks/social-links'); ?>
        </div>
    <?php endif; ?>

    <div class="iw-footer-sidebar">
        <?php get_sidebar('footer-widget'); ?>
    </div>

    <div class="iw-footer-logo">
        <a href="<?php echo esc_url(home_url('/')); ?>"><img alt="logo" src="<?php echo esc_url($inwave_smof_data['footer-logo']); ?>"/></a>
    </div>
    <div class="iw-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <p><?php echo wp_kses_post($inwave_smof_data['footer-copyright']) ?></p>
                    <?php if ($inwave_smof_data['backtotop-button']): ?>
                        <div class="back-to-top"><a href="#page-top" title="Back to top" class="button-effect3"><i class="fa fa-arrow-up"></i></a></div>
                            <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>