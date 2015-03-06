<?php

/*
 * GDrive: Page Authenticate
 */

$gdi = new GDriveIntegration();

$gdi->authenticate();

$is_authenticated = $gdi->isAuthenticated();

if (!$is_authenticated) {
	$auth_url = $gdi->createAuthUrl();
	
	forward($auth_url);
}

$content = elgg_view('gdrive/authenticate/index');

echo $content;