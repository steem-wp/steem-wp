<?php

    function GENERATE_VIRTUAL_STEEMWP_AUTH_PAGE( $posts ) {
        
        global $wp;

        if ( ! defined( 'VIRTUAL_STEEMWP_AUTH_PAGE' ) && ( strtolower( $wp->request ) == STEEMWP_SC_AUTH_URL ) ) {
            
            //Now we need to make sure that both the required variables are set

            if (isset($_GET['access_token']) and isset($_GET['expires_in'])) {
                //Set the session's code to the access_token from steemConnect
                
                $steemwp_auth = unserialize ( get_option( STEEMWP_AUTH_GROUP ) ) ?? array();
                
                $steemwp_auth['account'] = $_GET['username'];
                $steemwp_auth['token'] = $_GET['access_token'];
                $steemwp_auth['expiry'] = time() + $_GET['expires_in'];
                $steemwp_auth['scope'] = $_GET['scope'];
                
                $params = array (
                    'method' => 'POST'
                );
                
                include STEEMWP_DIR_PATH . '/src/helpers/remote.php';
                $response = remote(SC_VERIFY_URL, $params);

                if($response && !$response->error) update_option( STEEMWP_AUTH_GROUP, serialize ( $steemwp_auth ) );
                
                exit ( wp_redirect( home_url() . '/wp-admin/admin.php?page=steemwp' ) );
                
            }
            
        }

        return $posts;
    }

    add_filter( 'the_posts', 'GENERATE_VIRTUAL_STEEMWP_AUTH_PAGE', -10 );  

?>