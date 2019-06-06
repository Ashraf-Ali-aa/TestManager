(function($){
    
    // init
    var acfe = {};
	
	window.acfe = acfe;
    
    acfe.modal = {
        
        modals: [],
        
        // Open
        open: function($target, args){
            
            args = acf.parseArgs(args, {
                title: '',
                footer: false,
                size: false,
                destroy: false
            });
            
            $target.addClass('-open');
            
            if(args.size){
                
                $target.addClass('-' + args.size);
                
            }
            
            var destroy;
            
            if(args.destroy){
                
                destroy = true;
                
            }
            
            if(!$target.find('> .acfe-modal-wrapper').length){
                
                $target.wrapInner('<div class="acfe-modal-wrapper" />');
                
            }
            
            if(!$target.find('> .acfe-modal-wrapper > .acfe-modal-content').length){
                
                $target.find('> .acfe-modal-wrapper').wrapInner('<div class="acfe-modal-content" />');
                
            }
            
            $target.find('> .acfe-modal-wrapper').prepend('<div class="acfe-modal-title"><span class="title">' + args.title + '</span><button class="close"></button></div>');
            
            $target.find('.acfe-modal-title > .close').click(function(e){
                e.preventDefault();
                acfe.modal.close(destroy);
            });
            
            if(args.footer){
                
                $target.find('> .acfe-modal-wrapper').append('<div class="acfe-modal-footer"><button class="button button-primary">' + args.footer + '</button></div>');
                
                $target.find('.acfe-modal-footer > button').click(function(e){
                    e.preventDefault();
                    acfe.modal.close(destroy);
                });
                
            }
            
            acfe.modal.modals.push($target);
            
            var $body = $('body');
            
            if(!$body.hasClass('acfe-modal-opened')){
				
				var overlay = $('<div class="acfe-modal-overlay" />').click(function(){
                    acfe.modal.close(destroy);
                });
                
				$body.addClass('acfe-modal-opened').append(overlay);
				
			}
            
            acfe.modal.multiple();
            
            return $target;
			
		},
		
        // Close
		close: function(destroy){
            
            var $target = acfe.modal.modals.pop();
			
			$target.find('.acfe-modal-title').remove();
			$target.find('.acfe-modal-footer').remove();
            
			$target.removeAttr('style');
            
			$target.removeClass('-open -small -full');
            
            if(destroy){
                
                $target.remove();
                
            }
            
			if(!acfe.modal.modals.length){
                
				$('.acfe-modal-overlay').remove();
                $('body').removeClass('acfe-modal-opened');
                
			}
            
            acfe.modal.multiple();

		},
        
        // Multiple
        multiple: function(){
            
            var last = acfe.modal.modals.length - 1;
            
            $.each(acfe.modal.modals, function(i){
                
                if(last == i){
                    $(this).css('margin-left', '');
                    return;
                }
                
                $(this).css('margin-left',  - (500 / (i+1)));
                
			});
            
        }
        
    };
    
})(jQuery);