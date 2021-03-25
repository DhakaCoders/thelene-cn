<?php
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);


add_action('woocommerce_before_main_content', 'get_custom_wc_output_content_wrapper', 11);
add_action('woocommerce_after_main_content', 'get_custom_wc_output_content_wrapper_end', 9);
add_filter( 'woocommerce_show_page_title', '__return_false' );
function get_custom_wc_output_content_wrapper(){

    if(is_shop() OR is_product_category()){ 
        echo '<section class="product-overview-sec"><div class="container"><div class="row"><div class="col-md-12"><div class="product-overview-inr">';
        get_template_part('templates/breadcrumbs');
        get_template_part('templates/shop', 'search');
        echo '<div class="pro-overview-cntnt-cntlr clearfix">';
        echo '<div class="pro-overview-cntnt-lft">';
            get_sidebar('shop');
        echo '</div>';
        echo '<div class="pro-overview-grid-cntlr">';
    }


}

function get_custom_wc_output_content_wrapper_end(){
  if(is_shop() OR is_product_category()){
    echo '</div>';
    echo '</div>'; 
    echo '</div></div></div></div></section>';
  }

}

function get_array( $string ){
    if( !empty( $string ) ){ 
        $str_arr = preg_split ("/\,/", $string);   
        return $str_arr;
    }
    return false;
}

add_filter('woocommerce_catalog_orderby', 'wc_customize_product_sorting');

function wc_customize_product_sorting($sorting_options){
    $sorting_options = array(
        'menu_order' => __( 'sort by', 'woocommerce' ),
        'popularity' => __( 'popularity', 'woocommerce' ),
        'rating'     => __( 'average rating', 'woocommerce' ),
        'date'       => __( 'newness', 'woocommerce' ),
        'price'      => __( 'low price', 'woocommerce' ),
        'price-desc' => __( 'high price', 'woocommerce' ),
    );

    return $sorting_options;
}

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
  function loop_columns() {
    return 3; // 3 products per row
  }
}

/*Loop Hooks*/


/**
 * Add loop inner details are below
 */

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

add_action('woocommerce_shop_loop_item_title', 'add_shorttext_below_title_loop', 5);
if (!function_exists('add_shorttext_below_title_loop')) {
    function add_shorttext_below_title_loop() {
        global $product, $woocommerce, $post;
        $person = ' ';
        $itemCls = 'notSimple';
          switch ( $product->get_type() ) {
          case "variable" :
              $link   = get_permalink($product->get_id());
              $label  = apply_filters('variable_add_to_cart_text', __('Selecteer optie', 'woocommerce'));
          break;
          case "grouped" :
              $link   = get_permalink($product->get_id());
              $label  = apply_filters('grouped_add_to_cart_text', __('Selecteer optie', 'woocommerce'));
          break;
          case "external" :
              $link   = get_permalink($product->get_id());
              $label  = apply_filters('external_add_to_cart_text', __('Less Meer', 'woocommerce'));
          break;
          default :
              $link   = esc_url( $product->add_to_cart_url() );
              $label  = apply_filters('add_to_cart_text', __('Bestel nu', 'woocommerce'));
              $person = 'Aantal personen';
              $itemCls = 'prsimple';
          break;
          }
        $isShowWeekProdict = get_field('weekend_product', $product->get_id());
        $gridurl = cbv_get_image_src( get_post_thumbnail_id($product->get_id()), 'pgrid' );
        echo "<div class='pro-item {$itemCls}'>";
        echo '<div class="pro-item-img-cntlr pw-item-img-cntlr">';
        echo '<a class="overlay-link" href="'.get_permalink( $product->get_id() ).'"></a>';
        echo '<div class="pro-item-img dft-transition inline-bg" style="background-image: url('.$gridurl.');"></div>';
        if( $isShowWeekProdict ):
            echo '<div class="pro-item-highlight-text">';
            echo '<span>Product van de week</span>';
            echo '</div>';
        endif;
        echo '</div>';
        echo '<div class="pro-item-desc pw-item-desc">';
        echo '<h3 class="pro-item-desc-title"><a href="'.get_permalink( $product->get_id() ).'">'.get_the_title().'</a></h3>';
        echo '<h6 class="pro-item-desc-sub-title">'.get_the_excerpt().'</h6>';
        echo '<div class="product-price">';
        echo $product->get_price_html();
        echo '<span class="pro-prize-shrt-title show-sm">pp</span>';
        echo '</div>';
        echo "<strong>{$person}</strong>";
        echo '<div class="product-quantity product-quantity-cntlr">';
        if ( ! $product->is_in_stock() ) :
            
        else:
            if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && ! $product->is_sold_individually() ) {
            echo '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="cart" method="post" enctype="multipart/form-data">';
            echo '<div class="quantity qty"><span class="minus">-</span>';
            echo loop_qty_input();
            echo '<span class="plus">+</span></div>';
            echo '<div class="product-order-btn"><button type="submit" class="fl-btn">Bestel nu</button></div>';
            echo '</form>';
            }else{
                printf('<div class="product-order-btn"><a class="fl-btn" href="%s" rel="nofollow" data-product_id="%s" class="button add_to_cart_button product_type_%s">%s</a></div>', $link, $product->get_id(), $product->get_type(), $label);
            }
        endif;
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
    }
}

