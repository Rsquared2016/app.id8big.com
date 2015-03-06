<?php
/**
 * Layout of the projects profile page
 *
 * @uses $vars['entity']
 */

$entity = elgg_extract('entity', $vars, false);
if (!$entity) {
	return true;
}
?>
<div class="project-profile-layout">
	<div class="project-profile-left-col">
		<?php
			echo elgg_view('projects/profile/summary', $vars);
			//if (project_gatekeeper(false)) {
			//	echo elgg_view('projects/profile/widgets', $vars);
			//} else {
			//	echo elgg_view('projects/profile/closed_membership');
			//}
			
			if (project_gatekeeper(false)) {
				set_input('profile_groups_tabs', true);
				echo elgg_view('projects/profile/project_activity_module', $vars);
				set_input('profile_groups_tabs', false);
			}
		?>
	</div>
	<div class="project-profile-right-col">
		<?php
			set_input('profile_groups_tabs', true);
			if (project_gatekeeper(false) && ($entity->isMember() || elgg_is_admin_logged_in())) {
				echo elgg_view('gtask/project_progress', $vars);
				echo elgg_view('projects/profile/project_objectives', $vars);
			}
			if (elgg_is_active_plugin('bbbintegration')) {// && $entity->isCollaborator()
				$vars['options_online_users'] = array(
//					'relationship' => 'collaborator',
					'relationship' => 'member',
					'relationship_guid' => elgg_get_page_owner_guid(),
					'inverse_relationship' => TRUE,
				);
				echo elgg_view('meeting/widgets/user/online', $vars);
			}
			echo elgg_view('projects/sidebar/collaborators', $vars);
			echo elgg_view('projects/sidebar/visitors', $vars);
			set_input('profile_groups_tabs', false);
		?>
	</div>
</div>