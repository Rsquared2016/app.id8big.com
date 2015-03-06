<?php

/**
 * GCalendar Import
 */

// Calendar list
$calendar_list = elgg_extract('calendar_list', $vars, FALSE);

?>
<div class="import-gcalendar-wrapper">
    <h2 class="mainContentsTitle subMnCont">
        <span class="titleTxt"><?php echo elgg_echo('gcalendar:widgets:gcalendars:button'); ?></span>
    </h2>
    <div>
    <?php
        // List calendars
        if ($calendar_list instanceof Google_CalendarList) {
            $items = $calendar_list->getItems();
            
            $body = '<p class="list-gcalendar-note">'.elgg_echo('gcalendar:list:calendar:note').'</p>';
            $body .= '<table class="list-gcalendar-google">';
            $body .= '<thead>';
            $body .= '<tr>';
            $body .= '<th class="name-item">'.elgg_echo('gcalendar:list:calendar:name').'</th>';
            $body .= '</tr>';
            $body .= '</thead>';
            $body .= '</table>';
            $body .= '<div class="list-gcalendar-items">';
            $body .= '<table class="list-gcalendar-google">';
            $body .= '<tbody>';
            $has_calendars = FALSE;
            if (!empty($items) && is_array($items)) {
                foreach($items as $item) {
                    if ($item instanceof Google_CalendarListEntry) {
                        $has_calendars = TRUE;

                        $summary = $item->getSummary();

                        $calendar_id = $item->getId();

                        $body .= '<tr class="item-list" data-calendar-id="'.$calendar_id.'">';
                        $body .= '<td class="name-item">'.$summary.'</td>';
                        $body .= '</tr>';
                    }
                }
            }
            $body .= '</tbody>';
            $body .= '</table>';
            $body .= '</div>';
            
            if (!$has_calendars) {
                $body = '<p>'.elgg_echo('gcalendar:list:empty').'</p>';
            }
            echo $body;
        }
        else {
     ?>
        <p><?php echo elgg_echo('gcalendar:load:calendars:error'); ?></p>
     <?php
        }
        echo elgg_view('input/hidden', array(
            'name' => 'calendar_id',
            'value' => '',
        ));
    ?>
    </div>
</div>