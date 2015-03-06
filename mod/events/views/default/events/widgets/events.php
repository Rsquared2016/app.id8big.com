<?php
/**
 * Generic widget for racers 
 */
$page_owner = elgg_extract('page_owner', $vars);

$extra_class = elgg_extract('extra_class', $vars, 'blockHome');
$widget_title = elgg_extract('widget_title', $vars, '');

$max_items = (int) elgg_extract('max_items', $vars, 4);

$display_view_all = (bool) elgg_extract('display_view_all', $vars, FALSE);
$display_title = (bool) elgg_extract('display_title', $vars, TRUE);


$default = array(
	'annotation_name' => EVENTS_ATTEND_ANNOTATION_NAME,
	'annotation_values'	=> EVENTS_ATTEND_YES,
	'annotation_owner_guids' => array($page_owner->getGUID()),
	'count' => FALSE,
);

if (!is_array($options)) {
	$options = array();
}
$options = array_merge($default, $options);
$access_alowed = ACCESS_LOGGED_IN;
$options['wheres'] = array("e.access_id = '{$access_alowed}'");
$events = elgg_get_entities_from_annotations($options);

if (!$events) {
	return FALSE;
}

$extraClass = 'blockEvents';

?>
<div class="<?php echo $extra_class ?> widgetBlock <?php echo $extraClass ?>">
<?php if ($display_title) { ?>
		<h3>
			<?php echo $widget_title ?>
			<?php if ($display_view_all) { ?>
				<a href="#">View all</a>
			<?php } ?>
		</h3>
		<?php } ?>
	<div class="bhCont">
	<?php
	if (!empty($events)) {
		$last_item = sizeof($events);
		$i_cont = 1;
		foreach ($events as $event) {
			
			$start_date = $event->start_date;
			$time = '';
			if ($start_date) {
				$user_star_time = events_get_user_time_start($event);

				$time .= date("F j - G:i", $user_star_time);
			}

			$end_date = $event->end_date;
			if ($end_date) {
				$user_end_time = events_get_user_time_end($event);
				$time .= ' to ' .date("F j - G:i", $user_end_time);
			}
	?>
		<div class="eventItem  <?php if ($i_cont == $last_item) { echo 'npBot nbBot'; } else { $i_cont++; } ?>">
			<div class="eventIcon flLef">
				<a href="<?php echo $event->getUrl() ?>">
					<img src="<?php echo $event->getIconUrl(); ?>" alt="" />
				</a>
			</div>
			<div class="eventInfo flLef">
				<a href="<?php echo $event->getUrl() ?>" class="aTitle"><?php echo $event->title ?></a>
				<p class="eventLocationInfo nmBot"><?php echo $event->location; ?></p>
				<p class="eventDateInfo nmBot"><?php echo $time; ?></p>
			</div>
			<div class="cThis"></div>
			<?php
				/*
				ESTA ES LA DIV PARA QUE GABRIEL AGREGUE EL CARTEL SI EL EVENTO ESTA CANCELADO O NO
				*/
			?>
			<?php
				if($event->isCanceled()) {
			?>
			<div class="eventState eventStateClosed"></div>
			<?php
				}
			?>
		</div>
	<?php
			}
		} else {
			echo elgg_echo('gearzy:widgets:teams:empty_content');
		}
	?>
	</div>	
</div>