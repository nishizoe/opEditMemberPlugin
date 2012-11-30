<?php slot('title', __('SearchMember')); ?>
<form action="<?php echo url_for('editmember/search') ?>" method="post">
<table>
<tr>
<th>id</th>
<td><input type="text" value="" name="member[id]" /></td>
</tr>
<tr>
<td colspan="2"><input type="submit" value=<?php echo __('Search') ?> /></td>
</tr>
</table>
</form>
