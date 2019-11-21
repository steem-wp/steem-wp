<?php
    
    function logout() {
        
        $params = array (
            'method' => 'POST'
        );
        
        include STEEMWP_DIR_PATH . '/src/helpers/remote.php';
        $response = remote(STEEMWP_SC_REVOKE_URL, $params);
        
        delete_option( STEEMWP_AUTH_GROUP );
        
        exit ( wp_redirect( home_url() . '/wp-admin/admin.php?page=steemwp' ) );
        
    }
    
    add_action( 'admin_post_steemwp_revoke', 'logout' );
    
?>