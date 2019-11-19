<?php

    function steemwp_plugin_deactivation() {
        
        delete_option ( STEEMWP_AUTH_GROUP );
        //log out of steem connect
        
    }
    
    register_deactivation_hook( STEEMWP_FILE , 'steemwp_plugin_deactivation' );
    
?>