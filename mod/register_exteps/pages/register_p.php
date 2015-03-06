<?php

elgg_set_context('register_ex');
define('externalpage', true);

//$default_tab = 'profile_image';
$default_tab = 'personal_information';

$user = ProfileComplete::get_user_entity();
if ($user && $user->next_step == 'go_home' && $user->start_using == 'no') {
	$default_tab = 'start_using';
}

$vars['tab'] = get_input('tab', $default_tab);

// Tabs
$vars['content'] = elgg_view('register_exteps/steps/tabs', array(
	'selected_tabs' => register_exteps_get_user_tab(get_input('user_type')),
	'tab' => $vars['tab'],
));

$vars['content'] .= elgg_view('register_exteps/steps/' . $vars['tab'], $vars);

if (empty($vars['content'])) {
	$vars['content'] = elgg_view('register_exteps/steps/' . $default_tab, $vars);
	$vars['tab'] = $default_tab;
}



$vars['selected_tabs'] = register_exteps_get_user_tab(get_input('user_type'));


$body = elgg_view('register_exteps/steps/wrapper', $vars);

//$title = elgg_echo("register_exteps:welcome");
//
//if (elgg_is_logged_in()) {
//	$title = $title . ' ' . elgg_get_logged_in_user_entity()->name;
//}
$title = elgg_echo('register_exteps:tab_info:personal_information:title:normal');

//$widget_sidebar = elgg_view('register_exteps/widgets/first_steps', array());
$vars = array(
	'content' => $body,
	'sidebar' => FALSE,
	'nav' => FALSE,
	'filter' => FALSE,
//	'title' => $title,
	'class' => 'RegisterExtepWrapperContent',
);

$body = elgg_view_layout('one_column', $vars);

echo elgg_view_page($title, $body);