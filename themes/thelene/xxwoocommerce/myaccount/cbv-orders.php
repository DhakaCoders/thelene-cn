<?php
defined( 'ABSPATH' ) || exit;
if(! empty($_GET['pageno']) && is_numeric($_GET['pageno']) ){
    $paged = $_GET['pageno'];
}else{
    $paged = 1;
}
$posts_per_page = 3;

$all_orders = get_posts(
apply_filters(
  'woocommerce_my_account_my_orders_query',
  array(
    'numberposts' => -1,
    'meta_key'    => '_customer_user',
    'meta_value'  => get_current_user_id(),
    'post_type'   => wc_get_order_types( 'view-orders' ),
    'post_status' => array_keys( wc_get_order_statuses() )
  )
)
);

//how many total posts are there?
$order_count = count($all_orders);

//how many pages do we need to display all those posts?
$num_pages = ceil($order_count / $posts_per_page);

//let's make sure we don't have a page number that is higher than we have posts for
if($paged > $num_pages || $paged < 1){
    $paged = $num_pages;
}


$customer_orders = get_posts(
apply_filters(
  'woocommerce_my_account_my_orders_query',
  array(
    'numberposts' => $posts_per_page,
    'meta_key'    => '_customer_user',
    'meta_value'  => get_current_user_id(),
    'post_type'   => wc_get_order_types( 'view-orders' ),
    'post_status' => array_keys( wc_get_order_statuses() ),
        'paged'       => $paged
  )
)
);
?>
<div class="customer-order-details">
<?php
if ( $customer_orders ) :
?>
<div class="faq-accordion-wrp cbvmyaccount">
    <ul class="clearfix reset-list tabs">
        <?php
    foreach ( $customer_orders as $customer_order ) :
      $order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
      $item_count = $order->get_item_count();
    ?>
        <li>
        <div class="faq-accordion-controller">
        <time class="my-ac-time" datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created(), 'd. m. Y' ) ); ?></time>
      <a class="code-text">
        <?php echo __('Bestelnummer', 'woocommerce' ) . '#'.$order->get_order_number(); ?>
      </a>
      <?php 
      echo "<div class='order-status color-green'>";
      echo "<label>Status:</label> ";
      echo esc_html( wc_get_order_status_name( $order->get_status() ) );
      echo "</div>";
      ?>

      <?php
        echo "<div class='order-price'>{$order->get_formatted_order_total()}</div>";
      ?>
          <span></span>
          <div class="faq-accordion-dsc mac-single-accordion-dsc">
            <div class="myac-pro-grds">
                <?php 
                    $order_items = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
                    if( $order_items ):
                    foreach ( $order_items as $item_id => $item ) {
                $product = $item->get_product();
                $itemImgID = get_post_thumbnail_id($product->get_id());
                if( empty($itemImgID) ){
                    $itemImgID = get_post_thumbnail_id($product->get_parent_id());
                }
                $order_img = cbv_get_image_tag( $itemImgID, 'thumbnail' );
                    $qty = $item->get_quantity();
                $refunded_qty = $order->get_qty_refunded_for_item( $item_id );
                if ( $refunded_qty ) {
                  $qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
                } else {
                  $qty_display = esc_html( $qty );
                }
                ?>
              <div class="myac-pro-grd-item">
                <div class="myac-pro-grd-item-inr">
                  <div class="myac-pro-grd-img">
                    <?php echo $order_img; ?>
                  </div>
                  <h5><?php echo $item->get_name(); ?> <strong class="product-quantity">&times;&nbsp;<?php echo $qty_display; ?></strong></h5>
                  <?php 
                            
                  ?>
                  <?php if( !empty($product->get_short_description()) ) echo wpautop($product->get_short_description()); ?>

                  <div class="product-price">
                    <?php echo $product->get_price_html(); ?>
                  </div>
                </div>
              </div>
              <?php } ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
<div class="faq-pagi-ctlr">
<?php
    //we need to display some pagination if there are more total posts than the posts displayed per page
    if($order_count > $posts_per_page ){

        echo '<ul class="reset-list page-numbers">';

        if($paged > 1){
            echo '<li><a class="prev page-numbers" href="?pageno=1">
              <i>
              <svg class="faq-lft-arrows-icon-svg" width="10" height="10" viewBox="0 0 10 10" fill="717171">
                <use xlink:href="#faq-lft-arrows-icon-svg"></use>
              </svg>  
             </i>
             Vorige
            </a></li>';
        }else{
            echo '<li><span>
              <i>
              <svg class="faq-lft-arrows-icon-svg" width="10" height="10" viewBox="0 0 10 10" fill="717171">
                <use xlink:href="#faq-lft-arrows-icon-svg"></use>
              </svg>  
             </i>
             Vorige
            </span></li>';
        }

        for($p = 1; $p <= $num_pages; $p++){
            if ($paged == $p) {
                echo '<li><span class="page-numbers current">'.$p.'</span></li>';
            }else{
                echo '<li><a class="page-numbers" href="?pageno='.$p.'">'.$p.'</a></li>';
            }
        }

        if($paged < $num_pages){
            echo '<li><a class="next page-numbers" href="?pageno='.$num_pages.'">    
            Volgende
            <i>
              <svg class="faq-rgt-arrows-icon-svg" width="10" height="10" viewBox="0 0 10 10" fill="717171">
                <use xlink:href="#faq-rgt-arrows-icon-svg"></use>
              </svg>  
             </i>
             </a></li>';
        }else{
            echo '<li><span>    
            Volgende
            <i>
              <svg class="faq-rgt-arrows-icon-svg" width="10" height="10" viewBox="0 0 10 10" fill="717171">
                <use xlink:href="#faq-rgt-arrows-icon-svg"></use>
              </svg>  
             </i>
            </span></li>';
        }

        echo '</ul>';
    }
?>
</div>
<?php endif; ?>
    <div class="back-to-dashboard-btn-cntlr">
        <a class="backshop-cart" href="javascript: history.go(-1)">terug naar dashboard</a>
    </div>
</div>