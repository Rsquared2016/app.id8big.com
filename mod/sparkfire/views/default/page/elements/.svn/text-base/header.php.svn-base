<?php
/**
 * Elgg page header
 * In the default theme, the header lives between the topbar and main content area.
 */

$site = elgg_get_site_entity();
$site_name = $site->name;

$logo_url = ThemeSettings::getForwardHomePageOutURL();

$logged_in_user = elgg_get_logged_in_user_entity();
if ($logged_in_user) {
	$logo_url = ThemeSettings::getForwardHomePageInURL();
}

?>
<div id="headerLef">
	<h1><a class="elgg-heading-site" href="<?php echo $logo_url ?>" title="<?php echo $site_name; ?>"><span class="no"><?php echo $site_name; ?></span></a></h1>
</div>
<div class="headerCenter flLef">
	<p>Where Ideas Become Opportunities!</p>
</div>
<div class="headRig flRig">
	<?php
		if(!elgg_is_logged_in()) {
			//echo elgg_view('forms/login_lb');
	?>
		<a href="<?php echo $vars['url']; ?>login" class="flRig loginTopText">Log In</a>
	<?php
		}
		else {
			if (elgg_is_active_plugin('search')) {
				echo elgg_view('search/header');
			}
			if (elgg_is_active_plugin('top_notifications')) {
				echo elgg_view('page/elements/top_notif_extend');
			}
			else {
				theme_exclude_topbar_items();
				echo elgg_view_menu('topbar', array('sort_by' => 'priority','class' => 'theme-topbar-menu-items'));
			}
        	echo elgg_view('page/elements/user_mn_top');
		}
	?>
</div>
<div class="clearfloat"></div>
