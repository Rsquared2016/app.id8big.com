<?php
/*
 * Full profile view.
 *
 * @uses $vars['entity']
 *
 **/

//Get title
$title = $vars['entity']->title;

if (!$title) {
	$title = $vars['entity']->name;
}
if (!$title) {
	$title = get_class($vars['entity']);
}

//Get description
$description = $vars['entity']->description;

//Time
$friendly_time = elgg_get_friendly_time($vars['entity']->time_created);

//Owner
$owner = $vars['entity']->getOwnerEntity();

//Get icon ?
$content = elgg_view(
		'meeting/icon', array(
		'entity' => $vars['entity'],
		'size' => 'master',
	)
);

$content = elgg_trigger_plugin_hook('ktform:profile_full', $vars['entity']->type, array('entity' => $vars['entity']), $content)

?>
<div class='ktFormCont'>
	<?php // Title Section ?>
	<div class="innerTitle">
		<h3><?php echo $title; ?></h3>
		<div class="clearfloat">&nbsp;</div>
	</div>
	<div class="goBackBreadCrumb">
		<?php
		//KTODO: Profile Full - Generate a breadcrumbs ?
		
		$go_back_link = '#';
		$go_back_text = elgg_echo('meeting_ktform:profile:full:go:back');

		if(get_input('go_back', '')) {
			$go_back_link = get_input('go_back');
		}
		echo elgg_view('output/url', array(
			'href' => $go_back_link,
			'text' => $go_back_text,
		))
		?>
	</div>
	<?php
		// Entity Content Section
		/*
		 * Tener en cuenta que en esta seccion puede ir algun contenido: imagen, video.
		 * Seria buenno dejar ambos wrappers, por las dudas.
		 * Por ejemplo flechas ant y sig.
		 */
	?>
	<div class='ktFormContInner'>
		<div class="ktFormFullContents"><?php echo $content; ?></div>
	</div>
	<?php // Buttons Section ?>
	<div class='ktFormButtonsCont'>
		<?php
			// This view should be extended to add some buttons.
			echo elgg_view('meeting/profile_full/buttons', $vars);
		?>
		<div class="clearfloat">&nbsp;</div>
	</div>
	<?php // Description Section ?>
	<div class='ktFormDescCont'>
		<div class='ktFormTxt'>
			<?php echo $description; ?>
		</div>
	</div>
	<?php // Owner Section  ?>
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
					//Actions
					$entity_actions = array();

				//	if ($vars['entity']->canEdit()) {
						//Try to get from class.
						if($vars['entity']->canEdit() && is_callable(array($vars['entity'], 'getEntityLinkActions'))) {
							$entity_actions = $vars['entity']->getEntityLinkActions();
							$entity_actions_str = implode($separator, $entity_actions);
							echo $entity_actions_str;
						}
				//	}
				?>
			</div>
			<div class="clearfloat">&nbsp;</div>
		</div>
		<?php // Extensible section, to add comments, likes, etc ?>
		<div class="likesAndMore">
			<?php
				//This view is called to extend from likes and comments.
				echo elgg_view('meeting/profile/owner_section', $vars)
			?>
		</div>
		<div class="clearfloat">&nbsp;</div>
	</div>
	<?php /** You can extend anything over here **/ ?>
	<?php echo elgg_view('meeting/profile_full/profile_footer') ?>
</div>
