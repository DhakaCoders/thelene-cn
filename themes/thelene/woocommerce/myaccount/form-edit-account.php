<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' );
$reg = array();
if (isset( $_POST["account_email"] ) && isset($_POST['user_id'])) { 
	$reg = registered_user_info_update($_POST);
}
?>
<div class="woocommerce-edit-account-crtl">
	<?php 
		if( array_key_exists('error', $reg) ){
			printf('<div class="contact-er-msg"><span><i><svg class="error-msg-icon-svg" width="32" height="32" viewBox="0 0 32 32" fill="#ffffff"><use xlink:href="#error-msg-icon-svg"></use> </svg></i>%s</div>', $reg['error']);
		}elseif( array_key_exists('success', $reg) ){
			printf('<div class="contact-success-msg">%s</div>', $reg['success']);
		}
	?>
	<form class="woocommerce-EditAccountForm edit-account" action="" method="post" >
		<input type="hidden" name="user_id" value="<?php echo $user->ID; ?>">
		<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
		<fieldset>
			<legend><?php esc_html_e( 'Contactpersoon', 'woocommerce' ); ?></legend>
		<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
			<label for="account_first_name"><?php esc_html_e( 'Naam', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
			<label for="account_last_name">&nbsp;</label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
		</p>
		<div class="clear"></div>
		<p class="form-row form-row-first billing_gsm_number" id="billing_address_1_field">
			<label for="billing_gsm_number" class="">GSM nummer</label>
			<span class="woocommerce-input-wrapper">
				<input type="text" class="input-text " name="billing_gsm_number" id="billing_gsm_number" value="<?php echo esc_attr( get_user_meta( $user->ID, 'billing_gsm_number', true ) ); ?>" placeholder="Bijv. 0493 20 36 20" autocomplete="gsm-number">
			</span>
		</p>
		<p class="form-row form-row-last billing_phone" id="billing_phone_field">
			<label for="billing_phone" class="">Telefoon</label>
			<span class="woocommerce-input-wrapper">
				<input type="tel" class="input-text " name="billing_phone" id="billing_phone" value="<?php echo esc_attr( get_user_meta( $user->ID, 'billing_phone', true ) ); ?>" placeholder="Bijv. 09 224 61 11" autocomplete="tel">
			</span>
		</p>
		<div class="clear"></div>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="account_email"><?php esc_html_e( 'E-mailadres', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
		</p>
		</fieldset>
		<fieldset>
			<legend><?php esc_html_e( 'Adres', 'woocommerce' ); ?></legend>

			<p class="form-row form-row-first billing_address_1" id="billing_address_1_field">
				<label for="billing_address_1" class="">Straatnaam</label>
				<span class="woocommerce-input-wrapper">
					<input type="text" class="input-text " name="billing_address_1" id="billing_address_1" value="<?php echo esc_attr( get_user_meta( $user->ID, 'billing_address_1', true ) ); ?>" placeholder="Bijv. Stationstraat" autocomplete="address-line1">
				</span>
			</p>
			<p class="form-row form-row-last billing_house" id="billing_house_field">
				<label for="billing_house" class="">Nummer</label>
				<span class="woocommerce-input-wrapper">
					<input type="text" class="input-text " name="billing_house" id="billing_house" value="<?php echo esc_attr( get_user_meta( $user->ID, 'billing_house', true ) ); ?>" placeholder="Bijv. 113-C" autocomplete="house-number">
				</span>
			</p>
			<div class="clear"></div>
			<p class="form-row form-row-first billing_postcode" id="billing_postcode_field">
				<label for="billing_postcode" class="">Postcode</label>
				<span class="woocommerce-input-wrapper">
					<input type="text" class="input-text " name="billing_postcode" id="billing_postcode" value="<?php echo esc_attr( get_user_meta( $user->ID, 'billing_postcode', true ) ); ?>" placeholder="Bijv. 9300" autocomplete="postal-code">
				</span>
			</p>
			<p class="form-row form-row-last billing_city" id="billing_city_field">
				<label for="billing_city" class="">Gemeente</label>
				<span class="woocommerce-input-wrapper">
					<input type="text" class="input-text " name="billing_city" id="billing_city" value="<?php echo esc_attr( get_user_meta( $user->ID, 'billing_city', true ) ); ?>" placeholder="Bijv. 9300" autocomplete="address-level2">
				</span>
			</p>
		</fieldset>
		<fieldset>
			<legend><?php esc_html_e( 'Login Details', 'woocommerce' ); ?></legend>
			<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
				<label for="password_1"><?php esc_html_e( 'Wachtwoord', 'woocommerce' ); ?></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" placeholder="Wachtwoord" />
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
				<label for="password_2"><?php esc_html_e( 'Bevestig wachtwoord', 'woocommerce' ); ?></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" placeholder="Wachtwoord"/>
			</p>
		</fieldset>
		<div class="clear"></div>

		<?php do_action( 'woocommerce_edit_account_form' ); ?>

		<p>
			<input type="hidden" name="update_custom_account_details_nonce" value="<?php echo wp_create_nonce('update-custom-account-details-nonce'); ?>"/>
			<button type="submit" class="woocommerce-Button button" name="save_account_details" value="<?php esc_attr_e( 'Opslaan', 'woocommerce' ); ?>"><?php esc_html_e( 'Opslaan', 'woocommerce' ); ?></button>
		</p>

		<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
	</form>
</div>
<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
