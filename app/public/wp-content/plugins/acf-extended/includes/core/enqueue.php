<?php

if(!defined('ABSPATH'))
    exit;

/**
 * Enqueue
 */
add_action('admin_enqueue_scripts', 'acfe_enqueue_admin');
function acfe_enqueue_admin(){
    
    // ACF Extended: Fix
    wp_enqueue_style('acf-extended-fix', plugins_url('assets/acf-extended-fix.css', ACFE_FILE), false, null);
    
    // ACF Extended: Enqueue ACF
    wp_enqueue_style('acf-input');
    wp_enqueue_script('acf-input');
    
    // ACF Extended: WP jQuery UI Dialog
    wp_enqueue_style('wp-jquery-ui-dialog');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-dialog');
    
    if(acf_is_screen(array('edit-acf-field-group', 'acf-field-group'))){
    
        // CSS
        wp_enqueue_style('acf-extended', plugins_url('assets/acf-extended.css', ACFE_FILE), false, null);
        
        // JS
        wp_enqueue_script('acf-extended', plugins_url('assets/acf-extended.js', ACFE_FILE), array('jquery'), null);
    
    }
    
}

add_action('acf/input/admin_enqueue_scripts', 'acfe_enqueue_fields');
function acfe_enqueue_fields(){
    
    wp_enqueue_script('acf-extended-fields', plugins_url('assets/acf-extended-fields.js', ACFE_FILE), array('jquery'), null);
    
    // ACF Extended: Flexible Content
    wp_enqueue_style('acf-extended-fc', plugins_url('assets/acf-extended-flexible-content.css', ACFE_FILE), false, null);
    wp_enqueue_script('acf-extended-fc', plugins_url('assets/acf-extended-flexible-content.js', ACFE_FILE), array('jquery'), null);
    
}