<?php
/**
 * Bookmarklet
 *
 * @package Help texts
 */

$page_owner = elgg_get_page_owner_entity();

if ($page_owner instanceof ElggGroup) {
	$title = elgg_echo("help_texts:this:group", array($page_owner->name));
} else {
	$title = elgg_echo("help_texts:this");
}

$guid = $page_owner->getGUID();

if (!$name && ($user = elgg_get_logged_in_user_entity())) {
	$name = $user->username;
}

$url = elgg_get_site_url();
$img = elgg_view('output/img', array(
	'src' => 'mod/help_texts/graphics/bookmarklet.gif',
	'alt' => $title,
));
$bookmarklet = "<a href=\"javascript:location.href='{$url}help_texts/add/$guid?address='"
	. "+encodeURIComponent(location.href)+'&title='+encodeURIComponent(document.title)\">"
	. $img . "</a>";

?>
<p><?php echo elgg_echo("help_texts:bookmarklet:description"); ?></p>
<p><?php echo $bookmarklet; ?></p>
<p><?php echo elgg_echo("help_texts:bookmarklet:descriptionie"); ?></p>
<p><?php echo elgg_echo("help_texts:bookmarklet:description:conclusion"); ?></p>
