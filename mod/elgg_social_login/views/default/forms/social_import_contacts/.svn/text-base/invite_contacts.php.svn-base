<?php

/**
 * Social Import Contacts / Invite Contacts
 */

$site = elgg_get_site_entity();
$introduction = elgg_echo('social_import_contacts:invite_contacts:introduction');
$message = elgg_echo('social_import_contacts:invite_contacts:message');
$default = elgg_echo('social_import_contacts:invite_contacts:message:default', array($site->name));

echo <<< HTML
<div>
	<label>
		$introduction
		<textarea class="elgg-input-textarea" name="emails" ></textarea>
	</label>
</div>
<div>
	<label>
		$message
		<textarea class="elgg-input-textarea" name="emailmessage" >$default</textarea>
	</label>
</div>
HTML;

echo '<div class="elgg-foot">';
echo elgg_view('input/submit', array('value' => elgg_echo('social_import_contacts:invite_contacts:invite')));
echo '</div>';