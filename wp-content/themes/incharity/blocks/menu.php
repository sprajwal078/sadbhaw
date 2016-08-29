<!--Menu desktop-->
<?php
global $inwave_smof_data, $inwave_cfg;
if ($inwave_smof_data['show_donate_button'] == 'yes') {
    ?>
    <div class="header-donate-button">
        <a href="<?php echo esc_url($inwave_smof_data['donate_button_link']) ?>">
            <span  data-hover="<?php echo esc_attr($inwave_smof_data['donate_button_text']); ?>"><?php echo wp_kses_post($inwave_smof_data['donate_button_text']); ?></span>
        </a>
    </div>
    <?php
}
wp_nav_menu(array(
    "container_class" => "menu-default-menu-container",
    'menu' => $inwave_cfg['theme-menu-id'],
    'theme_location' => $inwave_cfg['theme-menu'],
    "menu_class" => "iw-nav-menu",
    "walker" => new Inwave_InCharity_Walker_Nav_Menu(),
));
?>
