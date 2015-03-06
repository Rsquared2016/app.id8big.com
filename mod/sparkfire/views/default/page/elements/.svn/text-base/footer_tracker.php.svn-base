<?php

$company_id = 96;//TODO: CONFIGURE HERE;
$site_id = 221;//TODO: CONFIGURE HERE 

$guid = get_input('guid');
$entity = get_entity($guid);

$page = get_input('page');
$pages = array();
if ($page && !$entity) {
	$pages = explode('/', $page);
	if (isset($pages[0]) && $pages[0] == 'view') {
		if (isset($pages[1]) && is_numeric($pages[1])) {
			$entity = get_entity($pages[1]);
		}
	}
}


$content_type = get_input('handler');
if(!$content_type) {
	$content_type = get_context();
}

$ratings_count = 0;
$favorites_count = 0;
$comments_count = 0;
$likes_count = 0;
if ($entity instanceof ElggObject) {
	$comments_count = (int) $entity->countComments();
	$likes_count = (int) $entity->countAnnotations('likes');
	//KTODO: Implement rating & favorites.
}

$prand_id = abs(crc32(current_page_url()));
$cat_id = (($prand_id % 2) == 0) ? 'One' : 'Two';
$content = array(
	'type' => $content_type,
	'keyword' => '',
	'lang' => get_current_language(),
	'comments_count' => $comments_count,
	'likes_count' => $likes_count,
	'ratings_count' => $ratings_count,
	'favorites_count' => $favorites_count,
	'therapeutic_area' => 'Therapeutic Area '.$cat_id,
	'profession' => 'Profession '.$cat_id,
	'topic' => 'Topic '.$cat_id,
	'category' => 'Category '.$cat_id,
	'subcategory' => 'Subcategory '.$cat_id,
	'content_format' => (($prand_id % 2) == 0) ? 'other' : 'text',
	'target_segment' => (($prand_id % 2) == 0) ? 'segment1' : 'segment2',
);


$user = array();

$user_entity = elgg_get_logged_in_user_entity();
if ($user_entity instanceof ElggUser) {
	$friends_count = elgg_get_entities_from_relationship(array(
		'relationship' => 'friend',
		'relationship_guid' => $user_entity->getGUID(),
		'type' => 'user',
		'count' => TRUE,
	));

	$comments_options = array(
		'annotation_owner_guids' => array($user_entity->guid),
		'annotation_names' => array('generic_comment'),
		'annotation_calculation' => 'count'
	);

	$comments_count = (int) elgg_get_annotations($comments_options);

	$likes_options = array(
		'annotation_owner_guids' => array($user_entity->guid),
		'annotation_names' => array('likes'),
		'annotation_calculation' => 'count'
	);

	$likes_count = (int) elgg_get_annotations($likes_options);
	
	
	$user = array(
		'id' => $user_entity->getGUID(),
		'name' => $user_entity->name,
		'email' => $user_entity->email,
		'gender' => $user_entity->gender,
		'icon_url' => $user_entity->getIconURL('medium'), //Size: 200x200
		'birthday' => date('Y-m-d', strtotime('-19 YEARS')), //Y-m-d => 2013-03-02
		'created_at' => date('Y-m-d H:i:s', $user_entity->time_created), //Y-m-d H:i:s => 2013-03-02 21:10:15
		'last_login' => date('Y-m-d H:i:s', $user_entity->last_login), //Y-m-d H:i:s => 2013-03-02 21:10:15
		'friends_count' => $friends_count,
		'comments_count' => $comments_count,
		'likes_count' => $likes_count,
		'ratings_count' => 300,
		'favorites_count' => 0,
		'user_social' => array(),
	);
}


$mdk_settings = array(
	'content' => $content,
	'user' => $user,
	'settings' => array('debug' => FALSE),
	
	'comments' => array(
		'selector' => '.elgg-form-comments-add',
	),
);
?>
<script type="text/javascript" id="mdk-setting-script">
	window.mdk_settings = <?php echo json_encode($mdk_settings); ?>;
	setTimeout(function() {
		var a = document.createElement("script");
		var b = document.getElementsByTagName("script")[0];
		a.src = document.location.protocol + "//insights.dev/tr/l/<?php echo $company_id; ?>/<?php echo $site_id; ?>/s.js?" + Math.floor(new Date().getTime() / 3600000);
		a.async = true;
		a.type = "text/javascript";
		b.parentNode.insertBefore(a, b);
	}, 1);
</script>
