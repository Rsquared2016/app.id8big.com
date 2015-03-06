<?php
/**
* register_exteps
*
* @author Bortoli German
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/
$plugin = find_plugin_settings('register_exteps');
$form_body = elgg_view('settings/register_exteps/edit', array('entity' => $plugin));
$form_body .= "<p>" . elgg_view('input/hidden', array('name' => 'plugin', 'value' => 'register_exteps')) . elgg_view('input/submit', array('value' => elgg_echo('save'))) . "</p>";

$content = elgg_view('input/form', array('action' => "{$CONFIG->url}action/plugins/settings/save", 'body' => $form_body));
$content = "<div class='contentWrapper'>$content</div>";

echo $content;