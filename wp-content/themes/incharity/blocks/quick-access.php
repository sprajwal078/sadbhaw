<?php
/**
* The template part for displaying quick access block. Including cart & search widgets
* @package incharity
*/
global $inwave_smof_data, $inwave_cfg;
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$loginUrl = wp_login_url( get_permalink());
$cartUrl = '';
$loginIcon = 'fa fa-unlock';
$redirectLink = '';

$redirectLink = get_permalink();

if(is_user_logged_in()){
    $loginIcon = 'fa fa-user';
    if(get_option('woocommerce_myaccount_page_id') && function_exists('WC')){
        $loginUrl = get_the_permalink(get_option('woocommerce_myaccount_page_id'));
    }else{
        $loginUrl = get_edit_user_link();
    }

}
$resetPass = '';
$createAccount = '';
if(is_plugin_active('whmcs-bridge-sso/sso.php') && get_option('cc_whmcs_bridge_sso_singlesignon') =='checked'){
    $loginUrl = $resetPass = $createAccount = get_the_permalink(cc_whmcs_bridge_mainpage());
    if(!get_option('permalink_structure')){
        $loginUrl .= '&ccce=clientarea';
        $cartUrl .= '&ccce=cart&a=view';
        $resetPass .= '&ccce=pwreset';
        $createAccount .= '&ccce=register';
        if(is_user_logged_in()){
            $loginUrl .= '&action=details';
        }
    }
    else{
        if (get_option('cc_whmcs_bridge_permalinks') && function_exists('cc_whmcs_bridge_parser_with_permalinks')){
            $loginUrl .= 'clientarea';
            $cartUrl .= 'cart?a=view';
            $resetPass .= 'pwreset';
            $createAccount .= 'register';
            if(is_user_logged_in()){
                $loginUrl .= '?action=details';
            }
        }else{
            $loginUrl .= '?ccce=clientarea';
            $cartUrl .= '?ccce=cart&a=view';
            $resetPass .= '?ccce=pwreset';
            $createAccount .= '?ccce=register';
            if(is_user_logged_in()){
                $loginUrl .= '&action=details';
            }
        }
    }
    $redirectLink = $loginUrl;
}
if(function_exists('WC')) {
    $cartUrl = WC()->cart->get_cart_url();
}
?>
<?php if($inwave_cfg['show-quick-access']):  ?>
<div class="head-login">
    <a href="<?php echo esc_url($loginUrl) ?>" class="login-icon"><span class="inner-icon ibutton-effect3"><i class="<?php echo esc_attr($loginIcon) ?>"></i></span></a>
    <?php if($inwave_smof_data['woocommerce_cart_top_nav'] && $cartUrl):  ?>
    <a href="<?php echo esc_url($cartUrl); ?>" class="cart-icon">
        <span class="inner-icon ibutton-effect3"><i class="fa fa-shopping-cart"></i></span>
        <?php if(function_exists('WC')): ?>
        <span class="cart-product-number"><?php echo WC()->cart->cart_contents_count; ?></span>
        <?php endif;?>
    </a>
    <?php endif ?>
</div>
<div id="iw-login-form" class="iw-login-form">
	<form method="post" action="<?php echo esc_url(wp_login_url( get_permalink())); ?>" name="loginform">
		<h3><?php esc_html_e('LOG IN','incharity')?></h3>
		<div class="iw-login-content">
			<div class="login-close-btn"><i class="fa fa-times"></i></div>
			<div class="control-group">
				<label for="username" class="control-label"><?php esc_html_e('Username:','incharity')?></label>
				<div class="controls">
					<input type="text" id="username" name="log" class="input-xlarge">
				</div>
			</div>
			<div class="control-group">
				<label for="password" class="control-label"><?php esc_html_e('Password:','incharity')?></label>
				<div class="controls">
					<input type="password" id="password" name="pwd" class="input-xlarge">
				</div>
			</div>

			<div class="loginbtn"><button type="submit" class="ibutton ibutton1 ibutton-small ibutton-effect3" ><i class="fa fa-lock"></i><span><?php esc_html_e('LOGIN','incharity')?></span></button></div>
			<div class="rememberme"><input type="checkbox" value="forever" id="rememberme" name="rememberme"> &nbsp; <label><?php esc_html_e('Remember Me','incharity')?></label></div>
			<input type="hidden" value="<?php echo esc_url($redirectLink);?>" name="redirect_to">
			<input type="hidden" value="Log In" name="wp-submit">
		</div>
		<div class="iw-login-footer">
			<ul>
			<?php if(is_plugin_active('whmcs-bridge-sso/sso.php') && get_option('cc_whmcs_bridge_sso_singlesignon') =='checked') : ?>
			 
				<li><a href="<?php echo esc_url($createAccount); ?>"><?php esc_html_e('Create a account','incharity')?></a></li>
				<li><a href="<?php echo esc_url($resetPass); ?>"><?php esc_html_e('Forgot password','incharity')?></a></li>
				<?php else:?>
				<li><a href="<?php echo esc_url(wp_lostpassword_url());?>"><?php esc_html_e('Forgot password','incharity')?></a></li>
			<?php endif;?>
			</ul>
		</div>
	</form>
</div>
<?php endif; ?>
