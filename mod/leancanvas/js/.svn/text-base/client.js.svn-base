/**
 * 
 * Lean Canvas Main
 * 
 */

//var node_js_url = location.protocol + "//" + location.hostname + ":8080/";
//var node_js_url = "http://aqueous-sierra-6745.herokuapp.com/";

var socket = io.connect(node_js_url,  {'sync disconnect on unload' : true});

$(document).ready(function() {

	// Connect


	// New User Online
	var leancanvas_guid = elgg.get_page_owner_guid();
	var user_guid = elgg.get_logged_in_user_guid();
	var online_user_html = $('.onlineUsersList').html();

	socket.emit('new.online.user', {
		leancanvas_guid: leancanvas_guid,
		user_guid: user_guid,
		online_user_html: online_user_html
	});


	// Update Online Users
	socket.on('update.online.users', function(data) {

		// Update data
		var count_online_users = data.count_online_users;
//		var user_guid = data.user_guid;
//		var online_user_html = data.online_user_html;
		var online_users_lightbox = data.online_users_lightbox;

		$('.count_online_users').text(count_online_users);
		$('.onlineUsersList').html('');
		$('.onlineUsersList').html(online_users_lightbox);

	});

	socket.on('block_section.start', function(data) {
		var sections = data;
		var user = elgg.get_logged_in_user_entity();

		var user_name = user.name;
		var user_guid = user.guid;

		for (var section_key in sections) {
			var current_section = parseInt(section_key) + 1;
			if (typeof(sections[section_key][current_section]) !== 'undefined' && sections[section_key][current_section] !== user_guid && sections[section_key][current_section] !== 0) {
				var section_container = $('div[data-id="' + current_section + '"]').find('.canvasColumnBody');
				section_container.block({
					showOverlay: true,
					overlayCSS: {backgroundColor: 'transparent'},
					message: "Editing",
					css: {
						border: 'none',
						padding: '15px',
						backgroundColor: '#000',
						'-webkit-border-radius': '10px',
						'-moz-border-radius': '10px',
						opacity: .5,
						color: '#fff'
					}
				});
			}
		}

	});

	socket.on('block_section.stop', function(data) {
		var sections = data;
		var user = elgg.get_logged_in_user_entity();

		var user_name = user.name;
		var user_guid = user.guid;

		for (var section_key in sections) {
			var current_section = parseInt(section_key) + 1;
			if (typeof(sections[section_key][current_section]) !== 'undefined' && sections[section_key][current_section] === 0) {
				var section_container = $('div[data-id="' + current_section + '"]').find('.canvasColumnBody');
				section_container.unblock();
			}
		}

//		section_container.unblock();

	});

	socket.on('item.update', function(data) {
		var guid = data.guid;
		var output = data.output;

		$('#lean_objective_' + guid).replaceWith(output);

	});

	socket.on('item.add', function(data) {
		var section_id = data.section_id;
		var output = data.output;
		
		var section_container = $('div[data-id="' + section_id + '"]');
		
		section_container.find('.canvasContent').append(output).addClass('on').removeClass('no');
		section_container.find('.canvasTextAndNumber').addClass('no').removeClass('on');

	});


	socket.on('item.delete', function(data) {

		var element_id = data.element_id;

		var element = $('#' + element_id);

		var sisters_and_brothers = element.siblings();

		if (sisters_and_brothers.size() === 0) {
			element.parents('.canvasColumnBody').find('.canvasTextAndNumber').removeClass('no');
		}

		element.remove();
	});


});