<?php
/*Events Calendar View*/
//Initial ajax url
	elgg_load_js('events.qtip.js');
	$event_load_url = "{$vars['url']}mod/events/endpoint/events_calendar.php";
	$components = array();

//Add params.
	//Container Guid, filter by owner of the events, by user or group.
	if(array_key_exists('container_guid', $vars)) {
		$components['container_guid'] = $vars['container_guid'];
	}

	if(array_key_exists('attend_user_guid', $vars)) {
		$components['attend_user_guid'] = $vars['attend_user_guid'];
	}

	if(array_key_exists('attend_options', $vars)) {
		$attend_options = $vars['attend_options'];
	} else {
		//Attend default options all ones.
		$attend_options = events_get_attend_options();
		//Get only keys.
		$attend_options = array_keys($attend_options);

		$vars['attend_options'] = $attend_options;
	}
	$components['attend_options'] = $attend_options;


//Build ajax url.
	$event_load_url = elgg_http_add_url_query_elements($event_load_url, $components);

	//KTODO: Agregar ajax url en la url de la pagina, para recargar y se cargue la misma ubicacion.
?>

<div class="calendarRelative">
	<?php
		//Calendar header.
		echo elgg_view('events/calendar/header', $vars);
	?>
	<div id='loading' style='display:none'><?php echo elgg_echo('events:loading'); ?></div>
	<div id='calendar'></div>
	<?php
		//Calendar footer.
		echo elgg_view('events/calendar/footer', $vars);
	?>
</div>

<?php
//KTODO: Add language support: http://arshaw.com/fullcalendar/docs/text/buttonText/
//KTODO: Add different calendars views: month, week, day.
?>

