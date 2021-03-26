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
        $gridurl = cbv_get_image_src( get_post_thumbnail_id($product->get_id()), 'pgrid' );
        echo '<div class="product-loop-crtl">';
        echo '<div class="pro-item-img-cntlr pw-item-img-cntlr">';
        echo '<a class="overlay-link" href="'.get_permalink( $product->get_id() ).'"></a>';
        echo '<div class="pro-item-img dft-transition inline-bg" style="background-image: url('.$gridurl.');"></div>';
        echo '</div>';/*end loop image*/
        echo '<div class="pro-item-desc pw-item-desc">';
        echo '<h3 class="pro-item-desc-title"><a href="'.get_permalink( $product->get_id() ).'">'.get_the_title().'</a></h3>';
        echo '</div>';/*end loop description*/
        echo '<div class="product-price">';
        echo $product->get_price_html();
        echo '</div>';/*end loop price*/
        echo '<div class="loop-btn-crtl"><a href="'.get_permalink( $product->get_id() ).'">MEER INFO</a></div>';
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
  $cols = 4;
  return $cols;
}


add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
function jk_related_products_args( $args ) {
$args['posts_per_page'] = 4; // 4 related products
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
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


add_action('woocommerce_single_product_summary', 'add_custom_box_product_summary', 5);
if (!function_exists('add_custom_box_product_summary')) {
    function add_custom_box_product_summary() {
        global $product, $woocommerce, $post;
        $sh_desc = $product->get_short_description();
        $long_desc = $product->get_description();
        $product_usps = get_field('product_usps', 'options' );
        $sh_desc = !empty($sh_desc)?$sh_desc:'';

            echo '<div class="summary-ctrl">';
            echo '<div class="summary-hdr">';
            echo '<h1 class="product_title entry-title">'.$product->get_title().'</h1>';
            if( !empty($sh_desc) ){
                echo '<div class="short-desc">';
                echo wpautop( $sh_desc, true );
                echo '</div>';
            }
            if( !empty($long_desc) ){
                echo '<div class="long-desc">';
                echo '<h2>Beschrijving</h2>';
                echo wpautop( $long_desc, true );
                echo '</div>';
            }
            echo '</div>';
            echo '<div class="meta-crtl">';
            echo '<ul>';
                echo '<li>';
                    echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in"><strong>' .esc_html__( 'Categorie', 'woocommerce' ). '</strong> ', '</span>' );
                echo '</li>';
                if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) :
                cbv_display_some_product_attributes();
                echo '<li>';
                    echo '<strong>';
                    esc_html_e( 'SKU:', 'woocommerce' );
                    echo '</strong>';
                    echo '<span class="sku">'.( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ).'</span>';
                echo '</li>';
                endif;
            echo '</ul>';
            echo '</div>';
            echo '<div class="price-quentity-ctrl">';
              woocommerce_template_single_add_to_cart();
            echo '</div>';
            echo '</div>';

    }
}

add_action('woocommerce_before_add_to_cart_quantity', 'cbv_start_div_single_price');
function cbv_start_div_single_price(){
    echo '<div class="cartbtn-wrap clearfix"><strong>Aantal</strong><div class="cart-btn-qty">';
    echo '<div class="quantity qty"><span class="minus">-</span>';
}
add_action('woocommerce_after_add_to_cart_quantity', 'cbv_get_single_price');
function cbv_get_single_price(){
    global $product;
    echo '<span class="plus">+</span></div>';
    echo '</div></div>';
    echo '<div class="qty-price-wrap">';
    echo $product->get_price_html();
    echo '</div>';
}


// Change 'add to cart' text on single product page (only for product ID 386)
add_filter( 'woocommerce_product_single_add_to_cart_text', 'bryce_id_add_to_cart_text' );
function bryce_id_add_to_cart_text( $default ) {
        return __( 'In Winkelmand', THEME_NAME );
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
function projectnamespace_woocommerce_text( $translated, $text, $domain ) {
    if ( $domain === 'woocommerce' ) {
        $translated = str_replace(
            array( 'Related Products' ),
            array( 'Gerelateerde Producten'),
            $translated
        );
    }

    return $translated;
}

add_filter( 'gettext', 'projectnamespace_woocommerce_text', 30, 3 );


include_once(THEME_DIR .'/inc/wc-manage-fields.php');

function cbv_display_some_product_attributes(){
    global $product;
    $formatted_attributes = array();
    $attributes = $product->get_attributes();
    if($attributes):
        foreach($attributes as $attr => $attr_deets){

            $attribute_label = wc_attribute_label($attr);

            if ( isset( $attributes[ $attr ] ) || isset( $attributes[ 'pa_' . $attr ] ) ) {

                $attribute = isset( $attributes[ $attr ] ) ? $attributes[ $attr ] : $attributes[ 'pa_' . $attr ];

                if ( $attribute['is_taxonomy'] ) {
                    echo '<li><span class="pro-attribute">';
                        echo '<strong>'.$attribute_label.': </strong>';
                        echo implode( ', ', wc_get_product_terms( $product->get_id(), $attribute['name'], array( 'fields' => 'names' ) ) );
                    echo '</span></li>';

                } else {
                    echo '<li><span class="pro-attribute">';
                        echo '<strong>'.$attribute_label.': </strong>';
                    echo $attribute['value'];
                    echo '</span></li>';
                }

            }
        }
    endif;
}