<?php
$context = elgg_get_context();

if (empty($context)) {
	return;
}

$filter = elgg_extract('filter', $vars, 'all');

$view_name = "empty_sections/{$context}/{$filter}/empty_content";
if (elgg_view_exists($view_name)) {
	echo elgg_view($view_name, $vars);
	return;
}

$container_guid = elgg_get_page_owner_guid();
if (empty($container_guid)) {
	$container_guid = elgg_get_logged_in_user_guid();
}

$add_url = elgg_normalize_url("{$context}/add/{$container_guid}");

$intro_text = elgg_echo("empty_section:{$context}:{$filter}:intro", array($add_url));

$help = elgg_view("empty_sections/{$context}/{$filter}/help")

?>

<div class="emptySection context-<?php echo $context; ?> filter-<?php echo $filter ?>">
	<div class="introText">
		<h2><?php echo $intro_text; ?></h2>
	</div>
	<?php if ($help) { ?>
	<div class="helpEmptySection">
		<?php echo $help ?>
	</div>
	<?php } ?>
</div>