<script type='text/javascript'>
	var eventsCalendar = eventsCalendar || {};
	eventsCalendar.calendarId = '#calendar';
	
	Date.prototype.getMonthName = function() {
	   return [
			'<?php echo elgg_echo('events:january') ?>',
			'<?php echo elgg_echo('events:february') ?>',
			'<?php echo elgg_echo('events:march') ?>',
			'<?php echo elgg_echo('events:april') ?>',
			'<?php echo elgg_echo('events:may') ?>',
			'<?php echo elgg_echo('events:june') ?>',
			'<?php echo elgg_echo('events:july') ?>',
			'<?php echo elgg_echo('events:august') ?>',
			'<?php echo elgg_echo('events:september') ?>',
			'<?php echo elgg_echo('events:october') ?>',
			'<?php echo elgg_echo('events:november') ?>',
			'<?php echo elgg_echo('events:december') ?>'
	   ]
	   [this.getMonth()];
	}
	<?php //Define some language keys 
	?>
	eventsCalendar.titleButtonClose = '<?php echo elgg_echo('events:calendar:qtip:title:button:close'); ?>';
	eventsCalendar.descSearchText = '<?php echo elgg_echo('events:calendar:qtip:desc:search:text'); ?>';
	eventsCalendar.descAddText = '<?php echo elgg_echo('events:calendar:qtip:desc:add:text'); ?>';

	$(document).ready(function() {
		var qtip_default_opts = {
				show: {
					when: false, // Don't specify a show event
					ready: true, // Show the tooltip when ready
					solo: true
				},

				hide: {
					when: 'unfocus'
				},
				position: {
					my: 'left center',
                    at: 'top right'
				},
				style: {
					width: 250,
					padding: 0,
					tip: true,
//					name: 'light'
					name: 'cream'
				}
			};

<?php //KTODO: Send agenda mode, into the callback url, eg: month, week, day?>
		var calendarDefault = {
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			events: "<?php echo $event_load_url; ?>",
			lazyFetching : false,
			loading: function(bool) {
				if (bool) $('#loading').show();
				else $('#loading').hide();
			},
            eventRender: function(event, eventElement) {
                if (event.imageurl) {
//                    console.log(eventElement.find('span.fc-event-time'));
                    eventElement.find('.fc-event-time').prepend(event.imageurl);   
                }
                
                if (event.gcalendar_id) {
                    if ($(eventElement).length > 0) {
                        $(eventElement).attr('rel', event.gcalendar_id);
                    }
                    var $checkbox = $('.elgg-input-checkbox[rel='+event.gcalendar_id+']');
                    if ($checkbox.length > 0) {
                        if ($checkbox.is(':checked')) {
                            $(eventElement).show();
                        }
                        else {
                            $(eventElement).hide();
                        }
                    }
                }
            },
			eventClick: function(event, jsEvent, view) {
				//If event have url, forward.
				if(event.url != undefined) {
					window.location.href = event.url;
					return false;
				}

				//Open a qTip with event information.
				var eventDesc = '<div class = "eventCalQtipWrapper">' +
					'<div>'+event.when_friendly + '</div>';
                if (event.where_friendly) {
                    eventDesc += '<div>'+event.where_friendly + '</div>';
                }
                eventDesc += '<div>' + event.description + '</div>' +
					'<div>' + event.view_more_link + '</div>' +
					'</div>';
				
				var qtip_opts_event = {
					content: {
						title: {
							text: event.title_full,
							button: eventsCalendar.titleButtonClose
						},

						text: eventDesc
					},
					hide: 'click'

					
				};

				qtip_opts_event = $.extend(qtip_default_opts, qtip_opts_event);
				
				$(jsEvent.currentTarget).qtip(qtip_opts_event);

			},
			//We should open a qtip, and redirect to the search page.
			dayClick: function(date, allDay, jsEvent, view) {
				//Open a qTip with day information.
				var day_start_whs = parseInt((Date.parse(date))) / 1000;

//				var day_start = new Date(date.getFullYear(), date.getMonth(), date.getDate(), 0, 0, 0); //Date.UTC(year, month[, date[, hours[, min[, sec[, ms]]]]])
//				day_start = parseInt((Date.parse(day_start))) / 1000;
				var day_start = date.getFullYear() + '-' + ((date.getMonth()+1)<10?'0':'') + (date.getMonth()+1) + '-' + (date.getDate()<10?'0':'') + date.getDate();

				var day_end = new Date(date.getFullYear(), date.getMonth(), date.getDate(), 23, 59, 59); //Date.UTC(year, month[, date[, hours[, min[, sec[, ms]]]]])
				day_end = parseInt((Date.parse(day_end))) / 1000;

				var search_url = "<?php echo $vars['url'] ?>pg/events/search?from_date="+day_start+"&to_date="+day_start+"&search_from=calendar";
				var add_url = "<?php echo $vars['url'] ?>pg/events/add?start_date="+day_start+'&end_date='+day_start;

				var eventDesc = '<div class = "eventCalQtipWrapper">' +
					'<div><a href="'+add_url+'">'+ eventsCalendar.descAddText + '</a></div>' +
					'<div><a href="'+search_url+'">'+ eventsCalendar.descSearchText + '</a></div>' +
				'</div>';
			
				$('.qtip.ui-tooltip').qtip('destroy');
				var qtip_opts_event = {
					content: {
						title: {
							text: date.getMonthName() +' - '+ date.getDate(),
							button: eventsCalendar.titleButtonClose
						},
						text: eventDesc
					},
					hide: {
						delay: 200,
						fixed: true // <--- add this
					}

				};

				qtip_opts_event = $.extend(qtip_default_opts, qtip_opts_event);

				$(jsEvent.currentTarget).qtip(qtip_opts_event);
			}
		};

		var calendarExtend = new Object();
		<?php
			//Support for calendar customization.
			$calendarExtend = elgg_view('events/calendar/js/init_params', $vars);
			if(!empty($calendarExtend)) {
		?>
			calendarExtend = {<?php echo $calendarExtend ?>};
		<?php
			}
		?>

		if(typeof(calendarExtend) != 'undefined') {
			calendarDefault = $.extend(calendarDefault, calendarExtend);
		}

		//Show calendar.
//		console.log(calendarDefault);
		$(eventsCalendar.calendarId).fullCalendar(calendarDefault);

	});

</script>
