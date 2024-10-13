<?php
// add scripts
function tdpx_add_scripts(){

    // add main css
    wp_enqueue_style('tdpx-main-style', plugins_url(). '/3dpx-header/css/style.css');
    // add main JS
    wp_enqueue_script('tdpx-main-script', plugins_url(). '/3dpx-header/js/main.js', array('jquery'));

}

add_action('wp_enqueue_scripts', 'tdpx_add_scripts');
