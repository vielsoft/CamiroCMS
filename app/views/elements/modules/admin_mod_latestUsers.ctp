<?php
//latest user - module
 $users = $this->requestAction('/users/getLatestItems/'); ?>
<b>Latest <?php echo $html->link('Users', '/admin/users/index'); ?></b>
<?php echo " - " . $html->link('Add','/admin/users/add'); ?>
<?php if (empty($users)):?>
	No Items Available
<?php else:?>
	<ul>
	<?php foreach ($users as $user):?>
	<li>
		<?php echo $html->link($user['User']['name'], '/admin/users/edit/' . $user['User']['id']); 
		echo " - ";
		echo ($user['User']['email_address']);
		echo " - ";
		/* Removed edit icon and link
		echo $html->link($html->image('admin/icons/edit.gif', array('title' => 'Edit ' . $user['User']['name'])),
		'/admin/users/view/' . $user['User']['id'], array(), false, false );
		*/
		echo $html->link($html->image('admin/icons/delete.gif', array('title' => 'Delete ' . $user['User']['name'])),
			'/admin/users/delete/' . $user['User']['id'], null, sprintf(__('Are you sure you want to delete ' . $user['User'][
			'name'] . '?', true), $user['User']['id']), false);
		?>
	</li>
		<?php endforeach;?>
	</ul>
	<?php endif;?>