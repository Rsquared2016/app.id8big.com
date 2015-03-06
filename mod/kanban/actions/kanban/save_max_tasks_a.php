<?php

/**
 * Save max tasks
 */

$guid = get_input('guid');
$max_tasks = (int)get_input('max_tasks');
$status = get_input('status');

$kanban = new Kanban();

$kanban->saveMaxTasks($guid, $status, $max_tasks);

forward();