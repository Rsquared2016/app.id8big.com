
/**
 * Theme Ajaxify
 */

function theme_ajaxify_likes_delete_confirmation() {
	$.each($('.elgg-list-likes a.elgg-requires-confirmation'), function(index, value) {
		$(value).removeClass('elgg-requires-confirmation');
		$(value).addClass('elgg-likes-delete');
	});
}

function theme_ajaxify_comments_delete_confirmation() {
	$.each($('.elgg-river-comments a.elgg-requires-confirmation'), function(index, value) {
		$(value).removeClass('elgg-requires-confirmation');
		$(value).addClass('elgg-comments-delete');
	});
}

$(document).ready(
    function() {
		
		// Likes with ajax
		theme_ajaxify_likes_delete_confirmation();
		$('.elgg-menu-item-likes a, .elgg-list-likes .elgg-likes-delete').live('click', function(event) {
			event.preventDefault();
			// Link
			var link = $(this);
			// Get href
			var href = $(this).attr('href');
			
			// Add icon loading
			link.find('span').addClass('elgg-ajax-loader');
			
			// Like / Unlike
			elgg.action(href, {
				success: function(data) {
					if (typeof(data.output) != 'null' && data.output) {
						// Get output
						var output = data.output;
						
						// Get menu
						var elgg_menu_item_likes, elgg_menu, elgg_menu_item_likes_count;
						if (link.hasClass('elgg-likes-delete')) {
							if (typeof(output.entity_guid) != 'null') {
								var entity_guid = output.entity_guid;
								var item = $('a[href=#likes-'+entity_guid+']');
								elgg_menu_item_likes_count =item.parent('.elgg-menu-item-likes-count');
								elgg_menu = elgg_menu_item_likes_count.parent('.elgg-menu');
								elgg_menu_item_likes = elgg_menu.find('.elgg-menu-item-likes');
								link.parents('.elgg-module-popup.elgg-likes').hide();
							}
						}
						else {
							elgg_menu_item_likes = link.parent('.elgg-menu-item-likes');
							elgg_menu = elgg_menu_item_likes.parent('.elgg-menu');
							elgg_menu_item_likes_count = elgg_menu.find('.elgg-menu-item-likes-count');
						}
						
						// Button
						if (typeof(output.button) != 'null' && elgg_menu_item_likes.length > 0) {
							elgg_menu_item_likes.html(output.button);
						}
						
						// Count
						if (typeof(output.count) != 'null' && elgg_menu.length > 0 && elgg_menu_item_likes.length > 0) {
							if (elgg_menu_item_likes_count.length > 0) {
								elgg_menu_item_likes_count.html(output.count);
							}
							else {
								var html = '<li class="elgg-menu-item-likes-count">';
								html += output.count;
								html += '</li>';
								elgg_menu_item_likes.after(html);
							}
						}
						theme_ajaxify_likes_delete_confirmation();
					}
					link.find('span').removeClass('elgg-ajax-loader');
				}
			});
		});
		
		// Comments
		theme_ajaxify_comments_delete_confirmation();
		$('.elgg-river-responses .elgg-form-comments-add').live('submit', function(event) {
			// Get form
			var form = $(this);
			// Get url
			var url = form.attr('action');
			// Get data
			var data = form.serialize();
			
			if (form.find('input[name=generic_comment]').val() != '') {
				// Add icon loading
				form.addClass('elgg-ajax-loader');
				
				$.ajax({
					url: url,
					data: data,
					type: 'POST',
					dataType: 'json',
					success: function(data) {
						// Clean generic_comment
						form.find('input[name=generic_comment]').val('');
						form.find('input[name=generic_comment]').focus();
						
						// Show message
						var error = false;
						if (data.system_messages.success.length > 0) {
							elgg.system_message(data.system_messages.success);
						}
						else {
							error = true;
							elgg.system_message(data.system_messages.error);
						}
						
						if (typeof(data.output) != 'null' && data.output && !error) {
							// Get output
							var output = data.output;

							if (typeof(output.comment) != 'null' && typeof(output.annotation_id) != 'null') {
								// Get list comments
								var elgg_river_responses = form.parent('.elgg-river-responses');
								if (elgg_river_responses.length > 0) {
									var elgg_river_comments = elgg_river_responses.find('.elgg-river-comments');

									var html = '';
									if (elgg_river_comments.length == 0) {
										html += '<ul class="elgg-list elgg-river-comments">';
									}
									html += '<li id="item-annotation-'+output.annotation_id+'" class="elgg-item">';
									html += output.comment;
									html += '</li>';
									if (elgg_river_comments.length == 0) {
										html += '</ul>';
										form.before(html);
									}
									else {
										elgg_river_comments.append(html);
									}
									elgg_river_comments.show();
									elgg_river_responses.find('.elgg-river-comments-tab').removeClass('hidden');
								}
							}
							theme_ajaxify_comments_delete_confirmation();
						}
						// Remove icon loading
						form.removeClass('elgg-ajax-loader');
					}
				});
			}

			return false;
		});
		$('[rel=toggle]').live('click', function(event) {
			// Get href
			var href = $(this).attr('href');
			
			// Get form
			var form = $('form'+href);
			if (form.length > 0) {
				setTimeout(function() {
					form.find('input[name=generic_comment]').focus();
				}, 500);
				
				var elgg_river_responses = form.parent('.elgg-river-responses');
				var ul = elgg_river_responses.find('.elgg-river-comments');
				if (!$(this).hasClass('elgg-state-active')) {
					ul.show();
				}
				else {
					if (ul.length > 0 && ul.find('.elgg-item').length < 1) {
						ul.hide();
					}
				}
			}
			
		});
		$('a.elgg-comments-delete').live('click', function(event) {
			event.preventDefault();
			
			// Link
			var link = $(this);
			// Get href
			var href = $(this).attr('href');
			// Get rel
			var rel = $(this).attr('rel');
			
			if (confirm(rel)) {
				// Add icon loading
				link.find('span').hide();
				link.addClass('elgg-ajax-loader');
				
				elgg.action(href, {
					success: function(data) {
						if (typeof(data.output) != 'null' && data.output) {
							// Get output
							var output = data.output;
							
							if (typeof(output.annotation_id) != 'null') {
								var li = link.parents('#item-annotation-'+output.annotation_id);
								var ul = li.parent('ul.elgg-river-comments');
								var elgg_river_responses = ul.parent('.elgg-river-responses');
								var li_amount = ul.find('li.elgg-item').length;
								
								if (li_amount - 1 < 1) {
									var elgg_river_more = elgg_river_responses.find('.elgg-river-more');
									if (elgg_river_more.length > 0) {
										elgg_river_more.find('a').click();
									}
									else {
										elgg_river_responses.find('.elgg-river-comments-tab').addClass('hidden');
										elgg_river_responses.find('.elgg-river-comments').hide();
									}
								}
								// Remover river
								if (typeof(output.river_id) != 'null' && output.river_id) {
									var river = $('li#item-river-'+output.river_id);
									if (river.length > 0) {
										river.remove();
									}
								}
								// Remove element comment
								li.remove();
								// Focus
								var form = elgg_river_responses.find('.elgg-form-comments-add');
								if (form.length > 0) {
									if (form.is(':visible')) {
										form.find('input[name=generic_comment]').focus();
									}
								}
							}
						}
					}
				});
			}
		});
		// More comments
		$('.elgg-river-responses .elgg-river-more a').live('click', function(event) {
			event.preventDefault();
			// Get url
			var url = $(this).attr('href');
			// Get link
			var link = $(this);
			
			// Add icon loading
			link.parent('.elgg-river-more').addClass('elgg-ajax-loader');
			
			$.ajax({
				url: url,
				success: function(data) {
					if (data) {
						var elgg_river_responses = link.parents('.elgg-river-responses');
						if (elgg_river_responses.length > 0) {
							elgg_river_responses.find('.elgg-river-comments').remove();
						}
						link.parent().before(data);
						link.parent().remove();
						theme_ajaxify_comments_delete_confirmation();
					}
					link.parent('.elgg-river-more').removeClass('elgg-ajax-loader');
				}
			});
		});
    }
);