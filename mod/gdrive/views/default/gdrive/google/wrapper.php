<?php

/**
 * Gdrive Google Wrapper
 */

$page_owner = elgg_get_page_owner_entity();
if (!elgg_instanceof($page_owner, 'group', 'project')) {
    return FALSE;
}

$alternate_link = '';
$entity = elgg_extract('entity', $vars, FALSE);
if (elgg_instanceof($entity, 'object', 'gdrive')) {
    $alternate_link = $entity->alternative_link;
}
$create = elgg_extract('create', $vars, 'no');
?>
<div class="google-wrapper">
    <div class="options-google">
        <?php
            echo elgg_view('output/url', array(
                'text' => elgg_echo('gdrive:back:files'),
                'href' => $vars['url'] . 'gdrive/group/' . $page_owner->getGUID() . '/all',
                'class' => 'elgg-button flRig',
            ));
        ?>
        <div class="clearfix"></div>
    </div>
    <?php
        if ($create == 'no') {
            // Load document
    ?>
    <div class="iframe-google">
        <?php
            if (!empty($alternate_link)) {
                $href = $vars['url'] . 'action/gdrive/savedocument';
                $href .= '?file_guid='.$entity->getGUID().'&file_id='.$entity->file_id.'&t='.time();
                $href = elgg_add_action_tokens_to_url($href);
        ?>
        <iframe id="iframe-google" src="<?php echo $alternate_link; ?>" width="100%" height="100%" /></iframe>
        <script type="text/javascript">
            $(document).ready(function() {
               elgg.gdrive.save_document('<?php echo $href; ?>');
            });
        </script>
        <?php
            }
            else {
        ?>
        <p><?php echo elgg_echo('gdrive:google:error'); ?></p>
        <?php
            }
        ?>
        <div class="clearfix"></div>
    </div>
    <?php
        }
        else {
            // Create document
            echo elgg_view('gdrive/loading', array(
                'text' => elgg_echo('gdrive:google:creating'),
            ));
    ?>
        <script type="text/javascript">
            $(document).ready(function() {
               elgg.gdrive.create_document(); 
            });
        </script>
    <?php
        }
    ?>
</div>