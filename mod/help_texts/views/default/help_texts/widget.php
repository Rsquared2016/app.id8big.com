<?php
/**
 * Elgg help_texts widget
 *
 * @package Help texts
 */
elgg_push_context('widgets');
$options = array(
    'type' => 'object',
    'subtype' => 'help_texts',
    'limit' => 0
);
//$content = elgg_list_entities($options);
$all_helps = elgg_get_entities($options);
$entities = array();
$url = current_page_url();


foreach ($all_helps as $help) {
    if (strpos($url, $help->section) !== FALSE) {
        $entities[] = $help;
    }
}
$options_list = array(
    'full_view' => FALSE,
    'pagination' => FALSE,
);
$content = elgg_view_entity_list($entities, $options_list);
elgg_pop_context();

if ($content) {
    ?>
    <div class="sidebarBox helpTextWidget cicTypeDash1">
        <?php
        echo $content;
        ?>
    </div>
    <?php
} else {
    return false;
}
?>
