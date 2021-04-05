<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$attachment_ids = $product->get_gallery_image_ids();
if ( $attachment_ids && $product->get_image_id() ) {
echo '<div class="thumbnails-cntlr">';
echo '<span class="fl-singgle-pro-prev"></span><span class="fl-singgle-pro-next"></span>';
echo '<div class="thumbnails">';
if ( $product->get_image_id() ) {
	$imgtag = wp_get_attachment_image( $product->get_image_id(), 'thumbnail' );
      echo '<div class="thumb-bg">';
      echo '<div>';
      		echo $imgtag;
      echo '</div>';
      echo '</div>';
} else {
	echo '<div class="thumb-bg">';
	echo '<div>';
	echo sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
	echo '</div>';
	echo '</div>';
}

	foreach ( $attachment_ids as $attachment_id ) {
		$imgtag = wp_get_attachment_image( $attachment_id, 'thumbnail' );
		echo '<div class="thumb-bg">';
		echo '<div>';
      		echo $imgtag;
      	echo '</div>';
      	echo '</div>';
	}

echo '</div></div>';
}