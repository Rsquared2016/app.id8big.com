<?php
/*
 * CUSTOM JS
 */
//
//// Google Drive Authenticate?
//$gdi = new GDriveIntegration();
//
//$gdi->authenticate();
//
//$is_authenticated = $gdi->isAuthenticated();
?>
//<script>
elgg.provide('elgg.gdrive');

elgg.gdrive.saving_document = false;

elgg.gdrive.init = function() {
	
	// Add class 'gdrive-auth-no'
	<?php //if (!$is_authenticated) { ?>
	$('.gdrive-auth').addClass('gdrive-auth-no');
	<?php //} ?>
	
	$('form.gdrive-auth').submit(function() {
		
		if ($(this).hasClass('gdrive-auth-no')) {
			window.open('<?php echo $vars['url']; ?>gdrive/authenticate', 'gdrive_authenticate', "location=1,status=0,scrollbars=0,width=800,height=570");
			$(this).removeClass('gdrive-auth-no');
			$(this).addClass('gdrive-auth-yes');
			return false;
		}
	
	});
	
	$('a.gdrive-auth.gdrive-sync').live('click touchend', function(event) {
		
		if ($(this).hasClass('gdrive-auth-no')) {
			window.open('<?php echo $vars['url']; ?>gdrive/authenticate', 'gdrive_authenticate', "location=1,status=0,scrollbars=0,width=800,height=570");
			$(this).removeClass('gdrive-auth-no');
			$(this).addClass('gdrive-auth-yes');
			event.preventDefault();
		}
		
	});
    
    $('a.gdrive-delete.gdrive-requires-confirmation').attr('rel', elgg.echo('deleteconfirm'));
    $('a.gdrive-auth.gdrive-google').live('click touchend', function(event) {
		
        var success = true;
        if ($(this).hasClass('gdrive-requires-confirmation') && !$(this).hasClass('gdrive-requires-confirmation-yes')) {
           var rel = $(this).attr('rel'); 
           success = confirm(rel);
           
           if (success) {
               $(this).addClass('gdrive-requires-confirmation-yes');
           }
        }
        else {
            if ($(this).hasClass('gdrive-requires-confirmation') && $(this).hasClass('gdrive-requires-confirmation-yes')) {
                $(this).addClass('gdrive-delete-yes');
            }
        }
        
		if (success && $(this).hasClass('gdrive-auth-no')) {
			window.open('<?php echo $vars['url']; ?>gdrive/authenticate', 'gdrive_authenticate', "location=1,status=0,scrollbars=0,width=800,height=570");
			$(this).removeClass('gdrive-auth-no');
			$(this).addClass('gdrive-auth-yes');
            
			event.preventDefault();
		}
		
	});
    
    $('a.gdrive-delete').live('click touchend', elgg.gdrive.delete_document);
    
    $('table.list-documents-google tbody tr.item-list').live('click touchend', elgg.gdrive.import_document_google);
	
    $(window).bind('beforeunload', elgg.gdrive.before_unload_window);
};

elgg.gdrive.before_unload_window = function() {

	if (elgg.gdrive.saving_document) {
        return '';
    }

}

elgg.gdrive.save_document = function(href) {
    
    var interval = 1000*10; // 10 seg.

    var interval_id = setInterval(function() {
        if (href && !elgg.gdrive.saving_document) {
            var time = new Date().getTime();
            var url = href + '&t' + time;
            elgg.gdrive.saving_document = true;
            $.ajax(url, {
                dataType: 'json',
                cache: false,
                success: function(data) {
                    elgg.gdrive.saving_document = false;
                    if (typeof(data.success) == 'string' && data.success == 'yes') {
                        if (typeof(data.title) == 'string') {
                            $(document).attr('title', data.title);
                        }
                    }
                }
            });
        }
    }, interval);
    
}

elgg.gdrive.create_document = function() {
    
    var href = window.location.href;
    
    if (href.indexOf('?') == -1) {
        href += '?c=yes';
    }
    else {
        href += '&c=yes';
    }
    
    $.ajax(href, {
        dataType: 'json',
        success: function(data) {
            if (data.system_messages.error.length > 0) {
                elgg.register_error(data.system_messages.error);
                $('.loading-wrapper').addClass('hidden');
            }
            else {
                var output = data.output;
                if (output.forward) {
                    window.location.replace(output.forward);
                }
//                elgg.system_message(data.system_messages.success);
            }
        }
    });
    
}

elgg.gdrive.load_documents = function() {

    var href = elgg.get_site_url() + 'gdrive/loaddocuments/' + elgg.get_page_owner_guid();

    $.ajax(href, {
        dataType: 'json',
        success: function(data) {
            $('.loading-wrapper.load-document').addClass('hidden');
            if (data.system_messages.error.length > 0) {
                elgg.register_error(data.system_messages.error);
            }
            else {
                var output = data.output;
                $('.import-google-wrapper').append(output);
//                elgg.system_message(data.system_messages.success);
            }
        }
    });

}

elgg.gdrive.import_document_google = function(event) {
    
    $('.loading-wrapper.import-document').removeClass('hidden');
    $('.list-document-wrapper').addClass('hidden');
    
    var $tr = $(this);
    var $form = $('.elgg-form-gdrive-importgoogle');
    
    var file_id = $tr.data('file-id');
    var $file_id_input = $('input[name=file_id]', $form);
    $file_id_input.val(file_id);
    
    var action = $form.attr('action');
    var options = {
        data: $form.serialize(),
        success: function(data) {
            if (data.system_messages.error.length > 0) {
                $('.loading-wrapper.import-document').addClass('hidden');
                $('.list-document-wrapper').removeClass('hidden');
//                elgg.register_error(data.system_messages.error);
//                $('.loading-wrapper').addClass('hidden');
            }
            else {
                var output = data.output;
                if (output.forward) {
                    window.location.replace(output.forward);
                }
//                elgg.system_message(data.system_messages.success);
            }
        }
    };
    
    elgg.action(action, options);
    
}

elgg.gdrive.delete_document = function(event) {

    event.preventDefault();

    var link = $(this);

    if (!$(link).hasClass('gdrive-delete-yes')) {
        return false;
    }
    if (!$(this).hasClass('gdrive-requires-confirmation-yes')) {
        if(!confirm($(this).attr('rel'))) {
            return false;
        }
    }

    //var deleting_file = <?php echo json_encode(elgg_view('gdrive/loading', array('text' => elgg_echo('gdrive:google:deleting:document'), 'show_icon' => FALSE))); ?>;

    var elgg_item = $(link).parents('.elgg-item');

    if (elgg_item.length > 0) {
        elgg_item.addClass('ajax-loading');
    }

    var action = $(link).attr('href');
    var options = {
        dataType: 'json',
        success: function(data) {
            if (data.system_messages.success.length > 0) {
                window.location.href = elgg.get_site_url() + 'gdrive/group/' + elgg.get_page_owner_guid() + '/all';
            }
            else {
                 $(link).removeClass('gdrive-requires-confirmation-yes');
                 $(link).removeClass('gdrive-delete-yes');
                 $(link).removeClass('gdrive-auth-yes');
                 $(link).addClass('gdrive-auth-no');
                 elgg_item.removeClass('ajax-loading');
            }
        }
    };
    elgg.action(action, options);
    
};

elgg.register_hook_handler('init', 'system', elgg.gdrive.init);