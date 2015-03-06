<?php

/*
 * BigBlueButton
 */

// Get meeting
$meeting = elgg_extract('entity', $vars, false);
if (!elgg_instanceof($meeting, 'object', 'meeting')) {
    return false;
}

// Get join url
$url = $vars['url'] . 'action/meeting/join?guid=' . $meeting->getGUID();
$url = elgg_add_action_tokens_to_url($url);

?>
<iframe src="<?php echo $url; ?>" width="100%" height="500" id="bbbintegration-wrapper" class="bbbintegration-wrapper"></iframe>
<script type="text/javascript">
elgg.bbbintegration.resize_iframe();
elgg.bbbintegration.before_unload_window();

$(window).resize(function() {
    elgg.bbbintegration.resize_iframe();
});
</script>