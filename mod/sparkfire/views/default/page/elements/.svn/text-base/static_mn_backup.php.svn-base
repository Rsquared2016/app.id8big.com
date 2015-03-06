<ul class="elgg-menu elgg-menu-site elgg-menu-site-default elgg-menu-default-accordion">
    <li class="elgg-menu-item-activity"><a href="<?php echo $vars['url']; ?>activity">Activity</a></li>
    <li class="elgg-menu-item-people">
        <a href="#">People</a>
        <ul class="subMn">
            <li class="elgg-menu-item-thewire"><a href="<?php echo $vars['url']; ?>thewire/all">Wire</a></li>
            <li class="elgg-menu-item-members"><a href="<?php echo $vars['url']; ?>members">Community</a></li>
        </ul>
    </li>
    <li class="elgg-menu-item-blog"><a href="<?php echo $vars['url']; ?>blog/all">Blogs</a></li>
    <li class="elgg-menu-item-news">
        <a href="<?php echo $vars['url']; ?>news">News</a>
        <ul class="subMn">
            <li class="elgg-menu-item-sample"><a href="#">Sample item</a></li>
            <li class="elgg-menu-item-sample"><a href="#">Sample item</a></li>
            <li class="elgg-menu-item-sample"><a href="#">Sample item</a></li>
            <li class="elgg-menu-item-sample"><a href="#">Sample item</a></li>
            <li class="elgg-menu-item-sample"><a href="#">Sample item</a></li>
        </ul>
    </li>
    <li class="elgg-menu-item-projects"><a href="<?php echo $vars['url']; ?>projects/all?filter=mine">Projects</a></li>
    <li class="elgg-menu-item-events"><a href="<?php echo $vars['url']; ?>events/">Events</a></li>
    <li class="elgg-menu-item-file">
        <a href="<?php echo $vars['url']; ?>file/all">Files</a>
        <ul class="subMn">
            <li class="elgg-menu-item-sample"><a href="#">Sample item</a></li>
            <li class="elgg-menu-item-sample"><a href="#">Sample item</a></li>
            <li class="elgg-menu-item-sample"><a href="#">Sample item</a></li>
        </ul>
    </li>
    <li class="elgg-menu-item-circles"><a href="<?php echo $vars['url']; ?>circles/">Circles</a></li>
    <li class="elgg-menu-item-jobs"><a href="<?php echo $vars['url']; ?>jobs/last">Jobs</a></li>
    <li class="elgg-menu-item-meeting"><a href="<?php echo $vars['url']; ?>meeting">Meetings</a></li>
    <li class="elgg-menu-item-kt-polls"><a href="<?php echo $vars['url']; ?>kt_polls">Polls</a></li>
    <li class="elgg-menu-item-start-using"><a href="<?php echo $vars['url']; ?>startusing">Start using</a></li>
    <li class="elgg-menu-item-help"><a href="<?php echo $vars['url']; ?>help">Help</a></li>
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
