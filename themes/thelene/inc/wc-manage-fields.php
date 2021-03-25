<?php
// Function to check starting char of a string
function startsWith($haystack, $needle){
    return $needle === '' || strpos($haystack, $needle) === 0;
}

add_action('init','zk_save_billing_address');
// Custom function to save Usermeta or Billing Address of registered user
function zk_save_billing_address(){
    if (isset( $_POST["action"] ) && !empty($_POST["action"])) {
        $user_id = get_current_user_id();
        global $woocommerce;
        $address = $_POST;

        foreach ($address as $key => $field){
            if(startsWith($key,'billing_')){
                // Condition to add firstname and last name to user meta table
                //var_dump($key);
                if($key == 'billing_first_name' || $key == 'billing_last_name'){
                    $new_key = explode('billing_',$key);
                    update_user_meta( $user_id, $new_key[1], $_POST[$key] );
                }
                update_user_meta( $user_id, $key, $_POST[$key] );
            }
        }
    }
    return false;
}


// Registration page billing address form Validation
function zk_validation_billing_address( $errors ) {
    $address = $_POST;
    foreach ($address as $key => $field) :
        if(startsWith($key,'billing_')){
            if($key == 'billing_country' && $field == ''){
                add_the_error($errors, $key, 'Country');
            }
            if($key == 'billing_first_name' && $field == ''){
                wc_add_notice( '<strong>Please enter first name</strong>', 'error' );
            }
            if($key == 'billing_last_name' && $field == ''){
                add_the_error($errors, $key, 'Last Name');
            }
            if($key == 'billing_address_1' && $field == ''){
                add_the_error($errors, $key, 'Address');
            }
            if($key == 'billing_city' && $field == ''){
                add_the_error($errors, $key, 'City');
            }
            if($key == 'billing_postcode' && $field == ''){
                add_the_error($errors, $key, 'Post Code');
            }
            if($key == 'billing_phone' && $field == ''){
                add_the_error($errors, $key, 'Phone Number');
            }

        }
    endforeach;

    return $errors;
}
add_action( 'woocommerce_custom_account_content', 'zk_validation_billing_address' );

function add_the_error( $errors, $key, $field_name ) {
    echo sprintf( __( '<p class="field-error">%s is a required field.</p>', 'iconic' ), '<strong>' . $field_name . '</strong>' );
}

add_action('init', function() {
    add_rewrite_endpoint('my-orders', EP_ROOT | EP_PAGES);
});

add_action('woocommerce_account_my-orders_endpoint', function() {
    $order_id = get_query_var('my-orders');
    $cbvorders = [];  // Function to return licenses for order ID
 
    wc_get_template('myaccount/cbv-orders.php', [
        'cbvorder' => $cbvorders,
        'order_id' => $order_id
    ]);
});