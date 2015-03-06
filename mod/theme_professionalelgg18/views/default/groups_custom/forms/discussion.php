<?php

/*
 * Forms discussion
 */

$group = elgg_extract('entity', $vars, false);
if (!elgg_instanceof($group, 'group')) {
	return false;
}
$container_guid = $group->getGUID();

//$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');

$body = "";
//$body .= "<div>";
//$body .= "<label>".elgg_echo('title')."</label><br />";
$body .= elgg_view('input/hidden', array('name' => 'title', 'value' => $title));
//$body .= "</div>";
$body .= "<div>";
$body .= "<label>".elgg_echo('theme:groups:discussion:note')."</label><br />";
$body .= elgg_view('input/longtext', array('name' => 'description', 'value' => $desc));
$body .= "</div>";
$body .= "<div class='elgg-foot'>";
$body .= elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));
$body .= elgg_view('input/hidden', array('name' => 'profile_group', 'value' => 1));
$body .= elgg_view('input/hidden', array('name' => 'access_id', 'value' => ACCESS_LOGGED_IN));
$body .= elgg_view('input/submit', array('value' => elgg_echo("save")));
$body .= "</div>";

$vars['action'] = $vars['url'] . 'action/discussion/save';
$vars['body'] = $body;
$vars['class'] = 'elgg-form-profile-groups-discussion';
echo elgg_view('input/form', $vars);

/*
?>
<script type="text/javascript">
$(document).ready(function() {
	
	$('form.elgg-form-profile-groups-discussion').submit(function() {
		if (typeof(tinyMCE) == 'object') {
			tinyMCE.triggerSave();
		}
		var val = $(this).find('textarea[name=description]').val();
		if (!val) {
			elgg.register_error('<?php echo elgg_echo('theme:groups:discussion:error'); ?>');
			return false;
		}
		val = val.substring(0, 50);
		$(this).find('input[name=title]').val(val);
	});
	
});
</script>
*/