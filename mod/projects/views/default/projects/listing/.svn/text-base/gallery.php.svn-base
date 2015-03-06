<?php

$project = $vars['entity'];
if (!($project instanceof ProjectGroup)) {
	return;
}
//$icon = elgg_view_entity_icon($project, 'tiny');

$owner = $project->getOwnerEntity();

$owner_link = elgg_view('output/url', array(
	'href' => "file/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));

$date = '<span class="addDot">' .  elgg_view_friendly_time($project->time_created) . '</span>';

$members = $project->countMembers();
$discussions = $project->countDiscussions();
$favorites = $project->countFavorites();

$title = elgg_get_excerpt($project->name, 30);

$title_url = elgg_view('output/url', array('text' => $title, 'href' => $project->getURL(), 'is_trusted' => TRUE));

$is_fav = $project->isFavorite();
$star_icon = elgg_view_icon('star-empty');
if ($is_fav) {
	$star_icon = elgg_view_icon('star-alt');
}

?>
<div class="project-gallery-item">
	<div class="isMarkedAsFavorite"><?php echo elgg_view('output/url', array('text' => $star_icon, 'href' => '#', 'is_trusted' => TRUE)) ?></div>
    <?php echo elgg_view_entity_icon($project, 'medium'); ?>
    <div class="projectGalleryTitle"><?php echo $title_url; ?></div>
	<div class="projectGalleryMoreInfo">
		<span class="discussionCounter">
			<?php 
				$user_member_validation = $project->canWriteToContainer();
				if($user_member_validation){
					echo elgg_view('output/url', array('text' => elgg_view_icon('speech-bubble-alt').$discussions, 'href' => elgg_normalize_url("project_discussion/owner/{$project->getGUID()}"), 'is_trusted' => TRUE)); 
				}
				//echo elgg_view('output/url', array('text' => elgg_view_icon('speech-bubble-alt').$discussions,'href' => '#', 'is_trusted' => TRUE));
			?>
		</span>
		<span class="membersCounter"><?php echo elgg_view('output/url', array('text' => elgg_view_icon('users').$members, 'href' => '#', 'is_trusted' => TRUE)) ?></span>
		<?php
			/*
		?>
		<span class="favCounter"><?php echo elgg_view('output/url', array('text' => elgg_view_icon('star').$favorites, 'href' => '#', 'is_trusted' => TRUE)) ?></span>
		<?php
			*/
		?>
	</div>
</div>
