<h2 class="title"><?php __('Manage Trash Users');?></h2>
<?php if(empty($users)): ?>
There are no deleted users found.
<?php else: ?>
<table cellpadding="2" cellspacing="2" >
<tr>
	<th>Id</th>
	<th>Name</th>
	<th>Email Address</th>
	<th>Date Created</th>
	<th class="actions">Actions</th>
</tr>
<?php
$i = 0;
foreach ($users as $user):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $user['User']['id']; ?>
		</td>
		<td>
			<?php echo $user['User']['name']; ?>
		</td>
		<td>
			<?php echo $user['User']['email_address']; ?>
		</td>
		<td>
			<?php echo $time->niceShort($user['User']['created']); ?>
		</td>
		<td class="actions">
		<?php echo $html->link($html->image('admin/icons/restore.gif', array('title' => 'Restore ' . $user['User']['name'])),
		'/admin/trash/restore_user/' . $user['User']['id'], array(), false, false ); ?>
		<?php echo $html->link($html->image('admin/icons/permanent_delete.gif', array('title' => 'Delete ' . $user['User']['name'])),
			'/admin/trash/delete_user/' . $user['User']['id'], null, sprintf(__('Are you sure you want to delete ' . $user['User']['name'] . '?', true), $user['User']['id']), false
			); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<?php endif;?>