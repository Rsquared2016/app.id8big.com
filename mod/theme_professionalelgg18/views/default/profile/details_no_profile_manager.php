<?php
/**
 * Elgg user display (details)
 * @uses $vars['entity'] The user entity
 */
$user = elgg_get_page_owner_entity();

if ($user->isBanned()) {
	$about .= "<p class='profile-banned-user'>";
	$about .= elgg_echo('banned');
	$about .= "</p>";
} else {
	if ($user->description) {
		$about .= "<p class='profile-aboutme-title'><b>" . elgg_echo("profile:aboutme") . "</b></p>";
		$about .= "<div class='profile-aboutme-contents'>";
		$about .= "<div class='pamInner'>";
		$about .= elgg_view('output/longtext', array('value' => $user->description, 'class' => 'mtn'));
		$about .= "</div>";
		$about .= "</div>";
		$about .= "<a href='#' id='showMore'></a>";
		
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
			<?php
				if(THEME_RESPONSIVE_SUPPORT) {
			?>
				<div class="flRig mnUserProfileResponsive">
					<div class="theButton" id="btnShowHideMnRespProfile"></div>
				</div>
			<?php
				}
			?>
			<div class="clearfloat"></div>
		</div>	
		<?php
			echo elgg_view("profile/status", array("entity" => $user));
		?>
	</div>
<?php
	$description_position = 'bottom';
	if ($description_position == "top") {
		echo $about;
	}

	$fields = elgg_get_config('profile_fields');
	$show_header = FALSE;

	$cat_title = "";
	$field_result = "";
	$even_odd = "odd";


	foreach ($fields as $metadata_name => $output_type) {
		if ($metadata_name != "description") {
			// make nice title
			$title = elgg_echo("profile:{$metadata_name}");

			// get user value
			$value = $user->$metadata_name;

			// adjust output type
			if ($output_type == 'tags') {
				$value = string_to_tag_array($value);
			}

			if ($output_type == "url") {
				$target = "_blank";
			}
			else {
				$target = null;
			}

			// build result
			if (!empty($value)) {
				$field_result .= "<div class='" . $even_odd . " profileFieldRow'>";
				$field_result .= "<b>" . $title . "</b>:&nbsp;";
				$field_result .= elgg_view("output/" . $output_type, array("value" => $value, "target" => $target));
				$field_result .= "</div>\n";
			}
			// give correct class
			if ($even_odd != "even") {
				$even_odd = "even";
			}
			else {
				$even_odd = "odd";
			}
		}
	}
	if (!empty($field_result)) {
		$details_result .= $field_result;
	}
?>
	<div class="profileFields">
<?php
	if (!empty($details_result)) {
		echo "<div id='custom_fields_userdetails'>" . $details_result . "</div>";
	}
	if ($description_position != "top") {
?>
		<div class="<?php echo $even_odd; ?>  profileFieldRow profileAboutCont"><?php echo $about; ?></div>
<?php
	}
?>
	</div>
</div>