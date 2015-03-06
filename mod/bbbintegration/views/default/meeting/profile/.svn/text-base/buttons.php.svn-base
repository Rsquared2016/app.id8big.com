<?php

// Get meeting
$meeting = elgg_extract('entity', $vars, false);
if (!($meeting instanceof Meeting)) {
    return false;
}

$logged_in_user = elgg_get_logged_in_user_entity();
	
//$context = elgg_get_context();
$context = MeetingBaseMain::ktform_get_subtype($vars);

$rating_support = MeetingBaseMain::ktform_get_entity_rating_support($context);

//If the rating is supported into the profile.
if($rating_support['enabled'] && $rating_support['profile']) {
	echo elgg_view('meeting/behavior/rating', $vars);
}
$container = $meeting->getContainerEntity();
// Button Join
$can_join = $meeting->canJoin();
if ($can_join) {
    $are_complete = $meeting->areCompleteNumberParticipants();
    if (!$are_complete) {
        $is_member = true;
		$member_type = '';
		
        if (elgg_instanceof($container, 'group')) {
            $is_member = $container->isMember();
            if (elgg_instanceof($container, 'group', 'project')) {
                $member_type = $container->getMemberType($logged_in_user->getGUID());
            }
        }
		
        if ($is_member) {
			if ($member_type) {
				$invitations = $meeting->getAnnotations('invited');
				$is_invited = false;
				foreach ($invitations as $invitation) {
					$invitation instanceof ElggAnnotation;
					if ($invitation->value == $logged_in_user->getGUID()) {
						$is_invited = TRUE;
						break;
					}
				}
				if ( ($member_type == ProjectSettings::REL_COLLABORATOR) || ($container->getOwnerGUID() == $logged_in_user->getGUID()) || ($is_invited)){
					echo elgg_view('output/url', array(
						'text' => elgg_echo('meeting:button:join'),
						'href' => $vars['url'] . 'meeting/join/' . $meeting->getGUID(),
						'class' => 'elgg-button elgg-button-action',
					));
				}
			}
			else {
				echo elgg_view('output/url', array(
					'text' => elgg_echo('meeting:button:join'),
					'href' => $vars['url'] . 'meeting/join/' . $meeting->getGUID(),
					'class' => 'elgg-button elgg-button-action',
				));
			}
        }
        else {
            echo '<p>' . elgg_echo('meeting:join:member:not') . '</p>';
        }
    }
    else {
        echo '<p>' . elgg_echo('meeting:participants:complete') . '</p>';
    }
}
else {
    $status = $meeting->getStatus();
    echo '<p>' . elgg_echo('meeting:status:' . $status) . '</p>';
}


if (elgg_instanceof($container, 'group') && $container instanceof ProjectGroup) {
    $is_member = $container->isMember();
    
    if ($is_member) {
//        if ( ($member_type == ProjectSettings::REL_COLLABORATOR) || ($container->getOwnerGUID() == $logged_in_user->getGUID()) ){
        if ($container->canWriteToContainer() ){
            $options = array(
                'relationship' => 'visitor',
                'relationship_guid' => $container->getGUID(),
                'inverse_relationship' => TRUE,
                'limit' => 9999,
                'types' => 'user',
                'count' => TRUE,
            );
            $count_users = elgg_get_entities_from_relationship($options);
            if ($count_users) {
                $button_invite_visitor = elgg_view('output/url', array(
                    'href' => $vars['url'] . 'meeting/invite_visitors/' . $meeting->getGUID(),
                    'text' => elgg_echo('meeting:button:invite:visitors'),
                    'class' => 'elgg-button elgg-button-action',
                ));
                echo $button_invite_visitor;
            }
        }
        
    }
}