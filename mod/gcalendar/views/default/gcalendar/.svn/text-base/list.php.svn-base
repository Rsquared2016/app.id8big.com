<?php

/**
 * GCalendar list
 */

$gcalendars = elgg_extract('gcalendars', $vars, array());
if (empty($gcalendars)) {
    return FALSE;
}

echo elgg_view('input/checkboxes', array(
    'name' => 'gcalendar',
    'options' => $options_checkboxes,
    'class' => 'gcalendars-ul',
));

?>
<ul class="elgg-input-checkboxes elgg-vertical gcalendars-ul">
<?php
    foreach($gcalendars as $gc) {
        // Label
        $label = $gc->title;
        
        // Value
        $value = gcalendar_get_friendly_gcalendar_id($gc->calendar_id);
        
        // Input
        $input_vars = array(
            'name' => 'gcalendar[]',
            'value' => $value,
            'checked' => TRUE,
            'rel' => $value,
        );
        $input = elgg_view('input/checkbox', $input_vars);
        
        // Delete
        $href = 'action/gcalendar/delete?guid=' . $gc->getGUID();
        $href = elgg_add_action_tokens_to_url($href);
        $delete_link = elgg_view('output/url', array(
            'text' => elgg_view_icon('delete'),
            'href' => $href,
        ));
        
        echo "<li class='clearfix'><label>$input$label</label>$delete_link</li>";
    }
?>
</ul>