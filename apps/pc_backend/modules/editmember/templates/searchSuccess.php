<?php
//$options = array(
//  'title' => __('Edit Profile'),
//  'url' => url_for('@member_editProfile'),
//);
//op_include_form('profileForm', array($memberForm, $profileForm), $options)
?>

<?php slot('title', __('Members')); ?>

<?php if (!$pager->getNbResults()): ?>
<p><?php echo __('No members matching') ?></p>
<?php else: ?>

<p>
<?php echo image_tag('backend/icn_delete_account.gif', array('alt' => __('Unsubscribe'))) ?>: <?php echo __('Unsubscribe') ?>
&nbsp;
<?php echo image_tag('backend/icn_rejected.gif', array('alt' => __('Ban'))) ?>: <?php echo __('Ban') ?>
&nbsp;
<?php echo image_tag('backend/icn_permit.gif', array('alt' => __('Unban'))) ?>: <?php echo __('Unban') ?>
&nbsp;
<?php echo image_tag('backend/icn_passwd.gif', array('alt' => __('Reissue password'))) ?>: <?php echo __('Reissue password') ?>
&nbsp;
<?php echo image_tag('backend/icn_blacklist.gif', array('alt' => __('Add mobile UID to blacklist'))) ?>: <?php echo __('Add mobile UID to blacklist') ?>
</p>

<form action="<?php echo url_for('editmember/regist') ?>" method="post">
<table>
<?php foreach ($pager->getResults() as $i => $member): ?>
    <tr>
        <th><?php echo __('Operation') ?></th>
        <td>
<?php if ($member->getId() != 1) : ?>
<?php echo link_to(image_tag('backend/icn_delete_account.gif', array('alt' => __('Unsubscribe'))), 'member/delete?id='.$member->getId()) ?>
<?php endif; ?>
        </td>
        <td>
<?php if (!$member->getIsLoginRejected()) : ?>
<?php echo link_to(image_tag('backend/icn_rejected.gif', array('alt' => __('Ban'))), 'member/reject?id='.$member->getId()) ?>
<?php else: ?>
<?php echo link_to(image_tag('backend/icn_permit.gif', array('alt' => __('Unban'))), 'member/reject?id='.$member->getId()) ?>
<?php endif; ?>
        </td>
        <td>
<?php echo link_to(image_tag('backend/icn_passwd.gif', array('alt' => __('Reissue password'))), 'member/reissuePassword?id='.$member->getId()) ?>
        </td>
        <td>
<?php echo link_to(image_tag('backend/icn_blacklist.gif', array('alt' => __('Add mobile UID to blacklist'))), 'member/blacklist?uid='.$member->getConfig('mobile_uid')) ?>
        </td>
    </tr>
    <tr>
        <th><?php echo __('ID') ?></th>
        <td colspan="4"><?php echo $member->getId() ?></td>
    </tr>
    <tr>
        <th><?php echo __('Nickname') ?></th>
        <td colspan="4"><input type="text" value="<?php echo $member->getName() ?>" name="member[name]" /></td>
    </tr>
<?php foreach ($profiles as $profile) : ?>
<?php if ($profile->isPreset()): ?>
<?php $config = $profile->getPresetConfig(); ?>
    <tr>
        <th><?php echo __($config['Caption']) ?></th>
        <td colspan="4"><?php echo __((string)$member->getProfile($profile->getName())); ?></td>
    </tr>
<?php else: ?>
    <tr>
        <th><?php echo $profile->getCaption() ?></th>
        <td colspan="4"><?php echo $member->getProfile($profile->getName()); ?></td>
<?php endif; ?>
<?php endforeach; ?>
    <tr>
        <th><?php echo __('PC email') ?></th>
        <td colspan="4"><input type="text" value="<?php echo $member->getConfig('pc_address') ?>" name="member[pc_address]" /></td>
    </tr>
    <tr>
        <th><?php echo __('Mobile email') ?></th>
        <td colspan="4"><input type="text" value="<?php echo $member->getConfig('mobile_address') ?>" name="member[mobile_address]" /></td>
    </tr>
    <tr>
        <th><?php echo __('Mobile UID') ?></th>
        <td colspan="4"><?php echo $member->getConfig('mobile_uid') ?></td>
    </tr>
