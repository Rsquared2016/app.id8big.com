<?php

/*
 * Social Import Contacts
 */

global $CONFIG;
global $HA_SOCIAL_LOGIN_PROVIDERS_CONFIG;

require_once elgg_get_plugins_path() . "elgg_social_login/settings.php"; 

// Get logged in user
$user_logged_in = elgg_get_logged_in_user_entity();
if (!elgg_instanceof($user_logged_in, 'user')) {
	return false;
}

$project_guid = get_input('project_guid', false);


$project = get_entity($project_guid);

if (elgg_instanceof($project, 'object', 'project')) {
    elgg_set_page_owner_guid($project_guid);
}

// Provider availables
if ($project) {
    $providers_availables = array();
} else {
    $providers_availables = array(
        'Email' => 'Email',
    );
}
foreach ($HA_SOCIAL_LOGIN_PROVIDERS_CONFIG as $item ) {
	$provider_id     = @ $item["provider_id"];
	$provider_name   = @ $item["provider_name"];
	
	if (elgg_get_plugin_setting('ha_settings_' . $provider_id . '_import_contacts', 'elgg_social_login')) {
		$providers_availables[$provider_id] = $provider_name;
	}
}
if (!$project) {
    $providers_availables['Share'] = 'Share';
}

// Get provider active
$provider = get_input('provider', 'Email');
if (!array_key_exists($provider, $providers_availables)) {
	$provider = 'Email';
}

// Site
$site = elgg_get_site_entity();

// In lightbox?
$in_lightbox = elgg_extract('in_lightbox', $vars, false);

// Content tabs
$content_tabs = '';

$invited_contacts_head_class = '';
if (elgg_is_active_plugin('theme_professionalelgg18')) {
	$invited_contacts_head_class = 'ttu';
}
?>
<div class="socialImportContactsWrapper <?php if ($in_lightbox) { echo 'socialImportContactsLightbox'; } ?>">
	<?php
		// Welcome
		if ($in_lightbox) {
	?>
		<div class="mainTitle">
			<h2 class="flLef"><?php echo elgg_echo('social_import_contacts:welcome'); ?></h2>
			<div class="clearfloat"></div>
		</div>
	<?php
		}
	?>
	<div class="iewTxt">
		<p><?php echo elgg_echo('social_import_contacts:text'); ?></p>
	</div>
	<div class="socialButtons">
	<?php		
		foreach ($providers_availables as $provider_id => $provider_name ) {
			$text = '';
			if (in_array($provider_id, array('Email', 'Share'))) {
				$text = elgg_echo('social_import_contacts:social:btn:'.strtolower($provider_id));
			}
			
			$provider_active = '';
			if ($provider_id == $provider) {
				$provider_active = 'on';
			}
            if ($project) {
    ?>
        <a href="<?php echo $vars['url'] . 'social_import_contacts?project_guid=' . $project_guid . '&provider=' . $provider_id; ?>">
    <?php            
            } else {
	?>
		<a href="<?php echo $vars['url'] . 'social_import_contacts?provider=' . $provider_id; ?>">
    <?php
            }
    ?>
		<div class="socialBtn btn<?php echo $provider_name; ?> <?php echo $provider_active; ?>" provider="<?php echo $provider_id; ?>" title="<?php echo $provider_name ?>">
			<?php echo $text; ?>
		</div>
		</a>
	<?php
		}
	?>
	</div>
	<div class="clearfloat"></div>
	<?php
		// Content tabs
		$content = '';
		$invite_contacts_form = '';
		$content_invited_contacts = '';
		
		// Get invite contacts form
		if ($provider == 'Email') {
			if ($in_lightbox) {
				set_input('show_button_later', true);
			}
			$invite_contacts_form = elgg_view_form('social_import_contacts/invite_contacts');
			set_input('show_button_later', false);
		}
		elseif ($provider == 'Share') {
			$invite_contacts_form = elgg_view('social_import_contacts/share_buttons', $vars);
		}
		else {
			$invite_contacts_form = '<form method="POST" class="elgg-form elgg-form-social-import-contacts">';
			$invite_contacts_form .= '<fieldset>';
			$invite_contacts_form .= elgg_view('input/hidden', array('name' => 'provider', 'id' => 'provider', 'value' => $provider));
			$invite_contacts_form .= elgg_view('input/hidden', array('name' => 'ha_popup_base_url', 'id' => 'ha_popup_base_url', 'value' => $vars['url'] . 'mod/elgg_social_login/import_contacts.php?'));
            if ($project) {
                $invite_contacts_form .= elgg_view('input/hidden', array('name' => 'project_guid', 'id' => 'project_guid', 'value' => $project_guid));
            }
			$invite_contacts_form .= '</fieldset>';
			$invite_contacts_form .= '<div class="elgg-foot">';
			$invite_contacts_form .= elgg_view('input/submit', array(
				'value' => elgg_echo("social_import_contacts:provider:invite", array($provider)),
				'class' => 'elgg-button-submit',
				'id' => 'import',
			));
			$invite_contacts_form .= '</div>';
			$invite_contacts_form .= '</form>';
		}
		
		// Get invited contacts
		if ($provider != 'Share') {
			$options = array(
				'annotation_names' => SOCIAL_IMPORT_CONTACTS_INVITED_CONTACTS . '_' . strtolower($provider),
			);
			$list_invited_contacts = social_import_contacts_list_invited_contacts($options);
			if (empty($list_invited_contacts)) {
				$list_invited_contacts = '<p>'.elgg_echo('social_import_contacts:invited:contacts:provider:empty', array($provider)).'</p>';
			}
			$content_invited_contacts = '<div class="elgg-module-aside invited_contacts_wrapper">';
			$content_invited_contacts .= '<div class="elgg-head '.$invited_contacts_head_class.'"><h3>';
			$content_invited_contacts .= elgg_echo('social_import_contacts:invited:contacts:provider', array($provider));
			$content_invited_contacts .= '</h3></div>';
			$content_invited_contacts .= $list_invited_contacts;
			$content_invited_contacts .= '</div>';
		}
		
		$content .= '<div class="socialBtnContent content'.$provider.'">';
		$content .= $invite_contacts_form . $content_invited_contacts;
		$content .= '</div>';
		echo $content;
	?>
	<div class="clearfloat"></div>
