<?php

  function steemwp_load_plugin_css() {

      wp_enqueue_style('steemwp-skeleton', plugins_url('steem-wp/assets/css/skeleton.css'), false, STEEMWP_VERSION);
      wp_enqueue_style('steemwp-custom', plugins_url('steem-wp/assets/css/custom.css'), false, STEEMWP_VERSION);

  }

  add_action( 'admin_enqueue_scripts', 'steemwp_load_plugin_css' );

?>