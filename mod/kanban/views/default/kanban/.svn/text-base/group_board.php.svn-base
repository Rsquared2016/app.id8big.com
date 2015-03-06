<?php

$page_owner = elgg_extract('page_owner', $vars, elgg_get_page_owner_entity());

$container_guid = $page_owner->getGUID();

$kanban = new Kanban();
//Get all tasks
$options = array(
	'limit' => 0,
	'container_guid' => $container_guid,
);
$entities = $kanban->getGroupedTasks($options);

//Params
$responsible = array();
if ($page_owner instanceof ProjectGroup) {
    $responsible = gtask_get_responsive_options($container_guid);
    $responsible = array('' => elgg_echo('kanban:all:tickets')) + $responsible;
}

// Options max tasks
$options_max_tasks = $kanban->getOptionsMaxTasks();
//$active_max_tasks = $kanban->getMaxTasks($page_owner->getGUID(), 'active');
$in_progress_max_tasks = $kanban->getMaxTasks($page_owner->getGUID(), 'in_progress');
$for_testing_max_tasks = $kanban->getMaxTasks($page_owner->getGUID(), 'for_testing');
//$finished_max_tasks = $kanban->getMaxTasks($page_owner->getGUID(), 'finished');
//$onhold_max_tasks = $kanban->getMaxTasks($page_owner->getGUID(), 'onhold');
?>

<div class="kanbanContainer">
    <div class="tableCont">
		<table id="quick_filter_bar">
			<tr>
               <?php if (!empty($responsible)) { ?>
			   <td>
				   <div class="td1 padTop">
						<label class="blackLabel flLef"><?php echo elgg_echo('kanban:responsible'); ?></label>
						<?php
                                echo elgg_view('input/dropdown', array(
                                    'name' => 'responsible',
                                    'id' => 'responsible',
                                    'options_values' => $responsible,
                                    'class' => 'flLef',
                                ));
						?>
						<div class="clearfloat"></div>
				   </div>
			   </td>
               <?php } ?>
			   <td>
				   <table class="type-milestone-table">
					<tbody>
						<tr>
							<td>
								<div class="td2 flRig padTop">
									<input type="checkbox" name="tasks_info[]" value="important" id="tasks_info_important" class="flLef input_checkbox">
									<label class="flLef check-milestone smallLabel" for="tasks_info_important"><?php echo elgg_echo('kanban:group_board:important_tasks'); ?></label>
									<div class="clearfloat"></div>
								</div>
							</td>
							<td>
								<div class="td3 padTop">
									<input type="checkbox" name="tasks_info[]" value="overdue" id="tasks_info_overdue" class="flLef input_checkbox">
									<label class="flLef check-milestone smallLabel" for="tasks_info_overdue"><?php echo elgg_echo('kanban:group_board:overdue'); ?></label>
									<div class="clearfloat"></div>
								</div>
							</td>
						</tr>
					</tbody>
				  </table>
			   </td>
			   <td>
					<form action="" method="POST" id="quick_jump_form" class="uniForm td4 flRig padTop">
						<label class="blackLabel flLef" for="search_kanban"><?php echo elgg_echo('kanban:group_board:keyword'); ?></label>
						<?php
							echo elgg_view('input/text', array('name' => 'search_kanban', 'id' => 'search_kanban', 'class' => 'flLef nmRig'));
						?>
						<div class="clearfloat"></div>
					</form>
			  </td>
			</tr>
		</table>
	</div>
    <div class="container-first-columns">
        <div class="column active" rel="active">
            <h3>
			<?php
				echo elgg_echo('kanban:group_board:active');
