<?php

    function steemwp_plugin_activation() {
        
        delete_option ( STEEMWP_AUTH_GROUP );
            
        $steemwp_auth = array(
            "account" => "",
            "token" => "",
            "expiry" => time(),
            "scope" => array(),
            "state" => "active",
            "created" => time()
        );
        
        add_option ( STEEMWP_AUTH_GROUP , serialize ( $steemwp_auth ) );
        
        function steemwp_deactivation( $plugin ) {
            
            exit( wp_redirect( home_url() . '/wp-admin/admin.php?page=steemwp' ) );
            
        }
        
        add_action( 'activated_plugin', 'steemwp_deactivation' );
        
    }
    
    register_activation_hook( STEEMWP_FILE, 'steemwp_plugin_activation' );
    
?>