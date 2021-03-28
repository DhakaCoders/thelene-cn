<?php
add_action('wp_enqueue_scripts', 'wc_user_signup_action_hooks');

function wc_user_signup_action_hooks(){
        ajax_wc_user_signup_init();
}
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



function ajax_wc_user_signup_init(){
    wp_register_script('ajax-user-register-script', get_stylesheet_directory_uri(). '/assets/js/ajax-action.js', array('jquery') );
    wp_enqueue_script('ajax-user-register-script');

    wp_localize_script( 'ajax-user-register-script', 'ajax_user_register_signup_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));
    // Enable the user with no privileges to run ajax_login() in AJAX
}
add_action('wp_ajax_nopriv_ajax_register_save', 'ajax_register_save');
//add_action('wp_ajax_ajax_register_save', 'ajax_register_save');
function ajax_register_save(){
    $data = array();
    if (isset( $_POST["billing_email_2"] ) && wp_verify_nonce($_POST['user_register_nonce'], 'user-register-nonce')) {

        if( isset($_POST['billing_email']) && !empty($_POST['billing_email'])){
            $email = sanitize_email($_POST['billing_email']);
        }else{
            $email = sanitize_email($_POST['billing_email_2']);
        }
        if( isset($_POST['password']) && !empty($_POST['password'])){
            $user_password = $_POST['password'];
        }
        $firstname = (isset($_POST['billing_first_name']) && !empty($_POST['billing_first_name']))? $_POST['billing_first_name']:'';
        $lastname = (isset($_POST['billing_last_name']) && !empty($_POST['billing_first_name']))? $_POST['billing_last_name']:'';
        if(isset($email) && !empty($email)){
            $exp = explode('@', $email);
            $user_login = $exp[0];

        }
        if(email_exists($email)) {
            //Email address already registered
            $data['email'] = 'Email already registered';
        }else{
            $customerId = wp_insert_user(array(
                'user_login'        => $user_login,
                'user_pass'         => $user_password,
                'user_email'        => $email,
                'first_name'        => $firstname,
                'last_name'         => $lastname,
                'user_registered'   => date('Y-m-d H:i:s'),
                'role'              => 'customer'
                )
            );
            if( $customerId ){
                if( isset($_POST['billing_order_type']) && !empty($_POST['billing_order_type'])){
                    update_user_meta( $customerId, "billing_order_type", $_POST['billing_order_type'] );

                    if( $_POST['billing_order_type'] == 'Zakelijk' ){
                        if( isset($_POST['billing_company']) && !empty($_POST['billing_company'])){
                            update_user_meta( $customerId, "billing_company", $_POST['billing_company'] );
                        }
                        if( isset($_POST['billing_btw_nummer']) && !empty($_POST['billing_btw_nummer'])){
                            update_user_meta( $user, "billing_btw_nummer", $_POST['billing_btw_nummer'] );
                        }
                        if( isset($_POST['billing_reference']) && !empty($_POST['billing_reference'])){
                            update_user_meta( $customerId, "billing_reference", $_POST['billing_reference'] );
                        }
                    }
                }

                if( isset($_POST['billing_salutation']) && !empty($_POST['billing_salutation'])){
                    update_user_meta( $customerId, "billing_salutation", $_POST['billing_salutation'] );
                }
                if( !empty($firstname) ){
                    update_user_meta( $customerId, "billing_first_name", $firstname );
                }
                if( !empty($lastname) ){
                    update_user_meta( $customerId, "billing_last_name", $lastname );
                }
                if( isset($_POST['billing_email_2']) && !empty($_POST['billing_email_2']) ){
                    update_user_meta( $user, "billing_email_2", $_POST['billing_email_2'] );
                }
                if( isset($_POST['billing_email']) && !empty($_POST['billing_email']) ){
                    update_user_meta( $customerId, "billing_email", $_POST['billing_email'] );
                }

                if( isset($_POST['billing_address_1']) && !empty($_POST['billing_address_1']) ){
                    update_user_meta( $customerId, "billing_address_1", $_POST['billing_address_1']);
                }
                if( isset($_POST['billing_address_2']) && !empty($_POST['billing_address_2']) ){
                    update_user_meta( $customerId, "billing_address_2", $_POST['billing_address_2'] );
                }
                if( isset($_POST['billing_house']) && !empty($_POST['billing_house']) ){
                    update_user_meta( $customerId, "billing_house", $_POST['billing_house'] );
                }

                if( isset($_POST['billing_city']) && !empty($_POST['billing_city']) ){
                    update_user_meta( $customerId, "billing_city", $_POST['billing_city']);
                }
                if( isset($_POST['billing_postcode']) && !empty($_POST['billing_postcode']) ){
                    update_user_meta( $customerId, "billing_postcode", $_POST['billing_postcode'] );
                }
                if( isset($_POST['billing_country']) && !empty($_POST['billing_country'])){
                    update_user_meta( $customerId, "billing_country", $_POST['billing_country']);
                }
                if( isset($_POST['billing_gsm_number']) && !empty($_POST['billing_gsm_number'])){
                    update_user_meta( $customerId, "billing_gsm_number", $_POST['billing_gsm_number'] );
                }
                if( isset($_POST['billing_phone']) && !empty($_POST['billing_phone'])){
                    update_user_meta( $customerId, "billing_phone", $_POST['billing_phone'] );
                }
                $user = get_user_by( 'id', $customerId );
                if($user){
                    wp_clear_auth_cookie();
                    wp_set_current_user( $user->ID, $user->user_login );
                    if (wp_validate_auth_cookie()==FALSE)
                    {
                        wp_set_auth_cookie($user->ID, false, true);
                    }
                    //do_action( 'wp_login', $user->user_login );
                    if ( is_user_logged_in() ){
                        $data['user_name'] = $user->user_login;
                        $data['login_success'] = 'Login successful. Please wait a seccound...';
                        $data['status'] = 'success';
                        echo json_encode($data);
                        wp_die();
                    }
                }

            }
            $data['status'] = 'error';
        }
        echo json_encode($data);
        wp_die();
    }
}