function loop_qty_input(){

    global $product;
    $qty_input = woocommerce_quantity_input( array(
        'min_value'   => apply_filters( 'woocommerce_quantity_input_min', product_min_qty(), $product ),
        'max_value'   => apply_filters( 'woocommerce_quantity_input_max', product_max_qty(), $product ),
        'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : product_min_qty(), // WPCS: CSRF ok, input var ok.
    ) );
    return $qty_input;
}

function wc_stock_manage(){
    global $product;
    $StockQ = $product->get_stock_quantity();
    if ( ! $product->managing_stock() && ! $product->is_in_stock() ){
        echo '<span class="out-of-stock">Out of Stock</span>';
        
    } elseif( $StockQ < 1 ) {
        if ($product->backorders_allowed()){
            echo '<span class="backorders">Available on Backorder</span>';
        } elseif ( !$product->backorders_allowed() && $StockQ == 0 && ! $product->is_in_stock()){
            echo '<span class="out-of-stock">Out of Stock</span>';
        } elseif ( $product->is_on_backorder() ){
            echo '<span class="backorders">Available on Backorder</span>';
        }
    } 
}

add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options –> Reading
  // Return the number of products you wanna show per page.
  $cols = 3;
  return $cols;
}


//add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
function jk_related_products_args( $args ) {
$args['posts_per_page'] = 8; // 4 related products
return $args;
}



// change a number of the breadcrumb defaults.
add_filter( 'woocommerce_breadcrumb_defaults', 'cbv_woocommerce_breadcrumbs' );
if( !function_exists('cbv_woocommerce_breadcrumbs')):
function cbv_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '',
            'wrap_before' => '<ul class="reset-list">',
            'wrap_after'  => '</ul>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}
endif;

/*Remove Single page Woocommerce Hooks & Filters are below*/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


add_action('woocommerce_single_product_summary', 'add_custom_box_product_summary', 5);
if (!function_exists('add_custom_box_product_summary')) {
    function add_custom_box_product_summary() {
        global $product, $woocommerce, $post;
        $sh_desc = $product->get_description();
        $get_inhoud = get_field('inhoud', $product->get_id() );
        $product_usps = get_field('product_usps', 'options' );
        $sh_desc = !empty($sh_desc)?$sh_desc:'';

           echo '<div class="summary-hdr hide-md">';
            echo '<h1 class="product_title entry-title">'.$product->get_title().'</h1>';
            echo wpautop( $sh_desc, true );
            if( $product_usps ){
            echo '<ul>';
                foreach( $product_usps as $product_usp ){
                    if( !empty($product_usp['titel']) ) printf('<li>%s</li>', $product_usp['titel']);
                }
            echo '</ul>';
            }
            echo '</div>';
            echo '<div class="price-quentity">';
              woocommerce_template_single_add_to_cart();
            echo '</div>';
            if( $product_usps ){
            echo '<div class="summary-hdr show-md">';
                echo '<ul>';
                    foreach( $product_usps as $product_usp ){
                        if( !empty($product_usp['titel']) ) printf('<li>%s</li>', $product_usp['titel']);
                    }
                echo '</ul>';
            echo '</div>';
            }
            if( !empty($get_inhoud) ){
                echo '<div class="pro-summary-content">';
                echo wpautop( $get_inhoud );
                echo '</div>';
            }
            echo '<div class="woocommerce-tabs">';
             wc_get_template(  'single-product/tabs/tabs.php' ); 
            echo '</div>';

    }
}

