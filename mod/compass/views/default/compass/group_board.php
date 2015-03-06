<?php

$page_owner = elgg_extract('page_owner', $vars, elgg_get_page_owner_entity());

$container_guid = $page_owner->getGUID();

$compass = new Compass();
//Get all tasks
$options = array(
	'limit' => 0,
	'container_guid' => $container_guid,
);
$entities = $compass->getGroupedTasks($options);

$sections_options = $compass->getSectionsOptions($page_owner);
?>
<div class="compassContainer">
    <div class="tableCont">
		<table id="quick_filter_bar">
			<tr>
			   <td>
                <form action="" method="POST" id="quick_jump_form" class="uniForm td4 flLef padTop">
                    <label class="blackLabel flLef" for="search_compass"><?php echo elgg_echo('compass:group_board:keyword'); ?></label>
                    <?php
                        echo elgg_view('input/text', array('name' => 'search_compass', 'id' => 'search_compass', 'class' => 'flLef nmRig'));
                    ?>
                    <div class="clearfloat"></div>
                </form>
                <?php
                    // Dropdown filter
                    if (!empty($sections_options)) {
                ?>
                   <div class="sectionsCompass">
                       <label class="blackLabel flLef"><?php echo elgg_echo('compass:sections:label'); ?></label>
                <?php
                        echo elgg_view('input/dropdown', array(
                            'id' => 'compass_section',
                            'name' => 'compass_section',
                            'options_values' => $sections_options,
                            'value' => '0',
                        ));
                    }
                ?>
                   </div>
			  </td>
			</tr>
		</table>
	</div>
    <div class="container-first-columns">
        <div class="column active" rel="active">
			<div class="compassColumnHead">
				<h3>
				<?php
					echo elgg_echo('compass:group_board:active');
	//				echo elgg_view('input/dropdown', array(
	//					'id' => 'max_tasks',
	//					'name' => 'max_tasks',
	//					'class' => 'max_tasks',
	//					'options' => $options_max_tasks,
	//					'value' => $active_max_tasks,
	//				));
				 ?>
				</h3>
				<div class="columnSectionHelp" data-position-at="right bottom" title="<?php echo elgg_echo('compass:group_board:active:help'); ?>"></div>
			</div>
            <div class='column-content'>
				<div class="draggable-area">
                <?php
					if(array_key_exists(Compass::COLUMN_ACTIVE, $entities)) {
						echo elgg_view('compass/compass_column', array('entities' => $entities[Compass::COLUMN_ACTIVE]));
					} else {
						//KTODO: Display an empty message, start draggig items.
					}
				?>
				</div>
            </div>
        </div>
        <div class="column in_progress" rel="in_progress">
			<div class="compassColumnHead">
				<h3>
				<?php
					echo elgg_echo('compass:group_board:in_progress');
					echo elgg_view('output/icon_help', array(
						'value' => elgg_echo('compass:group_board:in_progress:help'),
					));

					/*echo elgg_view('input/dropdown', array(
						'id' => 'max_tasks',
						'name' => 'max_tasks',
						'class' => 'max_tasks',
						'options' => $options_max_tasks,
						'value' => $in_progress_max_tasks,
					));*/
				?>
				</h3>
				<div class="columnSectionHelp" data-position-my="right middle" data-position-at="left middle" title="<?php echo elgg_echo('compass:group_board:in_progress:help'); ?>"></div>
			</div>				
            <?php
			/*<h3>In Progress {select_wip class='select-wip' name='wip' value="5" id=wipInProgress optional=1}</h3>*/
			?>
            <div class='column-content'>
				<div class="draggable-area">
                <?php
					if(array_key_exists(Compass::COLUMN_IN_PROGRESS, $entities)) {
						echo elgg_view('compass/compass_column', array('entities' => $entities[Compass::COLUMN_IN_PROGRESS]));
					} else {
						//KTODO: Display an empty message, start draggig items.
					}
				?>
				</div>
            </div>
        </div>
        <div class="cThis"></div>
    </div>

    <div class="container-second-columns">
        <div class="column validated flLef nmRig" rel="validated">
			<div class="compassColumnHead">
				<h3>
				<?php
					echo elgg_echo('compass:group_board:validated');
					echo elgg_view('output/icon_help', array(
						'value' => elgg_echo('compass:group_board:validated:help'),
					));
					/*echo elgg_view('input/dropdown', array(
						'id' => 'max_tasks',
						'name' => 'max_tasks',
						'class' => 'max_tasks',
						'options' => $options_max_tasks,
						'value' => $validated_max_tasks,
					));*/
				?>
				</h3>
				<div class="columnSectionHelp" data-position-my="right middle" data-position-at="left middle" title="<?php echo elgg_echo('compass:group_board:validated:help'); ?>"></div>
			</div>
            <div class='column-content'>
				<div class="draggable-area">
				<?php
					if(array_key_exists(Compass::COLUMN_DONE_VALIDATED, $entities)) {
						echo elgg_view('compass/compass_column', array('entities' => $entities[Compass::COLUMN_DONE_VALIDATED]));
					} else {
						//KTODO: Display an empty message, start draggig items.
					}
				?>
				</div>
            </div>
        </div>		
		<div class="column unvalidated flLef nmRig" rel="unvalidated">
			<div class="compassColumnHead">
				<h3>
				<?php
					echo elgg_echo('compass:group_board:unvalidated');
									echo elgg_view('output/icon_help', array(
						'value' => elgg_echo('compass:group_board:validated:help'),
					));

		//			echo elgg_view('input/dropdown', array(
		//					'id' => 'max_tasks',
		//					'name' => 'max_tasks',
		//					'class' => 'max_tasks',
		//					'options' => $options_max_tasks,
		//					'value' => $unvalidated_max_tasks,
		//			));
				?>
				</h3>
				<div class="columnSectionHelp" data-position-my="right middle" data-position-at="left middle" title="<?php echo elgg_echo('compass:group_board:unvalidated:help'); ?>"></div>
			</div>
			<div class='column-content'>
				<div class="draggable-area">
				<?php
					if(array_key_exists(Compass::COLUMN_DONE_UNVALIDATED, $entities)) {
						echo elgg_view('compass/compass_column', array('entities' => $entities[Compass::COLUMN_DONE_UNVALIDATED]));
					} else {
						//KTODO: Display an empty message, start draggig items.
					}
				?>
				</div>
			</div>
		</div>
		<div class="column unknown flLef nmRig" rel="unknown">
			<div class="compassColumnHead">
				<h3>
				<?php
					echo elgg_echo('compass:group_board:unknown');
									echo elgg_view('output/icon_help', array(
						'value' => elgg_echo('compass:group_board:unknown:help'),
					));

		//			echo elgg_view('input/dropdown', array(
		//					'id' => 'max_tasks',
		//					'name' => 'max_tasks',
		//					'class' => 'max_tasks',
		//					'options' => $options_max_tasks,
		//					'value' => $unvalidated_max_tasks,
		//			));
				?>
				</h3>
				<div class="columnSectionHelp" data-position-my="right middle" data-position-at="left middle" title="<?php echo elgg_echo('compass:group_board:unknown:help'); ?>"></div>
			</div>
			<div class='column-content'>
				<div class="draggable-area">
				<?php
					if(array_key_exists(Compass::COLUMN_DONE_UNKNOWN, $entities)) {
						echo elgg_view('compass/compass_column', array('entities' => $entities[Compass::COLUMN_DONE_UNKNOWN]));
					} else {
						//KTODO: Display an empty message, start draggig items.
					}
				?>
				</div>
			</div>
		</div>		
	</div>	
    <div class="cThis"></div>
</div>
