<?php $user = $_SESSION['user'] ?>
<?php if($user->linkedin_user): ?>
<h3><?php echo elgg_echo('linkedin:usersettings:title') ?></h3>
<p><?php echo elgg_echo('linkedin:usersettings:desc') ?></p>
<p>
    <?php echo elgg_echo('linkedin:usersettings:sync') ?>
    <input type="checkbox" name="linkedin_sync" value="1"<?php echo $user->linkedin_sync ? ' checked="checked"' : '' ?>>
</p>
<?php endif ?>