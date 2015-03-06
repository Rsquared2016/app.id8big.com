<?php

/*
 * Agenda Item
 */
$entity = elgg_extract('entity', $vars);
//if(!($entity instanceof ElggEntity)) {
//	return FALSE;
//}

$is_google_event = ($entity instanceof Google_Event);
$is_entity = ($entity instanceof ElggEntity);
if (empty($is_google_event) && empty($is_entity)) {
    return FALSE;
}

if ($is_google_event) {
    $link = $entity->getHtmlLink();
    $subtype = 'gcalendar';
    $entity_title = $entity->getSummary();
}
elseif ($is_entity) {
    $link = $entity->getURL();
    $subtype = $entity->getSubtype();
    $entity_title = $entity->title;
}
$title = sprintf('%s: %s', elgg_echo("agenda:item:$subtype"), elgg_get_excerpt($entity_title, 200));

switch($subtype) {
	case 'event':
		if(is_callable('events_get_user_time_start') && defined('EVENT_TIME_FORMAT')) {
//			$entity_when = date('G:i', events_get_user_time_start($entity));
            $entity_when = events_get_user_time_start($entity, EVENT_TIME_FORMAT);
		}
		break;
	case 'meeting':
		if(is_callable('meeting_get_user_time_start') && defined('EVENT_TIME_FORMAT')) {
//			$entity_when = date('G:i', meeting_get_user_time_start($entity));
            $entity_when = meeting_get_user_time_start($entity, EVENT_TIME_FORMAT);
		}
		break;
	case 'gtask':
        if (is_callable('gtask_get_user_time_start') && defined('EVENT_TIME_FORMAT')) {
//          $entity_when = date('G:i', strtotime($entity->calendar_end));
            $entity_when = gtask_get_user_time_start($entity, EVENT_TIME_FORMAT);
        }
		break;
    case 'gcalendar':
        if (is_callable('gcalendar_get_user_time_start') && defined('EVENT_TIME_FORMAT')) {
//            $start = $entity->getStart();
//            $start_datetime = strtotime($start->dateTime);
//            $entity_when = date('G:i', $start_datetime);
            $entity_when = gcalendar_get_user_time_start($entity, EVENT_TIME_FORMAT);
        }
        break;
	default:
		break;
	
}

$extra_class="item-$subtype"; 
?>
<div class="widgetItem <?php echo $extra_class; ?>">
	<div class="itemDate flLef"><?php echo $entity_when; ?></div>
	<div class="itemTitle">
		<?php 
			echo elgg_view('output/url', array('href' => $link, 'text' => $title));
		?>
	</div>
	<div class='cThis'></div>
</div>
	
	
