<?php

/**
 * Projects welcome message
 */

$welcome_message = elgg_get_plugin_setting('welcome_message', 'projects');
if (empty($welcome_message)) {
	return true;
}

if (!isset($_SESSION['projects_show_welcome_message'])) {
	return true;
}

$show_welcome_message = $_SESSION['projects_show_welcome_message'];
if (!$show_welcome_message) {
	return true;
}

$_SESSION['projects_show_welcome_message'] = false;
?>
<div class="projectsWelcomeMessage hidden">
	<div class="projectsWelcomeMessageContent"><?php echo $welcome_message; ?></div>
</div>
<script type="text/javascript">
function projects_show_welcome_message() {
	var content = $('.projectsWelcomeMessage').html();
	$.fancybox({
		content: content
	});
}
$(document).ready(function() {
	setTimeout(projects_show_welcome_message, 2000);
});
</script>