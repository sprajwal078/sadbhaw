<?php global $inwave_cfg, $inwave_smof_data;?>
<div class="header header-version-3 theme-bg <?php if($inwave_cfg['header-sticky'] == 1) { echo 'header-sticky' ;} if(!$inwave_cfg['slide-id']){if($inwave_cfg['show-pageheading'] == '0'){ echo ' no-pageheading'; echo  ' no-slider';}}; ?>">
    <!-- the header -->
    <div role="navigation" class="navbar navbar-default navbar-bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-12 col-xs-12 no-padding">
                    <h1 class="logo">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="InCharity">
                            <img class="main-logo" src="<?php echo esc_url($inwave_smof_data['logo']); ?>" alt="InCharity">
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
    </div>			<!-- the menu -->
</div>
<!--End Header-->