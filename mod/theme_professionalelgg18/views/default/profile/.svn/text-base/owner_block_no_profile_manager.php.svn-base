<?php
/**
 * Profile owner block
 */
$user = elgg_get_page_owner_entity();

if (!$user) {
	// no user so we quit view
	echo elgg_echo('viewfailure', array(__FILE__));
	return TRUE;
}

$icon = '<div class="imgProfileContainer">';
$icon .= elgg_view_entity_icon($user, 'large', array(
	 'use_hover' => false,
	 'use_link' => false,
		  ));


if ($user->canEdit()) {
	$icon .= '<div class="editProfileIcon"><a href="' . $vars['url'] . 'avatar/edit/' . $user->username . '">'.elgg_echo('theme:profile:edit:picture').'</a></div>';
}
$icon .= '</div>';

// grab the actions and admin menu items from user hover
$menu = elgg_trigger_plugin_hook('register', "menu:user_hover", array('entity' => $user), array());
$builder = new ElggMenuBuilder($menu);
$menu = $builder->getMenu();
$actions = elgg_extract('action', $menu, array());
$admin = elgg_extract('admin', $menu, array());

/* profile actions */
$ignore_items = array(
	 'avatar:edit',
);

$profile_actions = '';
if (elgg_is_logged_in() && $actions) {
	$profile_actions = '<ul class="elgg-menu elgg-menu-owner-block profile-content-menu elgg-menu-owner-block-default nmBot">';
	foreach ($actions as $action) {
		$item_name = $action->getName();

		if (!in_array($item_name, $ignore_items)) {
			$profile_actions .= '<li>' . $action->getContent() . '</li>';
		}
	}
	$profile_actions .= '</ul>';
}

// content links
$content_menu = elgg_view_menu('owner_block', array(
	 'entity' => elgg_get_page_owner_entity(),
	 'class' => 'profile-content-menu nmBot',
		  ));
		  
$mn_prof = '';
// if admin, display admin links
if (elgg_is_admin_logged_in() && elgg_get_logged_in_user_guid() != elgg_get_page_owner_guid()) {

	$mn_prof = '<ul class="profile-menu-admin elgg-menu elgg-menu-owner-block profile-content-menu elgg-menu-owner-block-default nmBot">';
	foreach ($admin as $menu_item) {
		$mn_prof .= elgg_view('navigation/menu/elements/item', array('item' => $menu_item));
	}
	$mn_prof .= '</ul>';
}

//View to extend inside the left menu on user profile page
$profile_extended = elgg_view('profile/owner_block_extended');

?>

<div id="profile-owner-block">
	<?php echo $icon; ?>
	<div class="allProfileMenus">
		<?php echo $profile_actions; ?>
		<?php echo $content_menu; ?>
		<?php echo $mn_prof; ?>
	</div>
	<?php echo $profile_extended; ?>
</div>
