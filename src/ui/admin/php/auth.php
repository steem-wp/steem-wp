<?php

    include plugin_dir_path(__FILE__) . 'partials/head.php';
    
?>

<div class="steemwp-container">

    <?php include plugin_dir_path(__FILE__) . 'partials/header.php';?>
    
        <h4>Connect using Steem Connect</h4>
        
        <br/>
        
        <p>
            <b>Securely link your account to the Wordpress using the secure Steem Connect. No keys are required, accessed or stored by the Wordpress. Disconnect anytime.</b>
        </p>
        
        <div style="margin-top: 1rem">
            <a href="<?php echo SC_LOGIN_URL ?>" class="steemwp-button"> Secure connect</a>
        </div>
        
        <div style="margin-top: 5rem">
          <a href="https://facebook.com/steemstudios" target="_blank" class="steemwp-social" style="background-color: #3D5B94;">f</a>
          <a href="https://twitter.com/steemstudios" target="_blank" class="steemwp-social" style="background-color: #3DACDD;">t</a>
          <a href="https://linkedin.com/company/steemstudios" class="steemwp-social" style="background-color: #1E83AE;">in</a>
          <a href="https://steem.online/@steemwp.com" target="_blank" class="steemwp-social" style="background-color: #33C3F0;">s</a>
        </div>
        
    <?php include plugin_dir_path(__FILE__) . 'partials/footer.php';?>

</div>