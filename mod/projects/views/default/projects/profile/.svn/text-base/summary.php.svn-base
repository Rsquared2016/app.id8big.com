<?php
/**
 * Project profile summary
 *
 * Icon and profile fields
 *
 * @uses $vars['project']
 */

if (!isset($vars['entity']) || !$vars['entity']) {
	echo elgg_echo('projects:notfound');
	return true;
}

$project = $vars['entity'];
$owner = $project->getOwnerEntity();

if (!$owner) {
	// not having an owner is very bad so we throw an exception
	$msg = elgg_echo('InvalidParameterException:IdNotExistForGUID', array('project owner', $project->guid));
	throw new InvalidParameterException($msg);
}

?>
<div class="projects-profile projects-profile-box clearfix elgg-image-block">
	<div class="elgg-image">
		<div class="projects-profile-icon">
			<?php echo elgg_view_entity_icon($project, 'large', array('href' => '')); ?>
		</div>
		<div class="projects-stats">
			<p>
				<b><?php echo elgg_echo("projects:owner"); ?>: </b>
				<?php
					echo elgg_view('output/url', array(
						'text' => $owner->name,
						'value' => $owner->getURL(),
						'is_trusted' => true,
					));
				?>
			</p>
			<p>
				<b><?php echo elgg_echo("projects:profile:status"); ?>: </b>
				<?php
					echo elgg_view('output/project_status', array(
						'entity' => $project,
						'value' => $project->project_status,
					));
				?>
			</p>
			<ul class="projectsSocialButtons">
				<?php if ($project->facebook_url) { ?>
				<li>
					<a class="btnFacebook" href="<?php echo elgg_normalize_url($project->facebook_url); ?>"></a>
				</li>
				<?php } ?>
				<?php if ($project->twitter_url) { ?>
				<li>
					<a class="btnTwitter" href="<?php echo elgg_normalize_url($project->twitter_url); ?>"></a>
				</li>
				<?php } ?>
				<?php if ($project->linkedin_url) { ?>
				<li>
					<a class="btnLinkedin" href="<?php echo elgg_normalize_url($project->linkedin_url); ?>"></a>
				</li>
				<?php } ?>
			</ul>
			<?php /*
			<p>
				echo elgg_echo('projects:members') . ": " . $project->getMembers(0, 0, TRUE);
			</p>
			 */
			?>
		</div>
	</div>

	<div class="projects-profile-fields elgg-body">
		<div class="project-name">
			<?php
				echo elgg_view('output/url', array(
					'text' => $project->name,
					'href' => $project->getURL(),
				));
			?>
		</div>
		<?php
			echo elgg_view('projects/profile/fields', $vars);
		?>
	</div>
</div>
<?php
