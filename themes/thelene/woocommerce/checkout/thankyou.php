<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

	<?php
	if ( $order ) :
		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>
			<section class="thank-you-section">
			  <div class="container">
			    <div class="row">
			      <div class="col-md-12">
			        <div class="thank-you-sec-cntlr">
			          <div class="thnk-you-des">
			            <i><img src="<?php echo THEME_URI; ?>/assets/images/thankyou-pg-logo.svg" alt="logo"></i>
			            <h1 class="fl-h2 thank-you-des-title">Bedankt <span>&lt;<?php echo $order->get_billing_first_name(); ?>&gt;</span> voor je bestelling</h1>
			            <a href="#">Bestelnummer: #<?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
			            <p>Een bevestigingsmail <br> komt zodadelijk jouw richting uit.</p>
			          </div>
			          <div class="thnk-y-social-des" style="background:url(<?php echo THEME_URI; ?>/assets/images/thank-you-social-bg.jpg);">
			            <div class="thnk-you-social-des-cntlr" >
			              <h5 class="fl-h5 thnk-you-social-des-title"><?php esc_html_e( 'Social Media', 'woocommerce' ); ?></h5>
			              <p>Interdum, nunc id blandit porttitor, velit purus posuere turpis.</p>
			               <?php 
							$smedias = get_field('social_media', 'options');
			                if(!empty($smedias)):  
			               ?>
			              <div class="thnkY-social-link">
			                <ul class="reset-list">
			                  <?php foreach($smedias as $smedia): ?>
				                  <li>
				                    <a target="_blank" href="<?php echo $smedia['url']; ?>">
				                        <?php echo $smedia['icon']; ?>
				                    </a>
				                  </li>
				                <?php endforeach; ?>
			                </ul>
			              </div>
			          	  <?php endif; ?>
			            </div>
			          </div>
			        </div>
			      </div>
			    </div>
			  </div>
			</section>
		<?php endif; ?>

	<?php else : ?>

	<?php endif; ?>

</div>
