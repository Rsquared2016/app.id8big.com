<?php

/*
 * Social Import Contacts
 */

// load hybridauth
//require_once( elgg_get_plugins_path() . "elgg_social_login/vendors/hybridauth/Hybrid/Auth.php" );

$contacts = elgg_extract('contacts', $vars, '');
$provider = elgg_extract('provider', $vars, '');
$project_guid = elgg_extract('project_guid', $vars, FALSE);
$highlight = 'all';
//$highlight = 'default';
$site = elgg_get_site_entity();
$project = get_entity($project_guid);
if (elgg_instanceof($project, 'object', 'project')) {
    elgg_set_page_owner_guid($project_guid);
}

?>
<div class="contactsPickerWrapper">
	<p><?php echo elgg_echo('social_import_contacts:invite:text', array($provider)); ?></p>
	<?php
        if ($project) {
            $invitation_types = project_get_invite_type_options(array('selectable' => FALSE));
            $project_input = elgg_view('input/hidden', array(
                'name' => 'project_guid',
                'value' => $project_guid,
            ));
            echo $project_input;
    ?>
    <div class="memberType">
        <label for="invite_types"><?php echo elgg_echo('projects:invite:form:type'); ?></label>
        <?php
        echo elgg_view('input/dropdown', array('name' => 'invite_type', 'options_values' => $invitation_types, 'id' => 'invite_types'));
        ?>
    </div>
	<?php
        }
		// Friends picker
		echo elgg_view('input/contactspicker', array(
			'entities' => $contacts,
			'name' => 'contacts',
			'highlight' => $highlight,
		));
	?>
</div>
<div>
	<label><?php echo elgg_echo('social_import_contacts:form:message'); ?></label>
	<?php
        if ($project) {
            $value = elgg_echo('social_import_contacts:to:project:message:body', array($project->name, $site->name));
        } else {
            $value = elgg_echo('social_import_contacts:message:body', array($site->name, elgg_get_site_url()));
        }
		echo elgg_view('input/plaintext', array(
			'name' => 'body',
			'value' => $value,
		));
	?>
</div>
<div class="elgg-foot npBot">
	<?php
		echo elgg_view('input/hidden', array(
			'name' => 'provider',
			'value' => $provider,
		));
		echo elgg_view('input/submit', array(
			'value' => elgg_echo("social_import_contacts:invite"),
			'class' => 'elgg-button-submit',
			'id' => 'import',
		));
	?>
</div>