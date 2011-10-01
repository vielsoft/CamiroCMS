<h2 class="title"><?php __('Menu Containers');?></h2>
<?php if(empty($menucontainers)): ?>
There are no menus in this list
<?php else: ?>
<?php echo $html->link($html->image('admin/icons/add.png', array('title' => __("Add New Container", true))),
	 array('controller' => 'menu_containers', 'action' => 'add'), array(), false, false ); ?>
<br /> 
<br />
<table border="1" cellpadding="2" cellspacing="2" width="100%">
<tr>
<th>Title</th>
<th>State</th>
<th>Ordering</th>
<th>Access</th>
<th>Properties</th>
<th>Actions</th>
</tr>
<?php foreach ($menucontainers as $menu): ?>
<tr>
<td>
<?php echo $html->link($menu['MenuContainer']['name'], array('action'=>'admin_edit', $menu['MenuContainer']['id'])); ?>
</td>
<td>
<?php echo $menu['MenuContainer']['state'] ?>
</td>
<td>
<?php echo $menu['MenuContainer']['ordering'] ?>
</td>
<td>
<?php echo $menu['Group']['name']?>
</td>
<td>
<?php echo $menu['MenuContainer']['properties'] ?>
</td>
<td class="actions">
		<?php echo $html->link($html->image('admin/icons/edit.gif', array('title' => 'Edit ' . $menu['MenuContainer']['name'])),
		'/admin/menu_containers/edit/' . $menu['MenuContainer']['id'], array(), false, false ); ?>
		<?php echo $html->link($html->image('admin/icons/delete.gif', array('title' => 'Delete ' . $menu['MenuContainer']['name'])),
			'/admin/menu_containers/delete/' . $menu['MenuContainer']['id'], null, sprintf(__('Are you sure you want to delete ' . $menu['MenuContainer']['name'] . '?', true), $menu['MenuContainer']['id']), false
			); ?>
		<?php echo $html->link($html->image('admin/icons/container.gif', array('title' => 'View Children Container(s)')),
		array('action'=>'admin_index', $menu['MenuContainer']['id']), array(), false, false ); ?>
		<?php echo $html->link($html->image('admin/icons/contents.gif', array('title' => 'View Container Menu(s)')),
		array('controller' => 'contents', 'action'=>'admin_index', $menu['MenuContainer']['id']), array(), false, false ); ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif;
echo "<br />";
echo "<br />"; ?>