<?php
/* user menu "twitter style" */

$user = elgg_get_logged_in_user_entity();
if ($user instanceof ElggUser) {
    $usr_name = $user->name;
    $usr_url = $user->getURL();
    $usr_username = $user->username;
}

//Use elgg_register_menu_item to add more or plugin hook
$user_top_menu = elgg_view_menu('user_top_menu', array('sort_by' => 'priority'));
?>
<div class="userTopMn">
    <div class="usrIcoName">
		<div class="usrIco"><a href="<?php echo $usr_url; ?>"></a></div>
		<div class="utmMnButton"></div>
		<div class="clearfloat"></div>
    </div>
    <?php echo $user_top_menu ?>
</div>
<script type="text/javascript">
    function hideUserMn() {
		$('.userTopMn').removeClass('on');
    }
    $(document).ready(
	    function() {
			$('.utmMnButton').bind('click touchend',
				function() {
				    /* hide visible menus */
				    if (typeof window.notificationsListHide == 'function') {
						notificationsListHide();	// hide other notifications list
				    }
				    if (typeof window.hideCommonMn == 'function') {
						hideCommonMn();				// hide any common menu
				    }
				    // hide other (similar or equal) menus
				    $('.userTopMn').siblings().removeClass('on');
				    /* show this menu */
				    $(this).parents('.userTopMn').addClass('on');
				}
			);
			$('html').bind('click touchend',
				function() {
				    hideUserMn();
				}
			);
			$('.userTopMn').bind('click touchend',
				function(event) {
				    event.stopPropagation();
				}
			);
	    }
    );
</script>
