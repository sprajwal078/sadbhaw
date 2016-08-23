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
<footer class="page-footer">
    <div class="iw-footer-v2-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <p><?php echo wp_kses_post($inwave_smof_data['footer-copyright']) ?></p>
                </div>
                <div class="col-md-6 col-sm-6 <?php if ($inwave_smof_data['backtotop-button']) echo 'back-to-top-container'; ?>">
                    <?php get_template_part('blocks/menu-footer'); ?>
					<?php if ($inwave_smof_data['backtotop-button']): ?>
						<div class="back-to-top"><a href="#page-top" title="Back to top" class="button-effect3"><i class="fa fa-arrow-up"></i></a></div>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>