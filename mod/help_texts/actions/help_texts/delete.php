<?php
/**
 * Delete a help_text
 *
 * @package Help texts
 */

$guid = get_input('guid');
$help_text = get_entity($guid);

if (elgg_instanceof($help_text, 'object', 'help_texts') && $help_text->canEdit()) {
	//$container = $help_text->getContainerEntity();
	if ($help_text->delete()) {
		system_message(elgg_echo("help_texts:delete:success"));
		forward("help_texts/all");
	}
}

register_error(elgg_echo("help_texts:delete:failed"));
forward(REFERER);
