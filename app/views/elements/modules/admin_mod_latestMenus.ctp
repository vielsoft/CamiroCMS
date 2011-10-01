<?php
// latest menus - module
 $menus = $this->requestAction('/menus/getLatestItems/'); ?>
<b>Latest <?php echo $html->link('Menus', 'admin/menus/index'); ?></b>
<?php echo " - " . $html->link('Add','/admin/menus/add'); ?>
<?php if (empty($menus)):?>
	No Menu Items Available
<?php else:?>
	<ul>
		<?php foreach ($menus as $menu):?>
	<li>
		<?php echo $html->link($menu['Menu']['link'], '/admin/menus/edit/' . $menu['Menu']['id']); 
		echo " - "; 
		/* Removed edit icon and link
		echo $html->link($html->image('admin/icons/edit.gif', array('title' => 'Edit ' . $menu['Menu']['name'])),
		'/admin/menus/view/' . $menu['Menu']['id'], array(), false, false );
		*/
		echo $html->link($html->image('admin/icons/delete.gif', array('title' => 'Delete ' . $menu['Menu']['name'])),
			'/admin/menus/delete/' . $menu['Menu']['id'], null, sprintf(__('Are you sure you want to delete ' . $menu['Menu']['name'] . '?', true), $menu['Menu']['id']), false
			); ?>
	</li>
		<?php endforeach;?>
	</ul>
<?php endif;?>