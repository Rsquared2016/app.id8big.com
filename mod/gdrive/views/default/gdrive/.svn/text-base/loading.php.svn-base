<?php

/**
 * Gdrive loading
 */

$text = elgg_extract('text', $vars, elgg_echo('gdrive:loading'));
$class = elgg_extract('class', $vars, '');
$show_icon = elgg_extract('show_icon', $vars, TRUE);
?>
<div class="loading-wrapper <?php echo $class; ?>">
    <p><?php echo $text; ?></p>
    <?php if ($show_icon) { ?>
    <span class="ajax-loading"></span>
    <?php } ?>
    <div class="clearfix"></div>
</div>