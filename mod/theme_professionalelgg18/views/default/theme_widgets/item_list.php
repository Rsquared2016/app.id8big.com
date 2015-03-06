<?php

/**
 * Item List
 */

$picture = $vars['picture'];
$title = $vars['title'];
$content = $vars['content'];
$owner = $vars['owner'];
$when = $vars['when'];
$item_url = $vars['item_url'];
$max_length = $vars['max_length'];

if ($owner instanceof ElggUser) {
	$owner_url = $owner->getURL();
	$owner_name = $owner->name;
	$owner = <<< EOT
	<a href="$owner_url" title="$owner_name">$owner_name</a>
EOT;
}

if (preg_match("/\<img/", $picture)) {
	$img = $picture;
} else {
	$img = "<img alt=\"$title\" src=\"$picture\" />";
}

if ($picture) {
	$picture = <<< EOT
	<div class="img">
    	<a href="$item_url">$img</a>
	</div>
EOT;
} else {

}
?>
<li>
<?php echo $picture ?>
	<div class="txt flN">
<?php
	if ($title) {
?>
		<div class="title">
			<h3><a href="<?php echo $item_url ?>" title="<?php echo $title ?>"><?php echo elgg_get_excerpt($title, 35); ?></a></h3>
		</div>
<?php
	}
	if ($content && !empty($content)) {
		switch ($max_length) {
			case -1:
				break;
			case 0:
				echo $content;
				break;
			default:
				$body = elgg_get_excerpt($content, $max_length);
				if (elgg_substr($body, -3, 3) == '...') {
					$body .=  " <a href=\"{$item_url}\">" . elgg_echo('theme:widget:item:read_more') . '</a>';
				}
				echo $body;
				break;
		}
	}
?>
		<div class="ownedBy">
			<span class="owner"><?php echo $owner; ?></span><span class="sep"> · </span><span class="date"><?php echo $when; ?></span>
		</div>
	</div>
</li>
