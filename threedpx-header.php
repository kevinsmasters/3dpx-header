<?php
/**
 * Plugin Name: 3DPX Header
 * Description: Hero Header Timeline.
 * Version: 1.0
 * Author: Kevin Masters
 * Author URI: http://www.kevinmasters.com
 */

 // no direct access
 if(!defined('ABSPATH')) {
     exit;
 }

 // load scripts
require_once(
    plugin_dir_path(__FILE__). '/includes/threedpx-header-scripts.php'
);

// load class
require_once(
    plugin_dir_path(__FILE__). '/includes/threedpx-header-class.php'
);
