<h2 class="title"><?php __('Manage Permissions');?></h2>
<?php echo $this->element('/permissions/menus/index_menu', array('cache' => 'true'));?>
<table cellpadding="2" cellspacing="2">
<tr>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($permissions as $permission):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $permission['Permission']['name']; ?>
		</td>
		<td>
			<?php echo $time->niceShort($permission['Permission']['created']); ?>
		</td>
		<td>
			<?php echo $time->niceShort($permission['Permission']['modified']); ?>
		</td>
		<td class="actions">
		<?php echo $html->link($html->image('admin/icons/view.gif', array('title' => 'View ' . $permission['Permission']['name'])),
		'/admin/permissions/view/' . $permission['Permission']['id'], array(), false, false ); ?>
		<?php echo $html->link($html->image('admin/icons/edit.gif', array('title' => 'Edit ' . $permission['Permission']['name'])),
		'/admin/permissions/edit/' . $permission['Permission']['id'], array(), false, false ); ?>
		<?php echo $html->link($html->image('admin/icons/delete.gif', array('title' => 'Delete ' . $permission['Permission']['name'])),
			'/admin/permissions/delete/' . $permission['Permission']['id'], null, sprintf(__('Are you sure you want to delete ' . $permission['Permission']['name'] . '?', true), $permission['Permission']['id']), false
			); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
