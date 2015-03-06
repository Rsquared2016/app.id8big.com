<?php

/**
 * Social Import Contacts / Invite Contacts
 */

$site = elgg_get_site_entity();

$emails = get_input('emails');
$emailmessage = get_input('emailmessage');

$emails = trim($emails);
if (strlen($emails) > 0) {
	$emails = preg_split('/\\s+/', $emails, -1, PREG_SPLIT_NO_EMPTY);
}

if (!is_array($emails) || count($emails) == 0) {
	register_error(elgg_echo('social_import_contacts:invite_contacts:noemails'));
	forward(REFERER);
}

$current_user = elgg_get_logged_in_user_entity();

$error = FALSE;
$bad_emails = array();
$already_members = array();
$sent_total = 0;
foreach ($emails as $email) {

	$email = trim($email);
	if (empty($email)) {
		continue;
	}

	// send out other email addresses
	if (!is_email_address($email)) {
		$error = TRUE;
		$bad_emails[] = $email;
		continue;
	}

	if (get_user_by_email($email)) {
		$error = TRUE;
		$already_members[] = $email;
		continue;
	}
	
	$link = social_import_contacts_get_invite_url($current_user);
	$message = elgg_echo('social_import_contacts:invite_contacts:email', array(
					$site->name,
					$current_user->name,
					$emailmessage,
					$link
				)
	);

	$subject = elgg_echo('social_import_contacts:invite_contacts:subject', array($site->name));

	// create the from address
	$site = get_entity($site->guid);
	if ($site && $site->email) {
		$from = $site->email;
	} else {
		$from = 'noreply@' . get_site_domain($site->guid);
	}

	$success = elgg_send_email($from, $email, $subject, $message);
	
	// Recorded emails
	if ($success) {
		$opt_annot = array(
			'guid' => $current_user->getGUID(),
			'annotation_names' => SOCIAL_IMPORT_CONTACTS_INVITED_CONTACTS . '_email',
			'annotation_values' => $email,
		);
		$annotations = elgg_get_annotations($opt_annot);
		if (!$annotations) {
			$current_user->annotate(
				SOCIAL_IMPORT_CONTACTS_INVITED_CONTACTS . '_email',
				$email,
				ACCESS_PRIVATE,
				$current_user->getGUID()
			);
		}
	}
	
	$sent_total++;
}

if ($error) {
	register_error(elgg_echo('social_import_contacts:invite_contacts:invitations_sent', array($sent_total)));

	if (count($bad_emails) > 0) {
		register_error(elgg_echo('social_import_contacts:invite_contacts:email_error', array(implode(', ', $bad_emails))));
	}

	if (count($already_members) > 0) {
		register_error(elgg_echo('social_import_contacts:invite_contacts:already_members', array(implode(', ', $already_members))));
	}

} else {
	system_message(elgg_echo('social_import_contacts:invite_contacts:success'));
}

forward(REFERER);