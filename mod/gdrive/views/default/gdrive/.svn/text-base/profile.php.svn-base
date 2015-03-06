<?php
/*
 * Full profile view.
 *
 * @uses $vars['entity']
 *
 * */

$entity = $vars['entity'];
if (!($entity instanceof GDrive)) {
	return FALSE;
}
$subtype = $entity->getSubtype();

//Get title
$title = $entity->title;

$params_hook = array('entity' => $entity); //Should we add another params ?
//The list of elements that we dont want to include into the entity profile.
$exclude_fields = array('title', 'description', 'access_id', 'container_guid');

//Add a hook, so we can add some fields to exclude.
$exclude_fields = elgg_trigger_plugin_hook('entity:profile:exclude:fields', $entity->getType(), $params_hook, $exclude_fields);

//The the fields to print.
$object_fields = $entity->getObjectValues($exclude_fields);

//Add hook, so we can add some fields into the entity profile.
$object_fields = elgg_trigger_plugin_hook('entity:profile:output:fields:extend', $entity->getType(), $params_hook, $object_fields);

////The list of elements that we dont want to include into the entity profile.
$include_description_fields = array(
	 'include' => array('description'),
);

//Add a hook, so we can add some fields to exclude.
$include_description_fields['include'] = elgg_trigger_plugin_hook('entity:profile:description:fields', $entity->getType(), $params_hook, $include_description_fields['include']);

//The the fields to print.
$object_description_fields = $entity->getObjectValues($include_description_fields);

$image_support = GDriveBaseMain::ktform_get_entity_image_support($subtype);

//Get description
$description = $entity->description;

//Time
$friendly_time = elgg_get_friendly_time($entity->time_created);

//Owner
$owner = $entity->getOwnerEntity();

$icon = FALSE;
if ($image_support && ($image_support !== GDriveBaseMain::$GDrive_st_OWNER_ICON_NAME)) {
//Get icon
	$icon_entity = $vars['entity'];

	$icon = elgg_view(
			  'gdrive/icon', array(
		 'entity' => $icon_entity,
		 'size' => 'large',
			  )
	);
}
?>
<div class='ktFormCont'>
	<?php // Title Section  ?>

	<?php // Picture and entity fields Section ?>
	<div class='ktFormContInner'>
		<?php if ($image_support && $icon) { ?>
			<div class="ktFormContIcon"><?php echo $icon; ?></div>
		<?php } ?>
		<?php if (is_array($object_fields) && count($object_fields) > 0) { ?>
			<ul class='ktFormFields ktFormProfile'>
				<?php
				foreach ($object_fields as $internalname => $field_data) {
					$tmp_classname = GDriveBaseMain::ktform_camelize_string($internalname, FALSE);
					$field = '<li class="' . $tmp_classname . '">';
					$field .= '<strong>';
					$field .= $field_data['label'];
					$field .= ':</strong> ';
					$field .= '<div class="ktFormFieldsData">';
					$field .= $field_data['value'];
					$field .= '</div>';
					$field .= '</li>';

					echo $field;
				}
				?>
			</ul>
		<?php } ?>
		<div class="clearfloat">&nbsp;</div>
	</div>
	<?php // Buttons Section  ?>
	<?php
	// This view should be extended to add some buttons.
	$profile_btns = elgg_view('gdrive/profile/buttons', $vars);
	//If no data, do not print the wrapper.
	if ($profile_btns) {
		?>
		<div class='ktFormButtonsCont'>
			<?php
			echo $profile_btns;
			?>
			<div class="clearfloat">&nbsp;</div>
		</div>
		<?php
	}
	?>
	<?php // Description Section ?>
	<div class='ktFormDescCont'>
		<?php foreach ($object_description_fields as $desc_internalname => $description_field) { ?>
			<div class="ktFormDescInner <?php echo GDriveBaseMain::ktform_camelize_string($desc_internalname, FALSE) ?>">
				<h4><?php echo $description_field['label'] ?></h4>
				<div class='ktFormTxt'>
					<?php echo $description_field['value'] ?>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php // Owner Section  ?>
	<?php if ($vars['hide_owner'] != TRUE) { ?>
		<div class='ktFormUserInfo'>
			<div class="ktUserInfo">
				<?php
				// Default separator.
				$separator = '<span class="sep">&middot;</span>';
				?>
				<div class="img">
					<?php
					echo elgg_view_entity_icon($owner, 'tiny');
					?>
				</div>
				<div class="txt">
					<a href="<?php echo $owner->getURL(); ?>"><?php echo $owner->name; ?></a>
					<?php echo $separator; ?>
					<span class="timeSpan"><?php echo $friendly_time; ?></span>
					<?php echo $separator; ?>
					<?php
					$metadata = elgg_view_menu('entity', array(
						 'entity' => $entity,
						 'handler' => 'gdrive',
						 'sort_by' => 'priority',
						 'class' => 'elgg-menu-hz elgg-bottom-object-menu float-right',
							  ));
					echo $metadata;
					?>
				</div>
				<div class="clearfloat ">&nbsp;</div>
			</div>
			<?php // Extensible section, to add comments, likes, etc  ?>

			<div class="clearfloat">&nbsp;</div>
		</div>
	<?php } ?>
	<?php /** You can extend anything over here * */ ?>
	<?php
	echo elgg_view('gdrive/profile/profile_footer', $vars);
	?>
</div>