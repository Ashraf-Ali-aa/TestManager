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
    
    // Layout: Clone
    model.events['click [data-acfe-flexible-control-clone]'] = 'acfeCloneLayout';
    model.acfeCloneLayout = function(e, $el){
        
        // Get Flexible
        var flexible = this;
        
        // Vars
        var $layout_original = $el.closest('.layout');
        var $layout = $el.closest('.layout').clone();
        
        // Fix TinyMCE attribute value
        $layout.find('textarea').each(function(){
            $(this).html(this.value);
        });
        
        // Clean Layout
        flexible.acfeCleanLayouts($layout);
        
        // Clone
        var $layout_added = flexible.acfeDuplicate({
            layout: $layout,
            before: $layout_original
        });
        
        // Scroll to new layout
        $('html, body').animate({
            scrollTop: parseInt($layout_added.offset().top) - 200
        }, 200);
        
    }
    
    // Layout: Copy
    model.events['click [data-acfe-flexible-control-copy]'] = 'acfeCopyLayout';
    model.acfeCopyLayout = function(e, $el){
        
        // Get Flexible
        var flexible = this;
        
        // Vars
        var $layout = $el.closest('.layout').clone();
        
        // Fix inputs
        flexible.acfeFixInputs($layout);
        
        // Clean layout
        flexible.acfeCleanLayouts($layout);
        
        // Get layout data
        var data = JSON.stringify($layout[0].outerHTML);
        
        // Append Temp Input
        var $input = $('<input type="text" style="clip:rect(0,0,0,0);clip-path:rect(0,0,0,0);position:absolute;" value="" />').appendTo($el);
        $input.attr('value', data).select();
        
        // Command: Copy
        if(document.execCommand('copy'))
            alert('Layout has been transferred to your clipboard');
            
        // Prompt
        else
            prompt('Copy the following layout data to your clipboard', data);
        
        // Remove the temp input
        $input.remove();
        
    }
    
    // Flexible: Copy Layouts
    model.acfeCopyLayouts = function(){
        
        // Get Flexible
        var flexible = this;
        
        // Get layouts
        var $layouts = flexible.$layoutsWrap().clone();
        
        // Fix inputs
        flexible.acfeFixInputs($layouts);
        
        // Clean layout
        flexible.acfeCleanLayouts($layouts);
        
        // Get layouts data
        var data = JSON.stringify($layouts.html());
        
        // Append Temp Input
        var $input = $('<input type="text" style="clip:rect(0,0,0,0);clip-path:rect(0,0,0,0);position:absolute;" value="" />').appendTo(flexible.$el);
        $input.attr('value', data).select();
        
        // Command: Copy
        if(document.execCommand('copy'))
            alert('Layouts have been transferred to your clipboard');
            
        // Prompt
        else
            prompt('Copy the following layouts data to your clipboard', data);
        
        $input.remove();
        
    }
    
    // Flexible: Paste Layouts
    model.acfePasteLayouts = function(){
        
        // Get Flexible
        var flexible = this;
        
        var paste = prompt('Paste layouts data in the following field');
        
        // No input
        if(paste == null || paste == '')
            return;
        
        try{
            
            // Paste HTML
            var $html = $(JSON.parse(paste));
            
            // Parsed layouts
            var $html_layouts = $html.closest('[data-layout]');
            
            if(!$html_layouts.length)
                return alert('No layouts data available');
            
            // init
            var validated_layouts = [];
            
            // Each first level layouts
            $html_layouts.each(function(){
                
                var $this = $(this);
                
                // Validate layout against available layouts
                var get_clone_layout = flexible.$clone($this.attr('data-layout'));
                
                // Layout is invalid
                if(!get_clone_layout.length)
                    return;
                
                // Add validated layout
                validated_layouts.push($this);
                
            });
            
            // Nothing to add
            if(!validated_layouts.length)
                return alert('No corresponding layouts found');
            
            // Add layouts
            $.each(validated_layouts, function(){
                
                flexible.acfeDuplicate({
                    layout: $(this),
                    before: false
                });
                
            });
            
        }catch(e){
            
            console.log(e);
            alert('Invalid data');
            
        }
        
    }
    
    // Flexible: Dropdown
    model.events['click [data-name="acfe-flexible-control-button"]'] = 'acfeControl';
    model.acfeControl = function(e, $el){
        
        // Get Flexible
        var flexible = this;
        
        // Vars
        var $dropdown = $el.next('.tmpl-acfe-flexible-control-popup').html();
        
        // Init Popup
        var Popup = acf.models.TooltipConfirm.extend({
            render: function(){
                this.html(this.get('text'));
                this.$el.addClass('acf-fc-popup');
            }
        });
        
        // New Popup
        var popup = new Popup({
            target: $el,
            targetConfirm: false,
            text: $dropdown,
            context: flexible,
            confirm: function(e, $el){
                
                if($el.attr('data-acfe-flexible-control-action') == 'paste')
                    flexible.acfePasteLayouts();
                
                else if($el.attr('data-acfe-flexible-control-action') == 'copy')
                    flexible.acfeCopyLayouts();
                
            }
        });
        
        popup.on('click', 'a', 'onConfirm');
        
    }
    
    // Flexible: Duplicate
    model.acfeDuplicate = function(args){
        
        // Arguments
        args = acf.parseArgs(args, {
            layout: '',
            before: false
        });
        
        // Validate
        if(!this.allowAdd())
            return false;
        
        // Add row
        var $el = acf.duplicate({
            target: args.layout,
            append: this.proxy(function($el, $el2){
                
                // append before
                if(args.before){
                    
                    // Fix clone: Use after() instead of native before()
                    args.before.after($el2);
                    
                }
                
                // append end
                else{
                    
                    this.$layoutsWrap().append($el2);
                    
                }
                
                // enable 
                acf.enable($el2, this.cid);
                
                // render
                this.render();
                
            })
        });
        
        // trigger change for validation errors
        this.$input().trigger('change');
        
        // return
        return $el;
        
    }
    
    // Flexible: Fix Inputs
    model.acfeFixInputs = function($layout){
        
        $layout.find('input').each(function(){
            
            $(this).attr('value', this.value);
            
        });
        
        $layout.find('textarea').each(function(){
            
            $(this).html(this.value);
            
        });
        
        $layout.find('input:radio,input:checkbox').each(function() {
            
            if(this.checked)
                $(this).attr('checked', 'checked');
            else
                $(this).attr('checked', false);
            
        });
        
        $layout.find('option').each(function(){
            if(this.selected)
                $(this).attr('selected', 'selected');
            else
                $(this).attr('selected', false);
        });
        
    }
    
    // Flexible: Clean Layout
    model.acfeCleanLayouts = function($layout){
        
        // Clean WP Editor
        $layout.find('.acf-editor-wrap').each(function(){
            
            var $input = $(this);
            
            $input.find('.wp-editor-container div').remove();
            $input.find('.wp-editor-container textarea').css('display', '');
            
        });
        
        // Clean Date
        $layout.find('.acf-date-picker').each(function(){
            
            var $input = $(this);
            
            $input.find('input.input').removeClass('hasDatepicker').removeAttr('id');
            
        });
        
        // Clean Time
        $layout.find('.acf-time-picker').each(function(){
            
            var $input = $(this);
            
            $input.find('input.input').removeClass('hasDatepicker').removeAttr('id');
            
        });
        
        // Clean DateTime
        $layout.find('.acf-date-time-picker').each(function(){
            
            var $input = $(this);
            
            $input.find('input.input').removeClass('hasDatepicker').removeAttr('id');
            
        });
        
        // Clean Color Picker
        $layout.find('.acf-color-picker').each(function(){
            
            var $input = $(this);
            
            var $color_picker = $input.find('> input');
            var $color_picker_proxy = $input.find('.wp-picker-container input.wp-color-picker').clone();
            
            $color_picker.after($color_picker_proxy);
            
            $input.find('.wp-picker-container').remove();
            
        });
        
        // Clean Post Object
        $layout.find('.acf-field-post-object').each(function(){
            
            var $input = $(this);
            
            $input.find('> .acf-input span').remove();
            
            $input.find('> .acf-input select').removeAttr('tabindex aria-hidden').removeClass();
            
        });
        
        // Clean Page Link
        $layout.find('.acf-field-page-link').each(function(){
            
            var $input = $(this);
            
            $input.find('> .acf-input span').remove();
            
            $input.find('> .acf-input select').removeAttr('tabindex aria-hidden').removeClass();
            
        });
        
        // Clean Tab
        $layout.find('.acf-tab-wrap').each(function(){
            
            var $wrap = $(this);
            
            var $content = $wrap.closest('.acf-fields');
            
            var tabs = []
            $.each($wrap.find('li a'), function(){
                
                tabs.push($(this));
                
            });
            
            $content.find('> .acf-field-tab').each(function(){
                
                $current_tab = $(this);
                
                $.each(tabs, function(){
                    
                    var $this = $(this);
                    
                    if($this.attr('data-key') != $current_tab.attr('data-key'))
                        return;
                    
                    $current_tab.find('> .acf-input').append($this);
                    
                });
                
            });
            
            $wrap.remove();
            
        });
        
        // Clean Accordion
        $layout.find('.acf-field-accordion').each(function(){
            
            var $input = $(this);
            
            $input.find('> .acf-accordion-title > .acf-accordion-icon').remove();
            
        });
        
    }
    
    /*
     * Spawn
     */
    acf.addAction('new_field/type=flexible_content', function(flexible){
        
        /* 
         * Dropdown HTML
         */
        var $dropdown_grey = $('' +
        '<a href="#" class="button" style="padding-left:5px;padding-right:5px; margin-left:3px;" data-name="acfe-flexible-control-button">' +
        '   <span class="dashicons dashicons-arrow-down-alt2" style="vertical-align:text-top;width:auto;height:auto;font-size:13px;line-height:20px;"></span>' +
        '</a>' +
        
        '<script type="text-html" class="tmpl-acfe-flexible-control-popup">' +
        '   <ul>' +
        '       <li><a href="#" data-acfe-flexible-control-action="copy">Copy layouts</a></li>' +
        '       <li><a href="#" data-acfe-flexible-control-action="paste">Paste layouts</a></li>' +
        '   </ul>' +
        '</script>');
            
        var $dropdown_blue = $('' +
        '<a href="#" class="button button-primary" style="padding-left:5px;padding-right:5px; margin-left:3px;" data-name="acfe-flexible-control-button">' +
        '   <span class="dashicons dashicons-arrow-down-alt2" style="vertical-align:text-top;width:auto;height:auto;font-size:13px;line-height:20px;"></span>' +
        '</a>' +
        
        '<script type="text-html" class="tmpl-acfe-flexible-control-popup">' +
        '   <ul>' +
        '       <li><a href="#" data-acfe-flexible-control-action="copy">Copy layouts</a></li>' +
        '       <li><a href="#" data-acfe-flexible-control-action="paste">Paste layouts</a></li>' +
        '   </ul>' +
        '</script>');

        
        // Remove potential duplicated buttons
        flexible.$el.find('> .acf-input > .acf-flexible-content > .acfe-flexible-stylised-button > .acf-actions > [data-name="acfe-flexible-control-button"]').remove();
        flexible.$el.find('> .acf-input > .acf-flexible-content > .acf-actions > [data-name="acfe-flexible-control-button"]').remove();
        
        // Add buttons
        flexible.$el.find('> .acf-input > .acf-flexible-content > .acfe-flexible-stylised-button > .acf-actions > .acf-button').after($dropdown_grey);
        flexible.$el.find('> .acf-input > .acf-flexible-content > .acf-actions > .acf-button').after($dropdown_blue);
        
    });
    
    acf.addAction('acfe/flexible/layouts', function($layout, flexible){
        
        var $controls = $layout.find('> .acf-fc-layout-controls');
        
        // Remove Duplicated Buttons
        $controls.find('> .acfe-flexible-icon').remove();
        
        // Add Buttons
        $controls.prepend('' +
        '<a class="acf-icon small light acf-js-tooltip acfe-flexible-icon dashicons dashicons-admin-page" href="#" title="Clone layout" data-acfe-flexible-control-clone="' + $layout.attr('data-layout') + '"></a>' +
        '<a class="acf-icon small light acf-js-tooltip acfe-flexible-icon dashicons dashicons-category" href="#" title="Copy layout" data-acfe-flexible-control-copy="' + $layout.attr('data-layout') + '"></a>');
        
    });
    
})(jQuery);