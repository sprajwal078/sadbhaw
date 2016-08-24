<?php

get_header();
if (have_posts()) : while (have_posts()) : the_post();
        if (inFundingGetTemplatePath('infunding/campaign')) {
            include inFundingGetTemplatePath('infunding/campaign');
        } else {
            $inf_theme = INFUNDING_THEME_PATH . 'campaign.php';
            if (file_exists($inf_theme)) {
                include $inf_theme;
            } else {
                echo esc_html__('No theme was found', 'incharity');
            }
        }
    endwhile;
endif;
get_footer();
