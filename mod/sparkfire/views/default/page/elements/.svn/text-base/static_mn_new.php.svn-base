<?php

$main_links = array();
$direct_links = array(); //array used to generate a link into a main menu

$main_links['activity'] = array(
	'dashboard' => 'activity',
	'wire' => 'thewire',
);
//$direct_links['activity'] = 'activity';


$main_links['people'] = array(
	'circles' => 'circles',
	'community' => 'members',
);

$main_links['projects'] = 'projects/all?filter=mine';
$main_links['file'] = 'file/all';

$main_links['calendar'] = array(
//	'tasks' => '#',
	'events' => 'events',
	'video_conference' => 'meeting/onlineusers',
);

$main_links['social'] = array(
	'news' => 'news',
	'blogs' => 'blog/all',
	'groups' => 'groups/all',
	'jobs' => 'jobs/last',
);



?>

<ul class="elgg-menu elgg-menu-site elgg-menu-site-default elgg-menu-default-accordion">

	<?php foreach ($main_links as $link_section => $menu_urls) { ?>

		<?php
		
		$default_main_url = array_key_exists($link_section, $direct_links) ? $direct_links[$link_section] : "#{$link_section}";
		$main_url = (is_array($menu_urls)) ? $default_main_url : $menu_urls; ?>

		<li class="elgg-menu-item-<?php echo $link_section ?>">
			<a href="<?php echo elgg_normalize_url($main_url); ?>"><?php echo elgg_echo("sparkfire:static_menu:link_name:{$link_section}"); ?></a>

			<?php if (is_array($menu_urls)) { ?>
				<ul class="subMn">
					<?php foreach ($menu_urls as $item_section => $item_menu_url) { ?>
						<li class="elgg-menu-item-<?php echo $item_section; ?>"><a href="<?php echo elgg_normalize_url($item_menu_url); ?>"><?php echo elgg_echo("sparkfire:static_menu:sublink_menu:{$item_section}") ?></a></li>
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
                        if($(this).attr('href') == window.location.href) {
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