<?php endforeach; ?>
    <tr>
        <td colspan="5"><input type="submit" value=<?php echo __('Regist') ?> /></td>
    </tr>
</table>
</form>

<!--
<table>

<tr>
<td colspan="<?php echo 7 + count($profiles) + 4 ?>">
<?php op_include_pager_navigation($pager, 'member/list?page=%d', array('use_current_query_string' => true)) ?>
</td>
</tr>

<tr>
<th colspan="4"><?php echo __('Operation') ?></th>
<th><?php echo __('ID') ?></th>
<th><?php echo __('Nickname') ?></th>
<th><?php echo __('Invited by') ?></th>
<th><?php echo __('Last login') ?></th>
<?php foreach ($profiles as $profile) : ?>
<?php if ($profile->isPreset()): ?>
<?php $config = $profile->getPresetConfig(); ?>
<th><?php echo __($config['Caption']) ?></th>
<?php else: ?>
<th><?php echo $profile->getCaption() ?></th>
<?php endif; ?>
<?php endforeach; ?>
<th><?php echo __('PC email') ?></th>
<th><?php echo __('Mobile email') ?></th>
<th><?php echo __('Mobile UID') ?></th>
</tr>

<?php foreach ($pager->getResults() as $i => $member): ?>
<tr style="background-color:<?php echo cycle_vars('member_list', '#fff, #eee') ?>;">
<td>
<?php if ($member->getId() != 1) : ?>
<?php echo link_to(image_tag('backend/icn_delete_account.gif', array('alt' => __('Unsubscribe'))), 'member/delete?id='.$member->getId()) ?>
<?php endif; ?>
</td>
<td>
<?php if (!$member->getIsLoginRejected()) : ?>
<?php echo link_to(image_tag('backend/icn_rejected.gif', array('alt' => __('Ban'))), 'member/reject?id='.$member->getId()) ?>
<?php else: ?>
<?php echo link_to(image_tag('backend/icn_permit.gif', array('alt' => __('Unban'))), 'member/reject?id='.$member->getId()) ?>
<?php endif; ?>
</td>
<td>
<?php echo link_to(image_tag('backend/icn_passwd.gif', array('alt' => __('Reissue password'))), 'member/reissuePassword?id='.$member->getId()) ?>
</td>
<td>
<?php echo link_to(image_tag('backend/icn_blacklist.gif', array('alt' => __('Add mobile UID to blacklist'))), 'member/blacklist?uid='.$member->getConfig('mobile_uid')) ?>
</td>
<td><?php echo $member->getId() ?></td>
<td><?php echo $member->getName() ?></td>
<td><?php if ($member->getInviteMember()) : ?><?php echo $member->getInviteMember()->getName() ?><?php endif; ?></td>
<td><?php if ($member->getLastLoginTime()) : ?><?php echo date('y-m-d<b\r />H:i:s', $member->getLastLoginTime()) ?><?php endif; ?></td>
<?php foreach ($profiles as $profile) : ?>
<?php if ($profile->isPreset()): ?>
<td><?php echo __((string)$member->getProfile($profile->getName())); ?></td>
<?php else: ?>
<td><?php echo $member->getProfile($profile->getName()); ?></td>
<?php endif; ?>
<?php endforeach; ?>
<td><?php echo $member->getConfig('pc_address') ?></td>
<td><?php echo $member->getConfig('mobile_address') ?></td>
<td><?php echo $member->getConfig('mobile_uid') ?></td>
</tr>
<?php endforeach; ?>

</table>
<?php endif; ?>
-->

<?php use_helper('Javascript') ?>
<?php echo link_to_function(__('Return to previous page'), 'history.back()') ?>
