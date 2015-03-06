<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$entity = elgg_extract('entity', $vars, false);
if (!($entity instanceof ProjectGroup)) {
	return false;
}

$url = $vars['url'] . 'action/gdrive/sync?guid=' . $entity->getGUID();
$url = elgg_add_action_tokens_to_url($url);

?>
<div class="sync-files-gdrive-wrapper">
	<?php
        echo elgg_view('gdrive/loading', array(
            'text' => elgg_echo('gdrive:sync:label'),
        ));
    ?>
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
				$('.sync-files-gdrive-wrapper').html('<p class="sync-files-complete"><?php echo elgg_echo('gdrive:sync:finish'); ?></p>');
				elgg.system_message(data.system_messages.success);
                window.location.href = elgg.get_site_url() + 'gdrive/group/' + elgg.get_page_owner_guid() + '/all'
			}
		}
	});
});
</script>