<?php

    function steemwp_plugin_uninstall()
    {
        if ( ! current_user_can( 'activate_plugins' ) ) return;
        // check_admin_referer( 'bulk-plugins' );
        
        delete_option ( STEEMWP_AUTH_GROUP );
        delete_option ( STEEMWP_OPTIONS_GROUP );
        
        //log out of steem connect
    }

    register_uninstall_hook( STEEMWP_FILE, 'steemwp_plugin_uninstall' );

?>