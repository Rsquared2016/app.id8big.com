<?php

/*
 * Agenda activity widget
 */

elgg_push_context('widgets');

//Remember... In ajax view logged in is not required.
if(!elgg_is_logged_in()) {
	return false;
}
/*
 * Options: 
 * today => today 
 * this week => from today to the end of the current week sunday.
 * next week => from monday to sunday on the next week.
 */
$filter_date = get_input('filter_date', 'today'); 
$date_options = sparkfire_agenda_get_date(array('filter_date' => $filter_date));

$options = array(
	'metadata_name_value_pairs_operator' => 'AND',
	'grouped_by_day' => TRUE,
    'attend_user_guid' => elgg_get_logged_in_user_guid(),
);

$options = array_merge($options, $date_options);
//echo '<pre>';
//var_dump($options);
//echo '</pre>';
//exit;
$entities_grouped = sparkfire_get_agenda($options);

$content = '';
if($entities_grouped) {
	foreach($entities_grouped as $key_group => $entities) {
		$content .= "<h4>$key_group</h4>";
		foreach($entities as $entity) {
			//$content = elgg_view_entity($entity);
			$content .= elgg_view('agenda/agenda_item', array('entity' => $entity));
		}
	}
} else {
	$content = '<p>' . elgg_echo('agenda:no:content') . '</p>';
}

?>
<div id="agenda-widget-box" class="sidebarBox agendaBox agendaWidget">
	<div class='sidebarBoxHeader'>
		<h3>
			<span class="txt"><?php echo elgg_echo('agenda:widget:title'); ?></span>
			<span class="cThis"></span>
		</h3>
		<div class="btn-group">
		  <a class="btn dropdown-toggle elgg-button elgg-button-action btn-mini" data-toggle="dropdown" href="#">
			  <?php echo elgg_echo("agenda:filter_date:$filter_date")?>
			  <span class="caret"></span>
		  </a>
		  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-search="today"><?php echo elgg_echo('agenda:filter_date:today')?></a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-search="this_week"><?php echo elgg_echo('agenda:filter_date:this_week')?></a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-search="next_week"><?php echo elgg_echo('agenda:filter_date:next_week')?></a></li>
		  </ul>
		</div>
		<div class="cThis"></div>
	</div>
	<div>
		<?php 
		echo $content;
		?>
	</div>
</div>
<?php 

elgg_pop_context();

?>