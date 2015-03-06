<?php

/**
 * Gdrive import google
 */

$page_owner = elgg_get_page_owner_entity();

if (!elgg_instanceof($page_owner, 'group', 'project')) {
    return TRUE;
}

?>
<div class="import-google-wrapper">
    <?php
        // Loading
        echo elgg_view('gdrive/loading', array(
            'text' => elgg_echo('gdrive:google:loading:document'),
            'class' => 'load-document',
        ));
        
        // Loading
        echo elgg_view('gdrive/loading', array(
            'text' => elgg_echo('gdrive:google:import:document'),
            'class' => 'import-document hidden',
        ));
        
        echo elgg_view('input/hidden', array(
            'name' => 'container_guid',
            'value' => $page_owner->getGUID(),
        ));
        echo elgg_view('input/hidden', array(
            'name' => 'file_id',
            'value' => '',
        ));
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
           elgg.gdrive.load_documents(); 
        });
    </script>
</div>