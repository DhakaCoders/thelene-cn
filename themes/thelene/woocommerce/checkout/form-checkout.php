<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>

<div class="shipping-methods">
		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>
</div>

	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	<div class="over-review-crtl">
		<!-- <h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3> -->
		
		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>
		<div class="woocommerce-additional-fields extra-info">	
			<h3>4.<?php esc_html_e( 'Extra Info', 'woocommerce' ); ?></h3>
			<div class="woocommerce-additional-fields__field-wrapper">
				<p class="form-row notes thwcfd-field-wrapper thwcfd-field-textarea" id="order_comments_field" ><span class="woocommerce-input-wrapper"><textarea name="order_comments" class="input-text " id="order_comments" placeholder="" rows="2" cols="5"></textarea></span></p>	
			</div>
		</div>
		<div class="custom-checkout-btn">
			<button type="submit" class="button alt" name="woocommerce_checkout_place_order" value="Afrekenen" data-value="Afrekenen"><?php esc_html_e( 'Afrekenen', 'woocommerce' ); ?></button>
		</div>
	</div>
	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
	<div class="custom-checkout-order-review">
		<h3 class="order-review-title"><?php esc_html_e( 'Overzicht', 'woocommerce' ); ?></h3>
		<?php wc_get_template_part('checkout/review-order');?>
		<button type="submit" class="button alt" name="woocommerce_checkout_place_order" value="Afrekenen" data-value="Afrekenen"><?php esc_html_e( 'Afrekenen', 'woocommerce' ); ?></button>
	</div>

	
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
