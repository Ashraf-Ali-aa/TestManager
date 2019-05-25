jQuery(document).ready(function($){
    
    $('.acfe_modal').dialog({
        title: 'Data',
        dialogClass: 'wp-dialog',
        autoOpen: false,
        draggable: false,
        width: 'auto',
        modal: true,
        resizable: false,
        closeOnEscape: true,
        position: {
            my: "center",
            at: "center",
            of: window
        },
        open: function(){
            $('.ui-widget-overlay').bind('click', function(){
                $('.acfe_modal').dialog('close');
            })
        },
        create: function(){
            $('.ui-dialog-titlebar-close').addClass('ui-button');
        },
    });
    
    $('.button.edit-field').each(function(k, v){
        var tbody = $(this).closest('tbody');
        $(tbody).find('.acfe_modal_open:first').insertAfter($(this));
        $(tbody).find('tr.acf-field-setting-acfe_field_data:first').remove();
    });
    
    $('.acfe_modal_open').click(function(e){
        e.preventDefault();
        
        var key = $(this).attr('data-modal-key');
        console.log(key);
        $('.acfe_modal[data-modal-key=' + key + ']').dialog('open');
        
    });
    
});