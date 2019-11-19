<?php
/**
 * Plugin Name:       Steem WP
 * Plugin URI:        https://github.com/steem-wp/steemwp
 * Description:       Complete Steem solutions for Wordpress!
 * Version:           0.0.1
 * Author:            Steem WP
 * Author URI:        https://steemwp.com
 * Text Domain:       steemwp
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
    
    // load files only when activated
    defined( 'ABSPATH' ) OR exit;
    
    define( 'STEEMWP_DIR_PATH', plugin_dir_path( __FILE__ ) );
    define('STEEMWP_FILE', __FILE__);
    
    //main class
    if ( ! class_exists( 'SteemWP' ) ) {
         
        class SteemWP
        {
        
            // SteemWP constructor
            
            public function __construct() {
                
                require_once(plugin_dir_path(__FILE__) . '/src/app.php');
                
            }
            
        }
        
        new SteemWP();
        
    }

?>