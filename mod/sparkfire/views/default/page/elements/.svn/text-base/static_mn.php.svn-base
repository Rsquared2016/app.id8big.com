<?php

$user_logged_in = elgg_get_logged_in_user_entity();

$main_links = array();
$direct_links = array(); //array used to generate a link into a main menu

$handler = get_input('handler', '');
$page_owner = elgg_get_page_owner_entity();
$is_group = elgg_instanceof($page_owner, 'group');
$is_project = elgg_instanceof($page_owner, 'group', 'project');

$main_links['activity'] = array(
	'dashboard' => array(
        'href' => 'activity',
        'selected' => ($handler == 'activity' && !$is_group),
    ),
	'wire' => array(
        'href' => 'thewire',
        'selected' => ($handler == 'thewire' && !$is_group),
    ),
);
//$direct_links['activity'] = 'activity';
$main_links['people'] = array(
	'circles' => array(
        'href' => 'circles',
        'selected' => (($handler == 'circles' || $handler == 'collections') && !$is_group),
    ),
	'community' => array(
        'href' => 'members',
        'selected' => ($handler == 'members' && !$is_group),
    ),
);
if (elgg_instanceof($user_logged_in, 'user')) {
    $main_links['people']['following'] = array(
        'href' => 'friends/'.$user_logged_in->username,
        'selected' => (($handler == 'friends' || $handler == 'social_import_contacts') && !$is_group),
    );
    $main_links['people']['followers'] = array(
        'href' => 'friendsof/'.$user_logged_in->username,
        'selected' => ($handler == 'friendsof' && !$is_group),
    );
}

$main_links['projects'] = array(
    'href' => 'projects/all?filter=mine',
    'selected' => ($handler == 'projects' || $is_project),
);
$main_links['file'] = array(
    'href' => 'file/all',
    'selected' => ($handler == 'file' && !$is_group),
);

$main_links['calendar'] = array(
//	'tasks' => '#',
	'events_calendar' => array(
        'href' => 'events/calendar',
        'selected' => ($handler == 'events' && !$is_group),
    ),
	//'events' => 'events/calendar',
	'video_conference' => array(
        'href' => 'meeting/onlineusers',
        'selected' => ($handler == 'meeting' && !$is_group),
    ),
    'gtask' => array(
        'href' => 'kanban/view/'.  elgg_get_logged_in_user_guid(),
        'selected' => (($handler == 'kanban' || $handler == 'gtask') && !$is_group),
    ),
);

$main_links['social'] = array(
	'news' => array(
        'href' => 'news',
        'selected' => (($handler == 'news' || ($handler == 'blog_to_news' && elgg_in_context('news'))) && !$is_group),
    ),
	'blogs' => array(
        'href' => 'blog/all',
        'selected' => (($handler == 'blog' || ($handler == 'blog_to_news' && elgg_in_context('blog'))) && !$is_group),
    ),
	'groups' => array(
        'href' => 'groups/all',
        'selected' => (($handler == 'groups' && !$is_project) || ($is_group && !$is_project)),
    ),
	'jobs' => array(
        'href' => 'jobs/last',
        'selected' => ($handler == 'jobs' && !$is_group),
    ),
    'bookmarks' => array(
        'href' => 'bookmarks',
        'selected' => ($handler == 'bookmarks' && !$is_group),
    ),
    'pages' => array(
        'href' => 'pages/all',
        'selected' => (($handler == 'pages') && !$is_group),
    ),
);

//$main_links['tools'] = array(
//    'bookmarks' => 'bookmarks',
//    'gtask' => 'kanban/view/'.  elgg_get_logged_in_user_guid(),
//);

?>

