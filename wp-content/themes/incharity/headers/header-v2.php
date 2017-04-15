<!--Header version 2-->
<div class="header header-version-2 <?php if(!$inwave_cfg['slide-id']){if($inwave_cfg['show-pageheading'] == '0'){ echo ' no-pageheading'; echo  ' no-slider';}};?> ">
    <div role="navigation" class="navbar navbar-default navbar-bg-light">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 header-top-left">
                        <?php
                        if ($inwave_smof_data['contact_email']) {
                            echo '<span class="email-top"><i class="fa fa-envelope"></i> ' . esc_html($inwave_smof_data['contact_email']) . '</span>';
                        }
                        if ($inwave_smof_data['contact_mobile']) {
                            echo '<span class="mobile-top"><i class="fa fa-phone"></i> ' . esc_html($inwave_smof_data['contact_mobile']) . '</span>';
                        }
                        ?>
                    </div>
                    <div class="col-sm-6 header-top-right">
                        <?php if (isset($inwave_smof_data['header_social_links']) &&  $inwave_smof_data['header_social_links']): ?>
                            <?php get_template_part('blocks/social-links'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="iw-header-v2-menu <?php if($inwave_cfg['header-sticky'] == 1) { echo 'header-sticky' ;} ?>">
            <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-12 col-xs-12 no-padding">
                    <h1 class="logo">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="InCharity">
                            <img src="<?php echo esc_url($inwave_smof_data['logo']); ?>" alt="InCharity">
                            <img class="sticky-logo" src="<?php echo esc_url($inwave_smof_data['logo_sticky']); ?>" alt="InCharity">
                        </a>
                    </h1>
                </div>
                <div class="col-md-10 col-sm-12 col-xs-12">
                    <button data-target=".nav-collapse" class="iw-button-toggle btn-navbar pull-right" type="button">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="iw-menu-default main-menu nav-collapse">
                        <?php get_template_part('blocks/menu'); ?>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </div>			<!-- the menu -->
</div>
<!--End Header-->