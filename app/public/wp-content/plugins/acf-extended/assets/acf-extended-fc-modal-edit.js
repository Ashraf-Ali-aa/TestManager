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
    model.events['click [data-action="acfe-flexible-modal-edit"]'] = 'acfeModalEdit';
    model.acfeModalEdit = function(e, $el){
        
        // Layout
        var $layout = $el.closest('.layout');
        
        // Modal data
        var $modal = $layout.find('> .acfe-modal');
        var $title = $layout.find('> .acf-fc-layout-handle').html();
        
        // Open modal
        acfe.modal.open($modal, {
            title: $title,
            footer: 'Close'
        });
        
    }
    
    /*
     * Spawn
     */
    acf.addAction('new_field/type=flexible_content', function(flexible){
        
        if(!flexible.has('acfeFlexibleModalEdition'))
            return;
        
        // Remove Collapse Action
        flexible.removeEvents({'click [data-name="collapse-layout"]': 'onClickCollapse'});
        
        // Remove placeholder Collapse Action
        flexible.removeEvents({'click .acfe-flexible-collapsed-placeholder': 'onClickCollapse'});
        
    });
    
    acf.addAction('acfe/flexible/layouts', function($layout, flexible){
        
        if(!flexible.has('acfeFlexibleModalEdition'))
            return;
        
        // var
        var $name = $layout.data('layout');
        var $controls = $layout.find('> .acf-fc-layout-controls');
        
        // Remove collapse button
        $controls.find('> a.-collapse').remove();
        
        // Force close
        flexible.closeLayout($layout);
        
        // Wrap content
        $layout.find('> .acf-fields, > .acf-table').wrapAll('<div class="acfe-modal"><div class="acfe-modal-wrapper"><div class="acfe-modal-content"></div></div></div>');
        
        // Placeholder
        $layout.find('> .acfe-flexible-collapsed-placeholder').attr('data-action', 'acfe-flexible-modal-edit');
        
    });
    
})(jQuery);