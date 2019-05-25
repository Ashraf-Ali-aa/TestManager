<?php

if(!defined('ABSPATH'))
    exit;

/**
 * Get Flexible
 */
if(!function_exists('get_flexible')){
    
function get_flexible($selector, $post_id = false){
    
    if(!have_rows($selector, $post_id))
        return;

    $field = acf_get_field($selector);
    $acf_field_flexible_content = new acf_field_flexible_content();
    
    ob_start();
    
        while(have_rows($selector)): the_row();
            
            $layout_title = get_row_layout();
            $layout = $acf_field_flexible_content->get_layout($layout_title, $field);
            
            // Render: Style
            if(isset($layout['acfe_flexible_render_style']) && !empty($layout['acfe_flexible_render_style'])){
                
                if(file_exists(ACFE_THEME_PATH . '/' . $layout['acfe_flexible_render_style']))
                    echo '<link rel="stylesheet" href="' . ACFE_THEME_URL . '/' . $layout['acfe_flexible_render_style'] . '" type="text/css">';
                
            }
            
            // Render: Script
            if(isset($layout['acfe_flexible_render_script']) && !empty($layout['acfe_flexible_render_script'])){
                
                if(file_exists(ACFE_THEME_PATH . '/' . $layout['acfe_flexible_render_script']))
                    echo '<script src="' . ACFE_THEME_URL . '/' . $layout['acfe_flexible_render_script'] . '"></script>';
                
            }
            
            // Render: Template
            if(isset($layout['acfe_flexible_render_template']) && !empty($layout['acfe_flexible_render_template'])){
                
                locate_template(array($layout['acfe_flexible_render_template']), true);
                
            }

        endwhile;
    
    return ob_get_clean();
    
}

}

/**
 * The Flexible
 */
if(!function_exists('the_flexible')){
    
function the_flexible($selector, $post_id = false){
    
    echo get_flexible($selector, $post_id);
    
}

}

/**
 * Get Field Group from Field
 */
function acfe_get_field_group_from_field($field){
    
    $field_parent = $field['parent'];
    
    if(!$field_ancestors = acf_get_field_ancestors($field))
        return acf_get_field_group($field_parent);
    
    // Reverse for DESC order (Top field first)
    $field_ancestors = array_reverse($field_ancestors);
    
    $field_top_ancestor = $field_ancestors[0];
    $field_top_ancestor = acf_get_field($field_top_ancestor);
    
    return acf_get_field_group($field_top_ancestor['parent']);
    
}

/**
 * Is Json
 * Source: https://stackoverflow.com/a/6041773
 */
function acfe_is_json($string){
    
    // in case string = 1
    if(is_numeric($string))
        return false;
    
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
    
}

/**
 * Get Roles
 */
function acfe_get_roles(){
    
    global $wp_roles;
    $choices = array();
    
    if(is_multisite())
        $choices['super_admin'] = __('Super Admin');
    
    foreach($wp_roles->roles as $role => $settings){
        $choices[$role] = $settings['name'];
    }
    
    return $choices;
    
}

/**
 * Get Current Roles
 */
function acfe_get_current_user_roles(){
    
    global $current_user;
    
    if(!is_object($current_user) || !isset($current_user->roles))
        return false;
    
    $roles = $current_user->roles;
    if(is_multisite() && current_user_can('setup_network'))
        $roles[] = 'super_admin';
    
    return $roles;
    
}

/**
 * Folder Exists
 */
function acfe_folder_exists($folder){
    
    if(!is_dir(ACFE_THEME_PATH . '/' . $folder))
        return false;
    
    return true;
    
}