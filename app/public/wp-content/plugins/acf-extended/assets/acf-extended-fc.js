(function($){
    
    if(typeof acf === 'undefined')
        return;
    
    /*
     * Init
     */
    var flexible = acf.getFieldType('flexible_content');
    var model = flexible.prototype;
    
    /*
     * Actions
     */
    model.acfeOneClick = function(e, $el){
        
        // Get Flexible
        var flexible = this;
        
        // Vars
        var $clones = flexible.$clones();
        var $layout_name = $($clones[0]).data('layout');
        
        // Source
        var $layout_source = null;
        if($el.hasClass('acf-icon'))
            $layout_source = $el.closest('.layout');
        
        // Add
        flexible.add({
            layout: $layout_name,
            before: $layout_source
        });
        
        // Hide native tooltip
        if($('.acf-fc-popup').length)
            $('.acf-fc-popup').hide();
        
    }
    
    /*
     * Spawn
     */
    acf.addAction('new_field/type=flexible_content', function(flexible){
        
        // Vars
        var $clones = flexible.$clones();
        var $layouts = flexible.$layouts();
        
        // Merge
        var $all_layouts = $.merge($layouts, $clones);
        
        // Do Actions
        $all_layouts.each(function(){
            
            var $layout = $(this);
            var $name = $layout.data('layout');
            
            acf.doAction('acfe/flexible/layouts', $layout, flexible);
            acf.doAction('acfe/flexible/layout/name=' + $name, $layout, flexible);
            
        });
        
        // ACFE: Stylised button
        if(flexible.has('acfeFlexibleStylisedButton')){
            
            flexible.$button().removeClass('button-primary');
            flexible.$actions().wrap('<div class="acfe-flexible-stylised-button" />');
        
        }
        
        // ACFE: 1 layout available - OneClick
        if($clones.length === 1){
            
            // Remove native ACF Tooltip action
            flexible.removeEvents({'click [data-name="add-layout"]': 'onClickAdd'});
            
            // Add ACF Extended Modal action
            flexible.addEvents({'click [data-name="add-layout"]': 'acfeOneClick'});
        
        }
        
        flexible.addEvents({'click .acfe-flexible-collapsed-placeholder': 'onClickCollapse'});
        
        flexible.addEvents({'click .acfe-flexible-opened-actions > a': 'onClickCollapse'});

    });
    
    acf.addAction('acfe/flexible/layouts', function($layout, flexible){
        
        // Not clones
        if(!$layout.is('.acf-clone')){
            
            // Layout State: Collapse
            if(flexible.has('acfeFlexibleCollapse')){
                
                flexible.closeLayout($layout);
                
            }
            
            // Layout State: Open
            else if(flexible.has('acfeFlexibleOpen')){
                
                flexible.openLayout($layout);
                
            }
        
        }
        
        // Compatibility: Plugins that don't use native layout close method
        // TODO: Move to ready action for late init?
        if(flexible.isLayoutClosed($layout)){
            
            flexible.closeLayout($layout);
            
        }
        
        // Trigger show action for opened layouts
        else{
            
            acf.doAction('show', $layout, 'collapse');
            
        }
        
    });
    
    acf.addAction('show', function($layout, type){
        
        if(type != 'collapse' || !$layout.is('.layout'))
            return;
        
        var flexible = acf.getInstance($layout.closest('.acf-field-flexible-content'));
        
        // Bail early if Modal Edit
        if(flexible.has('acfeFlexibleModalEdition'))
            return;
    
        // Remove duplicate
        $layout.find('> .acfe-flexible-collapsed-placeholder').remove();
        $layout.find('> .acfe-flexible-opened-actions').remove();
        
        var $button = $('<div class="acfe-flexible-opened-actions"><a href="javascript:void(0);" class="button">Close</button></a>');
        var $button = $button.appendTo($layout);
        
    });
    
    acf.addAction('hide', function($layout, type){
        
        if(type != 'collapse' || !$layout.is('.layout'))
            return;
        
        // Get Flexible
        var flexible = acf.getInstance($layout.closest('.acf-field-flexible-content'));
        
        // Vars
        var $name = $layout.data('layout');
        var $controls = $layout.find('> .acf-fc-layout-controls');
    
        // Remove duplicate
        $layout.find('> .acfe-flexible-collapsed-placeholder').remove();
        $layout.find('> .acfe-flexible-opened-actions').remove();
        
        // Placeholder
        var $placeholder = $('' +
            '<div class="acfe-flexible-collapsed-placeholder" title="Edit layout">' +
            '   <div class="placeholder">' +
            '   <button class="button" onclick="return false;">' +
            '       <span class="dashicons dashicons-edit"></span>' +
            '   </button>' +
            '   </div>' +
            '</div>'
        );
        
        if(!flexible.has('acfeFlexiblePreview')){
            
            var $placeholder = $placeholder.insertAfter($controls);
            
            /*
            // vars
			var $input = $layout.children('input');
			var prefix = $input.attr('name').replace('[acf_fc_layout]', '');
			
			// ajax data
			var ajaxData = {
				action: 	'acfe/flexible/layout_preview',
				field_key: 	flexible.get('key'),
				i: 			$layout.index(),
				layout:		$layout.data('layout'),
				value:		acf.serialize( $layout, prefix )
			};
			
			// ajax
			$.ajax({
		    	url: acf.get('ajaxurl'),
		    	data: acf.prepareForAjax(ajaxData),
				dataType: 'html',
				type: 'post',
				success: function(html){
					if(html){
						$placeholder.find('> .placeholder').replaceWith(html);
					}
				}
			});
            */
            
            return;
            
        }
        
        // Get Previews
        var $previews = flexible.get('acfeFlexiblePreview');
        
        // Check Preview Exists
        if(!acf.isset($previews, $name)){
            
            $controls.after($placeholder);
            
            return;
            
        }
        
        $controls.after('' +
            '<div class="acfe-flexible-collapsed-placeholder acfe-flexible-collapsed-preview" title="Edit layout">' +
            '   <button class="button" onclick="return false;">' +
            '       <span class="dashicons dashicons-edit"></span>' +
            '   </button>' +
            '   <div class="acfe-flexible-collapsed-overlay"></div>' +
            '   <img src="' + $previews[$name] + '" />' +
            '</div>'
        );
        
    });
    
    /*
     * Field Error
     */
    acf.addAction('invalid_field', function(field){
        
        field.$el.parents('.layout').addClass('acfe-flexible-modal-edit-error');
        
    });
    
    /*
     * Field Valid
     */
    acf.addAction('valid_field', function(field){
        
        field.$el.parents('.layout').each(function(){
            
            var $layout = $(this);
            
            if(!$layout.find('.acf-error').length)
                $layout.removeClass('acfe-flexible-modal-edit-error');
            
        });
        
    });
    
})(jQuery);