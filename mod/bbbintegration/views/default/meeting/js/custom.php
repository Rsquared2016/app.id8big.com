<?php
/*
 * CUSTOM JS
 */
?>
//<script>
elgg.provide('elgg.bbbintegration');

elgg.bbbintegration.next_requests_talks = false;

elgg.bbbintegration.init = function() {

    // Check for talks
    if(elgg.is_logged_in()) {
		elgg.bbbintegration.check_for_requests_talks();

		$('a.request-talk').live('click', function(event) {
			elgg.bbbintegration.request_talk($(this), event);
		});

		$('a.talk-accept').live('click', function(event) {
			elgg.bbbintegration.accept_talk($(this), event);
		});

		$('a.talk-decline').live('click', function(event) {
			elgg.bbbintegration.decline_talk($(this), event);
		});

		$('a.talk-decline-accept').live('click', function(event) {
			elgg.bbbintegration.decline_talk_accept($(this), event);
		});

//		$('a.talk-down').live('click', function(event) {
//			elgg.bbbintegration.down_talk($(this), event);
//		});
	}

};

elgg.bbbintegration.before_unload_window = function() {

	$(window).bind('beforeunload', function(){ 
		return elgg.echo('meeting:talk:unload');
	});

}

elgg.bbbintegration.resize_iframe = function() {

    var id = 'bbbintegration-wrapper';

    document.getElementById(id).height = $(window).height();

}

elgg.bbbintegration.check_for_requests_talks = function() {

    var interval = 1000*8; // 8 seg.

    var interval_id = setInterval(elgg.bbbintegration.get_requests_talks, interval);

    //elgg.opentok.get_requests_talks();

}

elgg.bbbintegration.get_requests_talks = function() {

	if (elgg.bbbintegration.next_requests_talks) {
		elgg.bbbintegration.next_requests_talks = false;
		return;
	}

	var fancybox_opened = false;
	var in_talk = false;

	var fancybox_wrap = $('#fancybox-wrap');
	if (fancybox_wrap.length > 0) {
		fancybox_opened = fancybox_wrap.is(':visible');
	}

	// Valido si estoy en la ventana de conversacion, si estoy, no chequeo
	// por solicitudes de conversacion
	if ($('.elgg-layout-talk').length > 0) {
		in_talk = true;
	}
    
    if (!fancybox_opened && !in_talk) {
        var time = new Date().getTime();
        $.ajax({
    		dataType: 'json',
            cache: false,
            url: elgg.get_site_url()+'meeting/check_for_requests_talks?t='+time,
            success: function(data) {
				var content = '';

				if (data.request_talk) {
					content = data.request_talk;
				}
				else {
					if (data.accept_talk) {
						content = data.accept_talk;
					}
					else {
						if (data.decline_talk) {
							content = data.decline_talk;
						}
						else {
//							$.fancybox.close();
						}
					}
				}

                if (content) {
                    $.fancybox({
                        modal: true,
                        content: content,
    					padding: '5px'
                    });

                    // Play sound
                    if (typeof(swfobject) == 'object') {
                        var url_sound = "<?php echo $vars['url']; ?>mod/bbbintegration/sounds/new%5Frequest%5Ffor%5Ftalk.player.swf?soundswf=<?php echo $vars['url']; ?>mod/bbbintegration/sounds/new%5Frequest%5Ffor%5Ftalk.swf&autoplay=1&loops=0";
                        swfobject.embedSWF(url_sound, "meeting-request-talk-sound", "1", "1", "9.0.0");
                    }
                }
//    			if (data.online_users) {
//					if ($('.bodyActivity .meeting-users-opentok .elgg-body')) {
//						var widget_content = $('.bodyActivity .online-users-meeting .elgg-body').first();
//						widget_content.html(data.online_users);
//					}
//                }
            }
        });
    }

}

elgg.bbbintegration.request_talk = function(el, event) {

    event.preventDefault();

    var url = $(el).attr('href');

    $.ajax({
        url: url,
        dataType: 'json',
        success: function(data) {
            if (data.system_messages.error.length > 0) {
                elgg.register_error(data.system_messages.error);
            }
            else {
                if (data.system_messages.success.length > 0) {
                    elgg.system_message(data.system_messages.success);
                }
            }
        }
    });

}

elgg.bbbintegration.accept_talk = function(el, event) {

	elgg.bbbintegration.next_requests_talks = true;

    $.fancybox.close();

}

elgg.bbbintegration.decline_talk = function(el, event) {

    event.preventDefault();

    var url = $(el).attr('href');

    $.ajax({
        url: url,
        dataType: 'json',
        success: function(data) {
            if (data.system_messages.error.length > 0) {
                elgg.register_error(data.system_messages.error);
            }
            else {
                if (data.system_messages.success.length > 0) {
                    elgg.system_message(data.system_messages.success);
                }
            }
        }
    });

    $.fancybox.close();

}

elgg.bbbintegration.decline_talk_accept = function(el, event) {

    event.preventDefault();

    var url = $(el).attr('href');

    $.ajax({
        url: url,
        dataType: 'json',
        success: function(data) {
            if (data.system_messages.error.length > 0) {
                elgg.register_error(data.system_messages.error);
            }
            else {
                if (data.system_messages.success.length > 0) {
                    elgg.system_message(data.system_messages.success);
                }
            }
        }
    });

    $.fancybox.close();

}

//elgg.bbbintegration.down_talk = function(el, event) {
//
//	event.preventDefault();
//
//	window.close();
//
//}

elgg.register_hook_handler('init', 'system', elgg.bbbintegration.init);
