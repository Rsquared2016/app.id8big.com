<?php
/**
 * Object full rendering
 *
 * Sample output:
 * <div class="elgg-content">
 *     <div class="elgg-image-block">
 *     </div>
 *     <div class="elgg-output">
 *     </div>
 * </div>
 *
 * @uses $vars['entity']   ElggEntity
 * @uses $vars['icon']     HTML for the content icon
 * @uses $vars['summary']  HTML for the content summary
 * @uses $vars['body']     HTML for the content body
 * @uses $vars['class']    Optional additional class for the content wrapper
 */

$icon = elgg_extract('icon', $vars);
$summary = elgg_extract('summary', $vars);
$body = elgg_extract('body', $vars);
$class = elgg_extract('class', $vars);
$revision = ''; // only for pages
$revision = elgg_extract('revision', $vars);

if ($class) {
	$class = "elgg-content $class";
} else {
	$class = "elgg-content";
}

//$header = elgg_view_image_block($icon, $summary);

$the_entity = elgg_extract('entity', $vars, FALSE);
if ($the_entity) {
	$owner = $the_entity->getOwnerEntity();
	$owner_link = elgg_view('output/url', array(
		'href' => $owner->getUrl(),
		'text' => $owner->name,
		'is_trusted' => true,
	));

	$author_text = elgg_echo('byline', array($owner_link));
	$date =  '<span class="addDot">' . elgg_view_friendly_time($the_entity->time_created) . '</span>';
	$author_date = '<div class="elgg-subtext height25 nm">' . $author_text . $date . $revision . '</div>';
	$bottom_contents = elgg_view_image_block($icon, $author_date);
}

?>
<div class="<?php echo $class; ?> elggFullView">
	<div class="fullViewTop">
		<?php echo $summary; ?>
		<div class="clearfloat"></div>
	</div>
	<?php echo $body; ?>
	<?php echo $bottom_contents; ?>	
</div>