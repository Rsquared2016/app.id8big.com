<?php
$page_owner = page_owner();

$action_url = $vars['url'].'action/profile/edit';
$action_url = elgg_http_add_url_query_elements($action_url, array('guid' => $page_owner));

$form = new userProfileForm();
$form->setFormAction($action_url);

echo elgg_view('register_exteps/form_wrapper', array('form' => $form));