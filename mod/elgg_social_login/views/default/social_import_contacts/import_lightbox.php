<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$user_logged_in = elgg_get_logged_in_user_entity();
if (!$user_logged_in) {
	return true;
}

$show_import_lightbox = $user_logged_in->show_import_lightbox;
$next_step = $user_logged_in->next_step;

$show = false;
if (!empty($show_import_lightbox) && (empty($next_step) || $next_step == 'go_home')) {
	$show = true;
}

if (!$show) {
	return true;
}

$user_logged_in->show_import_lightbox = false;

//$show_import_lightbox = false;
//if (isset($_SESSION['show_import_lightbox'])) {
//	$show_import_lightbox = $_SESSION['show_import_lightbox'];
//}
//
//$_SESSION['show_import_lightbox'] = false;
//
//if (!$show_import_lightbox) {
//	return true;
//}

$vars['in_lightbox'] = true;

echo '<div class="importLightbox no">';
echo elgg_view('social_import_contacts/wrapper', $vars);
echo '</div>';
?>
<script type="text/javascript">
function social_import_contact_show_lightbox() {
	var content = $('.importLightbox').html();
	$.fancybox({
		content: content
	});
}
$(document).ready(function() {
	setTimeout(social_import_contact_show_lightbox, 2000);
});
</script>