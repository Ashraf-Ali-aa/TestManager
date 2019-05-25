<?php

if(!defined('ABSPATH'))
    exit;

/**
 * Add Settings
 */
add_action('acf/render_field_settings/type=flexible_content', 'acfe_flexible_settings', 0);
function acfe_flexible_settings($field){
    
    // Stylised button
    acf_render_field_setting($field, array(
        'label'         => __('Stylised button'),
        'name'          => 'acfe_flexible_stylised_button',
        'key'           => 'acfe_flexible_stylised_button',
        'instructions'  => __('Better layouts button integration'),
        'type'              => 'true_false',
        'message'           => '',
        'default_value'     => false,
        'ui'                => true,
        'ui_on_text'        => '',
        'ui_off_text'       => '',
    ), true);
    
    // Hide Empty Message
    acf_render_field_setting($field, array(
        'label'         => __('Hide Empty Message'),
        'name'          => 'acfe_flexible_hide_empty_message',
        'key'           => 'acfe_flexible_hide_empty_message',
        'instructions'  => __('Hide the empty message box'),
        'type'              => 'true_false',
        'message'           => '',
        'default_value'     => false,
        'ui'                => true,
        'ui_on_text'        => '',
        'ui_off_text'       => '',
        'conditional_logic' => array(
            array(
                array(
                    'field'     => 'acfe_flexible_stylised_button',
                    'operator'  => '!=',
                    'value'     => '1',
                ),
            )
        )
    ), true);
    
    // Empty Message
    acf_render_field_setting($field, array(
        'label'         => __('Empty Message'),
        'name'          => 'acfe_flexible_empty_message',
        'key'           => 'acfe_flexible_empty_message',
        'instructions'  => __('Text displayed when the flexible field is empty'),
        'type'          => 'text',
        'placeholder'   => _('Click the "Add Row" button below to start creating your layout'),
        'conditional_logic' => array(
            array(
                array(
                    'field'     => 'acfe_flexible_stylised_button',
                    'operator'  => '!=',
                    'value'     => '1',
                ),
                array(
                    'field'     => 'acfe_flexible_hide_empty_message',
                    'operator'  => '!=',
                    'value'     => '1',
                )
            )
        )
    ), true);
    
    // Layouts thumbnails
    acf_render_field_setting($field, array(
        'label'         => __('Layouts Thumbnails'),
        'name'          => 'acfe_flexible_layouts_thumbnails',
        'key'           => 'acfe_flexible_layouts_thumbnails',
        'instructions'  => __('Display thumbnails for each layout. You need to save the field group to take effect'),
        'type'              => 'true_false',
        'message'           => '',
        'default_value'     => false,
        'ui'                => true,
        'ui_on_text'        => '',
        'ui_off_text'       => '',
    ), true);
    
    // Layouts render
    acf_render_field_setting($field, array(
        'label'         => __('Layouts Render'),
        'name'          => 'acfe_flexible_layouts_templates',
        'key'           => 'acfe_flexible_layouts_templates',
        'instructions'  => __('Display PHP template, style & javascript includes fields. You need to save the field group to take effect'),
        'type'              => 'true_false',
        'message'           => '',
        'default_value'     => false,
        'ui'                => true,
        'ui_on_text'        => '',
        'ui_off_text'       => '',
    ), true);
    
    // Modal
    acf_render_field_setting($field, array(
        'label'         => __('Modal'),
        'name'          => 'acfe_flexible_modal',
        'key'           => 'acfe_flexible_modal',
        'instructions'  => __('Use modal for layout selection'),
        'type'          => 'group',
        'layout'        => 'block',
        'sub_fields'    => array(
            array(
                'label'             => '',
                'name'              => 'acfe_flexible_modal_enabled',
                'key'               => 'acfe_flexible_modal_enabled',
                'type'              => 'true_false',
                'instructions'      => '',
                'required'          => false,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'message'           => '',
                'default_value'     => false,
                'ui'                => true,
                'ui_on_text'        => '',
                'ui_off_text'       => '',
                'conditional_logic' => false,
            ),
            array(
                'label'         => '',
                'name'          => 'acfe_flexible_modal_title',
                'key'           => 'acfe_flexible_modal_title',
                'type'          => 'text',
                'prepend'       => __('Title'),
                'placeholder'   => 'Add Row',
                'instructions'  => false,
                'required'      => false,
                'wrapper'       => array(
                    'width' => '35',
                    'class' => '',
                    'id'    => '',
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field'     => 'acfe_flexible_modal_enabled',
                            'operator'  => '==',
                            'value'     => '1',
                        )
                    )
                )
            ),
            array(
                'label'         => '',
                'name'          => 'acfe_flexible_modal_col',
                'key'           => 'acfe_flexible_modal_col',
                'type'          => 'select',
                'prepend'       => '',
                'instructions'  => false,
                'required'      => false,
                'choices'       => array(
                    '1' => '1 column',
                    '2' => '2 columns',
                    '3' => '3 columns',
                    '4' => '4 columns',
                    '5' => '5 columns',
                    '6' => '6 columns',
                ),
                'default_value' => '4',
                'wrapper'       => array(
                    'width' => '15',
                    'class' => '',
                    'id'    => '',
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field'     => 'acfe_flexible_modal_enabled',
                            'operator'  => '==',
                            'value'     => '1',
                        )
                    )
                )
            ),
            array(
                'label'         => '',
                'name'          => 'acfe_flexible_modal_categories',
                'key'           => 'acfe_flexible_modal_categories',
                'type'          => 'true_false',
                'message'       => __('Categories'),
                'instructions'  => false,
                'required'      => false,
                'wrapper'       => array(
                    'width' => '15',
                    'class' => '',
                    'id'    => '',
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field'     => 'acfe_flexible_modal_enabled',
                            'operator'  => '==',
                            'value'     => '1',
                        )
                    )
                )
            ),
        )
    ), true);
    
    // Layouts State
    acf_render_field_setting($field, array(
        'label'         => __('Layouts State'),
        'name'          => 'acfe_flexible_layouts_state',
        'key'           => 'acfe_flexible_layouts_state',
        'instructions'  => __('Force layouts to be collapsed or opened'),
        'type'          => 'select',
        'allow_null'    => true,
        'choices'       => array(
            'collapse'  => 'Collapsed',
            'open'      => 'Opened',
        )
    ), true);
    
}