add_action('woocommerce_before_add_to_cart_quantity', 'cbv_start_div_single_price');
function cbv_start_div_single_price(){
    echo '<div class="cartbtn-wrap"><strong>Aantal personen</strong><div class="cart-btn-qty">';
}
add_action('woocommerce_after_add_to_cart_button', 'cbv_get_single_price');
function cbv_get_single_price(){
    global $product;
    echo '</div></div>';
    echo '<div class="qty-price-wrap">';
    echo $product->get_price_html();
    echo '</div>';
}

add_filter( 'woocommerce_product_tabs', 'woo_custom_product_tabs' );
function woo_custom_product_tabs( $tabs ) {

    // 1) Removing tabs
    unset( $tabs['description'] );              // Remove the description tab
    // unset( $tabs['reviews'] );               // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab

    //ACF Description tab
    $tabs['attrib_desc_tab'] = array(
        'title'     => __( 'Extra info', 'woocommerce' ),
        'priority'  => 1,
        'callback'  => 'woo_extrainfo_tab_content'
    );

    $tabs['qty_pricing_tab'] = array(
        'title'     => __( 'Allergenen', 'woocommerce' ),
        'priority'  => 2,
        'callback'  => 'woo_allergenen_tab_content'
    );

    return $tabs;

}

// New Tab contents

function woo_extrainfo_tab_content() {
    global $product;
    $extra_info = get_field('extra_info', $product->get_id() );
    if( !empty($extra_info) ){
        echo '<div class="extra-info-content">';
        echo wpautop( $extra_info );
        echo '</div>';
    }
}
function woo_allergenen_tab_content() {
    global $product;
    $allergenen = get_field('allergenen', $product->get_id() );
    if( !empty($allergenen) ){
        echo '<div class="allergenen-content">';
        echo wpautop( $allergenen );
        echo '</div>';
    }
}

add_filter( 'woocommerce_product_tabs', 'woo_rename_tab', 98);
function woo_rename_tab($tabs) {
$tabs['reviews']['title'] = 'Klanten reviews';
return $tabs;
}

/**
 * Build a custom query based on several conditions
 * The pre_get_posts action gives developers access to the $query object by reference
 * any changes you make to $query are made directly to the original object - no return value is requested
 *
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
 *
 */
function sm_pre_get_posts( $query ) {
    // check if the user is requesting an admin page 
    // or current query is not the main query
    if ( is_admin() || ! $query->is_main_query() ){
        return;
    }

    // edit the query only when post type is 'accommodation'
    // if it isn't, return
    if ( !is_post_type_archive( 'product' ) ){
        return;
    }
    $post_type = 'product';
    $meta_query = array();
    $keyword = '';

    if( isset($_GET['keyword']) && !empty($_GET['keyword']) ){
        $keyword = $_GET['keyword'];
    }

    if( !empty( $keyword ) ){
        $query->set('post_type', $post_type);
        $query->set( 's', $keyword );
        //$query->set( 'category_name', $keyword );
    }
    return $query;
    
}
add_action( 'pre_get_posts', 'sm_pre_get_posts', 1 );

add_action( 'woocommerce_product_options_inventory_product_data', 'misha_adv_product_options');
function misha_adv_product_options(){
 
    echo '<div class="options_group">';
 
    woocommerce_wp_text_input( array(
        'id'      => 'product_min_qty',
        'value'   => get_post_meta( get_the_ID(), 'product_min_qty', true ),
        'label'   => __('Product Min Quantity', 'woocommerce'),
        'type' => 'number',
        'custom_attributes' => array(
        'step' => 'any',
        'min' => '0'
        )
    ));
     woocommerce_wp_text_input( array(
        'id'      => 'product_max_qty',
        'value'   => get_post_meta( get_the_ID(), 'product_max_qty', true ),
        'label'   => __('Product Max Quantity', 'woocommerce'),
        'type' => 'number',
        'custom_attributes' => array(
        'step' => 'any',
        )
    ));
    echo '</div>';
 
}
 
 
add_action( 'woocommerce_process_product_meta', 'misha_save_fields', 10, 2 );
function misha_save_fields( $id, $post ){
 
    //if( !empty( $_POST['super_product'] ) ) {
        update_post_meta( $id, 'product_min_qty', $_POST['product_min_qty'] );
        update_post_meta( $id, 'product_max_qty', $_POST['product_max_qty'] );
    //} else {
    //  delete_post_meta( $id, 'super_product' );
    //}
 
}


