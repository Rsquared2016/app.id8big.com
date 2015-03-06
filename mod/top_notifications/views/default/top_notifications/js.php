<?php

/*
 * JS top_notifications
 */

?>
//<script>
	elgg.provide('elgg.top_notifications');
	elgg.top_notifications.notifications_enabled = <?php echo (TOP_NOTIFICATIONS_NOTIFICATIONS_ENABLED) ? 1 : 0; ?>;
	elgg.top_notifications.messages_enabled = <?php echo (TOP_NOTIFICATIONS_MESSAGES_ENABLED) ? 1 : 0; ?>;
	elgg.top_notifications.friend_request_enabled = <?php echo (TOP_NOTIFICATIONS_FRIEND_REQUIEST_ENABLED) ? 1 : 0; ?>;

	/* hide similar items */
	function notificationsListHide() {
		$('.reqList').hide();
		$('.divIco.on').removeClass('on');
		$('.reqIco.on').removeClass('on');
		// hide other menus
		$('.sMnTop.hover').removeClass('hover');
		$('.sMnUl').hide();
	}
	
	$(document).ready(
	function() {
		/* menu or lists show/hide */
		function listShow(mn_list, elementToShow) {
			mn_list.show();
			elementToShow.addClass('on');
			elementToShow.parent().addClass('on');
		}
		$('.divIco').click(
			function() {
				var mn_list = $(this).parent().find('.reqList');
				if(mn_list.length) {
					if(mn_list.is(':visible')) {
						return false;
					}
					/* hide visible menus */
					if(typeof window.notificationsListHide == 'function') {
						notificationsListHide();	// hide other notifications list
					}
					if(typeof window.hideUserMn == 'function') {
						hideUserMn();				// hide user menu
					}
					if(typeof window.hideCommonMn == 'function') {
						hideCommonMn();				// hide any common menu
					}
					/* show this list */
					listShow(mn_list, $(this));
				}
			}
		);
		$('html').click(
			function() {
				notificationsListHide();
			}
		);
		$('.divIco, .reqList').click(
			function(event){
				event.stopPropagation();
			}
		);
            
		/* items hover IE7 */
		$('.reqItem').mouseenter(
			function() {
				$(this).addClass('hover');
			}
		).mouseleave(
			function() {
				$(this).removeClass('hover');
			}
		);
            
		/* message list click */
		$('.messageListTop .reqItem').click(
			function() {
				var the_a = $(this).find('.notMessage a');
				window.location = the_a.attr('href');
			}
		);
				
		// Highlight to newest notifications
		$('.divIco').click(function () {
			// Highlight
			var to_highlight = $('ul.topNotifications .reqList').find('.newestTopNotifications');

			if (to_highlight.length > 0) {
				to_highlight.each(function(index, element) {
					if (typeof(elgg.highlight_element) == 'function') {
						elgg.highlight_element(element);
						$(element).removeClass('newestTopNotifications');
					}
				});
			}
		});

		/* Notifications section: Enable it */
		if(elgg.top_notifications.notifications_enabled) {
			// Mark read notifications
			$('ul.topNotifications .icoNotifications').click(function(){
				var $count =  parseInt($('ul.topNotifications .icoNotifications .count .counter').html());
				if ($count > 0) {
					$.ajax({
						url: '<?php echo $vars['url'] . 'mod/top_notifications/endpoint/mark_read_notification.php' ?>',
						dataType: 'json',
						success: function(data){
							if (!data.error) {
								$('ul.topNotifications .icoNotifications .count').addClass('no');
								$('ul.topNotifications .icoNotifications .count .counter').html("0");
							}
						}
					});
				}
			});

			// New notifications consultation
			if (elgg.is_logged_in()) {
				var top_notifications_notifications_interval = 1000 * 30;
				var top_notifications_notifications_interval_id = setInterval(function(){
					$.ajax({
						url: '<?php echo $vars['url'] . 'mod/top_notifications/endpoint/check_for_new_notifications.php' ?>',
						dataType: 'json',
						success: function(data){
							if (data) {
								if (data.count && parseInt(data.count) > 0) {
									if ($('ul.topNotifications .icoNotifications .count .counter').length &&
										$('ul.topNotifications .listNotifications h2').length) {
										$('ul.topNotifications .icoNotifications .count').removeClass('no');
										$('ul.topNotifications .icoNotifications .count .counter').html(data.count);
										if (data.notifications != 'undefined') {
											$('ul.topNotifications .listNotifications .reqItem').remove();
											$('ul.topNotifications .listNotifications .riEmpty').remove();
											$('ul.topNotifications .listNotifications h2').after(data.notifications);
										}
									}
								}
							}
						}
					});
				}, top_notifications_notifications_interval);
			} 
		}
    }
);