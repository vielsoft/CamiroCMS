<h2 class="title"><?php __('Manage Trash Menus');?></h2>
<?php if(empty($menus)): ?>
There are no deleted menus found.
<?php else: ?>
<table border="1" cellpadding="2" cellspacing="2" width="100%">
<tr>
<th>Name</th>
<th>State</th>
<th>Ordering</th>
<th>Access</th>
<th>Action</th>
</tr>
<?php foreach ($menus as $menu): ?>
<tr>
<td>
<?php echo $menu['Menu']['name']; ?>
</td>
<td>
<?php echo $menu['Menu']['state'] ?>
</td>
<td>
<?php echo $menu['Menu']['ordering'] ?>
</td>
<td>
<?php echo $menu['Group']['name'] ?>
</td>
<td class="actions">
		<?php echo $html->link($html->image('admin/icons/restore.gif', array('title' => 'Restore ' . $menu['Menu']['name'])),
		'/admin/trash/restore_menu/' . $menu['Menu']['id'], array(), false, false ); ?>
		<?php echo $html->link($html->image('admin/icons/permanent_delete.gif', array('title' => 'Delete ' . $menu['Menu']['name'])),
			'/admin/trash/delete_menu/' . $menu['Menu']['id'], null, sprintf(__('Are you sure you want to delete ' . $menu['Menu']['name'] . '?', true), $menu['Menu']['id']), false
			); ?>
		</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif;?>