<ul class="elgg-menu elgg-menu-site elgg-menu-site-default elgg-menu-default-accordion">

	<?php foreach ($main_links as $link_section => $menu_urls) { ?>

		<?php
		
		$default_main_url = array_key_exists($link_section, $direct_links) ? $direct_links[$link_section] : "#{$link_section}";
		$main_url = (is_array($menu_urls) && !array_key_exists('href', $menu_urls)) ? $default_main_url : elgg_extract('href', $menu_urls);
        
        $menu_url_selected = elgg_extract('selected', $menu_urls, FALSE);
        ?>

		<li class="elgg-menu-item-<?php echo $link_section ?>">
            <a class="<?php if ($menu_url_selected) { echo 'item_menu_selected'; } ?>" href="<?php echo elgg_normalize_url($main_url); ?>"><?php echo elgg_echo("sparkfire:static_menu:link_name:{$link_section}"); ?></a>

			<?php if (is_array($menu_urls) && !array_key_exists('href', $menu_urls)) { ?>
				<ul class="subMn">
					<?php
                        foreach ($menu_urls as $item_section => $item_menu_url) {
                            $class = '';
                            if ($item_section == 'events') {
                                $class = 'gcalendar-auth gcalendar-auth-no gcalendar-events';
                            }
                            
                            $item_menu_url_href = elgg_extract('href', $item_menu_url);
                            $item_menu_url_selected = elgg_extract('selected', $item_menu_url, FALSE);
                    ?>
                        <li class="elgg-menu-item-<?php echo $item_section; ?>">
                            <a class="<?php echo $class; ?> <?php if ($item_menu_url_selected) { echo 'item_menu_selected'; } ?>" href="<?php echo elgg_normalize_url($item_menu_url_href); ?>">
                                <?php echo elgg_echo("sparkfire:static_menu:sublink_menu:{$item_section}") ?>
                            </a>
                        </li>
					<?php } ?>
				</ul>
			<?php } ?>
		</li>
	<?php } ?>

</ul>


<script type="text/javascript">
	$(document).ready(
		function() {
            $('.elgg-menu-default-accordion > li > a').click(
                function() {
                    var this_li = $(this).parent();
                    var sub_mn = this_li.find('ul');

                    if(sub_mn.length) {
                        this_li.siblings().each(
                            function() {
                                if($(this).hasClass('elgg-state-selected')) {
                                    if($(this).find('ul').length) {
                                        $(this).find('ul').slideUp();
                                        $(this).removeClass('elgg-state-selected')
                                    }
                                }
                            }
                        );

                        $('.subMnOpen').removeClass('subMnOpen');

                        this_li.toggleClass('elgg-state-selected');
                        sub_mn.slideToggle('normal', function() { fix_main_height(); } );

                        make_active_item();

                        return false;
                    }
                }
            );

            function make_active_item() {
                $('.elgg-menu-default-accordion a').each(
                    function() {
                        //item_menu_selected
                        if($(this).hasClass('item_menu_selected')) {
                            /* it's a sub menu item */
                            if($(this).parents('.subMn').length) {
                                var sub_mn_parent = $(this).parents('.subMn').parent('li');

                                sub_mn_parent.addClass('elgg-state-selected');
                                $(this).parent().addClass('subMnOpen');
                                sub_mn_parent.find('ul').show();
                                return false;
                            }
                            else {
                                /* it's a menu item (level 1) */
                                $(this).parent().addClass('elgg-state-selected');
                                return false;
                            }
                        }
//                        if($(this).attr('href') == window.location.href) {
//                            /* it's a sub menu item */
//                            if($(this).parents('.subMn').length) {
//                                var sub_mn_parent = $(this).parents('.subMn').parent('li');
//
//                                sub_mn_parent.addClass('elgg-state-selected');
//                                $(this).parent().addClass('subMnOpen');
//                                sub_mn_parent.find('ul').show();
//                                return false;
//                            }
//                            else {
//                                /* it's a menu item (level 1) */
//                                $(this).parent().addClass('elgg-state-selected');
//                                return false;
//                            }
//                        }
                    }
                );
            }

            function fix_main_height() {
				var min_height = Math.max($('#mnSidebarWidget').outerHeight(), $('.sideBarsContainer').outerHeight())
                $('.elgg-layout > .elgg-main').css({ 'min-height' : min_height + 'px'} );
            }

            fix_main_height();
            make_active_item();

		}
	);
</script>
