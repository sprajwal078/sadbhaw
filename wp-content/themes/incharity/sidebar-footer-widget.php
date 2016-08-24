<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package inhost
 */
$inwave_cfg = Inwave_Main::getConfig();

if($inwave_cfg['footer-option'] == 'default' || $inwave_cfg['footer-option'] == 'v1') {
    ?>
    <div id="iw-sidebar-four" class="widget-area" role="complementary">
        <?php dynamic_sidebar('sidebar-footer-email'); ?>
    </div><!-- #sidebar footer -->
<?php
    }else
    if($inwave_cfg['footer-option'] == 'v2'){?>
    <div id="iw-sidebar-four" class="widget-area" role="complementary">
        <?php if ( is_active_sidebar( 'sidebar-footer1' ) ): ?>
                <?php dynamic_sidebar('sidebar-footer1'); ?>
                <?php else: ?>
                    <br />
                    <br />
					<?php esc_html_e('This is the footer area. Please add more widgets in Appearance -> Widgets -> Sidebar Footer Default','incharity'); ?>
                <?php endif;?>
    </div><!-- #sidebar footer -->
<?php
    }
?>