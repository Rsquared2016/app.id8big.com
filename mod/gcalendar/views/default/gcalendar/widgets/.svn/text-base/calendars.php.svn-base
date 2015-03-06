<?php

/**
 * GCalendar Widgets Calendars
 */

// Get user logged in
$user_logged_in = elgg_get_logged_in_user_entity();
if (!elgg_instanceof($user_logged_in, 'user')) {
    return FALSE;
}

$gci = new GCalendarIntegration();
$gcalendars = $gci->getGCalendars();

?>
<div id="calendars-widget-box" class="sidebarBox calendarsBox calendarsWidget">
	<div class="sidebarBoxHeader">
		<h3>
			<span class="txt"><?php echo elgg_echo('gcalendar:widgets:gcalendars:title'); ?></span>
			<span class="cThis"></span>
		</h3>
    </div>
    <div class="sidebarBoxButton">
        <?php
            echo elgg_view('output/url', array(
                'text' => elgg_echo('gcalendar:widgets:gcalendars:button'),
                'href' => 'javascript:void(0)',
                'class' => 'elgg-button btn-mini import-gcalendar gcalendar-auth gcalendar-auth-no',
            ));
        ?>
    </div>
    <div class="sidebarBoxContent calendar-list-widget">
        <?php
            echo elgg_view('gcalendar/list', array(
                'gcalendars' => $gcalendars,
            ));
        ?>
    </div>
</div>