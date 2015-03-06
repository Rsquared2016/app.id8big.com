<?php

/*
 * Repository Viewer: output/repositoryviewer
 */

// Get url
$url = elgg_extract('value', $vars, '');

// Get info
$info = repositoryviewer_get_info_from_url($url);
if (!is_array($info) || empty($info)) {
	return true;
}

// Get repository user
$repository_user = '';
if (isset($info['repository_user'])) {
	$repository_user = $info['repository_user'];
}

// Get repository name
$repository_name = '';
if (isset($info['repository_name'])) {
	$repository_name = $info['repository_name'];
}

if (empty($repository_user) || empty($repository_name)) {
	return true;
}

?>
<div class="repositoryviewer"></div>
<script type="text/javascript">
$(document).ready(function() {
	$('.repositoryviewer').repo({
		user: '<?php echo $repository_user; ?>',
		name: '<?php echo $repository_name; ?>'
	});
});
</script>