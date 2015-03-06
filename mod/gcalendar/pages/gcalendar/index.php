<?php

/*
 * GCalendar: Page Index
 */
//forward();
// Gatekeepr
gatekeeper();

// Get title
$title = elgg_echo('gcalendar:page:index:title');

// Get content
$content = '';

// Try to create event
$error = true;
try {
	$gcalendar = new GCalendarIntegration();
	
	$gcalendar->authenticate();
	
	if ($gcalendar->isAuthenticated()) {
		$options = array(
			'summary' => 'Event Test',
		);
		$event_id = $gcalendar->insertEvent($options);
		if (!empty($event_id)) {
			$error = false;
			
			$content .= elgg_echo('gcalendar:page:index:event:insert', array($options['summary'], $event_id));
			
			// Update event / Add attendees
			$options = array(
				'event_id' => $event_id,
				'attendees' => array(
					'socialadmin@keetup.com',
					'social.amigo1@gmail.com',
					'social.amigo2@gmail.com',
					'social.amigo3@gmail.com',
				),
			);
			$update_event = $gcalendar->updateEvent($options);
			$content .= '<br /><br />' . elgg_echo('gcalendar:page:index:event:update', $options['attendees']);
		}
	}
	else {
		$auth_url = $gcalendar->createAuthUrl();
		$content .= elgg_view('output/url', array(
			'href' => $auth_url,
			'text' => elgg_echo('gcalendar:page:index:connect'),
		));
	}
}
catch (Exception $e) {
	$gcalendar = new GCalendarIntegration();
	
	if(!$gcalendar->isAuthenticated()) {
		$auth_url = $gcalendar->createAuthUrl();
		$content .= elgg_view('output/url', array(
			'href' => $auth_url,
			'text' => elgg_echo('gcalendar:page:index:connect'),
		));
	}
}

$body = elgg_view_layout('content', array(
	'title' => $title,
	'content' => $content,
	'filter_override' => '',
));

echo elgg_view_page($title, $body);