<?php

/*
 * BigBlueButton
 */

$action_url = elgg_extract('action_url', $vars, '');

if (!$action_url) {
    return false;
}

?>
<iframe src="<?php echo $action_url; ?>" width="100%" height="500" id="bbbintegration-wrapper" class="meeting-wrapper"></iframe>
<script type="text/javascript">
elgg.bbbintegration.resize_iframe();
elgg.bbbintegration.before_unload_window();

$(window).resize(function() {
    elgg.bbbintegration.resize_iframe();
});
</script>