</div>
<script type="text/javascript">
	$(document).ready(
		function() {
			// Social Buttons
			/*$('.socialBtn').click(
				function() {
					if($(this).hasClass('on')) {
						return false;
					}
					$('.socialBtn').removeClass('on');
					$(this).addClass('on');
					
					var provider = $(this).attr('provider');
					$('form.elgg-form-social-import-contacts input#provider').val(provider);
//					$('form.elgg-form-social-import-contacts #import').removeAttr('disabled');

					var content = $('.socialBtnContent.content'+provider);
					if (content.length > 0) {
						$('.socialBtnContent').addClass('hidden');
						content.removeClass('hidden');
					}
					
					// Force submit
					if (provider != 'Email') {
						$('form.elgg-form-social-import-contacts').submit();
					}
				}
			);*/
			
			// Form
			$('form.elgg-form-social-import-contacts').submit(function() {
				var popupurl = $("#ha_popup_base_url").val();
				var provider = $("#provider").val();
			<?php 
                if ($project) {
            ?>
				var project_guid = $("#project_guid").val();
				window.open(
					popupurl+"provider="+provider+"&project_guid="+project_guid,
					"hybridauth_social_import_contacts", 
					"location=1,status=0,scrollbars=0,width=800,height=570"
				);
			<?php 
                } else {
            ?>
				window.open(
					popupurl+"provider="+provider,
					"hybridauth_social_import_contacts", 
					"location=1,status=0,scrollbars=0,width=800,height=570"
				);
			<?php 
                }
            ?>
					
				parent.$.fancybox.close();
				
				return false;
			});
			
			$('input#later').click(function() {
				parent.$.fancybox.close();
			});
		}
	);
</script>