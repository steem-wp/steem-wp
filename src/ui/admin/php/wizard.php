<?php

    include plugin_dir_path(__FILE__) . 'partials/head.php';

?>

<div class="steemwp-container">

    <?php include plugin_dir_path(__FILE__) . 'partials/header.php';?>
    
        <div style="text-align: center">
            <h6>Getting started</h6>
        </div>
        
        <div class="steemwp-section" style="text-align: center">
        
            <a class="steemwp-tile" href="<?php echo esc_url( admin_url('admin.php') ); ?>?page=steemwp">
                <div class="dashicons dashicons-smiley"></div>
                <div class="header">Dashboard</div>
                <div class="footer">Insights and usage stats</div>
            </a>
        
            <a class="steemwp-tile" href="<?php echo esc_url( admin_url('admin.php') ); ?>?page=steemwp-trends">
                <div class="dashicons dashicons-smiley"></div>
                <div class="header">Trends</div>
                <div class="footer">Discover trending keywords</div>
            </a>
        
            <a class="steemwp-tile" href="<?php echo esc_url( admin_url('admin.php') ); ?>?page=steemwp-support">
                <div class="dashicons dashicons-smiley"></div>
                <div class="header">Support</div>
                <div class="footer">Get support for Steem WP</div>
            </a>
        
        </div>
        
        
        <div style="text-align: center">
            <h6>Recommended resources</h6>
        </div>
        
        <div class="steemwp-section" style="text-align: center">
        
            <a class="steemwp-tile" href="https://steemium.com">
                <div class="dashicons dashicons-smiley"></div>
                <div class="header">Steemium</div>
                <div class="footer">Smart post promotion and financing</div>
            </a>
        
            <a class="steemwp-tile" href="https://steemmetrics.com" target="_blank">
                <div class="dashicons dashicons-smiley"></div>
                <div class="header">Steem Metrics</div>
                <div class="footer">Graphic insights of the Steem economy</div>
            </a>
        
        </div>
        
        
    <?php include plugin_dir_path(__FILE__) . 'partials/footer.php';?>

</div>