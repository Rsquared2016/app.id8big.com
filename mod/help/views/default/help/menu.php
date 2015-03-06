<?php
if (!$vars['entities']) {
	return FALSE;
}

$entities = $vars['entities'];

$categorized_entities = array();

$force_instance_of = ElggEntity;
if($vars['force_instance_of']) {
	$force_instance_of = $vars['force_instance_of'];
}


set_input('public_help', TRUE);
/**
 * We get all the entites and then make a multidimensional array with the category, 
 * sub category and the entity guid.
 */
foreach($entities as $entity) {
	if (!empty($entity->kt_category) && !empty($entity->kt_subcategory)){
		$subcat = explode('_',$entity->kt_subcategory);
		
		$subcat_id = 0;
		if (count($subcat) > 0) {
			if($subcat[1]) {
				$subcat_id = $subcat[1]; //No se porque busca la 1 ? :S
			} else {
				$subcat_id = $subcat[0];
			}
		}

		$categorized_entities[$entity->kt_category][$subcat_id][$entity->getGUID()] = $entity;  
	} else {
		$categorized_entities[0][0][$entity->getGUID()] = $entity;
	}
}

?>    
<div class="helpMenu flN">
<ul id="cwLef" class="flN">
	<?php
	foreach ($categorized_entities as $category => $sub_category) {
		$category_entity = get_entity($category);

		if (!($category_entity instanceof ElggEntity)) {
			continue;
		}
		?>

		<li class="lv1">
			<a href="#" class="mnTopLevel"><?php echo $category_entity->title ?></a>
			<div class="innerWrapper1">

				<?php
				foreach ($sub_category as $sub_category_key => $entities) {
					$sub_category_entity = get_annotation($sub_category_key);

					$sub_category_entity_title = '';
					if($sub_category_entity) {
						$sub_category_entity_title = $sub_category_entity->value;
					} else {
						//try to get entity ?
						$sub_category_entity = get_entity($sub_category_key);
						
						if(!$sub_category_entity) {
							continue;
						}
						
						$sub_category_entity_title = $sub_category_entity->title;
					}
					
					?>
					<ul class="cwLefSmn">
						<li>
							<a href="#" class="mn2ndLevel"><?php echo $sub_category_entity_title ?></a>
							<ul class="cwLefSmn2">
								<?php
								foreach ($entities as $entity) {
									if (!($entity instanceof $force_instance_of)) {
										continue;
									}
									
									$url = $entity->getURL();
									?>
									<li>
										<?php //Simple text ?>
										<div class="txt">
											<h3><a href="<?php echo $url; ?>"><?php echo $entity->title; ?></a></h3>
										</div>
										<div class="cThis">&nbsp;</div>
									</li>
								<?php } //endforeach products ?>
							</ul>
						</li>

					</ul>
				<?php } //endforeach sub_category ?>

			</div>
		</li>
	<?php } //endforeach category ?>

</ul>
</div>
<?php

set_input('public_help', FALSE);

?>