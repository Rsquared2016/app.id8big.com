<?php ?>
//<script>

	elgg.provide('elgg.leancanvas');

	elgg.leancanvas.init = function() {

		// Tooltip
        $.each($('.columnSectionHelp'), function(index, value) {
            var position_my = $(value).data('position-my');
            var position_at = $(value).data('position-at');
            if (!position_my) {
                position_my = 'left middle';
            }
            if (!position_at) {
                position_at = 'right middle';
            }
            
            $(value).qtip({
                style: {
                    classes: 'ui-tooltip-dark ui-tooltip-shadow'
                },
                position: {
                    my: position_my, // Position my top left...
                    at: position_at // at the bottom right of...
                }
            });
        });

		// Add objective
		$('.add_objective').live('click', elgg.leancanvas.add_objective);

		// Cancel objective
		$('.cancel_objective').live('click', elgg.leancanvas.cancel_objective);

		// Save objective
		$('form.elgg-form-leancanvas-add-objective').live('submit', elgg.leancanvas.save_objective);

		// Delete objective
		$('.delete_objective').live('click', elgg.leancanvas.delete_objective);

		// Edit objective
		$('.edit_objective').live('click', elgg.leancanvas.edit_objective);

//		$('input[name="lean_objective[title]"]').live('focus', elgg.leancanvas.focus_objective);
//		$('input[name="lean_objective[title]"]').live('blur', elgg.leancanvas.blur_objective);

		// Comments
		$('.leancanvas_comments').live('click', function(event) {
			event.preventDefault();

			var href = $(this).attr('href');

			$.fancybox({
				href: href,
				onComplete: function() {
					if (typeof(tinyMCE) == 'object') {
						elgg.tinymce.init();
//					$('textarea[name=comment]').focus();
						setTimeout(function() {
							tinyMCE.get('comment').focus();
						}, 1000);
					}
				},
				padding: 5
			});

		});

		// Save comment
		$('.elgg-form-leancanvas-add-comment').live('submit', elgg.leancanvas.save_comment);

		// Delete comment
		$('.delete_comment').live('click', elgg.leancanvas.delete_comment);

		// Select color
		$('.colorSq').live('click', function(event) {
			event.preventDefault();

			if ($(this).hasClass('on')) {
				return false;
			}

			var this_select = $(this).parent().find('select');

			$(this).parent().find('.colorSq').removeClass('on');
			$(this).addClass('on');

			if ($(this).hasClass('colorSqYellow')) {
				this_select.val('yellow');
			}
			else if ($(this).hasClass('colorSqOrange')) {
				this_select.val('orange');
			}
			else if ($(this).hasClass('colorSqBlue')) {
				this_select.val('skyblue');
			}
			
		});

		// Online users
		$('a.online_users').live('click', function(event) {
			event.preventDefault();

			var content = $('.onlineUsersContent').html();

			$.fancybox({
				content: content,
				padding: 5
			});
		});

	};

	elgg.leancanvas.add_objective = function(event) {

		event.preventDefault();

		var canvasColumnBody = $(this).parents('.canvasColumnBody');
		var columnCanvas = $(this).parents('.canvasColumnHover');

		if (canvasColumnBody.length > 0) {
			canvasColumnBody.find('.canvasTextAndNumber').addClass('no');
			
			var canvasContent = canvasColumnBody.find('.canvasContent');
			canvasContent.addClass('no');
			
			var canvasAddContentForm = canvasColumnBody.find('.canvasAddContentForm');
			canvasAddContentForm.addClass('on');

			var form = canvasAddContentForm.find('form');
			form.find('.elgg-input-text').focus();

		}

		if (typeof(socket) !== 'undefined') {
			socket.emit('leancanvas.block_section', {section_id: columnCanvas.data('id'), user: elgg.get_logged_in_user_entity()});
		}

	};

	elgg.leancanvas.cancel_objective = function(event) {

		event.preventDefault();

		var canvasColumnBody = $(this).parents('.canvasColumnBody');
		var columnCanvas = $(this).parents('.canvasColumnHover');

		if (canvasColumnBody.length > 0) {
			var canvasItem = canvasColumnBody.find('.canvasItem');
			if (!canvasItem.length) {
				canvasColumnBody.find('.canvasTextAndNumber').removeClass('no');
			}
			var canvasAddContentForm = canvasColumnBody.find('.canvasAddContentForm');
			var form = canvasAddContentForm.find('form');
			if (form) {
				$(form).each(function() {
					this.reset();
				});
			}
			canvasAddContentForm.removeClass('on');
			
			var canvasContent = canvasColumnBody.find('.canvasContent');
			canvasContent.addClass('on');
			canvasContent.removeClass('no');

			if (typeof(socket) !== 'undefined') {
				socket.emit('leancanvas.unblock_section', {section_id: columnCanvas.data('id'), user: elgg.get_logged_in_user_entity()});
			}

			if(canvasColumnBody.find('.canvasItem').length) {
				canvasColumnBody.find('.canvasContent').addClass('on');
			}
		}

	};

	elgg.leancanvas.save_objective = function(event) {

		var form = $(this);
		var columnCanvas = form.parents('.canvasColumnHover');
		
//		if (typeof(socket) !== 'undefined') {
//			socket.emit('leancanvas.block_section', {section_id: columnCanvas.data('id'), user: elgg.get_logged_in_user_entity()});
//		}

		// Ajax loading
		form.find('.buttons').addClass('ajax-loading');


		var action = form.attr('action');
		var options = {
			data: form.serialize(),
			success: function(data) {
				if (data.output) {
					var guid = form.find('#lean_objective_guid').val();

					var canvasShowOnClick = form.parents('.canvasShowOnClick');
					if (canvasShowOnClick.length > 0) {
						var canvasContent = canvasShowOnClick.find('.canvasContent');
						if (canvasContent.length > 0) {
							canvasContent.removeClass('no');
							canvasContent.addClass('on');
							
							var exists = canvasContent.find('#lean_objective_' + guid);
							if (exists.length > 0) {
								exists.replaceWith($(data.output));
								if (typeof(socket) !== 'undefined') {
									socket.emit('leancanvas.update_item', {guid: guid, user: elgg.get_logged_in_user_entity(), output: data.output});
								}
							}
							else {
								canvasContent.append(data.output);
								if (typeof(socket) !== 'undefined') {
									socket.emit('leancanvas.add_item', {section_id: columnCanvas.data('id'), user: elgg.get_logged_in_user_entity(), output: data.output});
								}
							}
						}
						
						var canvasAddContentForm = canvasShowOnClick.find('.canvasAddContentForm');
						if (canvasAddContentForm.length > 0) {
							canvasAddContentForm.removeClass('on');
						}
					}
				}
				$(form).each(function() {
					this.reset();
				});
				var submit = form.find('#lean_objective_save');
				var data_add = submit.data('add');
				submit.val(data_add);
				form.find('.buttons').removeClass('ajax-loading');

				if (typeof(socket) !== 'undefined') {
					socket.emit('leancanvas.unblock_section', {section_id: columnCanvas.data('id'), user: elgg.get_logged_in_user_entity()});
				}

			}
		};

		elgg.action(action, options);

		return false;

	};

	elgg.leancanvas.delete_objective = function(event) {

		event.preventDefault();

		var link = $(this);
		var columnCanvas = link.parents('.canvasColumnHover');

		if (typeof(socket) !== 'undefined') {
			socket.emit('leancanvas.block_section', {section_id: columnCanvas.data('id'), user: elgg.get_logged_in_user_entity()});
		}
		// Ajax loading
		link.parents('.canvasItem').addClass('ajax-loading');

		var action = link.attr('href');
		var options = {
			success: function(data) {
				if (data.system_messages.success.length > 0) {
					var canvasColumnBody = link.parents('.canvasColumnBody');
					if (canvasColumnBody.length > 0) {
						var canvasAddContentForm = canvasColumnBody.find('.canvasAddContentForm');
						var canvasItem = canvasColumnBody.find('.canvasItem');

						if ((!canvasItem.length || canvasItem.length <= 1) && !canvasAddContentForm.hasClass('on')) {
							canvasColumnBody.find('.canvasTextAndNumber').removeClass('no');
						}

						var form = canvasAddContentForm.find('form');
						if (form.length > 0) {
							form.each(function() {
								this.reset();
							})
						}
					}

					if (typeof(socket) !== 'undefined') {
						socket.emit('leancanvas.delete_item', {element_id: link.parents('.canvasItem').attr('id'), user: elgg.get_logged_in_user_entity()});
					}

					link.parents('.canvasItem').removeClass('ajax-loading');
					link.parents('.canvasItem').remove();

					if (typeof(socket) !== 'undefined') {
						socket.emit('leancanvas.unblock_section', {section_id: columnCanvas.data('id'), user: elgg.get_logged_in_user_entity()});
					}
				} else {
					if (typeof(socket) !== 'undefined') {
						socket.emit('leancanvas.unblock_section', {section_id: columnCanvas.data('id'), user: elgg.get_logged_in_user_entity()});
					}
				}
			},
			error: function(data) {
				if (typeof(socket) !== 'undefined') {
					socket.emit('leancanvas.unblock_section', {section_id: columnCanvas.data('id'), user: elgg.get_logged_in_user_entity()});
				}
			}
		};

		elgg.action(action, options);

	};

	elgg.leancanvas.edit_objective = function() {

		var canvas_item = $(this).parents('.canvasItem');
		var columnCanvas = $(this).parents('.canvasColumnHover');

		var data_guid = canvas_item.data('guid');
		var data_color = canvas_item.data('color');
		var data_title = canvas_item.find('.canvasItemDescription').text();
		var data_section = canvas_item.data('section');
		var data_container_guid = canvas_item.data('container-guid');

		var canvasColumnBody = canvas_item.parents('.canvasColumnBody');
		if (canvasColumnBody.length > 0) {
			var canvasAddContentForm = canvasColumnBody.find('.canvasAddContentForm');
			canvasAddContentForm.addClass('on');

			var form = canvasAddContentForm.find('form');
			form.find('#lean_objective_guid').val(data_guid);
			form.find('#lean_objective_container_guid').val(data_container_guid);
			form.find('#lean_objetive_text').val(data_title);
			form.find('#lean_objective_color').val(data_color);
			form.find('#lean_objective_section').val(data_section);
			var submit = form.find('#lean_objective_save');
			var data_edit = submit.data('edit');
			submit.val(data_edit);

			if (typeof(socket) !== 'undefined') {
				socket.emit('leancanvas.block_section', {section_id: columnCanvas.data('id'), user: elgg.get_logged_in_user_entity()});
			}
		}

	};

	elgg.leancanvas.focus_objective = function() {
		var columnCanvas = $(this).parents('.canvasColumnHover');

		if (typeof(socket) !== 'undefined') {
			socket.emit('leancanvas.block_section', {section_id: columnCanvas.data('id'), user: elgg.get_logged_in_user_entity()});
		}
	};

	elgg.leancanvas.blur_objective = function() {
		var columnCanvas = $(this).parents('.canvasColumnHover');
		if (typeof(socket) !== 'undefined') {
			socket.emit('leancanvas.unblock_section', {section_id: columnCanvas.data('id'), user: elgg.get_logged_in_user_entity()});
		}
	};

	elgg.leancanvas.save_comment = function(event) {

		var form = $(this);

		// Ajax loading
		form.find('h3').addClass('ajax-loading');

		var action = form.attr('action');
		var options = {
			data: form.serialize(),
			dataType: 'json',
			success: function(data) {
				if (data.output) {
					if (data.output.comment) {
						var commentsLeanCanvasWrapper = form.parents('.commentsLeanCanvasWrapper');
						if (commentsLeanCanvasWrapper.length > 0) {
							var elgg_list_annotation = commentsLeanCanvasWrapper.find('.elgg-list-annotation');
							if (elgg_list_annotation.length > 0) {
								elgg_list_annotation.append(data.output.comment);
							}
							else {
								var commentsWrapper = commentsLeanCanvasWrapper.find('.commentsWrapper');
								if (commentsWrapper.length > 0) {
									commentsWrapper.append(data.output.comment);
								}
							}
						}
					}
					if (data.output.link_comment) {
						var section_id = form.find('input[name=section_id]');
						if (section_id) {
							var si = section_id.val();
							
							var link = $('#leancanvas_comments_' + si);
							if (link.length > 0) {
								var parent = link.parents('.columnSectionCommentBubble');
								if (parent.length > 0) {
									parent.replaceWith(data.output.link_comment);
								}
								else {
									link.replaceWith(data.output.link_comment);
								}
							}
						}
					}
				}

				$(form).each(function() {
					this.reset();
				});

				form.find('h3').removeClass('ajax-loading');
			}
		};

		elgg.action(action, options);

		return false;

	};

	elgg.leancanvas.delete_comment = function(event) {

		event.preventDefault();

		var link = $(this);

		var rel = link.attr('rel');

		if (confirm(rel)) {
			// Ajax loading
			link.find('span').addClass('ajax-loading');
			var action = link.attr('href');
			var options = {
				success: function(data) {
					if (data.system_messages.success.length > 0) {
						var elgg_item = link.parents('.elgg-item');

						elgg_item.remove();

						if (data.output && data.output.link_comment && data.output.section_id) {
							var link_comments = $('#leancanvas_comments_' + data.output.section_id);
							if (link_comments.length > 0) {
								var parent = link_comments.parents('.columnSectionCommentBubble');
								if (parent.length > 0) {
									parent.replaceWith(data.output.link_comment);
								}
								else {
									link_comments.replaceWith(data.output.link_comment);
								}
							}
						}
					}
					link.find('span').removeClass('ajax-loading');
				}
			};

			elgg.action(action, options);
		}

	};

	elgg.register_hook_handler('init', 'system', elgg.leancanvas.init);
