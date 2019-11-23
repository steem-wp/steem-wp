<?php
    
    class SteemWP_App {
        
        public function __construct() {
            
            require_once('constants.php');
            require_once('modules/index.php');
            require_once('lib/index.php');
            require_once('hooks/index.php');
            require_once('ui/init.php');
        
        }
        
    }

    new SteemWP_App();

?>
