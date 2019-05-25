(function($){
    
    if(typeof acf === 'undefined')
        return;
    
    acf.addAction('new_field/type=flexible_content', function(flexible){
        
        var $layouts = flexible.$clones();
        var $layouts_added = flexible.$layouts();
        
        // ACFE: Layout State - Collapse
        if(flexible.$el.attr('data-acfe-flexible-collapse')){
            
            if($layouts_added.length){
                
                $layouts_added.each(function(){
                    flexible.closeLayout($(this));
                });
                
            }
            
        }
        
        // ACFE: Layout State - Open
        if(flexible.$el.attr('data-acfe-flexible-open')){
            
            if($layouts_added.length){
                
                $layouts_added.each(function(){
                    flexible.openLayout($(this));
                });
                
            }
            
        }
        
        // ACFE: Stylised button
        if(flexible.$el.attr('data-acfe-flexible-stylised-button')){
            
            $(flexible.$el).find('> .acf-input > .acf-flexible-content > .acf-actions .button-primary').removeClass('button-primary');
            $(flexible.$el).find('> .acf-input > .acf-flexible-content > .acf-actions').wrap('<div class="acfe-flexible-stylised-button" />');
        
        }
        
        // ACFE: Modal Prepare
        if(flexible.$el.attr('data-acfe-flexible-modal')){
            
            var flexible_layouts_html = flexible.getPopupHTML();
            
            // Categories
            var categories = [];
            $(flexible_layouts_html).find('li a span').each(function(){

                if(!$(this).data('acfe-flexible-category'))
                    return true;
                
                var category = $(this).data('acfe-flexible-category');
                
                if(categories.indexOf(category) != -1)
                    return true;
                
                categories.push(category);
                
            });
            
            categories.sort();
            
            var categories_html = '';
            
            if(categories.length){
                
                categories_html += '<h2 class="acfe-flexible-categories nav-tab-wrapper">';
                
                categories_html += '<a href="#" data-acfe-flexible-category="acfe-all" class="nav-tab nav-tab-active"><span class="dashicons dashicons-menu"></span></a>';
                
                $(categories).each(function(k, category){
                    
                    categories_html += '<a href="#" data-acfe-flexible-category="' + category + '" class="nav-tab">' + category + '</a>';
                    
                });
                
                categories_html += '</h2>';
                
            }
            
            $(flexible.$el).after(
            '<div id="acfe-fc-modal-' + flexible.data.key + '" class="acfe-fc-modal acfe-fc-modal-content" style="display:none;">' + 
                
                categories_html + 
                
                '<div class="acfe-flex-container">' + 
                
                    flexible.getPopupHTML() + 
                    
                '</div>' + 
                
            '</div>'
            );
            
            flexible.acfe_flexible_modal = function(e, $el){
                
                // validate
                if(!this.validateAdd())
                    return false;
                
                // within layout
                var $layout = null;
                if($el.hasClass('acf-icon')){
                    $layout = $el.closest('.layout');
                    $layout.addClass('-hover');
                }
                
                // ACFE: Modal Title
                var $modal_title = 'Add Row';
                
                if(flexible.$el.attr('data-acfe-flexible-modal-title')){
                    
                    $modal_title = flexible.$el.attr('data-acfe-flexible-modal-title');
                    
                }
                
                $('#acfe-fc-modal-' + flexible.data.key).dialog({
                    title: $modal_title,
                    dialogClass: 'acfe-fc-modal-wrap',
                    autoOpen: false,
                    draggable: false,
                    width: $(window).width() - 60,
                    height: $(window).height() - 60,
                    modal: true,
                    resizable: false,
                    closeOnEscape: true,
                    position: {
                        my: "center",
                        at: "center",
                        of: window
                    },
                    open: function(){
                        
                        $('.ui-widget-overlay, .acfe-fc-modal li a').bind('click', function(){
                            $('#acfe-fc-modal-' + flexible.data.key).dialog('close');
                        });
                        
                        // Fix for ACF autofocus
                        $('.acfe-fc-modal li:first-of-type a').blur();
                        
                    },
                    create: function(){
                        
                        $('.ui-dialog-titlebar-close').addClass('ui-button');
                        
                        $('.acfe-fc-modal li a').click(function(e){
                            
                            e.preventDefault();
                            
                            flexible.add({
                                layout: $(this).data('layout'),
                                before: $layout
                            });
                            
                        });
                        
                        $('.acfe-fc-modal .acfe-flexible-categories a').click(function(e){
                            
                            e.preventDefault();
                            
                            $('.acfe-fc-modal .acfe-flexible-categories a').removeClass('nav-tab-active');
                            $(this).addClass('nav-tab-active');
                            
                            var selected_category = $(this).data('acfe-flexible-category');
                            
                            $('.acfe-fc-modal li a span').each(function(){
                                
                                var current_category = $(this).data('acfe-flexible-category');
                                
                                $(this).closest('li').show();
                                
                                if(selected_category != 'acfe-all' && current_category != selected_category){
                                    
                                    $(this).closest('li').hide();
                                    
                                }
                                
                            });
                            
                        });
                        
                    },
                });
                
                $('#acfe-fc-modal-' + flexible.data.key).dialog('open');
                
                $(window).resize(function(){
                    $('#acfe-fc-modal-' + flexible.data.key).dialog("option", "position", {my: "center", at: "center", of: window});
                    $('#acfe-fc-modal-' + flexible.data.key).dialog("option", "width", $(window).width() - 60);
                    $('#acfe-fc-modal-' + flexible.data.key).dialog("option", "height", $(window).height() - 60);
                });
                
                // Modal Columns
                if(flexible.$el.attr('data-acfe-flexible-modal-col')){
                    
                    $('#acfe-fc-modal-' + flexible.data.key).addClass('acfe-fc-modal-col-' + flexible.$el.attr('data-acfe-flexible-modal-col'));
                    
                }
                
            }
            
            // Do not apply if OneClick
            if($layouts.length > 1){
                
                // Remove native ACF Tooltip action
                flexible.removeEvents({'click [data-name="add-layout"]': 'onClickAdd'});
                
                // Add ACF Extended Modal action
                flexible.addEvents({'click [data-name="add-layout"]': 'acfe_flexible_modal'});
                
            }
        
        }
        
        flexible.on('click', 'a[data-name="add-layout"]', function(e){
            
            // ACFE: OneClick
            if(!$layouts.length || $layouts.length > 1)
                return;
                
            var $layout_name = $($layouts[0]).attr('data-layout');
            
            var $layout = null;
            if($(this).hasClass('acf-icon')){
                $layout = $(this).closest('.layout');
                $layout.addClass('-hover');
            }
            
            flexible.add({
                layout: $layout_name,
                before: $layout
            });
            
            // Hide native ACF tooltip
            if($('.acf-fc-popup').length)
                $('.acf-fc-popup').hide();
            
        });

    });
})(jQuery);