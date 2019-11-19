<?php

    // Admin page calls:
    add_action( 'admin_menu', 'addAdminMenu' );
            
    function addAdminMenu()
    {
        
        if (STEEMWP_ACTIVE_ACCOUNT == '') {
            
            add_menu_page('Steem WP', 'Steem WP', 'manage_options', 'steemwp', 'loadView', STEEMWP_LOGO_DATA, 80 );
            
        } else {
                
            add_menu_page('Steem WP', 'Steem WP', 'manage_options', 'steemwp', 'loadView', STEEMWP_LOGO_DATA, 80 );
            add_submenu_page( 'steemwp', 'Dashboard', 'Dashboard', 'manage_options', 'steemwp', 'loadView' );
            add_submenu_page( 'steemwp', 'Statistics', 'Statistics', 'manage_options', 'steemwp-statistics', 'loadView' );
            add_submenu_page( 'steemwp', 'Wizard', 'Wizard', 'manage_options', 'steemwp-wizard', 'loadView' );
            add_submenu_page( 'steemwp', 'Trends', 'Trends', 'manage_options', 'steemwp-trends', 'loadView' );
            add_submenu_page( 'steemwp', 'Settings', 'Settings', 'manage_options', 'steemwp-settings', 'loadView' );
            add_submenu_page( 'steemwp', 'Support', 'Support', 'manage_options', 'steemwp-support', 'loadView' );
            add_submenu_page( 'steemwp', 'About us', 'About us', 'manage_options', 'steemwp-about', 'loadView' );
        
        }
    }
    
    function loadView() {
            $page = get_admin_page_title();
            
            switch ($page) {
                case "Steem WP":
                    require_once(plugin_dir_path(__FILE__) . '../ui/admin/php/auth.php');
                    break;
                case "Dashboard":
                    require_once(plugin_dir_path(__FILE__) . '../ui/admin/php/dashboard.php');
                    break;
                case "Wizard":
                    require_once(plugin_dir_path(__FILE__) . '../ui/admin/php/wizard.php');
                    break;
                case "Statistics":
                    require_once(plugin_dir_path(__FILE__) . '../ui/admin/php/statistics.php');
                    break;
                case "Trends":
                    require_once(plugin_dir_path(__FILE__) . '../ui/admin/php/trends.php');
                    break;
                case "Settings":
                    require_once(plugin_dir_path(__FILE__) . '../ui/admin/php/settings.php');
                    break;
                case "Support":
                    require_once(plugin_dir_path(__FILE__) . '../ui/admin/php/support.php');
                    break;
                case "About us":
                    require_once(plugin_dir_path(__FILE__) . '../ui/admin/php/about.php');
                    break;
                default:
                    require_once(plugin_dir_path(__FILE__) . '../ui/admin/php/coming.php');
            }
        
    }

?>
