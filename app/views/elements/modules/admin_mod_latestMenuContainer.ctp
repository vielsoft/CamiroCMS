<?php
//latest MenuContainer - module
 $menucontainers = $this->requestAction('/menu_containers/getLatestItems/'); ?>
<b>Latest <?php echo $html->link('Menu Containers', '/admin/menu_containers/index'); ?></b>
<?php echo " - " . $html->link('Add', '/admin/menu_containers/add'); ?>
<?php if (empty($menucontainers)):?>
	No Items Available
<?php else:?>
	<ul>
		<?php foreach ($menucontainers as $menucontainer):?>
	<li>
		<?php echo $html->link($menucontainer['MenuContainer']['name'], '/admin/menu_containers/edit/' . $menucontainer['MenuContainer']['id']); 
		echo " - "; 
		
		/*Removed edit icon 
		echo $html->link($html->image('admin/icons/edit.gif', array('title' => 'Edit ' . 	
		$menucontainer['MenuContainer']['name'])),
		'/admin/menu_containers/view/' . $menucontainer['MenuContainer']['id'], array(), false, false ); 
		*/
		echo $html->link($html->image('admin/icons/delete.gif', array('title' => 'Delete ' . $menucontainer['MenuContainer']['name'])), '/admin/menu_containers/delete/' . $menucontainer['MenuContainer']['id'], null, sprintf(__('Are you sure you want to delete ' . $menucontainer['MenuContainer']['name'] . '?', true), $menucontainer['MenuContainer']['id']), false
			); ?>
	</li>
		<?php endforeach;?>
	</ul>
<?php endif;?>