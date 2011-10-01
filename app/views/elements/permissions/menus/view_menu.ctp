<div class="actions">
<ul>
	<li>
	<?php echo $html->link($html->image('admin/icons/home.png', array('title' => __("Home", true))),
	 '/admin/permissions/', array(), false, false ); ?>
	</li>
	<li>
	<?php echo $html->link($html->image('admin/icons/add.png', array('title' => __("Add New Permission", true))),
	 '/admin/permissions/add/', array(), false, false ); ?>
	</li>
	<li>
	<?php echo $html->link($html->image('admin/icons/edit2.png', array('title' => __("Edit ", true) . $permission['Permission']['name'])),
	 '/admin/permissions/edit/' . $permission['Permission']['id'], array(), false, false ); ?>
	</li>
	<li>
	<?php echo $html->link($html->image('admin/icons/delete2.png', array('title' => 'Delete ' . $permission['Permission']['name'])),
			'/admin/permissions/delete/' . $permission['Permission']['id'], null, sprintf(__('Are you sure you want to delete ' . $permission['Permission']['name'] . '?', true), $permission['Permission']['id']), false
	); ?>
	</li>
</ul>
</div>
