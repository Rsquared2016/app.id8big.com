<?php

/**
 * Lean Canvas
 */

elgg_load_js('tinymce');
elgg_load_js('elgg.tinymce');

$page_owner = elgg_extract('page_owner', $vars, elgg_get_page_owner_entity());

$lean_canvas = new leanCanvas($page_owner);

?>

<script type="text/javascript">
	var node_js_url = '<?php echo leancanvas_get_nodejs_url() ?>';
</script>

<div class="canvasContainer">
	<div class="aOnlineMembers" id="watchingMembers">
		<a class="online_users" href="javascript:void(0);">
			<span class="count_online_users">0</span>
			<?php echo elgg_echo('leancanvas:online:users'); ?>
		</a>
		<div class="onlineUsersContent hidden">
			<div class="onlineUsersWrapper">
				<h3><?php echo elgg_echo('leancanvas:lightbox:online:users'); ?></h3>
				<div class="onlineUsersList">
					<?php
						echo elgg_view('leancanvas/online_user');
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="canvasTopRow canvasRow">
		<div class="canvasColumn canvasColumnHover canvasColumnStyle flLef">
			<?php
				$section_id = 3;
				$section = $lean_canvas->getSection($section_id);
				if (!empty($section)) {
					$count_objectives = $lean_canvas->getObjectivesForSection($section_id, array('count' => TRUE));
			?>
			<div class="topRow canvasColumnHover" data-id="<?php echo $section_id ?>">
				<div class="canvasColumnHead">
					<h3 class="h3SingleLine"><?php echo $section['title']; ?></h3>
					<div class="columnSectionHelp" title="<?php echo $section['help']; ?>"></div>
				</div>
				<div class="canvasColumnBody">
					<div class="canvasTextAndNumber <?php if ($count_objectives) { echo 'no'; } ?>">
						<div class="canvasExplainText"><?php echo $section['subtitle']; ?></div>
						<div class="columnSectionNumber"><?php echo $section['number']; ?></div>
					</div>
					<div class="canvasShowOnClick">
						<div class="canvasContent <?php if ($count_objectives) { echo 'on'; } ?>"><?php echo $lean_canvas->renderObjectivesForSection($section_id); ?></div>
						<div class="canvasAddContentForm"><?php echo $lean_canvas->renderObjectiveForm($section_id); ?></div>
					</div>
					<div class="commentAndCreate">
						<div class="columnSectionComment blockAction flLef">
							<?php echo $lean_canvas->renderLinkCommentForSection($section_id); ?>
						</div>
						<div class="canvasAddContentLink blockAction flRig">
							<?php if ($lean_canvas->canEdit()) { ?>
							<a class="add_objective" href="javascript:void(0);"><?php echo elgg_echo('leancanvas:add:objective'); ?></a>
							<?php } ?>
						</div>
						<div class="clearfloat"></div>
					</div>
				</div>
			</div>
			<?php
				}
				$section_id = 4;
				$section = $lean_canvas->getSection($section_id);
				if (!empty($section)) {
					$count_objectives = $lean_canvas->getObjectivesForSection($section_id, array('count' => TRUE));
			?>
			<div class="bottomRow canvasColumnHover" data-id="<?php echo $section_id ?>">
				<div class="canvasColumnHead">
                    <h3><?php echo $section['title']; ?></h3>
					<div class="columnSectionHelp" title="<?php echo $section['help']; ?>"></div>
				</div>
				<div class="canvasColumnBody">
					<div class="canvasTextAndNumber <?php if ($count_objectives) { echo 'no'; } ?>">
						<div class="canvasExplainText"><?php echo $section['subtitle']; ?></div>
					</div>
					<div class="canvasShowOnClick">
						<div class="canvasContent <?php if ($count_objectives) { echo 'on'; } ?>"><?php echo $lean_canvas->renderObjectivesForSection($section_id); ?></div>
						<div class="canvasAddContentForm"><?php echo $lean_canvas->renderObjectiveForm(4); ?></div>
					</div>
					<div class="commentAndCreate">
						<div class="columnSectionComment blockAction flLef">
							<?php echo $lean_canvas->renderLinkCommentForSection($section_id); ?>
						</div>
						<div class="canvasAddContentLink blockAction flRig">
							<?php if ($lean_canvas->canEdit()) { ?>
							<a class="add_objective" href="javascript:void(0);"><?php echo elgg_echo('leancanvas:add:objective'); ?></a>
							<?php } ?>
						</div>
						<div class="clearfloat"></div>
					</div>
				</div>
			</div>
			<?php
				}
			?>
		</div>
		<div class="canvasColumn flLef">
			<?php
				$section_id = 7;
				$section = $lean_canvas->getSection($section_id);
				if (!empty($section)) {
					$count_objectives = $lean_canvas->getObjectivesForSection($section_id, array('count' => TRUE));
			?>
			<div class="canvasColumnStyle topBlock canvasColumnHover" data-id="<?php echo $section_id ?>">
				<div class="canvasColumnHead">
					<h3 class="h3SingleLine"><?php echo $section['title']; ?></h3>
					<div class="columnSectionHelp" title="<?php echo $section['help']; ?>"></div>
				</div>
				<div class="canvasColumnBody">
					<div class="canvasTextAndNumber <?php if ($count_objectives) { echo 'no'; } ?>">
						<div class="canvasExplainText"><?php echo $section['subtitle']; ?></div>
						<div class="columnSectionNumber"><?php echo $section['number']; ?></div>
					</div>
					<div class="canvasShowOnClick">
						<div class="canvasContent <?php if ($count_objectives) { echo 'on'; } ?>"><?php echo $lean_canvas->renderObjectivesForSection($section_id); ?></div>
						<div class="canvasAddContentForm"><?php echo $lean_canvas->renderObjectiveForm(7); ?></div>
					</div>
					<div class="commentAndCreate">
						<div class="columnSectionComment blockAction flLef">
							<?php echo $lean_canvas->renderLinkCommentForSection($section_id); ?>
						</div>
						<div class="canvasAddContentLink blockAction flRig">
							<?php if ($lean_canvas->canEdit()) { ?>
							<a class="add_objective" href="javascript:void(0);"><?php echo elgg_echo('leancanvas:add:objective'); ?></a>
							<?php } ?>
						</div>
						<div class="clearfloat"></div>
					</div>
				</div>
			</div>
			<?php
				}
				$section_id = 11;
				$section = $lean_canvas->getSection($section_id);
				if (!empty($section)) {
					$count_objectives = $lean_canvas->getObjectivesForSection($section_id, array('count' => TRUE));
			?>
			<div class="canvasColumnStyle bottomBlock canvasColumnHover" data-id="<?php echo $section_id ?>">
				<div class="canvasColumnHead">
					<h3 class="h3SingleLine"><?php echo $section['title']; ?></h3>
					<div class="columnSectionHelp" title="<?php echo $section['help']; ?>"></div>
				</div>
				<div class="canvasColumnBody">
					<div class="canvasTextAndNumber <?php if ($count_objectives) { echo 'no'; } ?>">
						<div class="canvasExplainText"><?php echo $section['subtitle']; ?></div>
						<div class="columnSectionNumber"><?php echo $section['number']; ?></div>
					</div>
					<div class="canvasShowOnClick">
						<div class="canvasContent <?php if ($count_objectives) { echo 'on'; } ?>"><?php echo $lean_canvas->renderObjectivesForSection($section_id); ?></div>
						<div class="canvasAddContentForm"><?php echo $lean_canvas->renderObjectiveForm(11); ?></div>
					</div>
					<div class="commentAndCreate">
						<div class="columnSectionComment blockAction flLef">
							<?php echo $lean_canvas->renderLinkCommentForSection($section_id); ?>
						</div>
						<div class="canvasAddContentLink blockAction flRig">
							<?php if ($lean_canvas->canEdit()) { ?>
							<a class="add_objective" href="javascript:void(0);"><?php echo elgg_echo('leancanvas:add:objective'); ?></a>
							<?php } ?>
						</div>
						<div class="clearfloat"></div>
					</div>
				</div>
			</div>
			<?php
				}
			?>
		</div>
		<div class="canvasColumn canvasColumnHover canvasColumnStyle flLef">
			<?php
				$section_id = 5;
				$section = $lean_canvas->getSection($section_id);
				if (!empty($section)) {
					$count_objectives = $lean_canvas->getObjectivesForSection($section_id, array('count' => TRUE));
			?>
			<div class="topRow canvasColumnHover" data-id="<?php echo $section_id ?>">
				<div class="canvasColumnHead">
					<h3><?php echo $section['title']; ?></h3>
					<div class="columnSectionHelp" data-position-my="right middle" data-position-at="left middle" title="<?php echo $section['help']; ?>"></div>
				</div>
				<div class="canvasColumnBody">
					<div class="canvasTextAndNumber <?php if ($count_objectives) { echo 'no'; } ?>">
						<div class="canvasExplainText"><?php echo $section['subtitle']; ?></div>
						<div class="columnSectionNumber"><?php echo $section['number']; ?></div>
					</div>
					<div class="canvasShowOnClick">
						<div class="canvasContent <?php if ($count_objectives) { echo 'on'; } ?>"><?php echo $lean_canvas->renderObjectivesForSection($section_id); ?></div>
						<div class="canvasAddContentForm"><?php echo $lean_canvas->renderObjectiveForm(5); ?></div>
					</div>
					<div class="commentAndCreate">
						<div class="columnSectionComment blockAction flLef">
							<?php echo $lean_canvas->renderLinkCommentForSection($section_id); ?>
						</div>
						<div class="canvasAddContentLink blockAction flRig">
							<?php if ($lean_canvas->canEdit()) { ?>
							<a class="add_objective" href="javascript:void(0);"><?php echo elgg_echo('leancanvas:add:objective'); ?></a>
							<?php } ?>
						</div>
						<div class="clearfloat"></div>
					</div>
				</div>
			</div>
			<?php
				}
				$section_id = 6;
				$section = $lean_canvas->getSection($section_id);
				if (!empty($section)) {
					$count_objectives = $lean_canvas->getObjectivesForSection($section_id, array('count' => TRUE));
			?>
			<div class="bottomRow canvasColumnHover" data-id="<?php echo $section_id ?>">
				<div class="canvasColumn">
					<div class="canvasColumnHead">
						<h3><?php echo $section['title']; ?></h3>
                        <div class="columnSectionHelp" data-position-my="right middle" data-position-at="left middle" title="<?php echo $section['help']; ?>"></div>
					</div>
					<div class="canvasColumnBody">
						<div class="canvasTextAndNumber <?php if ($count_objectives) { echo 'no'; } ?>">
							<div class="canvasExplainText"><?php echo $section['subtitle']; ?></div>
						</div>
						<div class="canvasShowOnClick">
							<div class="canvasContent <?php if ($count_objectives) { echo 'on'; } ?>"><?php echo $lean_canvas->renderObjectivesForSection($section_id); ?></div>
							<div class="canvasAddContentForm"><?php echo $lean_canvas->renderObjectiveForm(6); ?></div>
						</div>
						<div class="commentAndCreate">
							<div class="columnSectionComment blockAction flLef">
								<?php echo $lean_canvas->renderLinkCommentForSection($section_id); ?>
							</div>
							<div class="canvasAddContentLink blockAction flRig">
								<?php if ($lean_canvas->canEdit()) { ?>
								<a class="add_objective" href="javascript:void(0);"><?php echo elgg_echo('leancanvas:add:objective'); ?></a>
								<?php } ?>
							</div>
							<div class="clearfloat"></div>
						</div>
					</div>
				</div>
			</div>
			<?php
				}
			?>
		</div>
		<div class="canvasColumn halfRow flLef">
			<?php
				$section_id = 12;
				$section = $lean_canvas->getSection($section_id);
				if (!empty($section)) {
					$count_objectives = $lean_canvas->getObjectivesForSection($section_id, array('count' => TRUE));
			?>
			<div class="canvasColumnStyle topBlock canvasColumnHover" data-id="<?php echo $section_id ?>">
				<div class="canvasColumnHead">
					<h3><?php echo $section['title']; ?></h3>
					<div class="columnSectionHelp" data-position-my="right middle" data-position-at="left middle" title="<?php echo $section['help']; ?>"></div>
				</div>
				<div class="canvasColumnBody">
					<div class="canvasTextAndNumber <?php if ($count_objectives) { echo 'no'; } ?>">
						<div class="canvasExplainText"><?php echo $section['subtitle']; ?></div>
						<div class="columnSectionNumber"><?php echo $section['number']; ?></div>
					</div>
					<div class="canvasShowOnClick">
						<div class="canvasContent <?php if ($count_objectives) { echo 'on'; } ?>"><?php echo $lean_canvas->renderObjectivesForSection($section_id); ?></div>
						<div class="canvasAddContentForm"><?php echo $lean_canvas->renderObjectiveForm(12); ?></div>
					</div>
					<div class="commentAndCreate">
						<div class="columnSectionComment blockAction flLef">
							<?php echo $lean_canvas->renderLinkCommentForSection($section_id); ?>
						</div>
						<div class="canvasAddContentLink blockAction flRig">
							<?php if ($lean_canvas->canEdit()) { ?>
							<a class="add_objective" href="javascript:void(0);"><?php echo elgg_echo('leancanvas:add:objective'); ?></a>
							<?php } ?>
						</div>
						<div class="clearfloat"></div>
					</div>
				</div>
			</div>
			<?php
				}
				$section_id = 8;
				$section = $lean_canvas->getSection($section_id);
				if (!empty($section)) {
					$count_objectives = $lean_canvas->getObjectivesForSection($section_id, array('count' => TRUE));
			?>
			<div class="canvasColumnStyle bottomBlock canvasColumnHover" data-id="<?php echo $section_id ?>">
				<div class="canvasColumnHead">
					<h3 class="h3SingleLine"><?php echo $section['title']; ?></h3>
					<div class="columnSectionHelp" data-position-my="right middle" data-position-at="left middle" title="<?php echo $section['help']; ?>"></div>
				</div>
				<div class="canvasColumnBody">
					<div class="canvasTextAndNumber <?php if ($count_objectives) { echo 'no'; } ?>">
						<div class="canvasExplainText"><?php echo $section['subtitle']; ?></div>
						<div class="columnSectionNumber"><?php echo $section['number']; ?></div>
					</div>
					<div class="canvasShowOnClick">
						<div class="canvasContent <?php if ($count_objectives) { echo 'on'; } ?>"><?php echo $lean_canvas->renderObjectivesForSection($section_id); ?></div>
						<div class="canvasAddContentForm"><?php echo $lean_canvas->renderObjectiveForm(8); ?></div>
					</div>
					<div class="commentAndCreate">
						<div class="columnSectionComment blockAction flLef">
							<?php echo $lean_canvas->renderLinkCommentForSection($section_id); ?>
						</div>
						<div class="canvasAddContentLink blockAction flRig">
							<?php if ($lean_canvas->canEdit()) { ?>
							<a class="add_objective" href="javascript:void(0);"><?php echo elgg_echo('leancanvas:add:objective'); ?></a>
							<?php } ?>
						</div>
						<div class="clearfloat"></div>
					</div>
				</div>
			</div>
			<?php
				}
			?>
		</div>
		<div class="canvasColumn canvasColumnHover canvasColumnStyle flRig nmRig">
			<?php
				$section_id = 1;
				$section = $lean_canvas->getSection($section_id);
				if (!empty($section)) {
					$count_objectives = $lean_canvas->getObjectivesForSection($section_id, array('count' => TRUE));
			?>
			<div class="topRow canvasColumnHover" data-id="<?php echo $section_id ?>">
				<div class="canvasColumnHead">
					<h3><?php echo $section['title']; ?></h3>
					<div class="columnSectionHelp" data-position-my="right middle" data-position-at="left middle" title="<?php echo $section['help']; ?>"></div>
				</div>
				<div class="canvasColumnBody">
					<div class="canvasTextAndNumber <?php if ($count_objectives) { echo 'no'; } ?>">
						<div class="canvasExplainText"><?php echo $section['subtitle']; ?></div>
						<div class="columnSectionNumber"><?php echo $section['number']; ?></div>
					</div>
					<div class="canvasShowOnClick">
						<div class="canvasContent <?php if ($count_objectives) { echo 'on'; } ?>"><?php echo $lean_canvas->renderObjectivesForSection($section_id); ?></div>
						<div class="canvasAddContentForm"><?php echo $lean_canvas->renderObjectiveForm(1); ?></div>
					</div>
					<div class="commentAndCreate">
						<div class="columnSectionComment blockAction flLef">
							<?php echo $lean_canvas->renderLinkCommentForSection($section_id); ?>
						</div>
						<div class="canvasAddContentLink blockAction flRig">
							<?php if ($lean_canvas->canEdit()) { ?>
							<a class="add_objective" href="javascript:void(0);"><?php echo elgg_echo('leancanvas:add:objective'); ?></a>
							<?php } ?>
						</div>
						<div class="clearfloat"></div>
					</div>
				</div>
			</div>
			<?php
				}
				$section_id = 2;
				$section = $lean_canvas->getSection($section_id);
				if (!empty($section)) {
					$count_objectives = $lean_canvas->getObjectivesForSection($section_id, array('count' => TRUE));
			?>
			<div class="canvasColumn bottomRow canvasColumnHover" data-id="<?php echo $section_id ?>">
				<div class="canvasColumnHead">
                    <h3 class="h3SingleLine"><?php echo $section['title']; ?></h3>
					<div class="columnSectionHelp" data-position-my="right middle" data-position-at="left middle" title="<?php echo $section['help']; ?>"></div>
				</div>
				<div class="canvasColumnBody">
					<div class="canvasTextAndNumber <?php if ($count_objectives) { echo 'no'; } ?>">
						<div class="canvasExplainText"><?php echo $section['subtitle']; ?></div>
					</div>
					<div class="canvasShowOnClick">
						<div class="canvasContent <?php if ($count_objectives) { echo 'on'; } ?>"><?php echo $lean_canvas->renderObjectivesForSection($section_id); ?></div>
						<div class="canvasAddContentForm"><?php echo $lean_canvas->renderObjectiveForm(2); ?></div>
					</div>
					<div class="commentAndCreate">
						<div class="columnSectionComment blockAction flLef">
							<?php echo $lean_canvas->renderLinkCommentForSection($section_id); ?>
						</div>
						<div class="canvasAddContentLink blockAction flRig">
							<?php if ($lean_canvas->canEdit()) { ?>
							<a class="add_objective" href="javascript:void(0);"><?php echo elgg_echo('leancanvas:add:objective'); ?></a>
							<?php } ?>
						</div>
						<div class="clearfloat"></div>
					</div>
				</div>
			</div>
			<?php
				}
			?>
		</div>
		<div class="clearfloat"></div>
	</div>
	<div class="canvasBottomRow canvasRow halfColumn">
		<?php
			$section_id = 10;
			$section = $lean_canvas->getSection($section_id);
			if (!empty($section)) {
				$count_objectives = $lean_canvas->getObjectivesForSection($section_id, array('count' => TRUE));
		?>
		<div class="canvasColumn canvasColumnStyle leftColumn flLef canvasColumnHover" data-id="<?php echo $section_id ?>">
			<div class="canvasColumnHead">
				<h3 class="h3SingleLine"><?php echo $section['title']; ?></h3>
				<div class="columnSectionHelp" title="<?php echo $section['help']; ?>"></div>
			</div>
			<div class="canvasColumnBody">
				<div class="canvasTextAndNumber <?php if ($count_objectives) { echo 'no'; } ?>">
					<div class="canvasExplainText flLef"><?php echo $section['subtitle']; ?></div>
					<div class="columnSectionNumber flLef"><?php echo $section['number']; ?></div>
					<div class="clearfloat"></div>
				</div>
				<div class="canvasShowOnClick">
					<div class="canvasContent <?php if ($count_objectives) { echo 'on'; } ?>"><?php echo $lean_canvas->renderObjectivesForSection($section_id); ?></div>
					<div class="canvasAddContentForm"><?php echo $lean_canvas->renderObjectiveForm(10); ?></div>
				</div>
				<div class="commentAndCreate">
					<div class="columnSectionComment blockAction flLef">
						<?php echo $lean_canvas->renderLinkCommentForSection($section_id); ?>
					</div>
					<div class="canvasAddContentLink blockAction flRig">
							<?php if ($lean_canvas->canEdit()) { ?>
							<a class="add_objective" href="javascript:void(0);"><?php echo elgg_echo('leancanvas:add:objective'); ?></a>
							<?php } ?>
						</div>
					<div class="clearfloat"></div>
				</div>
			</div>
		</div>
		<?php
			}
			$section_id = 9;
			$section = $lean_canvas->getSection($section_id);
			if (!empty($section)) {
				$count_objectives = $lean_canvas->getObjectivesForSection($section_id, array('count' => TRUE));
		?>
		<div class="canvasColumn canvasColumnStyle rightColumn flRig nmRig canvasColumnHover" data-id="<?php echo $section_id ?>">
			<div class="canvasColumnHead">
				<h3 class="h3SingleLine"><?php echo $section['title']; ?></h3>
				<div class="columnSectionHelp" data-position-my="right middle" data-position-at="left middle" title="<?php echo $section['help']; ?>"></div>
			</div>
			<div class="canvasColumnBody">
				<div class="canvasTextAndNumber <?php if ($count_objectives) { echo 'no'; } ?>">
					<div class="canvasExplainText canvasExplainText2 flLef"><?php echo $section['subtitle']; ?></div>
					<div class="columnSectionNumber flLef"><?php echo $section['number']; ?></div>
					<div class="clearfloat"></div>
				</div>
				<div class="canvasShowOnClick">
					<div class="canvasContent <?php if ($count_objectives) { echo 'on'; } ?>"><?php echo $lean_canvas->renderObjectivesForSection($section_id); ?></div>
					<div class="canvasAddContentForm"><?php echo $lean_canvas->renderObjectiveForm(9); ?></div>
				</div>
				<div class="commentAndCreate">
					<div class="columnSectionComment blockAction flLef">
						<?php echo $lean_canvas->renderLinkCommentForSection($section_id); ?>
					</div>
					<div class="canvasAddContentLink blockAction flRig">
							<?php if ($lean_canvas->canEdit()) { ?>
							<a class="add_objective" href="javascript:void(0);"><?php echo elgg_echo('leancanvas:add:objective'); ?></a>
							<?php } ?>
						</div>
					<div class="clearfloat"></div>
				</div>
			</div>
		</div>
		<?php
			}
		?>
		<div class="clearfloat"></div>
	</div>
</div>
