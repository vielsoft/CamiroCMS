<h2 class="title"><?php __('Manage Users');?></h2>
<?php echo $this->element('/users/menus/index_menu', array('cache' => 'true'));?>
<div id="userlist">
<table cellpadding="2" cellspacing="2" >
<tr>
	<th><?php echo $paginator->sort(__("Name", true));?></th>
	<th><?php echo $paginator->sort(__("Email Address", true));?></th>
	<th><?php echo __("Active", true);?></th>
	<th><?php echo $paginator->sort(__("Created", true));?></th>
	<th><?php echo $paginator->sort(__("Modified", true));?></th>
	<th class="actions"><?php echo __("Actions", true);?></th>
</tr>
<?php
$i = 0;
foreach ($users as $user):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $html->link($user['User']['name'], array('action' => 'view', $user['User']['id']), array(), false, false ); ?>
		</td>
		<td>
			<?php echo $user['User']['email_address']; ?>
		</td>
		<td>
		<?php 
		/*-- Deactivate --*/
			if ($user['User']['active'] == '1') {
				echo 'YES';
				} 

		/*-- Activate --*/
			else {
				echo 'NO';
				} ?>
		</td>
		<td>
			<?php echo $time->niceShort($user['User']['created']); ?>
		</td>
		<td>
			<?php echo $time->niceShort($user['User']['modified']); ?>
		</td>
		<td class="actions">
		<?php echo $html->link($html->image('admin/icons/edit.gif', array('title' => 'Edit ' . $user['User']['name'])),
		'/admin/users/edit/' . $user['User']['id'], array(), false, false ); ?>
		<?php echo $html->link($html->image('admin/icons/delete.gif', array('title' => 'Delete ' . $user['User']['name'])),
			'/admin/users/delete/' . $user['User']['id'], null, sprintf(__('Are you sure you want to delete ' . $user['User']['name'] . '?', true), $user['User']['id']), false
			); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
</div>
<div id="pagenav">
	<?php
		echo $paginator->counter(array(
			'format' => 'Showing %current% records out of %count% total.')
			); 	
		echo '<br />' . $paginator->prev() . ' ';
		echo $paginator->numbers(array('separator' => '|', 'modulus' => '20'));
		echo ' ' . $paginator->next();
	?>
</div>