add_action('acf/render_field', 'acfe_flexible_layouts_settings', 0);
function acfe_flexible_layouts_settings($field){
    
    if($field['_name'] != 'label' || stripos($field['name'], 'layout_') === false)
        return;
    
    $layout_prefix = $field['prefix'];
    
    preg_replace_callback('/\[(.*?)\]/', function($m) use (&$arr){
        $arr[] = explode(',',preg_replace('/([\w]+)/', "$1", $m[1]));
    }, $layout_prefix);
    
    $layout_key = $arr[2][0];
    $field_flexible_id = $arr[0][0];
    
    $field_flexible = acf_get_field($field_flexible_id);
    
    $layout = $field_flexible['layouts'][$layout_key];
    
    $echo = false;
    
    $is_flexible_layouts_thumbnails = isset($field_flexible['acfe_flexible_layouts_thumbnails']) && !empty($field_flexible['acfe_flexible_layouts_thumbnails']);
    $is_flexible_layouts_templates = isset($field_flexible['acfe_flexible_layouts_templates']) && !empty($field_flexible['acfe_flexible_layouts_templates']);
    $is_flexible_modal_enabled = isset($field_flexible['acfe_flexible_modal']['acfe_flexible_modal_enabled']) && !empty($field_flexible['acfe_flexible_modal']['acfe_flexible_modal_enabled']);
    $is_flexible_modal_categories = isset($field_flexible['acfe_flexible_modal']['acfe_flexible_modal_categories']) && !empty($field_flexible['acfe_flexible_modal']['acfe_flexible_modal_categories']);
    
    if($is_flexible_layouts_thumbnails || $is_flexible_layouts_templates || ($is_flexible_modal_enabled && $is_flexible_modal_categories)){
        
        $echo = true;
        
        ?>
        </li>
        <?php

    }

    // Thumbnail
    if($is_flexible_layouts_thumbnails){
    
        $acfe_flexible_thumbnail = isset($layout['acfe_flexible_thumbnail']) ? $layout['acfe_flexible_thumbnail'] : '';
        
        echo '<li>';
        
            echo '<div class="acf-label"><label>' . __('Thumbnail') . '</label></div>';
        
            acf_render_field_wrap(array(
                'label'         => false,
                'name'          => 'acfe_flexible_thumbnail',
                'type'          => 'image',
                'class'         => '',
                'prefix'        => $layout_prefix,
                'value'         => $acfe_flexible_thumbnail,
                'return_format' => 'array',
                'preview_size'  => 'thumbnail',
                'library'       => 'all',
            ));
        
        echo '</li>';
    
    }
    
    // Template
    if($is_flexible_layouts_templates){
    
        $acfe_flexible_render_template = isset($layout['acfe_flexible_render_template']) ? $layout['acfe_flexible_render_template'] : '';
        
        echo '<li>';
        
            echo '<div class="acf-label"><label>Render</label></div>';
        
            acf_render_field(array(
                'prepend'       => str_replace(home_url(), '', ACFE_THEME_URL) . '/',
                'name'          => 'acfe_flexible_render_template',
                'type'          => 'text',
                'class'         => 'acf-fc-meta-name',
                'prefix'        => $layout_prefix,
                'value'         => $acfe_flexible_render_template,
                'placeholder'   => 'template.php'
            ));
        
        echo '</li>';
        
        $acfe_flexible_render_style = isset($layout['acfe_flexible_render_style']) ? $layout['acfe_flexible_render_style'] : '';
        
        echo '<li>';
        
            acf_render_field(array(
                'prepend'       => str_replace(home_url(), '', ACFE_THEME_URL) . '/',
                'name'          => 'acfe_flexible_render_style',
                'type'          => 'text',
                'class'         => 'acf-fc-meta-name',
                'prefix'        => $layout_prefix,
                'value'         => $acfe_flexible_render_style,
                'placeholder'   => 'style.css'
            ));
        
        echo '</li>';
        
        $acfe_flexible_render_script = isset($layout['acfe_flexible_render_script']) ? $layout['acfe_flexible_render_script'] : '';
        
        echo '<li>';
        
            acf_render_field(array(
                'prepend'       => str_replace(home_url(), '', ACFE_THEME_URL) . '/',
                'name'          => 'acfe_flexible_render_script',
                'type'          => 'text',
                'class'         => 'acf-fc-meta-name',
                'prefix'        => $layout_prefix,
                'value'         => $acfe_flexible_render_script,
                'placeholder'   => 'script.js'
            ));
        
        echo '</li>';
    
    }
    
    // Category
    if($is_flexible_modal_enabled && $is_flexible_modal_categories){
        
        $acfe_flexible_category = isset($layout['acfe_flexible_category']) ? $layout['acfe_flexible_category'] : '';
        
        echo '<li>';
        
            echo '<div class="acf-label"><label>Modal Category</label></div>';
        
            acf_render_field(array(
                'prepend'       => __('Category'),
                'name'          => 'acfe_flexible_category',
                'type'          => 'text',
                'class'         => 'acf-fc-meta-name',
                'prefix'        => $layout_prefix,
                'value'         => $acfe_flexible_category,
            ));
        
        echo '</li>';
    
    }
    
    if($echo){
        ?>
        <li class="acf-fc-meta-label">
        <div class="acf-label"><label>Settings</label></div>
        <?php
    }
    
    
}

