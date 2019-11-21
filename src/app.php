<?php
    
    class SteemWP_App {
        
        public function __construct() {
            
            require_once('constants.php');
            require_once('modules/index.php');
            require_once('lib/index.php');
            require_once('hooks/index.php');
        
        }
        
    }

    new SteemWP_App();

?>