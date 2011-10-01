<div class="actions">
<ul>
	<li>
	<?php echo $html->link($html->image('admin/icons/home.png', array('title' => __("Home", true))),
	 array('controller' => 'content_containers', 'action' => 'index'), array(), false, false ); ?>
	</li>
	<?php echo $html->link($html->image('admin/icons/back.png', array('title' => __("Back to parent", true))),
	 array('controller' => 'content_containers', 'action' => 'index', $parentContainer['ContentContainer']['parent_id']), array(), false, false ); ?>
	<li>
	</li>
	<li>
	<?php echo $html->link($html->image('admin/icons/add.png', array('title' => __("Add New Container", true))),
	 array('controller' => 'content_containers', 'action' => 'add'), array(), false, false ); ?>
	</li>
</ul>
</div>
