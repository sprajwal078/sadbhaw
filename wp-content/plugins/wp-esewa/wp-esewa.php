<?php
/*
Plugin Name: Esewa Donation
Description: Handle Esewa transactions
Version: 1.0
Author: Sadbhaw
Text Domain: wpesewa
*/
// create plugin settings menu
add_action( 'admin_menu', 'wpesewa_create_menu' );

function wpesewa_create_menu() {

	//create new top-level menu
	add_menu_page( __('Esewa Plugin Page','wpesewa'), __('Esewa Donation','wpesewa'),'manage_options', 'wpesewa_main_menu', 'wpesewa_settings_page');
	//call register settings function
	add_action( 'admin_init', 'wpesewa_register_settings' );
}

//Register plugin settings in the wp_options table
function wpesewa_register_settings() {

	//register our settings
	register_setting( 'wpesewa-settings-group', 'wpesewa_options','wpesewa_sanitize_options' );

}

//Render plugin Settings page
function wpesewa_settings_page() {
?>
	<div class="wrap">
		<h2><?php _e('Esewa Donation Options','wpesewa') ?></h2>
		<!-- Display errors during saving of settings -->
		<?php settings_errors(); ?>
		<form method="post" action="options.php">
			<!-- Add hidden settings field -->
			<?php settings_fields( 'wpesewa-settings-group' ); ?>
			<!-- Get saved settings -->
			<?php $wpesewa_options = get_option( 'wpesewa_options' ); ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e('Client Reference ID','wpesewa'); ?></th>
					<td><input type="text" name="wpesewa_options[option_ref_id]" value="<?php echo esc_attr( $wpesewa_options['option_ref_id']); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('User ID','wpesewa'); ?></th>
					<td><input type="text" name="wpesewa_options[option_user_id]" value="<?php echo esc_attr( $wpesewa_options['option_user_id']); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Test Environment','wpesewa') ?></th>
					<td><input type="checkbox" name="wpesewa_options[option_testing]" <?php checked($wpesewa_options['option_testing'],'on'); ?> /></td>
				</tr>
			</table>
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes','wpesewa') ?>" />
			</p>
		</form>
	</div>
<?php
}

//Sanitize saved options
function wpesewa_sanitize_options( $input ) {
	$input['option_ref_id'] = sanitize_text_field( $input['option_ref_id'] );
	$input['option_user_id'] = sanitize_text_field( $input['option_user_id'] );
	$input['option_testing'] = ( isset($input['option_testing']) && $input['option_testing'] == 'on' ) ? 'on' : '';
	return $input;
}

//Add a shortcode
add_shortcode( 'wpesewa-donation', 'wpesewa_donation_btn' );
function wpesewa_donation_btn( $atts, $content = null ) {
	$wpesewa_options = get_option( 'wpesewa_options' );
	//Use dev url if test environment is et in the settings
	$action_url = ($wpesewa_options['option_testing'] == 'on')?"http://dev.esewa.com.np/donate/main":"https://esewa.com.np/donate/main";
	$atts = shortcode_atts(
		array(
			'amount' => 10, //Default amount
			'surl' => '',
			'furl' => '',
			'btn_text' => __('Esewa Donate','wpesewa') //Default button text
		), $atts );
	ob_start();
?>
	<!-- Display Esewa Donation Form with a donate button if shortcode is used -->
	<form action="<?php echo $action_url; ?>" method="POST">
		<input value="<?php echo $atts['amount'] ?>" name="amt" type="hidden">
		<input value="<?php echo $wpesewa_options['option_ref_id'] ?>" type="hidden" name="refid" >
		<input value="<?php echo $atts['surl'] ?>" type="hidden" name="surl">
		<input value="<?php echo $atts['furl'] ?>" type="hidden" name="furl">
		<button type="submit"><?php echo $atts['btn_text'] ?></button>
	</form>
	<?php
	return ob_get_clean();
}