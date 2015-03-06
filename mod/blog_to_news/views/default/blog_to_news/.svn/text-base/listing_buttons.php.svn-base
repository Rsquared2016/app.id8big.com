<?php
$entity = elgg_extract('entity', $vars);
$guid = $entity->getGUID();
//echo "<pre>";
//var_dump($guid);
//echo "</pre >";
//
//if ($entity->getAnnotations('suggested_to_news')) {
//    return FALSE;
//}

$url_accept = elgg_get_site_url().'action/blog_to_news/accept?guid='.$guid;
$url_accept = elgg_add_action_tokens_to_url($url_accept);

$url_deny = elgg_get_site_url().'action/blog_to_news/deny?guid='.$guid;
$url_deny = elgg_add_action_tokens_to_url($url_deny);

?>
<div class="blog_to_new_buttons_container">
    <a class="elgg-button elgg-button-action" href="<?php echo $url_accept?>"><?php echo elgg_echo('blog_to_news:accept:button:label');?> </a>
    <a class="elgg-button elgg-button-delete" href="<?php echo $url_deny?>"><?php echo elgg_echo('blog_to_news:deny:button:label');?> </a>
</div>
