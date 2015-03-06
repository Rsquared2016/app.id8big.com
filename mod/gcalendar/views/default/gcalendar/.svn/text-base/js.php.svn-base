<?php

/**
 * GCalendar
 */

?>
//<script>
elgg.provide('elgg.gcalendar');

elgg.gcalendar.init = function() {
	
	$('.ktFormmeeting form').addClass('gcalendar-auth');
	$('.ktFormmeeting form').addClass('gcalendar-auth-no');
	
	$('form.gcalendar-auth').submit(function() {
		
		if ($(this).hasClass('gcalendar-auth-no')) {
			window.open('<?php echo $vars['url']; ?>gcalendar/authenticate', 'gcalendar_authenticate', "location=1,status=0,scrollbars=0,width=800,height=570");
			$(this).removeClass('gcalendar-auth-no');
			$(this).addClass('gcalendar-auth-yes');
			return false;
		}
	
	});
	
	$('a.gcalendar-auth.gcalendar-sync, a.gcalendar-auth.import-gcalendar, a.gcalendar-auth.gcalendar-events').click(function(event) {
		
		if ($(this).hasClass('gcalendar-auth-no')) {
			window.open('<?php echo $vars['url']; ?>gcalendar/authenticate', 'gcalendar_authenticate', "location=1,status=0,scrollbars=0,width=800,height=570");
			$(this).removeClass('gcalendar-auth-no');
			$(this).addClass('gcalendar-auth-yes');
			event.preventDefault();
		}
		
	});
    
    $('.import-gcalendar').live('click touchend', elgg.gcalendar.import_from_google);
    
    $('table.list-gcalendar-google tbody tr.item-list').live('click touchend', elgg.gcalendar.import_calendar);
	
    $('ul.gcalendars-ul input.elgg-input-checkbox').live('click touchend', elgg.gcalendar.show_hide_events);
}

/**
 * Import From Google 
 */
elgg.gcalendar.import_from_google = function(event) {

    var $el = $(this);
    
    if (!$el.hasClass('import-gcalendar-yes')) {
        $el.addClass('import-gcalendar-yes');
        return false;
    }

    var href = elgg.get_site_url() + 'gcalendar/import';
    
    $.fancybox({
        href: href
    });

}

elgg.gcalendar.import_calendar = function(event) {
    
    $.fancybox.showActivity();
    
    var $tr = $(this);
    var $form = $('.elgg-form-gcalendar-import');
    
    // Calendar id
    var calendar_id = $tr.data('calendar-id');
    var $calendar_id_input = $('input[name=calendar_id]', $form);
    $calendar_id_input.val(calendar_id);
    
    var action = $form.attr('action');
    var options = {
        data: $form.serialize(),
        success: function(data) {
            if (data.system_messages.error.length > 0) {
                // Nothing...
            }
            else {
//                var output = data.output;
//                $('#calendars-widget-box .calendar-list-widget').html(output);
                  window.location.reload();
            }
            $.fancybox.hideActivity();
            $.fancybox.close();
        }
    };
    
    elgg.action(action, options);
    
}

elgg.gcalendar.show_hide_events = function() {

    // Element
    var $el = $(this);
    
    // Value
    var value = $el.val();
    
    if ($el.is(':checked')) {
        // Show events
        $('.fc-event[rel="'+value+'"]').show();
    }
    else {
        // Hide events
        $('.fc-event[rel="'+value+'"]').hide();
    }

}

//elgg.gcalendar.get_events = function() {
//
//    var $el = $(this);
//    var $parent = $el.parent('label');
//    
//    // Add loading
//    $el.css('visibility', 'hidden');
//    $parent.addClass('ajax-loading');
//    
//    // Value
//    var value = $el.val();
//    
//    var href = elgg.get_site_url() + 'gcalendar/getevents';
//    var data = {
//        calendar_id: value
//    };
//    var options = {
//        data: data,
//        success: function(data) {
//            
//            $el.css('visibility', 'visible');
//            $parent.removeClass('ajax-loading');
//        }
//    };
//    $.ajax(href, options);
//
//}

elgg.register_hook_handler('init', 'system', elgg.gcalendar.init);