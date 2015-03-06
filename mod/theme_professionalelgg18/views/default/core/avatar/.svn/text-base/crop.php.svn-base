<?php
/**
 * Avatar cropping view
 *
 * @uses vars['entity']
 */
$entity = elgg_extract('entity', $vars, FALSE);

if (elgg_instanceof($entity) && $entity->icontime) {
?>
<div id="avatar-croppingtool" class="mtl ptm">
	<label><?php echo elgg_echo('avatar:crop:title'); ?></label>
	<br />
	<p>
		<?php echo elgg_echo("avatar:create:instructions"); ?>
	</p>
	<?php echo elgg_view_form('avatar/crop', array(), $vars); ?>
</div>
<?php } ?>