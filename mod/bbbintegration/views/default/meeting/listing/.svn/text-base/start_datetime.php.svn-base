<?php

/**
 * BigBlueButton Integration
 */

$meeting = elgg_extract('entity', $vars, false);
if (!elgg_instanceof($meeting, 'object', 'meeting')) {
    return false;
}

$start_datetime = $meeting->getStartDatetimeForUser();
$start_datetime = $meeting->getStartDatetimeFriendly($start_datetime);

?>
<div class="elgg-subtext"><?php echo $start_datetime; ?></div>