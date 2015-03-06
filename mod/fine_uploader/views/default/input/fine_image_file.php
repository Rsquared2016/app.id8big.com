<?php


$entity = elgg_extract('entity', $vars);
if (!($entity instanceof ElggEntity)) {
    return;
}

$owner_guid = $entity->getOwnerGUID();

$associate_guid = $entity->getGUID();

elgg_load_js('fine_uploader');
elgg_load_css('fine_uploader');
elgg_load_js('fine_uploader_init');

?>

<div id="fine_uploader_element" data-upload-guid="<?php echo $owner_guid ?>" data-associate-guid="<?php echo $associate_guid ?>">		
    <noscript>			
    <p>Please enable JavaScript to use file uploader.</p>
    <!-- or put a simple form for upload here -->
    </noscript>         
</div>  