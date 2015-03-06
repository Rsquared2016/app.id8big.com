<?php
/**
 * Elgg user display (details)
 * @uses $vars['entity'] The user entity
 */

	$user = elgg_get_page_owner_entity();
	$about = "";
	if ($user->isBanned()) {
		$about .= "<p class='profile-banned-user'>";
		$about .= elgg_echo('banned');
		$about .= "</p>";
	} else {
		if ($user->description) {
			$about .= "<p class='profile-aboutme-title'><b>" . elgg_echo("profile:aboutme") . "</b></p>";
			$about .= "<div class='profile-aboutme-contents'>";
			$about .= elgg_view('output/longtext', array('value' => $user->description, 'class' => 'mtn'));
			$about .= "</div>";
		}
	}
?>
<div id="profile-details" class="elgg-body pll">
	<div class="titleAndStatus">
		<div id="profileTitle">
			<h2 class="flLef"><?php echo $user->name; ?></h2>
			<?php
			$context = elgg_get_context();
			$show_add_widgets = elgg_extract('show_add_widgets', $vars, TRUE);
			if (elgg_can_edit_widget_layout($context)) {
				if ($show_add_widgets) {
					echo elgg_view('page/layouts/widgets/add_button');
				}
			}
			?>
			<div class="clearfloat"></div>
		</div>
		<?php
			echo elgg_view("profile/status", array("entity" => $user));
		?>
	</div>
<?php

	$description_position = elgg_get_plugin_setting("description_position", "profile_manager");
	$show_profile_type_on_profile = elgg_get_plugin_setting("show_profile_type_on_profile", "profile_manager");
		
	if($description_position == "top"){
		echo $about;
	}
	
	$categorized_fields = profile_manager_get_categorized_fields($user);
	$cats = $categorized_fields['categories'];
	$fields = $categorized_fields['fields'];
	
	$details_result = "";
	
	if($show_profile_type_on_profile != "no"){
		if($profile_type_guid = $user->custom_profile_type){
			if(($profile_type = get_entity($profile_type_guid)) && ($profile_type instanceof ProfileManagerCustomProfileType)){
				$details_result .= "<div class='even'><b>" . elgg_echo("profile_manager:user_details:profile_type") . "</b>: " . $profile_type->getTitle() . " </div>";
			}
		}
	}
	
	if(count($cats) > 0){
				
		// only show category headers if more than 1 category available
		if(count($cats) > 1){
			$show_header = true;
		}
		else {
			$show_header = false;
		}
		
		foreach($cats as $cat_guid => $cat){
			$cat_title = "";
			$field_result = "";
			$even_odd = "odd";
			
			if($show_header){
				// make nice title
				if($cat_guid == -1){
					$title = elgg_echo("profile_manager:categories:list:system");
				}
				elseif($cat_guid == 0){
					if(!empty($cat)){
						$title = $cat;
					}
					else {
						$title = elgg_echo("profile_manager:categories:list:default");
					}
				}
				else if($cat instanceof ProfileManagerCustomFieldCategory) {
					$title = $cat->getTitle();
				}
				else {
					$title = $cat;
				}
				
				$params = array(
					'text' => ' ',
					'href' => "#",
					'class' => 'elgg-widget-collapse-button',
					'rel' => 'toggle',
				);
				$collapse_link = elgg_view('output/url', $params);
				$cat_title = "<h3>" . $title . "</h3>\n";
			}
			
			foreach($fields[$cat_guid] as $field){
				
				$metadata_name = $field->metadata_name;
				if($metadata_name != "description"){					
					// make nice title
					$title = $field->getTitle();
					
					// get user value
					$value = $user->$metadata_name;
					
					// adjust output type
					if($field->output_as_tags == "yes"){
						$output_type = "tags";
						if(!is_array($value)){
							$value = string_to_tag_array($value);
						}
					}
					else {
						$output_type = $field->metadata_type;
					}
					
					if($field->metadata_type == "url"){
						$target = "_blank";
					}
					else {
						$target = null;
					}
					
					// build result
					$field_result .= "<div class='" . $even_odd . " profileFieldRow'>";
					$field_result .= "<b>" . $title . "</b>:&nbsp;";
					$field_result .= elgg_view("output/" . $output_type, array("value" =>  $value, "target" => $target));
					$field_result .= "</div>\n";
					
					// give correct class
					if($even_odd != "even"){
						$even_odd = "even";
					}
					else {
						$even_odd = "odd";
					}
				}
			}
			
			if(!empty($field_result)){
				$details_result .= $cat_title;
				$details_result .= $field_result;	
			}
		}
	}
?>
<div class="profileFields">
<?php
	if(!empty($details_result)){
?>
	<div id='custom_fields_userdetails'><?php echo $details_result; ?></div>
<?php
		if(elgg_get_plugin_setting("display_categories", "profile_manager") == "accordion"){
			?>
			<script type="text/javascript">
				$('#custom_fields_userdetails').accordion({
					header: 'h3',
					autoHeight: false
				});
			</script>
			<?php 
		}
	}
	
	if($description_position != "top"){
?>
		<div class="<?php echo $even_odd; ?>  profileFieldRow profileAboutCont"><?php echo $about; ?></div>
<?php
	}
?>
	</div>
</div>