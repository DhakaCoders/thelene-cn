<?php 

//Exit if accessed directly
if(!defined('ABSPATH')){
	return; 	
}

global $xoo_cp_gl_qtyen_value;

$cart = WC()->cart->get_cart();

$cart_item = $cart[$cart_item_key];


$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

$thumbnail 		= apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

$product_name 	=  apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
					
$product_price 	= apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );



$product_subtotal = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
$exc = get_the_excerpt( $product_id );
// Meta data
$attributes = '';

//Variation
$attributes .= $_product->is_type('variable') || $_product->is_type('variation')  ? wc_get_formatted_variation($_product) : '';
// Meta data
if(version_compare( WC()->version , '3.3.0' , "<" )){
	$attributes .=  WC()->cart->get_item_data( $cart_item );
}
else{
	$attributes .=  wc_get_formatted_cart_item_data( $cart_item );
}


//Quantity input
$max_value = apply_filters( 'woocommerce_quantity_input_max', product_max_qty($product_id, $_product));
$min_value = apply_filters( 'woocommerce_quantity_input_min', product_min_qty($product_id, $_product) );
$step      = apply_filters( 'woocommerce_quantity_input_step', 1, $_product );
$pattern   = apply_filters( 'woocommerce_quantity_input_pattern', has_filter( 'woocommerce_stock_amount', 'intval' ) ? '[0-9]*' : '' );

?>



<div class="xoo-cp-pdetails clearfix">
	<div class="container" id="tr" data-xoo_cp_key="<?php echo $cart_item_key; ?>">
		<div class="row clearfix xoo-cp-pdetails-row plr-40">
			<div class="xoo-cp-pdetails-col-1">
        <div class="xoo-cp-left-des">
          <div class="xoo-cp-pimg"><a href="<?php echo  $product_permalink; ?>"><?php echo $thumbnail; ?></a></div>
            <div class="xoo-cp-ptitle">
            <div class="popup-product-title">
              <div><a href="<?php echo  $product_permalink; ?>"><?php echo $product_name; ?></a></div>
            </div>

          <?php if($attributes): ?>
            <div class="xoo-cp-variations"><?php echo $attributes; ?></div>
          <?php endif; ?>
              <div class="qty-price-wrap">
                <?php if ( $_product->is_sold_individually() || !$xoo_cp_gl_qtyen_value ): ?>
                  <span><?php echo $cart_item['quantity']; ?></span>        
                <?php else: ?>
                <div class="quantity qty">
                  <span class="xcp-minus xcp-chng">-</span>
                  <input type="number" class="xoo-cp-qty" max="<?php esc_attr_e( 0 < $max_value ? $max_value : '' ); ?>" min="<?php esc_attr_e($min_value); ?>" step="<?php echo esc_attr_e($step); ?>" value="<?php echo $cart_item['quantity']; ?>" pattern="<?php esc_attr_e( $pattern ); ?>">
                  <span class="xcp-plus xcp-chng">+</span>
                </div>
                <?php endif; ?>
                <div class="mpriceWrap">
                    <span class="xoo-cp-pprice"><?php echo  $product_price; ?></span>
                </div>
              </div>
          </div>
        </div>
			</div>
			<div class="xoo-cp-pdetails-col-2">
  			<div class="product-order-btn">
  				<a class="fl-btn continue-shopping-btn xoo-cp-close xcp-btn" href="<?php echo get_permalink(get_option( 'woocommerce_shop_page_id' ) );?>"><?php _e('Verder winkelen','added-to-cart-popup-woocommerce'); ?></a>
          <a class="fl-btn" href="<?php echo get_permalink(get_option( 'woocommerce_checkout_page_id' ) );?>"><?php _e('ik ga bestellen','added-to-cart-popup-woocommerce'); ?></a>
  			</div>
			</div>
		</div>

	</div>
