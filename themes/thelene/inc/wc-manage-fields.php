<?php
add_action('wp_enqueue_scripts', 'wc_user_signup_action_hooks');

function wc_user_signup_action_hooks(){
        ajax_wc_user_signup_init();
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
        $lastname = (isset($_POST['billing_last_name']) && !empty($_POST['billing_last_name']))? $_POST['billing_last_name']:'';
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
//add_action('init', 'registered_user_info_update');
function registered_user_info_update($post){
    $data = array();
    if (isset( $post["account_email"] ) && isset($post['user_id'])) {
        
        $user_password = $email = '';
        if( isset($post['account_email']) && !empty($post['account_email'])){
            $email = sanitize_email($post['account_email']);
        }
        if( isset($post['password']) && !empty($post['password'])){
            $user_password = $post['password'];
        }
        if( isset($post['user_id']) && !empty($post['user_id'])){
            $userID = $post['user_id'];
        }else{
            $user = wp_get_current_user();
            $userID = $user->ID;
        }
        $firstname = (isset($post['account_first_name']) && !empty($post['account_first_name']))? $post['account_first_name']:'';
        $lastname = (isset($post['account_last_name']) && !empty($post['account_last_name']))? $post['account_last_name']:'';
        if( !empty($userID) ){
            if( empty($user_password)){
                $customerId = wp_update_user(array(
                    'ID'                => $userID,
                    'user_email'        => $email,
                    'first_name'        => $firstname,
                    'last_name'         => $lastname
                    )
                );
            }else{
                $customerId = wp_update_user(array(
                    'ID'                => $userID,
                    'user_pass'         => $user_password,
                    'user_email'        => $email,
                    'first_name'        => $firstname,
                    'last_name'         => $lastname
                    )
                );
            }
            if( $customerId ){
                if( !empty($firstname) ){
                    update_user_meta( $customerId, "billing_first_name", $firstname );
                }
                if( !empty($lastname) ){
                    update_user_meta( $customerId, "billing_last_name", $lastname );
                }
                if( isset($post['account_email']) && !empty($post['account_email']) ){
                    update_user_meta( $customerId, "billing_email", $post['account_email'] );
                }

                if( isset($post['billing_address_1']) && !empty($post['billing_address_1']) ){
                    update_user_meta( $customerId, "billing_address_1", $post['billing_address_1']);
                }
                if( isset($post['billing_house']) && !empty($post['billing_house']) ){
                    update_user_meta( $customerId, "billing_house", $post['billing_house'] );
                }

                if( isset($post['billing_city']) && !empty($post['billing_city']) ){
                    update_user_meta( $customerId, "billing_city", $post['billing_city']);
                }
                if( isset($post['billing_postcode']) && !empty($post['billing_postcode']) ){
                    update_user_meta( $customerId, "billing_postcode", $post['billing_postcode'] );
                }
                if( isset($post['billing_gsm_number']) && !empty($post['billing_gsm_number'])){
                    update_user_meta( $customerId, "billing_gsm_number", $post['billing_gsm_number'] );
                }
                if( isset($post['billing_phone']) && !empty($post['billing_phone'])){
                    update_user_meta( $customerId, "billing_phone", $post['billing_phone'] );
                }
                $data['success'] = 'Updated';
            }else{
              $data['error'] = 'Could not update';  
            }
            
        }else{
            $data['error'] = 'Could not update';  
        }
        
    }
    return $data;
}


function cbv_my_custom_endpoints() {
    add_rewrite_endpoint( 'winkelmandje', EP_ROOT | EP_PAGES );
}

add_action( 'init', 'cbv_my_custom_endpoints' );

function cbv_my_custom_query_vars( $vars ) {
    $vars[] = 'winkelmandje';

    return $vars;
}

add_filter( 'query_vars', 'cbv_my_custom_query_vars', 0 );

function cbv_my_custom_flush_rewrite_rules() {
    flush_rewrite_rules();
}

add_action( 'wp_loaded', 'cbv_my_custom_flush_rewrite_rules' );