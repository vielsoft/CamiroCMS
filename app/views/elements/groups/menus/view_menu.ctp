<div class="actions">
<ul>
	<li>
	<?php echo $html->link($html->image('admin/icons/home.png', array('title' => __("Home", true))),
	 '/admin/groups/', array(), false, false ); ?>
	</li>
	<li>
	<?php echo $html->link($html->image('admin/icons/add.png', array('title' => __("Add New Group", true))),
	 '/admin/groups/add/', array(), false, false ); ?>
	</li>
	<li>
	<?php echo $html->link($html->image('admin/icons/edit2.png', array('title' => __("Edit ", true) . $group['Group']['name'])),
	 '/admin/groups/edit/' . $group['Group']['id'], array(), false, false ); ?>
	</li>
	<li>
	<?php echo $html->link($html->image('admin/icons/delete2.png', array('title' => 'Delete ' . $group['Group']['name'])),
			'/admin/groups/delete/' . $group['Group']['id'], null, sprintf(__('Are you sure you want to delete ' . $group['Group']['name'] . '?', true), $group['Group']['id']), false
	); ?>
	</li>
</ul>
</div>