</div>
<?php 
	$terms = get_the_terms($product_id, 'product_cat');
	$slugs = array();
	if( !empty($terms) ){
		foreach( $terms as $term ){
			$slugs[] = $term->slug;
		}
  	$pQuery = new WP_Query(array(
    'post_type' => 'product',
    'posts_per_page'=> 3,
    'orderby' => 'date',
    'order'=> 'asc',
    'tax_query' => array(
    	array(
    		'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $slugs,
    	)
    )

  ));
?>
<?php if( $pQuery->have_posts() ): ?>
  <div class="plr-40">
    <div class="spotlight-popup-cntlr">
    <h5 class="popup-related"><?php _e('Gerelateerde producten','added-to-cart-popup-woocommerce'); ?></h5>
    <div class="spotlight-popup d-flex bd-highlight">
      <?php 
        while($pQuery->have_posts()): $pQuery->the_post(); 
        global $product, $woocommerce, $post;
      ?>
      <div class="flex-fill bd-highlight">
        <div class="pro-item-cntlr">
          <?php 
          $person = ' ';
          $itemCls = 'notSimple';
            switch ( $product->get_type() ) {
            case "variable" :
                $link   = get_permalink($product->get_id());
                $label  = apply_filters('variable_add_to_cart_text', __('bestellen', 'woocommerce'));
            break;
            case "grouped" :
                $link   = get_permalink($product->get_id());
                $label  = apply_filters('grouped_add_to_cart_text', __('bestellen', 'woocommerce'));
            break;
            case "external" :
                $link   = get_permalink($product->get_id());
                $label  = apply_filters('external_add_to_cart_text', __('bestellen', 'woocommerce'));
            break;
            default :
                $link   = esc_url( $product->add_to_cart_url() );
                $label  = apply_filters('add_to_cart_text', __('bestellen', 'woocommerce'));
                $itemCls = 'prsimple';
            break;
            }
            $seller_flash = get_field('seller_flash', $product->get_id());
            $gridurl = cbv_get_image_tag( get_post_thumbnail_id($product->get_id()), 'hprogrid' );
            echo "<div class='pro-item {$itemCls}'>";
            if( !empty($seller_flash) ) printf('<span class="seller-flash">%s</span>', $seller_flash); 
            echo '<div class="pro-item-img-cntlr pw-item-img-cntlr">';
            echo '<a class="overlay-link" href="'.get_permalink( $product->get_id() ).'"></a>';
            echo '<div class="pro-item-img">'.$gridurl.'</div>';
            echo '</div>';
            echo '<div class="pro-item-desc pw-item-desc">';
            echo '<div class="pro-item-descWrap mHc">';
            echo '<h3 class="pro-item-desc-title"><a href="'.get_permalink( $product->get_id() ).'">'.get_the_title().'</a></h3>';
            echo '<div class="product-price">';
            echo $product->get_price_html();
            echo '<span class="pro-prize-shrt-title show-sm"></span>';
            echo '</div></div>';
            echo '<div class="product-quantity product-quantity-cntlr">';
            if ( ! $product->is_in_stock() ) :

            else:
            if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && ! $product->is_sold_individually() ) {
            echo '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="cart" method="post" enctype="multipart/form-data">';
            echo '<div class="quantity"><span class="minus">-</span>';
            echo loop_qty_input();
            echo '<span class="plus">+</span></div>';
            echo '<div class="product-order-btn"><button type="submit" class="fl-btn">bestellen</button></div>';
            echo '</form>';
            }else{
                printf('<div class="product-order-btn"><a class="fl-btn" href="%s" rel="nofollow" data-product_id="%s" class="button add_to_cart_button product_type_%s">%s</a></div>', $link, $product->get_id(), $product->get_type(), $label);
            }
            endif;
            echo '</div>';
            echo '</div>';
            echo '</div>';

            $catSlug = $catName = '';
            $cats  = get_the_terms($product->get_id(), 'product_cat');//$post->ID
            foreach($cats as $cd){
              $catSlug = $cd->slug;
              $catName = $cd->name;
            }    
          ?>
        </div>
        <?php if( !empty($catSlug) ): ?>
        <div><a class="backto-product-cat" href="<?php echo get_term_link($catSlug, 'product_cat'); ?>"><?php _e('Bekijk alle '.$catName,'added-to-cart-popup-woocommerce'); ?></a></div>
        <?php endif; ?>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
  <div class="popup-bottom-btn">
    <a class="fl-btn continue-shopping-btn xoo-cp-close xcp-btn" href="<?php echo get_permalink(get_option( 'woocommerce_shop_page_id' ) );?>"><?php _e('Verder winkelen','added-to-cart-popup-woocommerce'); ?></a>
    <a class="fl-btn" href="<?php echo get_permalink(get_option( 'woocommerce_checkout_page_id' ) );?>"><?php _e('ik ga bestellen','added-to-cart-popup-woocommerce'); ?></a>
  </div>
  </div>
<?php endif; wp_reset_postdata(); ?>
<?php } ?>

