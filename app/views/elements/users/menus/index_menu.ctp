<div class="actions">
<ul>
	<li>
	<?php echo $html->link($html->image('admin/icons/home.png', array('title' => __("Home", true))),
	 '/admin/', array(), false, false ); ?>
	</li>
	<li>
	<?php echo $html->link($html->image('admin/icons/add.png', array('title' => __("Add New User", true))),
	 '/admin/users/add/', array(), false, false ); ?>
	</li>
</ul>
</div>
