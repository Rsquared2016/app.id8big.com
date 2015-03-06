<?php

/*
 * View circles/block_user_profile
 *
 * Displays the list of circles in a user profile so that it can be added to any of the circles
 */

$user_loggedin = get_loggedin_user();
$page_owner = page_owner_entity();

if ( ($user_loggedin && $user_loggedin instanceof ElggUser) && ($page_owner && $page_owner instanceof ElggUser)) {

	if (!$page_owner->isFriend()) {
		return false;
	}

	if ($user_loggedin != $page_owner) {
		$circles = get_user_access_collections($user_loggedin->getGUID());
		if ($circles) {
?>
		<div class="titleCirclesProfile">
			<a href="#" class="showMnCircles"><?php echo elgg_echo('circles:profile:add'); ?></a>
			<div class="circlesMnProfile">
				<div class="ulCirclesCont">
					<ul>

				<?php
					foreach ($circles as $circle) {
						$friends = get_members_of_access_collection($circle->id, true);
						$checked = "";
						if (in_array($page_owner->getGUID(), $friends)) {
							$checked = "checked=checked";
						}
				?>
						<li>
							<div class="txt">
								<input type="checkbox" name="circle_id" id ="circle<?php echo $circle->id; ?>" value="<?php echo $circle->id ?>" <?php echo $checked; ?> />
								<label for="circle<?php echo $circle->id; ?>"><?php echo $circle->name; ?></label>
							</div>
							<div class="count"><?php echo count(get_members_of_access_collection($circle->id, false)); ?></div>
							<div class="clearfloat">&nbsp;</div>
						</li>
				<?php
					}
				?>
					</ul>
				</div>
				<div class="contentFormCircle">
					<a class="createNewCircle" href="<?php echo $vars['url'] ?>pg/circles/new/?from=profile"><?php echo elgg_echo('circles:section:circles:new') ?></a>
				</div>
			</div>
		</div>
	<?php
		} // end if $circles
	}
}
?>
<script type="text/javascript">

$(document).ready(function(){
	$('input[type=checkbox][name=circle_id]').click(function() {
		var is_checked = $(this).is(':checked');
		var circle_id = $(this).val();
		var friend_id = <?php echo $page_owner->getGUID(); ?>;
		var ajax_url = null;

		if (is_checked) {
			// add friend to the circle
			ajax_url = '<?php echo $vars['url']; ?>mod/circles/endpoint/addfriend.php?callback=1&circle_id='+circle_id+'&friend_id='+friend_id+"&rand="+<?php echo rand() ?>;
		}
		else {
			// delete friend to the circle
			ajax_url = '<?php echo $vars['url']; ?>mod/circles/endpoint/deletefriend.php?callback=1&circle_id='+circle_id+'&friend_id='+friend_id+"&rand="+<?php echo rand() ?>;
		}

		var fancybox_message = 'not content';

		$.getJSON(ajax_url, function(data) {
			if (data.error) {
				fancybox_message = data.error;
			} else {
				fancybox_message = data.success_msg;
			}

			$.fancybox({
				'transitionIn'	:	'elastic',
				'transitionOut'	:	'elastic',
				'speedIn'		:	600,
				'speedOut'		:	200,
				'overlayShow'	:	true,
				'content'		:	fancybox_message,
				'onStart'		: 	function() { $('#fancybox-wrap, #fancybox-outer, #fancybox-content').addClass('ktCirclesFancyBox'); },
				'onClosed'		:	function() { $('#fancybox-wrap, #fancybox-outer, #fancybox-content').removeClass('ktCirclesFancyBox'); }
			});
		});
	});

	$('.createNewCircle').click(function(event) {
		event.preventDefault();

		var url = $(this).attr('href');

		$('.contentFormCircle').load(url);
	});

	$('.showMnCircles').click(
		function() {
			$('.circlesMnProfile').show();
			return false;
		}
	);
	$('html').click(
		function() {
			$('.circlesMnProfile').hide();
		}
	);
	$('.showMnCircles, .circlesMnProfile *').click(
		function(event) {
			event.stopPropagation();
		}
	);

});

</script>
