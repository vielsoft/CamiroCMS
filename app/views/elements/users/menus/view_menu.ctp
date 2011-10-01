<div class="actions">
<ul>
	<li>
	<?php echo $html->link($html->image('admin/icons/home.png', array('title' => __("Home", true))),
	 '/admin/users/', array(), false, false ); ?>
	</li>
	<li>
	<?php echo $html->link($html->image('admin/icons/add.png', array('title' => __("Add New User", true))),
	 '/admin/users/add/', array(), false, false ); ?>
	</li>
	<li>
	<?php echo $html->link($html->image('admin/icons/edit2.png', array('title' => __("Edit ", true) . $user['User']['name'])),
	 '/admin/users/edit/' . $user['User']['id'], array(), false, false ); ?>
	</li>
	<li>
	<?php echo $html->link($html->image('admin/icons/delete2.png', array('title' => 'Delete ' . $user['User']['name'])),
			'/admin/users/delete/' . $user['User']['id'], null, sprintf(__('Are you sure you want to delete ' . $user['User']['name'] . '?', true), $user['User']['id']), false
	); ?>
	</li>
</ul>
</div>
