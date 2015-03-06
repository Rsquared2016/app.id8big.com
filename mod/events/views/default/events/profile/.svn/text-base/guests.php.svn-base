<?php

/*
 * Guests
 */

// Get entity
$entity = elgg_extract('entity', $vars, null);
if (!elgg_instanceof($entity, '', '', 'Events')) {
	return false;
}

// Tabs
$tabs = array(
	EVENTS_ATTEND_YES,
	EVENTS_ATTEND_MAYBE,
	EVENTS_ATTEND_NO,
);

$tabs[] = EVENTS_ATTEND_NOT_REPLIED;
$can_edit = FALSE;
if ($entity->canEdit()) {
	$can_edit = TRUE;
}

$entity_guid = $entity->getGUID();

$current_tab = 'yes';

?>
<ul class="elgg-tabs">
<?php
	foreach($tabs as $tab) {
		$tab_name = elgg_echo('events:guests:tabs:' . $tab);
?>
	<li class="<?php echo ($current_tab == $tab) ? 'elgg-state-selected' : '' ?>">
		<a class="tabGuestsEventListing" href="#" rel="<?php echo $tab; ?>"><?php echo $tab_name ?></a>
	</li>
<?php
	}
?>
</ul>
<?php
	// Get guests
	foreach($tabs as $tab) {
		$guests = $entity->getGuests(array('annotation_value' => $tab, 'offset' => 0, 'limit' => NULL));
?>
		<div class="guestsEventListing <?php echo $tab; ?>AttendListing <?php echo ($current_tab == $tab) ? '' : 'no' ?>">
			<?php
				if (!empty($guests)) {
					foreach ($guests as $guid) {
						$user = get_entity($guid);
						if ($user) {
			?>
						<div class="itemGuest flLef">
							<?php echo elgg_view_entity_icon($user, 'small') ?>
							
						</div>
			<?php
						}
					}
				}
				else {
			?>
					<p><?php echo elgg_echo("events:guests:listing:empty:{$tab}"); ?></p>
					
							<?php
								if ($tab != 'no' && $can_edit) {
									echo elgg_view('output/url', array('href' => "events/invite/{$entity_guid}", 'text' => elgg_echo('events:guests:listing:tabs:invite_link')));
								} 
							?>
					
					
			<?php
				}
			?>
			<div class="cThis"></div>
		</div>
<?php
	}
?>
<script type="text/javascript">
$(document).ready(function() {
	$('.tabGuestsEventListing').click(function(event) {
		event.preventDefault();
		
		var rel = $(this).attr('rel');
		var cont = '.' + rel + 'AttendListing';
		
		// Remove class on / no
		$('.tabGuestsEventListing').parent('li').removeClass('elgg-state-selected');
		$('.guestsEventListing').removeClass('no');
		$('.guestsEventListing').hide();
		
		$(this).parent('li').addClass('elgg-state-selected');
		$(cont).show();
	});
});
</script>