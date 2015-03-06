<?php

/*
 * Page searchfriends
 */

$is_xhr = elgg_is_xhr();
if (!$is_xhr) {
	forward();
}

$search = stripslashes(get_input('search', ''));

$options = array(
	'query' => $search,
);

$friends = circles_search_friends($options);

if ($friends) {
	echo elgg_view('circles/listing/list_friends', array('friends' => $friends));
}
else {
	echo elgg_view('circles/listing/nofriends', array('search' => $search));
}
return;