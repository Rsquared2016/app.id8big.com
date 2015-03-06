<?php

/*
 * Gdrive list documents
 */

$items = elgg_extract('items', $vars, array());

// Documents empty
$documents_empty = '<p>'.elgg_echo('gdrive:list:documents:empty').'</p>';

?>
<div class="list-document-wrapper">
<?php
    if (empty($items) || !is_array($items)) {
        echo $documents_empty;
    }
    else {
        // Render items
        $body = '<p class="list-documents-note">'.elgg_echo('gdrive:list:documents:note').'</p>';
        $body .= '<table class="list-documents-google">';
        $body .= '<thead>';
        $body .= '<tr>';
        $body .= '<th class="name-item">'.elgg_echo('gdrive:list:document:name').'</th>';
        $body .= '<th class="modified-item">'.elgg_echo('gdrive:list:document:modified').'</th>';
        $body .= '</tr>';
        $body .= '</thead>';
        $body .= '</table>';
        $body .= '<div class="list-document-items">';
        $body .= '<table class="list-documents-google">';
        $body .= '<tbody>';
        $has_files = FALSE;
        foreach($items as $item) {
            if ($item instanceof Google_DriveFile) {
                $has_files = TRUE;
                
                $title = $item->getTitle();
                
                $file_id = $item->getId();
                $modified_date = $item->getModifiedDate();
                $modified_date = strtotime($modified_date);
                $modified_date = date('Y-m-d H:i:s', $modified_date);
                
                $body .= '<tr class="item-list" data-file-id="'.$file_id.'">';
                $body .= '<td class="name-item">'.$title.'</td>';
                $body .= '<td class="modified-item">'.$modified_date.'</td>';
                $body .= '</tr>';
            }
        }
        $body .= '</tbody>';
        $body .= '</table>';
        $body .= '</div>';

        if (!$has_files) {
            $body = $documents_empty;
        }
        echo $body;
    }
?>
</div>