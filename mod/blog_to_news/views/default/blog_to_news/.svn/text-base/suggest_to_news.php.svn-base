<?php
$entity = elgg_extract('entity', $vars);
$guid = $entity->getGUID();

$logued_in_guid = elgg_get_logged_in_user_guid();

if ($entity->owner_guid != $logued_in_guid && !elgg_is_admin_logged_in()) {
    return FALSE;
}

if ($entity->getAnnotations('suggested_to_news')) {
    return FALSE;
}

$url = elgg_get_site_url().'action/blog_to_news/suggest?guid='.$guid;
$url = elgg_add_action_tokens_to_url($url);

?>
<div class="suggest_blog_container">
    <a class="elgg-button" href="<?php echo $url?>"><?php echo elgg_echo('blog_to_news:suggest:button:label');?> </a>
</div>
