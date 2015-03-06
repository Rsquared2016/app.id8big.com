<?php

/**
 * circles
 *
 * @author German Scarel
 * @link http://community.elgg.org/pg/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

$newcircle = true;

// Context where the form is loaded (circles, profile)
$from = $vars['from'];

$action = "circles/edit";

if ($newcircle) {
	$title_form = elgg_echo('circles:form:title:new');
	$submit_input = elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('circles:form:submit:new')));
} else {
	$title_form = elgg_echo('circles:form:title:edit');
	$submit_input = elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('circles:form:submit:edit')));
}

$name_label = elgg_echo('circles:form:name');
$name_input = elgg_view('input/text', array('name' => 'namecircle', 'value' => ''));
$from_input = elgg_view('input/hidden', array('name' => 'from', 'value' => $from));

$form_body = "";
if ($from == 'circles') {
	$form_body .= "<div><h2>" . $title_form . "</h2></div>";
}
$form_body .= "<p><label>" . $name_label . "</label>" . $name_input . "</p>" . $submit_input . $from_input;

echo elgg_view('input/form', array('action' => "{$vars['url']}action/$action", 'body' => $form_body, 'id' => 'circleForm'));