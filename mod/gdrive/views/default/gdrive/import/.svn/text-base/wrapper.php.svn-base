<?php

/**
 * Gdrive import
 */

$page_owner = elgg_get_page_owner_entity();

if (!elgg_instanceof($page_owner, 'group', 'project')) {
    return TRUE;
}

?>
<div class="import-wrapper">
    <ul class="list-import">
        <li class="upload-item-list">
            <span><?php echo elgg_echo('gdrive:import:upload:file'); ?></span>
            <?php
                echo elgg_view('output/url', array(
                    'text' => elgg_echo('gdrive:import:upload'),
                    'href' => $vars['url'] . 'gdrive/add/' . $page_owner->getGUID(),
                    'class' => 'elgg-button',
                ));
            ?>
        </li>
        <li class="google-item-list">
            <span><?php echo elgg_echo('gdrive:import:google'); ?></span>
            <?php
                echo elgg_view('output/url', array(
                    'text' => elgg_echo('gdrive:import:browse:google'),
                    'href' => $vars['url'] . 'gdrive/importgoogle/' . $page_owner->getGUID(),
                    'class' => 'elgg-button gdrive-auth gdrive-google',
                ));
            ?>
        </li>
    </ul>
</div>