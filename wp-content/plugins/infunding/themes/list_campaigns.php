<?php
/*
 * @package Inwave Charity
 * @version 1.0.0
 * @created Nov 3, 2015
 * @author Inwavethemes
 * @email inwavethemes@gmail.com
 * @website http://www.inwavethemes.com
 * @support Ticket https://inwave.ticksy.com/
 * @copyright Copyright (c) 2015 Inwavethemes. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

/**
 * Description of list_campaigns
 *
 * @developer duongca
 */
$utility = new inFundingUtility();
$query = $utility->getCampaignsList($category, $ids, $order_by, $order_dir, $limit, false, $page);
?>
<div class="infunding-listing-page <?php echo $class; ?>">
    <?php if ($show_filter_bar): ?>
        <div class="filter-item">
            <div class="filter-form">
                <?php echo $utility->getInfundingFilterForm($category); ?>
            </div>
        </div>
    <?php endif; ?>
    <section class="campaing-listing infunding_<?php echo $style ?>">
        <?php
        if ($query->have_posts()) {
            $path = inFundingGetTemplatePath('infunding/list_campaigns-' . $style);
            if ($path) {
                include $path;
            } else {
                $inf_theme = INFUNDING_THEME_PATH . 'list_campaigns-' . $style . '.php';
                if (file_exists($inf_theme)) {
                    include $inf_theme;
                } else {
                    echo __('No theme was found', 'inwavethemes');
                }
            }
        } else {
            echo __('No campaign found', 'inwavethemes');
        }
        ?>
        <!--        <div style="clear: both;"></div>-->
    </section>
    <?php if ($show_page_list): ?>
        <div class="load-campaigns">
            <?php
            $rs = $utility->infunding_display_pagination($query);
            if ($rs['success']) {
                echo $rs['data'];
            }
            ?>
        </div>
    <?php endif; ?>
</div>

