<?php
/**
* top_notifications
*
* @author German Scarel
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

$url = elgg_get_config('url');

$plugin = elgg_get_plugin_from_id('top_notifications');
$form_body = elgg_view('settings/top_notifications/edit', array('entity' => $plugin));
$form_body .= "<p>" . elgg_view('input/hidden', array('internalname' => 'plugin', 'value' => 'top_notifications')) . elgg_view('input/submit', array('value' => elgg_echo('save'))) . "</p>";

$content = elgg_view('input/form', array('action' => "{$url}action/plugins/settings/save", 'body' => $form_body));
$content = "<div class='contentWrapper'>$content</div>";

echo $content;