add_filter('acf/field_wrapper_attributes', 'acfe_flexible_wrapper', 10, 2);
function acfe_flexible_wrapper($wrapper, $field){
    
    if($field['type'] != 'flexible_content')
        return $wrapper;
    
    // Stylised button
    if(isset($field['acfe_flexible_stylised_button']) && !empty($field['acfe_flexible_stylised_button'])){
        
        $wrapper['data-acfe-flexible-stylised-button'] = 1;
        
    }
    
    // Hide Empty Message
    if(isset($field['acfe_flexible_hide_empty_message']) && !empty($field['acfe_flexible_hide_empty_message']) || isset($field['acfe_flexible_stylised_button']) && !empty($field['acfe_flexible_stylised_button'])){
        
        $wrapper['data-acfe-flexible-hide-empty-message'] = 1;
        
    }
    
    // Modal
    if(isset($field['acfe_flexible_modal']['acfe_flexible_modal_enabled']) && !empty($field['acfe_flexible_modal']['acfe_flexible_modal_enabled'])){
        
        $wrapper['data-acfe-flexible-modal'] = 1;
        
        // Columns
        if(isset($field['acfe_flexible_modal']['acfe_flexible_modal_col']) && !empty($field['acfe_flexible_modal']['acfe_flexible_modal_col']))
            $wrapper['data-acfe-flexible-modal-col'] = $field['acfe_flexible_modal']['acfe_flexible_modal_col'];
        
        // Title
        if(isset($field['acfe_flexible_modal']['acfe_flexible_modal_title']) && !empty($field['acfe_flexible_modal']['acfe_flexible_modal_title']))
            $wrapper['data-acfe-flexible-modal-title'] = $field['acfe_flexible_modal']['acfe_flexible_modal_title'];
    
    }
    
    // Layouts State
    if(isset($field['acfe_flexible_layouts_state']) && !empty($field['acfe_flexible_layouts_state'])){
        
        // Collapse
        if($field['acfe_flexible_layouts_state'] == 'collapse'){
            
            $wrapper['data-acfe-flexible-collapse'] = 1;
            
        }
        
        // Open
        elseif($field['acfe_flexible_layouts_state'] == 'open'){
            
            $wrapper['data-acfe-flexible-open'] = 1;
            
        }
        
    }
    
    return $wrapper;
    
}

