<?php

    include plugin_dir_path(__FILE__) . 'partials/head.php';
    
    wp_enqueue_script( 'vue', plugins_url('steem-wp/vendor/vue/vue.js'), false );
    wp_enqueue_script( 'steemwp-dsteem-js', plugins_url('steem-wp/vendor/dsteem/dsteem.js'), false );
    wp_enqueue_script( 'steemwp-dashboard-js', plugins_url('steem-wp/src/ui/admin/vue/about.js'), false, STEEMWP_VERSION );

?>

<div class="steemwp-container">

    <?php include plugin_dir_path(__FILE__) . 'partials/header.php';?>
    
        <div class="steemwp-row row">
        
            <div class="five columns steemwp-columns" style="border-right: 1px solid #fafafa; padding-right: 2rem">
                    
                <h5>Steem WP</h5>
                
                <h6>The complete Steem solution for your Wordpress blog.</h6>
                
                <br/>
                
                <p>
                    <b>Steem WP by the <a href="https://steemstudios.com" target="_blank">Steem Studios</a> and allows you to fully harness the power of the world's most powerful content Blockchain on the world's most popular CMS.</b>
                </p>
                
                <div style="margin-top: 1rem">
                    <a href="https://steemwp.com" target="_blank" class="steemwp-button"> Visit our site</a>
                </div>
                
                <div style="margin-top: 5rem">
                    <a href="https://facebook.com/steemstudios" target="_blank" class="steemwp-social" style="background-color: #3D5B94;">f</a>
                    <a href="https://twitter.com/steemstudios" target="_blank" class="steemwp-social" style="background-color: #3DACDD;">t</a>
                    <a href="https://linkedin.com/company/steemstudios" class="steemwp-social" style="background-color: #1E83AE;">in</a>
                  <a href="https://steem.online/@steemwp.com" target="_blank" class="steemwp-social" style="background-color: #33C3F0;">s</a>
                </div>
                
            </div>
            
            
            <div class="seven columns steemwp-columns">
            
                <h5>From our blog</h5>
                
                <div id="app"> <div class="steemwp-loader"></div> </div>
                
            </div>
            
        </div>
        
    <?php include plugin_dir_path(__FILE__) . 'partials/footer.php';?>

</div>