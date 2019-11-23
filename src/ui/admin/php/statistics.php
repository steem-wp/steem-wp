<?php
    
    include plugin_dir_path(__FILE__) . 'partials/head.php';
    
    wp_enqueue_script( 'vue', plugins_url('steem-wp/vendor/vue/vue.js'), false );
    wp_enqueue_script( 'dsteem', plugins_url('steem-wp/vendor/dsteem/dsteem.js'), false );
    wp_enqueue_script( 'apexcharts', plugins_url('steem-wp/vendor/apexcharts/apexcharts.min.js'), false );
    wp_enqueue_script( 'apexcharts-vue', plugins_url('steem-wp/vendor/apexcharts/vue-apexcharts.js'), false );
    wp_enqueue_script( 'steemwp-dashboard-js', plugins_url('steem-wp/src/ui/admin/vue/statistics.js'), false, STEEMWP_VERSION );
    
?>
<div class="steemwp-container">

    <?php include plugin_dir_path(__FILE__) . 'partials/header.php';?>
    
    <div id="app">
        <div class="steemwp-loader"></div>
    </div>

    <?php include plugin_dir_path(__FILE__) . 'partials/footer.php';?>

</div>

<script>
  var _statisticsData = {
    account: "<?php echo STEEMWP_ACTIVE_ACCOUNT; ?>"
  }
  
</script>