function product_min_qty($product_id = '', $_product = array()){
    global $product;
    if( !empty($product_id) ){
        $get_id = $product_id;
    }
    else{
        $get_id = $product->get_id();
    }
    if( !empty($_product) && $_product ){
        $product = $_product;
    }

    $minQty = get_post_meta( $get_id, 'product_min_qty', true );
    if( !empty($minQty) && $minQty > 0 ){
        $get_min_purchase_qty = $minQty;
    }else{
        $get_min_purchase_qty = $product->get_min_purchase_quantity();
    }
    return $get_min_purchase_qty;
}
function product_max_qty($product_id = '', $_product = array()){
    global $product;
    if( !empty($product_id) ){
        $get_id = $product_id;
    }
    else{
        $get_id = $product->get_id();
    }

    if( !empty($_product) && $_product ){
        $product = $_product;
    }
    
    $maxQty = get_post_meta( $get_id, 'product_max_qty', true );
    if( !empty($maxQty) && $maxQty > 0 ){
        $get_max_purchase_qty = $maxQty;
    }else{
        $get_max_purchase_qty = $product->get_max_purchase_quantity();
    }
    return $get_max_purchase_qty;
}

// custom cbv_catalog hook
add_action('cbv_catalog', 'cbv_catalog_ordering');

function cbv_catalog_ordering() {
    global $wp_query;

    if ( 1 == $wp_query->found_posts || ! woocommerce_products_will_display() ) {
        return;
    }

    $orderby                 = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
    $show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
    $catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
        'menu_order' => __( 'Default sorting', 'woocommerce' ),
        'popularity' => __( 'Sort by popularity', 'woocommerce' ),
        'rating'     => __( 'Sort by average rating', 'woocommerce' ),
        'date'       => __( 'Sort by newness', 'woocommerce' ),
        'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
        'price-desc' => __( 'Sort by price: high to low', 'woocommerce' )
    ) );

    if ( ! $show_default_orderby ) {
        unset( $catalog_orderby_options['menu_order'] );
    }

    if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
        unset( $catalog_orderby_options['rating'] );
    }

    if( get_option('woocommerce_enable_review_rating') == 'no' && get_option('woocommerce_default_catalog_orderby') == 'rating') {
        update_option('woocommerce_default_catalog_orderby', 'date');
    }

    wc_get_template( 'loop/orderby.php', array( 'catalog_orderby_options' => $catalog_orderby_options, 'orderby' => $orderby, 'show_default_orderby' => $show_default_orderby ) );
}

/* Custom Product data tab  */

/*add_filter( 'woocommerce_product_data_tabs', 'wc_add_my_custom_product_data_tab' );
function wc_add_my_custom_product_data_tab( $product_data_tabs ) {
    $product_data_tabs['min_max_qty-tab'] = array(
        'label' => __( 'Min/Max Quantity', 'woocommerce' ),
        'target' => 'wc_min_max_qty_product_data',
    );
    return $product_data_tabs;
}
add_action( 'woocommerce_product_data_panels', 'wc_add_my_custom_product_data_fields' );
function wc_add_my_custom_product_data_fields() {
    global $woocommerce, $post;
    ?>
    <!-- id below must match target registered in above add_my_custom_product_data_tab function -->
    <div id="wc_min_max_qty_product_data" class="panel woocommerce_options_panel">
        <?php
            woocommerce_wp_text_input( array(
                'id'      => 'product_min_qty',
                'value'   => get_post_meta( get_the_ID(), 'product_min_qty', true ),
                'label'   => __('Product Min Quantity', 'woocommerce'),
                'type' => 'number',
                'custom_attributes' => array(
                'step' => 'any',
                'min' => '0'
                )
            ));
             woocommerce_wp_text_input( array(
                'id'      => 'product_max_qty',
                'value'   => get_post_meta( get_the_ID(), 'product_max_qty', true ),
                'label'   => __('Product Max Quantity', 'woocommerce'),
                'type' => 'number',
                'custom_attributes' => array(
                'step' => 'any',
                )
            ));
        ?>
    </div>
    <?php

}*/

include_once(THEME_DIR .'/inc/wc-manage-fields.php');
