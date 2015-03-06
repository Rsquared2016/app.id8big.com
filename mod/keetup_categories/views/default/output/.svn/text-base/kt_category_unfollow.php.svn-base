<?php
$entity = $vars['entity'];
if(!$entity) {
	return false;
}

if($entity instanceof KtCategory || $entity instanceof KtSubCategory) {
	//Great!
} else {
	//Not great.
	return false;
}

$guid = $entity->getGUID();

$elements = array(
	'guids' => $guid,
);

//Url and text, default follow.
$url = $vars['url'] . 'action/keetup_categories/follow';
$text = elgg_echo('keetup_categories:follow:btn:text');
if(is_callable(array($entity, 'isFollowing'))) {
	$params = array(
		'relationship' => $vars['follow_rel'],
	);
	$following = $entity->isFollowing($params);
	
	//If following, unfollow.
	if($following) {
		$url = $vars['url'] . 'action/keetup_categories/unfollow';
		$text = elgg_echo('keetup_categories:unfollow:btn:text');
	}
}

$vars['follow_guid'] = $guid;
if($vars['follow_rel']) {
	$elements['follow_rel'] = $vars['follow_rel'];
}
if($vars['follow_type']) {
	$elements['follow_type'] = $vars['follow_type'];
}
if($vars['type_text']) {
	$elements['type_text'] = $vars['type_text'];
}

$url = elgg_http_add_url_query_elements($url, $elements);

$vars['href'] = $url;
$vars['text'] = $text;
$vars['is_action'] = TRUE;

?>
<div>
<?php
	echo elgg_view('output/url', $vars)
?>
</div>