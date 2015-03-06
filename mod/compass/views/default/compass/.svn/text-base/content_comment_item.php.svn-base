<?php

/**
 * Content Comment Item
 */

$item = elgg_extract('item', $vars, FALSE);
if (!($item instanceof ElggAnnotation)) {
    return FALSE;
}

?>
<div id="item-list-comments-<?php echo $item->id; ?>" class="item-list-comments">
    <div class="dash">- </div>
    <?php
        echo elgg_view('output/longtext', array(
            'value' => $item->value,
        ));
    ?>
    <div class="cThis"></div>
</div>