<?php
	/**
	 * Elgg default object view.
	 * This is a placeholder.
	 * 
	 * @package Elgg
	 * @subpackage Core
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.org/
	 */

	$entity = $vars['entity'];
	
	$title = '';
	$withicon = false;
	$icon = '';
	
	if ($entity instanceof ElggObject) {
		$title = $entity->title;
	}
	
	if ($entity instanceof ElggGroup) {
		
		//get the membership type
		/*$membership = $vars['entity']->membership;
		if($membership == 2)
			$extra = elgg_echo("organizations:open");
		else
			$extra = elgg_echo("organizations:closed");*/
	} 
	if ($entity instanceof ElggEntity) {
		if(!preg_match('/\/default\//',$entity->getIconURL('small'))){
			$icon = "<img src='" . $entity->getIconURL('small') . "' />" ;
			$withicon = true;
		}
		
		if(empty($title))
			$title = $entity->name;
	
		$description = $entity->description;
	}
	
	$url = $entity->getURL();
	$category = elgg_view('keetup_categories/showcategory', array('entity' => $entity, 'clean' => true));
	
	$content = "<h3><a href='{$url}'>{$title}</a></h3>";
	
	if($description)
		$description = nl2br(strip_tags($description));
		$content .= "<p>"  . (strlen($description) > 300) ? substr($description, 0, 300) . '...' : $description . "</p>";
	
	if($extra)
		$content .= "<p>$extra</p>";
	if($category)
		$content .= "<p>$category</p>";;
	
	$class = ($withicon) ? 'withicon' : '';

		
?>
<div class='entity_item <?php echo $class?>'>
	
<?php 
	if(!empty($icon)){	
		echo "<div class='entity_icon'>$icon</div>";
	}

	if(!empty($content)){
	
		echo "<div class='entity_content'>$content</div>";
	
	}
?>
	<div class='clearfloat'></div>
</div>