//				echo elgg_view('input/dropdown', array(
//					'id' => 'max_tasks',
//					'name' => 'max_tasks',
//					'class' => 'max_tasks',
//					'options' => $options_max_tasks,
//					'value' => $active_max_tasks,
//				));
			 ?>
			</h3>
            <div class='column-content'>
				<div class="draggable-area">
                <?php
					if(array_key_exists(Kanban::COLUMN_ACTIVE, $entities)) {
						echo elgg_view('kanban/kanban_column', array('entities' => $entities[Kanban::COLUMN_ACTIVE]));
					} else {
						//KTODO: Display an empty message, start draggig items.
					}
				?>
				</div>
            </div>
        </div>
        <div class="column in_progress" rel="in_progress">
            <h3>
			<?php
				echo elgg_echo('kanban:group_board:in_progress');
				echo elgg_view('input/dropdown', array(
					'id' => 'max_tasks',
					'name' => 'max_tasks',
					'class' => 'max_tasks',
					'options' => $options_max_tasks,
					'value' => $in_progress_max_tasks,
				));
			?>
			</h3>
            <?php
			/*<h3>In Progress {select_wip class='select-wip' name='wip' value="5" id=wipInProgress optional=1}</h3>*/
			?>
            <div class='column-content'>
				<div class="draggable-area">
                <?php
					if(array_key_exists(Kanban::COLUMN_IN_PROGRESS, $entities)) {
						echo elgg_view('kanban/kanban_column', array('entities' => $entities[Kanban::COLUMN_IN_PROGRESS]));
					} else {
						//KTODO: Display an empty message, start draggig items.
					}
				?>
				</div>
            </div>
        </div>
        <div class="column for_testing" rel="for_testing">
            <h3>
			<?php
				echo elgg_echo('kanban:group_board:for_testing');
				echo elgg_view('input/dropdown', array(
					'id' => 'max_tasks',
					'name' => 'max_tasks',
					'class' => 'max_tasks',
					'options' => $options_max_tasks,
					'value' => $for_testing_max_tasks,
				));
			?>
			</h3>
            <div class='column-content'>
				<div class="draggable-area">
				<?php
					if(array_key_exists(Kanban::COLUMN_TESTING, $entities)) {
						echo elgg_view('kanban/kanban_column', array('entities' => $entities[Kanban::COLUMN_TESTING]));
					} else {
						//KTODO: Display an empty message, start draggig items.
					}
				?>
				</div>
            </div>
        </div>

        <div class="cThis"></div>
        <div class="column onhold" rel="onhold">
            <h3>
			<?php
				echo elgg_echo('kanban:group_board:on_hold');
//				echo elgg_view('input/dropdown', array(
//					'id' => 'max_tasks',
//					'name' => 'max_tasks',
//					'class' => 'max_tasks',
//					'options' => $options_max_tasks,
//					'value' => $onhold_max_tasks,
//				));
			?>
			</h3>
            <div class='column-content'>
				<div class="draggable-area">
				<?php
					if(array_key_exists(Kanban::COLUMN_ON_HOLD, $entities)) {
						echo elgg_view('kanban/kanban_column', array('entities' => $entities[Kanban::COLUMN_ON_HOLD]));
					} else {
						//KTODO: Display an empty message, start draggig items.
					}
				?>
				</div>
            </div>
            <div class="cThis"></div>
        </div>
    </div>

    <div class="column finished nmRig" rel="finished">
        <h3>
		<?php
			echo elgg_echo('kanban:group_board:finished');
//			echo elgg_view('input/dropdown', array(
//					'id' => 'max_tasks',
//					'name' => 'max_tasks',
//					'class' => 'max_tasks',
//					'options' => $options_max_tasks,
//					'value' => $finished_max_tasks,
//			));
		?>
		</h3>
        <div class='column-content'>
			<div class="draggable-area">
			<?php
				if(array_key_exists(Kanban::COLUMN_DONE, $entities)) {
					echo elgg_view('kanban/kanban_column', array('entities' => $entities[Kanban::COLUMN_DONE]));
				} else {
					//KTODO: Display an empty message, start draggig items.
				}
			?>
			</div>
        </div>
    </div>
    <div class="cThis"></div>
</div>
