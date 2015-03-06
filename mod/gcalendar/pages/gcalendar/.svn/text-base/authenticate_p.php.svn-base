<?php

/*
 * GDrive: Page Authenticate
 */

$gc = new GCalendarIntegration();

$gc->authenticate();

$is_authenticated = $gc->isAuthenticated();

if (!$is_authenticated) {
	$auth_url = $gc->createAuthUrl();
	forward($auth_url);
}

$content = elgg_view('gcalendar/authenticate/index');

echo $content;