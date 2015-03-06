<?php

/**
 * circles
 *
 * @author German Scarel
 * @link http://community.elgg.org/pg/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

?>
//<script>
$(document).ready(function() {
	
	/* show / hide filter list */
	/* for css */
	$('.filterInnerGroup label').last().addClass('filterLastItem');	
	/* menu */
	$('.rdfTitle').live('click', function() {
			$('.rdfMn').show();
		}
	);
	$('html').live('click', function() {
			$('.rdfMn').hide();
		}
	);
	$('.rdfTitle').live('click', function(event) {
			event.stopPropagation();
		}
	);
	
	// Function to delete a friend in a circle.
	var delete_friend_circle = function(event) {
		event.preventDefault();

		// Get element 'a'
		var $aDeleteFriend = $(this);

		// Get the url to delete a friend
		var delete_url = $aDeleteFriend.attr('href');

		var fancybox_message = 'not content';

		$.getJSON(delete_url, function(data) {
			if (data.error) {
				fancybox_message = data.error;
			} else {
				// Update count friends
				var $cir = $aDeleteFriend.parents('.cCircle');
				$('.count_friends', $cir).text(data.count_friends);

				// Remove friend
				//$aDeleteFriend.parent().parent().parent().remove();
				$aDeleteFriend.parents('li').remove();

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
				'onClosed'		: 	function() { $('#fancybox-wrap, #fancybox-outer, #fancybox-content').removeClass('ktCirclesFancyBox'); }
			});
		});
	}
	// Apply function 'delete_friend_circle' to all element with class 'deleteFriend'
	$(".deleteFriend").click(delete_friend_circle);

	// there's the list of friends and the circles
	var $listFriends = $(".listFriends");
	var $circles = $(".cCircle");

	// let the list of friends items be draggable
	$( "li", $listFriends ).draggable({
		helper: "clone",
		revert: "invalid" // when not dropped, the item will revert back to its initial position
		//cancel: "a.ui-icon" // clicking an icon won't initiate dragging
		//containment: $( "#demo-frame" ).length ? "#demo-frame" : "document", // stick to demo-frame if present
		//cursor: "move"
	});

	// let the circle be droppable, accepting the list of friends items
	$circles.droppable({
		accept: ".listFriends > li",
		activeClass: "ui-state-highlight",
		drop: function( event, ui ) {
			event.preventDefault();

			// Get circle
			var $circle = $(this);

			// Get item draggable
			var $item_drag = ui.draggable;

			// Get id friend to add to the circle
			var friend_id = $item_drag.find(".friendId").val();

			// Get id circle to add the friend
			var circle_id = $circle.find(".circleId").val();

			var ajax_url = '<?php echo $vars['url']; ?>mod/circles/endpoint/addfriend.php?callback=1&circle_id='+circle_id+'&friend_id='+friend_id+"&rand="+<?php echo rand() ?>;

			var fancybox_message = 'not content';

			$.getJSON(ajax_url, function(data) {
				if (data.error) {
					fancybox_message = data.error;
				} else {
					var $list = $("ul", $circle).length ?
						$("ul", $circle) :
						$("<ul class='listFriendsCircle'/>").appendTo($circle);

					// Count friend in circles
					var count_friends = $("li", $list).length;

					if (count_friends < 6) {
						// link for delete friends
						var delete_url = '<?php echo $vars['url']; ?>mod/circles/endpoint/deletefriend.php?callback=1&circle_id='+circle_id+'&friend_id='+friend_id+"&rand="+<?php echo rand() ?>;
						var removeFriend = "<div class='deleteFriendCont'><a class='deleteFriend' href='"+delete_url+"'><?php echo elgg_echo('circles:remove') ?></a></div>";

						$item_drag.fadeOut(function() {

							// Add friend item to circle
							$item_drag.find(".nameFriend").remove();	// remove name friend
							$item_drag.find(".cFriend").append(removeFriend);	// add link for delete friends
							$item_drag.find(".deleteFriend").click(delete_friend_circle);	// add function to the link previous
							$item_drag.appendTo($list).fadeIn(function() {	// animate when add item, apply style
								$item_drag.animate({ width: "45px" })
								.find( "img" )
								.animate({ height: "100%" });
							});
						});
					} // Fin del if

					// Update count friends
					$(".count_friends", $circle).text(data.count_friends);

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
					'onClosed'		: 	function() { $('#fancybox-wrap, #fancybox-outer, #fancybox-content').removeClass('ktCirclesFancyBox'); }
				});
				//end of json call
			});
		}
	});

	// let the list of friends be droppable as well, accepting items from the circles
	$listFriends.droppable({
		accept: ".listFriendsCircle > li",
		activeClass: "custom-state-active",
		drop: function( event, ui ) {
			//recycleImage( ui.draggable );
		}
	});
	
	
	$('#btnShowHideSrchFrm').click(
		function() {
			if(!$('.ktHiddenSrchFrm').is(':animated')) {
				$('.ktHiddenSrchFrm').slideToggle();
				$(this).toggleClass('on');
			}
			return false;
		}
	);
	
	// Get content riverdashboard
	var circles_get_riverdashboard = function() {

		var circle = $('input[name=filter_circles]:checked').val();
		var type = $('input[name=filter_types]:checked').val();
		
		var circle_id = '';
		if (circle != 'all' &&
			circle != 'mine' &&
			circle != 'friends') {
			circle_id = circle;
			circle = 'circles';
		}
		
		var type_subtype = type.split('-');
		var type = '';
		var subtype = '';
		if (type_subtype.length > 0) {
			type = type_subtype[0];
		}
		if (type_subtype.length > 1) {
			subtype = type_subtype[1];
		}
		
//		var url = '<?php echo $vars['url']; ?>mod/circles/pages/riverdashboard/index.php?display='+$circle+'&content='+$type+'&callback=true';
		var url = '<?php echo $vars['url']; ?>activity/'+circle+'?type='+type+'&subtype='+subtype+'&circle_id='+circle_id;

		$('.circlesAjaxLoader').addClass('currentlyLoading');
		
		var $parentWrapper = $('.riverdashboardFilter').parents('.elgg-main.elgg-body');
		$parentWrapper.load(url, function(){
			$('.circlesAjaxLoader').removeClass('currentlyLoading');
		});
	}
	$('input[name=filter_circles]').live('click', function() {
		circles_get_riverdashboard();
	});
	$('input[name=filter_types]').live('click', function() {
		circles_get_riverdashboard();
	});
});