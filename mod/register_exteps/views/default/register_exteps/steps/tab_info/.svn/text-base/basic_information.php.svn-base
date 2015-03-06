<?php
/**
 * Basic Information tab
 */
$invite_code = get_input('invite_code');
$invitation = kt_get_entity_by_invitecode($invite_code);

$login_by_invite = get_input('login_by_invite', FALSE);
$friend = get_entity(get_input('friend_guid'));


if (($invitation instanceof KtInvite) || $friend) {

	$username = '';
if ($login_by_invite && $friend) {
	$owner = $friend;
} else {
	$owner = $invitation->getOwnerEntity();
	$username = $invitation->firstname.' '.$invitation->lastname;
	$username = '<span class="usrNm">'. $username.'</span>';
}



//$owner_name = elgg_view('output/url',array('text' => $owner->name, 'href' => $owner->getURL()));
$owner_name = '<span class="yellowNameOnStep">'.$owner->name.'</span>';


?>

<div class="regUsrPic">
	<div class="img"><img src="<?php echo $owner->getIcon() ?>" alt="" /></div>
	<div class="txt">
		<h3><?php echo sprintf(elgg_echo('register_exteps:invite:username'), $username)?></h3>
		<p><?php echo sprintf(elgg_echo('register_exteps:invite:ownername'), $owner_name) ?></p>
	</div>
	<div class="cThis">&nbsp;</div>
</div>

<?php } ?>
<?php echo elgg_view('register_exteps/steps/tab_info/generic_info', $vars) ?>
