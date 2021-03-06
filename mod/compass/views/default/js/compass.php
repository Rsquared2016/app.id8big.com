<?php ?>
//<script>

	elgg.provide('elgg.compass');

	elgg.compass.init = function() {
		elgg.compass.dropInit();
		elgg.compass.eventsInit();
		//Chequeamos el WIP
		//elgg.compass.checkWip();
		elgg.compass.keywordSearch();
		
        $('form#quick_jump_form').submit(function(event) {
            return false;
        });
        
		// Tooltip
        $.each($('.compassColumnHead .columnSectionHelp'), function(index, value) {
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
        
        $('.show-hide-details').live('click touchend', function(event) {
            event.preventDefault();
            
            var el = $(this);
            var rel = $(el).attr('rel');
            
            var details = $('#details-'+rel);
            if (details.length > 0) {
                // Slide toggle details open
                var details_open = $('.details.open');
                if (details_open.length > 0 && details.attr('id') !== details_open.attr('id')) {
                    details_open.removeClass('open');
                    details_open.slideToggle('slow', function() {
                        var parent = details_open.parents('.portlet');
                        if (parent.length > 0) {
                            var link = $('.show-hide-details', $(parent));
                            if (link.length > 0) {
                                var text = $(link).text();
                                if (text == elgg.echo('compass:content:comments:show')) {
                                    $(link).text(elgg.echo('compass:content:comments:hide'));
                                    
                                }
                                else {
                                    $(link).text(elgg.echo('compass:content:comments:show'));
                                    $(this).removeClass('open');
                                }
                            }
                        }
                    });
                }
                
                // Slide toggle details
                details.slideToggle('slow', function() {
                    var text = $(el).text();
                    if (text == elgg.echo('compass:content:comments:show')) {
                        $(el).text(elgg.echo('compass:content:comments:hide'));
                        $(this).addClass('open');
                    }
                    else {
                        $(el).text(elgg.echo('compass:content:comments:show'));
                        $(this).removeClass('open');
                    }
                });
            }
        });
        
        $('#compass_section').live('change', elgg.compass.filter_by_section);
	};

	elgg.compass.eventsInit = function() {	
		// Comments
		$('.compass_comments').live('click', function(event) {
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
		$('.elgg-form-compass-add-comment').live('submit', elgg.compass.save_comment);

		// Delete comment
		$('.delete_compass_comment').live('click', elgg.compass.delete_comment);	
		
	}
	
	elgg.compass.save_comment = function(event) {

		var form = $(this);

		// Ajax loading
		form.find('h3').addClass('ajax-loading');

		var action = form.attr('action');
		var options = {
			data: form.serialize(),
			dataType: 'json',
			success: function(data) {
				if (data.output) {
					//Append new comment.
					if (data.output.comment) {
						var commentsCompassWrapper = form.parents('.commentsCompassWrapper');
						if (commentsCompassWrapper.length > 0) {
							var elgg_list_annotation = commentsCompassWrapper.find('.elgg-list-annotation');
							if (elgg_list_annotation.length > 0) {
								elgg_list_annotation.append(data.output.comment);
							}
							else {
								var commentsWrapper = commentsCompassWrapper.find('.commentsWrapper');
								if (commentsWrapper.length > 0) {
									commentsWrapper.append(data.output.comment);
								}
							}
						}
					}
					//Change link comment count.
					if (data.output && data.output.link_comment && data.output.entity_guid) {
						var link_comments = $('#compass_comments_' + data.output.comment_type + '_' + data.output.entity_guid);
						if (link_comments.length > 0) {
							link_comments.replaceWith(data.output.link_comment);
						}
					}
                    
                    // Add item list comment
                    if (data.output && data.output.content_comment && data.output.entity_guid) {
						var content_comments = $('#content_comments_' + data.output.comment_type + '_' + data.output.entity_guid);
						if (content_comments.length > 0) {
                            var list_comments = $('.list-comments', $(content_comments));
                            if (list_comments.length > 0) {
                                list_comments.append(data.output.content_comment);
                            }
                            var list_empty = $('.list-comments-empty', $(content_comments));
                            if (list_empty.length > 0) {
                                list_empty.addClass('hidden');
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

	elgg.compass.delete_comment = function(event) {

		event.preventDefault();

		var link = $(this);

		var rel = link.attr('rel');
		var listWrapper = link.parents('.elgg-list-annotation');
		if (confirm(rel)) {
			// Ajax loading
			link.find('span').addClass('ajax-loading');
			var action = link.attr('href');
			var options = {
				success: function(data) {
					if (data.system_messages.success.length > 0) {
						var elgg_item = link.parents('.elgg-item');

						elgg_item.remove();

						if (data.output && data.output.link_comment && data.output.entity_guid) {
							var link_comments = $('#compass_comments_' + data.output.comment_type + '_' + data.output.entity_guid);
							if (link_comments.length > 0) {
								link_comments.replaceWith(data.output.link_comment);
							}
						}
                        
                        // Add item list comment
                        if (data.output && data.output.annotation_id && data.output.entity_guid) {
                            var content_comments = $('#content_comments_' + data.output.comment_type + '_' + data.output.entity_guid);
                            if (content_comments.length > 0) {
                                var list_comments = $('.list-comments', $(content_comments));
                                if (list_comments.length > 0) {
                                    var item = $('#item-list-comments-'+data.output.annotation_id, $(list_comments));
                                    if (item.length > 0) {
                                        item.remove();
                                    }
                                }
                                var list_empty = $('.list-comments-empty', $(content_comments));
                                var list_items = $('.item-list-comments', $(content_comments));
                                if (list_empty.length > 0 && list_items.length < 1) {
                                    list_empty.removeClass('hidden');
                                }
                            }
                        }
						
						//Check if empty li.
						if($('li', $(listWrapper)).length == 0) {
							$(listWrapper).remove();
						}
					}
					link.find('span').removeClass('ajax-loading');
				}
			};

			elgg.action(action, options);
		}

	};	
	
	
	elgg.compass.dropInit = function() {
        draggable_options = {
            cursor: "move",
            items: ".portlet",
            connectWith: ".draggable-area",
            receive: elgg.compass.dropAction
        }
        $( ".draggable-area" ).sortable(draggable_options);
 
        $( ".portlet" ).addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
		.find( ".portlet-header" )
		.addClass( "ui-widget-header ui-corner-all" )
		/*.prepend( "<span class='ui-icon ui-icon-plusthick'>[+]</span>")*/
		.end()
		.find( ".portlet-content" );
 
        $( ".portlet-header .ui-icon" ).click(function() {
            $( this ).toggleClass( "ui-icon-plusthick" ).toggleClass( "ui-icon-minusthick" );
			//			$( this ).toggle(function(){ $(this).html('[+]');}, function(){ $(this).html('[-]');console.log('sale');});
			if ($(this).hasClass('ui-icon-plusthick')) {
				$(this).html('[+]');
			}
			else {
				if ($(this).hasClass('ui-icon-minusthick')) {
					$(this).html('[-]');
				}
			}
            $( this ).parents( ".portlet:first" ).find( ".portlet-content" ).slideToggle();
        });
 
        $( ".draggable-area" ).disableSelection();	
	}

	elgg.compass.dropAction = function( event, ui ) {
		var origen = $(ui.sender).parents('.column');
		var received = $(this).parents('.column')
		var origen_name = origen.attr('rel');
		var received_name = received.attr('rel');
		var ticket_id = $(ui.item).attr('rel'); 
		var scrumboard_url = $('#scrumboard_url').val();
		
		var options_url = {
			async : 1, 
			skip_layout : 1, 
			column: received_name, 
			milestone_id: $('#milestone_id').val(),
			ticket_id: ticket_id,
			origen: origen_name,
			received: received_name 
		}
		
		received.find('h3').addClass('ajax-loading');
		var href = elgg.get_site_url()+'action/compass/changestatus';
		elgg.action(href, {
			data: {
				guid: ticket_id,
				origen: origen_name,
				received: received_name
			},
			success: function(data) {
				if (data.system_messages.error > 0) {
					$(ui.sender).sortable( "cancel" );
				}
				else {
					var icon = $(ui.item).find('.ui-icon');
					if (icon) {
						$(icon).removeClass('ui-icon-minusthick');
						$(icon).addClass('ui-icon-plusthick')
						$(icon).html('[+]');
					}
					$(ui.item).attr('data-status', received_name);
					elgg.compass.updateColumn();
				}
				received.find('h3').removeClass('ajax-loading');
				elgg.compass.compassFilter();
			}
		});
		
	}

	elgg.compass.updateColumn = function(){
		//elgg.compass.checkWip(); 
		//$('.')
		$('.draggable-area').sortable(draggable_options);
	}
	
	elgg.compass.compassFilter = function() {
		
		//Filtro
		var filter = '';
        
        // Section
        $('#compass_section').val('0');
		
		// Responsable
		var responsible = $('#responsible').val();
		if (responsible > 0) {
			filter += '[data-responsible='+responsible+']';
		}
		
		// Importancia
		var is_checked_important = $('#tasks_info_important').is(':checked');
		if (is_checked_important) {
			filter += '[data-priority=high]';
		}
		
		// Retrasada
		var is_checked_overdue = $('#tasks_info_overdue').is(':checked');
		if (is_checked_overdue) {
			filter += '[data-overdue=1][data-status!=finished]';
		}
		
		// Search
		var search = $.trim($('#search_compass').val());
		
		$('.draggable-area').unhighlight();
		
		if (search == '') {
            $('.portlet').show();
//			$('.portlet .portlet-content').hide();
//			$('.portlet').hide();
//			$('.portlet'+filter).show();
		}
		else {
			$('.portlet:visible').hide();
			
			$('.draggable-area').highlight(search);

			var divs = $(".draggable-area span.highlight");
//			divs.show();
			$.each(divs, function(index, value) {
                var $title_content = $(value).parent('.title-content');
                if ($title_content.length > 0) {
                    var $portlet = $title_content.parents('.portlet');
                    if ($portlet.length > 0) {
                        $portlet.show();
//                    var $portlet_header = $title_content.parent('.portlet-header.ui-widget-header');
//                    if ($portlet_header.length > 0) {
//                        $portlet_header.find('.show-hide-details').click();
//                    }
                    }
                }
                else {
                    $(value).parent().unhighlight();
                }
//				$(value).find('.portlet-content').show();
			});
		}
		
		//elgg.compass.checkWip();
		
	}

	elgg.compass.keywordSearch = function() {      
		//Buscador por Keyword
//		$('#tickets_jump').attr('disabled', 'disabled');
		$('#search_compass').keyup(function(){

//			var search = $.trim($(this).val());
//			if(search.substring(0, 1) == '#'){
//				$('#tickets_jump').attr('disabled', '');
//			}

//			if(search == ''){
				//$('.draggable-area *').parents('div').show();
				//$('.draggable-area *').show();
//				$('.portlet').show();
//				$('.portlet .portlet-content').hide();   
//			}else{
				//$('.draggable-area *').hide();
				//$('.draggable-area *').parents('div').hide();
//				$('.portlet:visible').hide();
//			}
			
			elgg.compass.compassFilter();
			
//			$('.draggable-area').unhighlight();
//			$('.draggable-area').highlight(search);
			
//			$(".draggable-area span.highlight").parents('div').show();
		});
	}

	elgg.compass.checkWip = function(){
		/*var selects = $('.max_tasks');
		$.each(selects, function(){
			obj = $(this);
			var wip = parseInt(obj.val());
			var elements = obj.parents('.column').find('.portlet:visible').length;
			if (elements > wip) {
				obj.parents('.column').addClass('overload');
			} else {
				obj.parents('.column').removeClass('overload');
			}
		});*/
	}
    
    elgg.compass.filter_by_section = function(event) {
        
        var val = $(this).val();
        
        $('#search_compass').val('');
        $('.draggable-area').unhighlight();
//        elgg.compass.compassFilter();
        
//        $('.ui-widget.portlet').removeClass('hidden');
        $('.ui-widget.portlet').show();
        if (val !== '0') {
//            $('.ui-widget.portlet:not([data-section='+val+'])').addClass('hidden');
            $('.ui-widget.portlet:not([data-section='+val+'])').hide();
        }
        
    }

	elgg.register_hook_handler('init', 'system', elgg.compass.init);