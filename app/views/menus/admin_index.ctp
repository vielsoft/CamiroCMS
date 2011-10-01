<h2 class="title"><?php __('Menus');?></h2>
<?php if(empty($menus)): ?>
There are no menus in this list
<?php else: ?>
<?php echo $html->link($html->image('admin/icons/add.png', array('title' => __("Add New Menu", true))),
	 array('controller' => 'menus', 'action' => 'add'), array(), false, false ); ?>
<br />
<br />
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
<?php echo $html->link($menu['Menu']['name'], array('action'=>'admin_edit', $menu['Menu']['id'])); ?>
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
		<?php echo $html->link($html->image('admin/icons/edit.gif', array('title' => 'Edit ' . $menu['Menu']['name'])),
		'/admin/menus/edit/' . $menu['Menu']['id'], array(), false, false ); ?>
		<?php echo $html->link($html->image('admin/icons/delete.gif', array('title' => 'Delete ' . $menu['Menu']['name'])),
			'/admin/menus/delete/' . $menu['Menu']['id'], null, sprintf(__('Are you sure you want to delete ' . $menu['Menu']['name'] . '?', true), $menu['Menu']['id']), false
			); ?>
		</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif;
echo "<br />";
echo "<br /"; ?>