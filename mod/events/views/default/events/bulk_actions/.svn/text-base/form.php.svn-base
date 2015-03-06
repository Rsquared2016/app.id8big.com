<?php
/*
 * Bulk action view, that handles the header and footer form.
 */

$entity_subtype = EventsBaseMain::ktform_get_subtype($vars);

$kt_chck = EventsBaseMain::ktform_get_bulk_action_support($entity_subtype);
?>
<?php
//if (defined('Events_st_DISABLE_BULK_ACTIONS') && Events_st_DISABLE_BULK_ACTIONS != TRUE) {
if($kt_chck) {
	//Get the defined bulk actions for this tab/content.
	$bulk_actions = EventsBaseMain::ktform_get_bulk_action_links($entity_subtype);
	
?>
<div class="ktFrmBulkActionsWrapper">
	<form method="post" action="#" class="ktToolsTop">
		<?php 
			echo elgg_view('input/securitytoken');
		?>
		<label class="ktChkLabel">
			<input type="checkbox" class="ktChk" />
			<span class="txt"><?php echo elgg_echo('events_ktform:bulk_actions:label:all'); ?></span>
		</label>
		<?php
		//Bulk actions.
		echo elgg_view('input/custom_pulldown', array(
			'internalname' => 'action_selected',
			'options_values' => $bulk_actions,
			'class' => 'ktSel',
		));
		?>
		<input type="submit" class="btnSnd" value="<?php echo elgg_echo('events_ktform:bulk_actions:label:apply'); ?>" />
		<div class="cThis">&nbsp;</div>
	</form>
</div>
<?php } ?>