<?php

/**
 * Get events
 */
forward();
//if (!elgg_is_xhr()) {
//    forward();
//}

//if (!elgg_is_logged_in()) {
//    echo '';
//    exit;
//}

//$calendar_id = get_input('calendar_id');
//if (empty($calendar_id)) {
//    echo '';
//    exit;
//}

// Google Calendar
$gci = new GCalendarIntegration();
//$gci->authenticate();
$start_time_date = strtotime(date('2013-08-31 11:00:00'));
$end_time_date = strtotime(date('2013-08-31 16:00:00'));

$options = array(
    'start_time_date' => $start_time_date,
    'end_time_date' => $end_time_date,
);
$events = $gci->getEventsForCalendar($options);

//echo '<pre>';
//var_dump($events);
//echo '</pre>';

//if ($events instanceof Google_Events) {
//    $items = $events->getItems();
//    echo '<pre>';
//    var_dump(count($items));
//    echo '</pre>';
//    foreach($items as $item) {
//        if ($item instanceof Google_Event) {
//            
//        }
//    }
//}

//exit;