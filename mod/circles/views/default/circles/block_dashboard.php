<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$user_loggedin = elgg_get_logged_in_user_entity();
if (!$user_loggedin) {
	return false;
}

// Get circles
$circles = get_user_access_collections($user_loggedin->getGUID());

?>
<div class='sidebarBox' id="circles_box">
	<h3>
		<span class="txt"><?php echo elgg_echo('circles'); ?></span>
		<a href="<?php echo $vars['url']; ?>circles/" class="viewAll"><?php echo elgg_echo('circles:riverdashboard:circles:view:all'); ?></a>
		<span class="clearfloat"></span>
	</h3>
<?php
	if ($circles) {
		// Render circles
		$circles_to_list = 3;
		$friends_to_list = 3;
		$size = 'small';
		
		$count_circles = 0;
		$count_friends = 0;
		foreach ($circles as $c) {
			$circle_name = $c->name;
			// Get users in the circle
			$friends = get_members_of_access_collection($c->id, false);
			if ($friends) {
	?>
				<div class="sbbCircleCont">
					<h4><?php echo $circle_name; ?></h4>
					<div class="sbbCircleInner">
						<?php
							foreach ($friends as $f) {
						?>
						<div class="sbbCircleItem flLef <?php if ($count_friends == ($friends_to_list - 1)) { echo 'nmRig'; } ?>">
							<a href="<?php echo $f->getURL(); ?>"><img src="<?php echo $f->getIcon($size); ?>" title="<?php echo $f->name; ?>" /></a>
							<?php //echo elgg_view('profile/icon', array('entity' => $f, 'size' => 'small')) ?>
						</div>
						<?php
								// Only list '$friends_to_list' friends
								$count_friends++;
								if ($count_friends >= $friends_to_list) {
									break;
								}
							}
						?>
						<div class="clearfloat"></div>
					</div>
				</div>
	<?php
				$count_circles++;
				$count_friends = 0;
				if ($count_circles >= $circles_to_list) {
					break;
				}
			}
		}
	}
	else {
		// No circles
	?>
	<div class="contentWrapper"><p><?php echo elgg_echo('circles:widget:dashboard:empty'); ?></p></div>
	<?php
	}
	?>
</div>
<?php
/*
 KTODO: Old
$circles = get_user_access_collections(get_loggedin_userid());

if (!$circles) {
	return false;
}
?>
<div class='sidebarBox'>
	<h3><?php echo elgg_echo('circles'); ?></h3>
		<ul class="ulCircles">
<?php
	foreach ($circles as $circle) {
?>
			<li><input type='radio' name='filter_circle' value='<?php echo $circle->id; ?>' id="inputCircle<?php echo $circle->id; ?>" /> <label for="inputCircle<?php echo $circle->id; ?>"><?php echo $circle->name; ?></label></li>
<?php
	}
?>
		</ul>
</div>
<script type="text/javascript">

$(document).ready(function(){
	$('input[name=filter_circle]').click(function(){
		var $circle_id = $(this).val();

		$('.riverdashboard_filtermenu').find('#filter_circle_id').val($circle_id);

		$('#river_container').load('<?php echo $vars['url']; ?>mod/circles/pages/riverdashboard/index.php?display=circles&filter_circle_id='+$circle_id+'&content=<?php echo $vars['type']; ?>,<?php echo $vars['subtype']; ?>&callback=true', load_riverdashboard_complete);

	});

	// Load riverdashboard complete
	load_riverdashboard_complete = function() {
		var value_display = $('.riverdashboard_filtermenu').find('#display').val();
		var value_circle_id = $('.riverdashboard_filtermenu').find('#filter_circle_id').val();
		$('input[name=filter_circle]:checked');

		switch (value_display) {
			case '':
			case 'all':
			case 'friends':
			case 'mine':
						$('input[name=filter_circle]:checked').attr('checked', false);
						break;
			case 'circles':
					$('input[name=filter_circle][value='+value_circle_id+']').attr('checked', true);
					break;
			default:
					break;
		}
	}
	load_riverdashboard_complete();
});

</script>
*/ ?>