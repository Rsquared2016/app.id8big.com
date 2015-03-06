<?php
/*
 * Full profile view.
 *
 * @uses $vars['entity']
 *
 * KTODO: Mejorar esta vista.
 * */

//Get title
$entity = $vars['entity'];

$title = $entity->title;

if (!$title) {
	$title = $entity->name;
}
if (!$title) {
	$title = get_class($entity);
}

//Get description
$description = elgg_get_excerpt($entity->description, 400);

//Time
$friendly_time = elgg_get_friendly_time($entity->time_created);

//Owner
$owner = $entity->getOwnerEntity();

//Extra listing fields.
$object_subtype = $entity->getSubtype();
$extra_fields = PollsBaseMain::ktform_get_extra_listing_full_fields($object_subtype);

//Image support.
$image_support = PollsBaseMain::ktform_get_entity_image_support($object_subtype);

$icon = FALSE;
if ($image_support) {
//Get icon
	$icon_entity = $vars['entity'];
	if  ($image_support === PollsBaseMain::$Polls_st_OWNER_ICON_NAME) {
		$icon_entity = $vars['entity']->getOwnerEntity();
	}
	
	$icon = elgg_view(
			'kt_polls/icon', array(
			'entity' => $icon_entity,
			'size' => 'large',
		)
	);
}
?>

<div class="search_listing searchListingFull">
	<?php if ($image_support && $icon) {?>
	<div class="ktFullIcon">
		<?php echo $icon; ?>
	</div>
	<?php } ?>	
	<div class="ktFullTxt">
		<h3 class="ktFullTitle"><a href="<?php echo $entity->getUrl(); ?>"><?php echo $title; ?></a></h3>
		<div class="ktFullSubTitle">
			<?php if ($owner) { ?>
				<a href="<?php echo $owner->getURL() ?>"><?php echo $owner->name; ?></a>
				<span class="sep">·</span>
				<span class="infoListingTime"><?php echo $friendly_time ?></span>
			<?php } ?>
			<span class="categories">
				<?php
				// This view should be extended to add a category.
				echo elgg_view('kt_polls/listing_full/info_middle_extend', $vars);
				?>
			</span>
		</div>
		<div class="innerTxt"><?php echo $description; ?></div>
		<?php if ($extra_fields && is_array($extra_fields) && count($extra_fields)) { ?>
			<ul class='ktFormFields'>
				<?php
				foreach ($extra_fields as $internalname => $options) {
					$skip_show_input = FALSE;
					
					$field_label = elgg_echo('kt_polls_ktform:listing:full:titles:' . $internalname);

					$output_view = $options['output_view'];
					$output_vars = array('value' => $entity->$internalname, 'entity' => $entity);

					$block_div = '';
					$tmp_class = PollsBaseMain::ktform_camelize_string($internalname, FALSE);

					
					switch($options['output_view']) {
						case 'output/longtext':
							$block_div = 'fieldValueBlock';

							if (defined('Polls_st_LISTING_FULL_EXCERPT_LONGTEXT')) {
								$excerpt = Polls_st_LISTING_FULL_EXCERPT_LONGTEXT;
							} else {
								$excerpt = 250;
							}

							$options['options']['excerpt'] = $excerpt;							
						break;
						
						case 'output/keetup_categories':
							if (empty($output_vars['value'])) {
								$skip_show_input = TRUE;
							}
							break;
					}

					if (array_key_exists('options', $options)) {
						$output_vars = array_merge($options['options'], $output_vars);
					}
					$field_value = elgg_view($output_view, $output_vars);
					if ($skip_show_input == FALSE) {
					echo "<li class='{$tmp_class} {$block_div}'>
						<div class='fieldLabel'><span class='labelTxt'>{$field_label}</span><span class='labelSep'>:</span></div>
						<div class='fieldValue'>{$field_value}</div>
					</li>";
					}
				}
				?>

			</ul>
		<?php } ?>
		<div class="btnKtFormFull"><?php echo elgg_view('kt_polls/listing_full/buttons', $vars); ?></div>
	</div>
	<div class="clearfloat">&nbsp;</div>
</div>
