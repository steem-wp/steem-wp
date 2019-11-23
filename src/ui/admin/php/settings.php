<?php
    
    include plugin_dir_path(__FILE__) . 'partials/head.php';
    
    wp_enqueue_script( 'vue', plugins_url('steem-wp/vendor/vue/vue.js'), false );
    wp_enqueue_script( 'steemwp-settings-js', plugins_url('steem-wp/src/ui/admin/vue/settings.js'), false, STEEMWP_VERSION );
    
?>
<div class="steemwp-container">

    <?php include plugin_dir_path(__FILE__) . 'partials/header.php';?>
    
    <div id="app">
        <div class="steemwp-loader"></div>
    </div>
    
    <?php include plugin_dir_path(__FILE__) . 'partials/footer.php';?>

</div>

<script>
  var _settingsData = {
    account: "<?php echo STEEMWP_ACTIVE_ACCOUNT; ?>",
    action: "<?php echo esc_url( admin_url('admin-post.php') ); ?>?action=steemwp_revoke"
  }
</script>
