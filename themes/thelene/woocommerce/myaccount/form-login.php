<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-1">

<?php endif; ?>

		<h2><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>

		<form class="woocommerce-form woocommerce-form-login login" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
				</label>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
			</p>
			<p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	</div>

	<div class="u-column2 col-2">

		<h2><?php esc_html_e( 'Nieuw bij Thelene?', 'woocommerce' ); ?></h2>
		<div class="signup-notification">
			<p>Vul hier je e-mailadres in als je nog niet beschikt over een account. Indien gewenst, kan je in de volgende stap een account aanmaken.</p>
		</div>
		<form method="post" class="woocommerce-form woocommerce-form-register register">
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'E-mailadres', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" placeholder="Bijv. jan@domein.be" required/>
			</p>
			<p class="woocommerce-form-row form-row">
				<button type="button" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'doorgaan', 'woocommerce' ); ?>"><?php esc_html_e( 'doorgaan', 'woocommerce' ); ?></button>
			</p>
		</form>

	</div>

</div>
<?php 
global $woocommerce;
    $countries_obj   = new WC_Countries();
    $countries   = $countries_obj->__get('countries');
?>
<div class="register-nextstep woocommerce-billing-fields">
	<div class="register-title">
		<h3>Persoonlijke gegevens</h3>
	</div>
	<form>
		<div class="woocommerce-billing-fields__field-wrapper">
			<p class="form-row form-row-first" id="billing_first_name_field">
				<label for="billing_first_name" class="">Naam</label>
				<span class="woocommerce-input-wrapper">
					<input type="text" class="input-text " name="billing_first_name" id="billing_first_name" placeholder="Voornaam"autocomplete="given-name">
				</span>
			</p>
			<p class="form-row form-row-last" id="billing_last_name_field">
				<label for="billing_first_name" class="">&nbsp;</label>
				<span class="woocommerce-input-wrapper">
					<input type="text" class="input-text " name="billing_last_name" id="billing_last_name" placeholder="Naam" autocomplete="family-name">
				</span>
			</p>
			<?php 
				woocommerce_form_field('billing_country', array(
			    'type'       => 'select',
			    'class'      => array( 'country_to_state country_select' ),
			    'label'      => __('Land'),
			    'placeholder'    => __('Selecteer Land'),
			    'options'    => $countries
			    )
			    );
			?>
			<p class="form-row form-row-first billing_postcode" id="billing_postcode_field">
				<label for="billing_postcode" class="">Postcode</label>
				<span class="woocommerce-input-wrapper">
					<input type="text" class="input-text " name="billing_postcode" id="billing_postcode" placeholder="Bijv. 9300" autocomplete="postal-code">
				</span>
			</p>
			<p class="form-row form-row-last billing_city" id="billing_city_field">
				<label for="billing_city" class="">Gemeente</label>
				<span class="woocommerce-input-wrapper">
					<input type="text" class="input-text " name="billing_city" id="billing_city" placeholder="Bijv. 9300" autocomplete="address-level2">
				</span>
			</p>

			<p class="form-row form-row-first billing_address_1" id="billing_address_1_field">
				<label for="billing_address_1" class="">Straatnaam</label>
				<span class="woocommerce-input-wrapper">
					<input type="text" class="input-text " name="billing_address_1" id="billing_address_1" placeholder="Bijv. Stationstraat" autocomplete="address-line1">
				</span>
			</p>
			<p class="form-row form-row-last billing_house" id="billing_house_field">
				<label for="billing_house" class="">Huisnummer en bus</label>
				<span class="woocommerce-input-wrapper">
					<input type="text" class="input-text " name="billing_house" id="billing_house" placeholder="Bijv. 113-C" autocomplete="house-number">
				</span>
			</p>
			<p class="form-row form-row-wide billing_address_2" id="billing_address_2_field">
				<label for="billing_address_2" class="">Extra adresregel</label>
				<span class="woocommerce-input-wrapper">
					<input type="text" class="input-text " name="billing_address_2" id="billing_address_2" placeholder="" autocomplete="address-line2">
				</span>
			</p>
			<div class="billing-address-wrap">
				<h3>Factuuradres</h3>
				<p class="same-as-shipping-address">
					<input type="checkbox" name="is_shipping_address" value="0">&nbsp;Hetzelfde als bezorgadres
				</p>
				<p class="form-row form-row-wide" id="billing_email_field">
					<label for="billing_email" class="">E-mailadres</label>
					<span class="woocommerce-input-wrapper">
						<input type="email" class="input-text " name="billing_email" id="billing_email" placeholder="" value="admin@gmail.com" autocomplete="email username">
					</span>
				</p>
			</div>
		</div>
	</form>
</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
