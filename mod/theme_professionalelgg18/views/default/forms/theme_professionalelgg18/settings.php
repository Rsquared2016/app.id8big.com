<?php
/*
 * Theme Settings
 */

$three_column_support = elgg_get_plugin_setting('three_column_support', THEME_NAME);
$full_width_support = elgg_get_plugin_setting('full_width_support', THEME_NAME);
$responsive_support = elgg_get_plugin_setting('responsive_support', THEME_NAME);
//$use_dynamic_menu = elgg_get_plugin_setting('use_dynamic_menu', THEME_NAME);
$use_widgets_profile_groups_as_tabs = elgg_get_plugin_setting('use_widgets_profile_groups_as_tabs', THEME_NAME);

if (empty($use_widgets_profile_groups_as_tabs)) {
	$use_widgets_profile_groups_as_tabs = 'yes';
}

$profile_groups_show_more_tab = elgg_get_plugin_setting('profile_groups_show_more_tab', THEME_NAME);
$group_tool_options = elgg_get_config('group_tool_options');
$more_tab_options = array('' => '');

if (is_array($group_tool_options)) {
	for ($i = 1; $i < count($group_tool_options); $i++) {
		$more_tab_options[$i] = $i;
	}
}

$show_content_comment_activity = elgg_get_plugin_setting('show_content_comment_activity', THEME_NAME);
if (empty($show_content_comment_activity)) {
	$show_content_comment_activity = 'no';
}

?>
<div class="mtm">
	<label><?php echo elgg_echo('full-width-support'); ?></label>
	<?php
		echo elgg_view('input/dropdown', array(
			'name' => 'full_width_support',
			'options_values' => array(
				'no' => elgg_echo('theme:no'),
				'yes' => elgg_echo('theme:yes'),
			),
			'value' => $full_width_support,
		));
	?>
</div>
<div class="mtm">
	<label><?php echo elgg_echo('responsive-support'); ?></label>
	<?php
		echo elgg_view('input/dropdown', array(
			'name' => 'responsive_support',
			'options_values' => array(
				'no' => elgg_echo('theme:no'),
				'yes' => elgg_echo('theme:yes'),
			),
			'value' => $responsive_support,
		));
	?>
</div>
<div class="mtm">
	<label><?php echo elgg_echo('three-column-support'); ?></label>
	<?php
		echo elgg_view('input/dropdown', array(
			'name' => 'three_column_support',
			'options_values' => array(
				'no' => elgg_echo('theme:no'),
				'yes' => elgg_echo('theme:yes'),
			),
			'value' => $three_column_support,
		));
	?>
</div>
<?php /* <div class="mtm">
	<label><?php echo elgg_echo('use-dynamic-menu'); ?></label>
	<?php
		echo elgg_view('input/dropdown', array(
			'name' => 'use_dynamic_menu',
			'options_values' => array(
				'no' => elgg_echo('theme:no'),
				'yes' => elgg_echo('theme:yes'),
			),
			'value' => $use_dynamic_menu,
		));
	?>
</div> */ ?>
<div class="mtm">
	<label><?php echo elgg_echo('widgets-profile-groups-as-tabs'); ?></label>
	<?php
		echo elgg_view('input/dropdown', array(
			'name' => 'use_widgets_profile_groups_as_tabs',
			'options_values' => array(
				'no' => elgg_echo('theme:no'),
				'yes' => elgg_echo('theme:yes'),
			),
			'value' => $use_widgets_profile_groups_as_tabs,
		));
	?>
</div>
<div class="mtm">
	<label><?php echo elgg_echo('profile-groups-show-more-tab:1'); ?></label>
	<?php
		echo elgg_view('input/dropdown', array(
			'name' => 'profile_groups_show_more_tab',
			'options_values' => $more_tab_options,
			'value' => $profile_groups_show_more_tab,
		));
	?>
	<label><?php echo elgg_echo('profile-groups-show-more-tab:2'); ?></label>
</div>

<div class="mtm">
	<label><?php echo elgg_echo('show-content-comment-in-your-activity'); ?></label>
	<?php
		echo elgg_view('input/dropdown', array(
			'name' => 'show_content_comment_activity',
			'options_values' => array(
				'no' => elgg_echo('theme:no'),
				'yes' => elgg_echo('theme:yes'),
			),
			'value' => $show_content_comment_activity,
		));
	?>
</div>

<div class="elgg-foot">
<?php 
//Submit
echo elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('save')));
//echo elgg_view('input/submit', array('name' => 'restore', 'value' => elgg_echo('Restore'), 'title' => 'Restore Default Css Style'));
?>
</div>
