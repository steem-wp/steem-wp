<?php

    function GENERATE_VIRTUAL_STEEMWP_AUTH_PAGE( $posts ) {
        
        global $wp;

        if ( ! defined( 'VIRTUAL_STEEMWP_AUTH_PAGE' ) && ( strtolower( $wp->request ) == STEEMWP_SC_AUTH_URL ) ) {
            
            //Now we need to make sure that both the required variables are set

            if (isset($_GET['access_token']) and isset($_GET['expires_in'])) {
                //Set the session's code to the access_token from steemConnect
                
                $steemwp_auth = unserialize ( get_option( STEEMWP_AUTH_GROUP ) ) ?? array();
                
                include STEEMWP_DIR_PATH . '/src/helpers/validate.php';

                $account = validateAccount ( sanitize_text_field ( $_GET['username'] ) );
                $token = sanitize_text_field ( $_GET['access_token'] );
                $expiry = time() +  intval ( $_GET['expires_in'] );
                $scope = sanitize_text_field ( $_GET['scope'] ) || 'posting';

                if ($account && $token && $expiry && $scope) {

                    $steemwp_auth['account'] = $account;
                    $steemwp_auth['token'] = $token;
                    $steemwp_auth['expiry'] = $expiry;
                    $steemwp_auth['scope'] = $scope;
                    
                    $params = array (
                        'method' => 'POST'
                    );
                    
                    include STEEMWP_DIR_PATH . '/src/helpers/remote.php';
                    $response = remote(STEEMWP_SC_VERIFY_URL, $params);

                    if($response && !$response->error) update_option( STEEMWP_AUTH_GROUP, serialize ( $steemwp_auth ) );
                }
                
                exit ( wp_redirect( home_url() . '/wp-admin/admin.php?page=steemwp' ) );
                
            }
            
        }

        return $posts;
    }

    add_filter( 'the_posts', 'GENERATE_VIRTUAL_STEEMWP_AUTH_PAGE', -10 );  

?>