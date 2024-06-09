<?php
/*
    Plugin Name: BD Searcher Advance
    Plugin URI: http://127.0.0.1
    Description: Searcher Advance from post and any features
    Version: 0.0.1
    Author: Innovativo
    Author URI: https://Innovativo.com
*/

function Activate (){

}

function Desactivate(){
    
}


register_activation_hook(__FILE__,'Activate');
register_deactivation_hook(__FILE__,'Desactivate');


function dbsa_get_results() {
  // var_dump(dirname(__FILE__) . '/views/shortcode-parts/search-advance-result.php');
  require_once dirname(__FILE__) . '/views/shortcode-parts/search-advance-result.php';
}

add_action('wp_ajax_nopriv_dbsa_ajax_get_result', 'dbsa_get_results');
add_action('wp_ajax_dbsa_ajax_get_result', 'dbsa_get_results');


function short_code($atts) {
  wp_enqueue_style('shortcodeCSS',plugins_url('views/css/shortcode.css',__FILE__),array(),date('U'),false);
  wp_enqueue_script('shortcodeJS',plugins_url('views/shortcodes/js/searcher-advance.js',__FILE__), array(), date('U'), false);
  wp_localize_script('shortcodeJS','dcms_vars', ['ajaxurl'=>admin_url('admin-ajax.php'),'seg'=>wp_create_nonce('seg')]);
  
  require_once dirname(__FILE__) . '/views/shortcodes/searcher-advance.php';
}


add_shortcode('bd_searcher_advance','short_code');