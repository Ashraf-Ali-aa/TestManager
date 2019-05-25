<?php

if(!defined('ABSPATH'))
    exit;

/**
 * ACFE Location: Post Type Archive Choices
 */
add_filter('acf/location/rule_values/post_type', 'acfe_location_post_type_archive_choices', 999);
function acfe_location_post_type_archive_choices($choices){
    
    $final_choices = array();
    foreach($choices as $choice => $choice_label){
        $final_choices[$choice] = $choice_label;
        $final_choices[$choice . '_archive'] = $choice_label . ' Archive' . ($choice == 'all' ? 's' : '');
    }
    
	$choices = $final_choices;
    return $choices;
    
}

/**
 * ACFE Location: Post Type Archive Save
 */
add_action('load-edit.php', 'acfe_location_post_type_archive_save');
function acfe_location_post_type_archive_save(){
    
    // Enqueue ACF JS
    acf_enqueue_scripts();
    
    // Success message
    if(isset($_GET['message']) && $_GET['message'] == 'acfe_post_type_archive')
        acf_add_admin_notice('Options have been saved', 'success');
    
    // Verify Nonce
    if(!acf_verify_nonce('post_type_archive_options'))
        return;
    
    // Get post type
    global $typenow;
    
    // Check post type
    $post_type = $typenow;
    if(empty($post_type))
        return;
    
    // Validate
    if(acf_validate_save_post(true)){
    
        // Autoload
        acf_update_setting('autoload', false);

        // Save
        acf_save_post($post_type . '_options');
        
        // Redirect
        wp_redirect(add_query_arg(array('message' => 'acfe_post_type_archive')));
        exit;
    
    }
    
}

/**
 * ACFE Location: Post Type Archive Footer
 */
add_action('admin_footer', 'acfe_location_post_type_archive_footer');
function acfe_location_post_type_archive_footer(){
    
    // Check current screen
    global $pagenow;
    if($pagenow !== 'edit.php')
        return;
    
    // Get post type
    global $typenow;
    
    // Check post type
    $post_type = $typenow;
    if(empty($post_type) || !in_array($post_type, acf_get_post_types()))
        return;
    
    // Get field groups
    $field_groups = acf_get_field_groups(array(
        'post_type' => 'all_archive'
    ));
    
    if(empty($field_groups)){
    
        $field_groups = acf_get_field_groups(array(
            'post_type' => $post_type . '_archive'
        ));
    
    }
    
    if(empty($field_groups))
        return;
    
    ?>
    <script type="text/html" id="tmpl-acf-column-2">
    <div class="acf-column-2">
        
        <div id="poststuff" class="acfe-post-type-archive-box">
            <form class="acf-form" action="" method="post">
            
                <?php 
                
                // Set post_id
                $post_id = $post_type . '_options';
                
                // Set form data
                acf_form_data(array(
                    'screen'    => 'post_type_archive_options', 
                    'post_id'   => $post_id, 
                ));
                
                $count = count($field_groups);
                $i=0; foreach($field_groups as $field_group){ $i++; ?>
                
                    <div class="postbox">
                    
                        <h2 class="hndle ui-sortable-handle"><span><?php echo $field_group['title']; ?></span></h2>
                        
                        <div class="inside">
                            <div class="submitbox">
                            
                                <?php 
                                
                                echo '<div class="acf-fields acf-form-fields -top">';
                                
                                    $fields = acf_get_fields($field_group);
                                    acf_render_fields($fields, $post_id, 'div', 'field');
                                
                                echo '</div>';
                                
                                ?>
                                
                                <?php if($i === $count){ ?>
                                
                                    <div id="major-publishing-actions">
                                    
                                        <div id="publishing-action">
                                        
                                            <div class="acf-form-submit">
                                                <input type="submit" class="acf-button button button-primary button-large" value="<?php _e('Update', 'acfe'); ?>" />
                                                <span class="acf-spinner"></span>
                                            </div>
                                            
                                        </div>
                                        <div class="clear"></div>
                                        
                                    </div>
                                    
                                <?php } ?>
                                
                            </div>
                        </div>
                        
                    </div>
                    
                <?php } ?>
            
            </form>
        </div>
        
    </div>
    </script>
    
    <script type="text/javascript">
    (function($){
        
        // wrap form
        $('#posts-filter').wrap('<div class="acf-columns-2" />');
        
        // add column main
        $('#posts-filter').addClass('acf-column-1');
        
        // add column side
        $('#posts-filter').after($('#tmpl-acf-column-2').html());
        
        // add missing spinners
        var $submit = $('input.button-primary');
        if(!$submit.next('.spinner').length){
            $submit.after('<span class="spinner"></span>');
        }
        
    })(jQuery);
    </script>
    <?php 
    
}