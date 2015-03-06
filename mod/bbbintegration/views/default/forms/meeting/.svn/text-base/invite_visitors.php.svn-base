<?php
$entity_guid = get_input('guid', 0);
$entity = get_entity($entity_guid);

$container = $entity->getContainerEntity();

$options = array(
    'relationship' => 'visitor',
    'relationship_guid' => $container->getGUID(),
    'inverse_relationship' => TRUE,
    'limit' => 9999,
    'types' => 'user',
);
$users = elgg_get_entities_from_relationship($options);

if ($users) {

    foreach ($users as $user) {
?>
<div>
	<?php
//        $user instanceof ElggUser;
//        $is_invited = elgg_get_annotations($options);
        $invitations = $entity->getAnnotations('invited');
        $is_invited = false;
        foreach ($invitations as $invitation) {
            $invitation instanceof ElggAnnotation;
            if ($invitation->value == $user->getGUID()) {
                $is_invited = TRUE;
                break;
            }
        }
        if (empty($is_invited)) {
            $check = elgg_view('input/checkboxes', array('name' => 'user_guids', 'default' => FALSE, 'options' => array('' => $user->getGUID())));
            $check = "<div class='check-invite-user'>$check</div>";
        } else {
            $check = "<div class='check-invite-user'>Invited</div>";
        }
        $icon = $check . "<img src='{$user->getIconURL("tiny")}'>";
        $info = "<h3><a href='{$user->getURL()}'>$user->name</a></h3>";

        
        echo elgg_view_image_block($icon, $info);
	?>
</div>
<?php
}

    echo '<div class="elgg-foot">';
    if ($entity_guid) {
        echo elgg_view('input/hidden', array(
            'name' => 'meeting_guid',
            'value' => $entity_guid,
        ));
    }
    echo elgg_view('input/hidden', array(
        'name' => 'container_guid',
        'value' => $vars['container_guid'],
    ));

    echo elgg_view('input/submit', array('value' => elgg_echo('Invite')));

    echo '</div>';
} else {
    echo elgg_echo('meeting:invite:visitors:no_visitors');
}