add_filter('acf/fields/flexible_content/no_value_message', 'acfe_flexible_empty_message', 10, 2);
function acfe_flexible_empty_message($message, $field){
    
    if(!isset($field['acfe_flexible_empty_message']) || empty($field['acfe_flexible_empty_message']))
        return $message;
    
    return $field['acfe_flexible_empty_message'];
    
}

add_filter('acf/prepare_field/type=flexible_content', 'acfe_flexible_layout_title');
function acfe_flexible_layout_title($field){
    
    if(empty($field['layouts']))
        return $field;
    
    foreach($field['layouts'] as $k => &$layout){
        
        $thumbnail = false;
        if(isset($field['acfe_flexible_layouts_thumbnails']) && !empty($field['acfe_flexible_layouts_thumbnails'])){
            
            $class = $style = array();
            $class[] = 'acfe-flexible-layout-thumbnail';
            
            // Modal disabled
            if(!isset($field['acfe_flexible_modal']['acfe_flexible_modal_enabled']) || empty($field['acfe_flexible_modal']['acfe_flexible_modal_enabled']))
                $class[] = 'acfe-flexible-layout-thumbnail-no-modal';
            
            // Thumbnail is set
            $thumbnail_found = false;
            if(isset($layout['acfe_flexible_thumbnail']) && !empty($layout['acfe_flexible_thumbnail'])){
            
                // Thumbnail exists
                if($thumbnail_src = wp_get_attachment_url($layout['acfe_flexible_thumbnail'])){
                    
                    $thumbnail_found = true;
                    $style[] = 'background-image:url(' . $thumbnail_src . ');';
                    
                }
            
            }
            
            // Thumbnail not found
            if(!$thumbnail_found){
                
                $class[] = 'acfe-flexible-layout-thumbnail-not-found';
                
            }
            
            $thumbnail = '<div class="' . implode(' ', $class) . '" style="' . implode(' ', $style) . '"></div>';
            
        }
        
        $category = '';
        if(isset($layout['acfe_flexible_category']) && !empty($layout['acfe_flexible_category'])){
            
            $category = 'data-acfe-flexible-category="' . $layout['acfe_flexible_category'] . '"';
            
        }
        
        $layout['label'] = $thumbnail . '<span '.$category.'>' . $layout['label'] . '</span>';
        
    }
    
    return $field;
    
}

add_filter('acf/fields/flexible_content/layout_title', 'acfe_flexible_layout_title_remove', 0, 4);
function acfe_flexible_layout_title_remove($title, $field, $layout, $i){
    
    // Remove thumbnail
    $title = preg_replace('/<\/?div[^>]*\>/i', '', $title);
    
    return $title;
    
}