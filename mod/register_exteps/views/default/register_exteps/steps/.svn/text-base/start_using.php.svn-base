<?php

$url = elgg_get_site_url() . 'startusing';

//Remove query string
$url_array = parse_url($url);
unset($url_array['query']);
$url = elgg_http_build_url($url_array);
$path = AnyPage::normalizePath(str_replace(elgg_get_site_url(), '', $url));

$page = AnyPage::getAnyPageEntityFromPath($path);

if($page instanceof AnyPage){
	echo elgg_view('output/longtext', array(
        'value' => $page->description,
    ));
}

$user = ProfileComplete::get_user_entity();
if ($user) {
	$user->start_using = 'yes';
}