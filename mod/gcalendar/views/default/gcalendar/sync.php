<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$entity = elgg_extract('entity', $vars, false);
if (!($entity instanceof ProjectGroup)) {
	return false;
}

$url = $vars['url'] . 'action/gcalendar/sync?guid=' . $entity->getGUID();
$url = elgg_add_action_tokens_to_url($url);

?>
<div class="sync-files-gcalendar ajax-loading">
	<?php echo elgg_echo('gcalendar:sync:label'); ?>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$.ajax({
		url: '<?php echo $url; ?>',
		dataType: 'json',
		success: function(data) {
			if (data.system_messages.error.length > 0) {
				elgg.register_error(data.system_messages.error);
			}
			else {
				$('.sync-files-gcalendar').removeClass('ajax-loading');
				$('.sync-files-gcalendar').html('<?php echo elgg_echo('gcalendar:sync:finish'); ?>');
				elgg.system_message(data.system_messages.success);
			}
		}
	});
});
</script>