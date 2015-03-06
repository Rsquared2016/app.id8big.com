<?php 

	/*
	 * Keetup categories add
	 * */ 

	$guid = get_input('guid', '');

	if($op=='edit' && $guid) {
		$entity = get_entity($guid);
		if($entity->canEdit()) {
			//Edit form
			$form = elgg_view('keetup_categories/admin/categories/add', array('entity' => $entity));
		}
	} else {
		//Add form
		$form = elgg_view("keetup_categories/admin/categories/add");
	}
	
	echo $form;
	
