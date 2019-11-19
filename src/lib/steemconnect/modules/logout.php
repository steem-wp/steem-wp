<?php
    
    function logout() {
        
        $query = array (
            'header' => array (
                'authorization: ' . STEEMWP_ACCESS_TOKEN,
                'cache-control: no-cache',
                'content-type: application/json'
            ),
            'method' => 'POST',
            'url' => SC_REVOKE_URL
        );
        
        include STEEMWP_DIR_PATH . '/src/helpers/curl.php';
        $response = curl($query);
        
        delete_option( STEEMWP_AUTH_GROUP );
        
        exit ( wp_redirect( home_url() . '/wp-admin/admin.php?page=steemwp' ) );
        
    }
    
    add_action( 'admin_post_steemwp_revoke', 'logout' );
    
?>