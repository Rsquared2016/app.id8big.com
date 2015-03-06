<?php
/**
 * Elgg right sidebar contents
 *
 */
$context = elgg_get_context();
?>
<div id="three_column_right_sidebar">
	<?php
	//Add an extended view to display at begins of the sidebar
	echo elgg_view('right_sidebar/start/extended');

	//Useful to add widgets in other contexts
	$allowed_context = elgg_trigger_plugin_hook('theme:right:sidebar:display', 'allow_context', array('current_cotext' => $context), 'activity');

	if ($context == $allowed_context) {
		
		$widgets = array();
		
		if (elgg_is_active_plugin('groups')) {
			$widgets['groups'] = 'groups';
		}
		
		if (elgg_is_active_plugin('members')) {
			$widgets['members'] = 'members';
		}
		
		//Launch a hook to override or register new widgets
		$widgets = elgg_trigger_plugin_hook('theme:right:sidebar:widgets', $context, NULL, $widgets);

		if (!empty($widgets)) {
			foreach ($widgets as $widget) {
				echo elgg_view('theme_widgets/' . $widget);
			}
		}
	}

	//Add an extended view to display at end of the sidebar
	echo elgg_view('right_sidebar/end/extended');
	?>
</div>