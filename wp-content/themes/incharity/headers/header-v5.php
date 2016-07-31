<!--Header version 5-->
<?php global $inwave_cfg, $inwave_smof_data;?>
<?php
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if(!isset($cartUrl)){
        $cartUrl = '';
    }
    if(function_exists('WC')) {
        $cartUrl = WC()->cart->get_cart_url();
    }
?>

<div class="header header-version-2 header-version-5 <?php  if(!$inwave_cfg['slide-id']){if($inwave_cfg['show-pageheading'] == '0'){ echo ' no-pageheading'; echo  ' no-slider';}}; ?>">
    <div role="navigation" class="navbar navbar-default navbar-bg-light">
        <div class="container">
            <div class="header-top">
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
                        <?php if($inwave_cfg['show_search_form']):  ?>
                            <form class="form-search-header" method="get" action="<?php echo esc_url( home_url( '/' ) )?>">
                                <div class="search-box theme-bg">
                                    <input class='input-text theme-bg' type="search" title="<?php echo esc_attr_x( 'Search:', 'label','incharity' ) ?>" value="<?php echo get_search_query() ?>" name="s" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder','incharity' );?>" class="top-search">
                                    <input type="image" alt="Submit" src="<?php echo esc_url(get_template_directory_uri())?>/images/search.png" class="sub-search">
                                </div>
                            </form>
                        <?php endif; ?>
                        <?php if($inwave_cfg['show-quick-access']):  ?>
                            <div class="header-cart-count">
                                <?php if($inwave_smof_data['woocommerce_cart_top_nav'] && $cartUrl):  ?>
                                    <a href="<?php echo esc_url($cartUrl); ?>" class="cart-icon">
                                        <span class="inner-icon"><i class="fa fa-shopping-cart"></i></span>
                                    </a>
                                <?php endif ?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($inwave_smof_data['header_social_links']) &&  $inwave_smof_data['header_social_links']): ?>
                            <?php get_template_part('blocks/social-links'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="iw-header-v2-menu header-version-5-menu theme-bg <?php if($inwave_cfg['header-sticky'] == 1) { echo 'header-sticky' ;} ?> ">
                <?php if($inwave_cfg['header-sticky'] == 1) { echo '<div class="header-version-5-container-clone">' ;} ?>
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
                            <?php get_template_part('/blocks/menu'); ?>
                        </div>
                    </div>
                </div>
                <?php if($inwave_cfg['header-sticky'] == 1) { echo '</div>' ;} ?>
            </div>
        </div>
    </div><!-- the menu -->
</div>

<!--End Header-->