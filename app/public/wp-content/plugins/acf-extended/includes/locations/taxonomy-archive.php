<?php

if(!defined('ABSPATH'))
    exit;

/**
 * ACFE Location: Taxonomy Archive Choices
 */
add_filter('acf/location/rule_values/taxonomy', 'acfe_location_taxonomy_archive_choices', 999);
function acfe_location_taxonomy_archive_choices($choices){
    
    $final_choices = array();
    foreach($choices as $choice => $choice_label){
        $final_choices[$choice] = $choice_label;
        $final_choices[$choice . '_archive'] = $choice_label . ' Archive' . ($choice == 'all' ? 's' : '');
    }
    
	$choices = $final_choices;
    return $choices;
    
}

/**
 * ACFE Location: Fix Native ACF 'Taxonomy == All' Location Matching Taxonomies Archives
 */
add_filter('acf/location/rule_match/taxonomy', 'acfe_location_taxonomy_archive_fix_all', 10, 3);
function acfe_location_taxonomy_archive_fix_all($result, $rule, $screen){
    
    if(!isset($screen['taxonomy']) || empty($screen['taxonomy']))
        return $result;
    
    if($rule['operator'] == '==' && $rule['value'] == 'all'){
        
        // Current screen taxonomy ends with '_archive'?
        $length = strlen('_archive');
        if(substr($screen['taxonomy'], -$length) === '_archive')
            $result = false;
        
    }
    
    return $result;
    
}

/**
 * ACFE Location: Taxonomy Archive Save
 */
add_action('load-edit-tags.php', 'acfe_location_taxonomy_archive_save');
function acfe_location_taxonomy_archive_save(){
    
    // Enqueue ACF JS
    acf_enqueue_scripts();
    
    // Success message
    if(isset($_GET['message']) && $_GET['message'] == 'acfe_taxonomy_archive')
        acf_add_admin_notice('Options have been saved', 'success');
    
    // Verify Nonce
    if(!acf_verify_nonce('taxonomy_archive_options'))
        return;
    
    // Get taxonomy
    global $taxnow;
    
    // Check taxonomy
    $taxonomy = $taxnow;
    if(empty($taxonomy))
        return;
    
    // Validate
    if(acf_validate_save_post(true)){
    
        // Autoload
        acf_update_setting('autoload', false);

        // Save
        acf_save_post('tax_' . $taxonomy . '_options');
        
        // Redirect
        wp_redirect(add_query_arg(array('message' => 'acfe_taxonomy_archive')));
        exit;
    
    }
    
}

/**
 * ACFE Location: Taxonomy Archive Footer
 */
add_action('admin_footer', 'acfe_location_taxonomy_archive_footer');
function acfe_location_taxonomy_archive_footer(){
    
    // Check current screen
    global $pagenow;
    if($pagenow !== 'edit-tags.php')
        return;
    
    // Get taxonomy
    global $taxnow;
    
    // Check taxonomy
    $taxonomy = $taxnow;
    if(empty($taxonomy) || !in_array($taxonomy, acf_get_taxonomies()))
        return;
    
    // Get field groups
    $field_groups = acf_get_field_groups(array(
        'taxonomy' => 'all_archive'
    ));
    
    if(empty($field_groups)){
    
        $field_groups = acf_get_field_groups(array(
            'taxonomy' => $taxonomy . '_archive'
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
                $post_id = 'tax_' . $taxonomy . '_options';
                
                // Set form data
                acf_form_data(array(
                    'screen'    => 'taxonomy_archive_options', 
                    'post_id'   => $post_id, 
                ));
                
                $count = count($field_groups);
                $i=0; foreach($field_groups as $field_group){ $i++; ?>
                
                    <div class="postbox">
                    
                        <h2 class="hndle"><span><?php echo $field_group['title']; ?></span></h2>
                        
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
        
        // Wrap form
        $('.search-form').next('#col-container').andSelf().wrapAll('<div class="acf-columns-2"><div class="acf-column-1"></div></div>');
        
        // Add column side
        $('.acf-column-1').after($('#tmpl-acf-column-2').html());
        
    })(jQuery);
    </script>
    <?php 

}