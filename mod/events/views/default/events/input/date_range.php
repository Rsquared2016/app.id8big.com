<?php

/**
 * This input mannipulate the date range, should allow to insert an initial date and end date.
 * In future could set up the initial and end time.
 * 
 * Is usefull to handle events, with startdate and enddate.
 */
/**
 * events_ktform_get_default_dates return an array with k=>v the value is the current start time and end time of key, calendar_start and calendar_end 
 */
$entity = FALSE;
if (isset($vars['entity'])) {
	$entity = $vars['entity'];
}


//if (!isset($vars['internalname']) || empty($vars['internalname'])) {
//	$defaults['internalname'] = 'calendar';
//}
$tmp_val = $vars['internalname'];

$vars['internalname'] = 'calendar';
$defaults = EventsBaseMain::ktform_get_default_dates(FALSE);

//Set default date to vars
$vars = array_merge($defaults, $vars);

$internalname_suffix = '_';
//Default names: calendar_start and calendar_end
$start_date_internalname = $vars['internalname'] . $internalname_suffix . 'start'; 
$end_date_internalname = $vars['internalname'] . $internalname_suffix . 'end';

//Add support for custom internalnames
if(array_key_exists('internalname_date_start', $vars)) {
	$start_date_internalname = $vars['internalname_date_start'];
}

if(array_key_exists('internalname_date_end', $vars)) {
	$end_date_internalname = $vars['internalname_date_end'];
}

$values = array();
if ($vars['value']) {
	$values = explode('|', $vars['value']);
	if (count($values) == 2) {
		$vars[$start_date_internalname] = $values[0];
		$vars[$end_date_internalname] = $values[1];
	} else if (count($values) == 1) {
		$vars[$start_date_internalname] = $values[0];
	}
}

$calendar_options = array();
$calendar_options[] = 'buttonImage: "' . $vars['url'] . 'mod/events/ktform/graphics/custom/events/ico-calendar.png"';

//KTODO: Add date picker end, to set as default hs:min:sec => 23:59:59.
$calendar_options[] = 'onSelect: function( selectedDate ) {
					var option = this.id == "' . $start_date_internalname . '" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
					
					$("#' . $start_date_internalname . ', #' . $end_date_internalname . '").not( this ).datepicker( "option", option, date );					
					
					var cal_val = $("#' . $start_date_internalname . '_alt").val()/1000 +"|"+$("#' . $end_date_internalname . '_alt").val()/1000;
					$("#' . $tmp_val . '").val(cal_val);

			}';

$calendar_options = implode(',', $calendar_options);
/**
 * Default values
 * TODO: check whens is an editable field
 */
if (!isset($vars[$start_date_internalname]) && empty($vars[$start_date_internalname])) {
	$vars[$start_date_internalname] = $vars['calendar_start'];
}

if (!isset($vars[$end_date_internalname]) && empty($vars[$end_date_internalname])) {
	$vars[$end_date_internalname] = $vars['calendar_end'];
}

$start_date_input = elgg_view('input/calendar', array('internalname' => $start_date_internalname, 'value' => $vars[$start_date_internalname], 'options' => $calendar_options));
$end_date_input = elgg_view('input/calendar', array('internalname' => $end_date_internalname, 'value' => $vars[$end_date_internalname], 'options' => $calendar_options));

$hidden_input = elgg_view('input/hidden', array('internalname' => $tmp_val, 'internalid' => $tmp_val, 'value' => "{$vars[$start_date_internalname]}|{$vars[$end_date_internalname]}"));

echo $start_date_input;


//KTODO: Add all the logic of intervaltimes into events_ktform.
//KTODO: Make it generic, to all objects, think a little.
if($vars['intervaltimes'] && elgg_is_active_plugin('meetups')) {
	
	if($vars['value'] && $vars['entity']) {
		$start_time_date_tmp = $vars['entity']->$start_date_internalname;
		$start_time_date = date('d F Y', $start_time_date_tmp);
		$start_time_hour_min = ((int)($start_time_date_tmp - strtotime($start_time_date))  / 60);
		//End time
		$end_time_date_tmp = $vars['entity']->$end_date_internalname;
		$end_time_date = date('d F Y', $end_time_date_tmp);
		$end_time_hour_min = ((int)($end_time_date_tmp - strtotime($end_time_date))  / 60);
	} else {
		//Start Time
		$suggested_date = meetup_suggested_date(time());
		$start_time_date = get_input('start_time_date',$suggested_date['time_date']);
		$start_time_hour_min = get_input('start_time_hour_min',$suggested_date['time_hour_min']);

		//End Time
		$start_time_suggest_unix = strtotime("+$start_time_hour_min minute", strtotime($start_time_date));
		$suggested_end_date = meetup_suggested_end_date($start_time_suggest_unix);
		$end_time_date = get_input('end_time_date');
		$end_time_hour_min = get_input('end_time_hour_min', $suggested_end_date['time_hour_min']);
	}
	
	
	//Default names: calendar_hour_min_start and calendar_hour_min_end
	$start_date_time_internalname = $vars['internalname'] . $internalname_suffix . 'hour_min_start';
	$end_date_time_internalname = $vars['internalname'] . $internalname_suffix . 'hour_min_end';

	//Add support for custom internalnames
	if(array_key_exists('internalname_time_start', $vars)) {
		$start_date_time_internalname = $vars['internalname_time_start'];
	}

	if(array_key_exists('internalname_time_end', $vars)) {
		$end_date_time_internalname = $vars['internalname_time_end'];
	}
	
	echo elgg_view('input/date_intervaltimes', array(
		'internalname' => $start_date_time_internalname,
		'value' => $start_time_hour_min,
		'class' => 'selectFrm selectFrm20 intervaltimes',
		'cthis' => FALSE,
	));
	
	if ($vars['calendar_end'] != FALSE) {
		echo '<span class="dateRangeTo">'. elgg_echo('events_ktform:input:date:range:to') .'</span>';
	}

	echo elgg_view('input/date_intervaltimes', array(
		'internalname' => $end_date_time_internalname,
		'value' => $end_time_hour_min,
		'class' => 'selectFrm selectFrm20 intervaltimes',
		'cthis' => FALSE,
	));

}

if ($vars['calendar_end'] != FALSE) {
	echo $end_date_input;
}

echo $hidden_input;
