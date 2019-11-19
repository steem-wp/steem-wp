<?php
    
    include plugin_dir_path(__FILE__) . 'partials/head.php';
    
    wp_enqueue_script( 'vue', plugins_url('steemwp/vendor/vue/vue.js'), false );
    
    wp_enqueue_script( 'apexcharts', plugins_url('steemwp/vendor/apexcharts/apexcharts.min.js'), false );
    wp_enqueue_script( 'apexcharts-vue', plugins_url('steemwp/vendor/apexcharts/vue-apexcharts.js'), false );
    
    wp_enqueue_script( 'dsteem', plugins_url('steemwp/vendor/dsteem/dsteem.js'), false );
    wp_enqueue_script( 'steemwp-trends-js', plugins_url('steemwp/src/ui/admin/vue/trends.js'), false, time() );
    
?>
<div class="steemwp-container">

    <?php include plugin_dir_path(__FILE__) . 'partials/header.php';?>
    
    <div id="app">
    </div>
    
    <?php include plugin_dir_path(__FILE__) . 'partials/footer.php';?>

</div>

<script>
  var _dashboardData = {
    logo: "<?php echo STEEMWP_LOGO_URL; ?>",
  }
  
</script>
