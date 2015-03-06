<?php
/**
 * Elgg help_text view
 *
 * @package ElggHelp texts
 */

$full = elgg_extract('full_view', $vars, FALSE);
$help_text = elgg_extract('entity', $vars, FALSE);

if (!$help_text) {
	return;
}

$owner = $help_text->getOwnerEntity();
$owner_icon = elgg_view_entity_icon($owner, 'tiny');
$descritive_icon = "<div class='fs1 iconb' data-icon='&#xe{$help_text->descriptive_icon};'>&nbsp;</div>";
$container = $help_text->getContainerEntity();
$categories = elgg_view('output/categories', $vars);

$description = elgg_view('output/longtext', array('value' => $help_text->description, 'class' => 'pbl'));

$comments_count = $help_text->countComments();
//only display if there are commments
if ($comments_count != 0) {
	$text = elgg_echo("comments") . " ($comments_count)";
	$comments_link = elgg_view('output/url', array(
		'href' => $help_text->getURL() . '#comments',
		'text' => $text,
		'is_trusted' => true,
	));
} else {
	$comments_link = '';
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'help_texts',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$subtitle = '';

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets')) {
	$metadata = '';
}

if ($full && !elgg_in_context('gallery')) {
	$params = array(
		'entity' => $help_text,
		'title' => false,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
	);
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);

	$help_text_icon = '';
	$body = <<<HTML
<div class="help_text elgg-content mts">
	$help_text_icon<span class="elgg-heading-basic mbs">$link</span>
	$description
</div>
HTML;


echo elgg_view('help_texts/full', array(
	'entity' => $help_text,
	'summary' => $summary,
	'body' => $body,
));

} elseif (elgg_in_context('gallery')) {
	echo <<<HTML
<div class="help_texts-gallery-item">
	<h3><div class='fs1 iconb' data-icon='$help_text->descriptive_icon'>&nbsp;</div>$help_text->title</h3>
	<p class='subtitle'>$owner_link $date</p>
</div>
HTML;
} else {

	$content = $help_text->description;
    $content = elgg_get_excerpt($content, 100);
    $content .= elgg_view('output/url', array(
        'href' => $help_text->getURL(),
        'text' => elgg_echo('help_texts:view_more'),
    ));
    $title = $help_text->title;
    if ($help_text->target_url) {
        $title = elgg_view('output/url', array(
            'href' => $help_text->target_url,
            'text' => $help_text->title,
            'js' => 'target="_blank"'
        ));
    }
	$params = array(
		'entity' => $help_text,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'content' => $content,
        'title' => $title,
	);
	$params = $params + $vars;
	$body = elgg_view('object/elements/summary', $params);

	echo elgg_view_image_block($descritive_icon, $body);
}
