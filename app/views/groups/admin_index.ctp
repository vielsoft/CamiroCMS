<div class="groups index">
<h2 class="title"><?php __('Manage Groups');?></h2>
<?php echo $this->element('/groups/menus/index_menu', array('cache' => 'true'));?>
<table cellpadding="2" cellspacing="2">
<tr>
	<th><?php echo $paginator->sort(__("Name", true));?></th>
	<th><?php echo $paginator->sort(__("Created", true));?></th>
	<th><?php echo $paginator->sort(__("Modified", true));?></th>
	<th class="actions"><?php __("Actions", true);?></th>
</tr>
<?php
$i = 0;
foreach ($groups as $group):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $html->link($group['Group']['name'], array('action' => 'view', $group['Group']['id']), array(), false, false ); ?>
		</td>
		<td>
			<?php echo $time->niceShort($group['Group']['created']); ?>
		</td>
		<td>
			<?php echo $time->niceShort($group['Group']['modified']); ?>
		</td>
		<td class="actions">
		<?php echo $html->link($html->image('admin/icons/edit.gif', array('title' => 'Edit ' . $group['Group']['name'])),
		'/admin/groups/edit/' . $group['Group']['id'], array(), false, false ); ?>
		<?php echo $html->link($html->image('admin/icons/delete.gif', array('title' => 'Delete ' . $group['Group']['name'])),
			'/admin/groups/delete/' . $group['Group']['id'], null, sprintf(__('Are you sure you want to delete ' . $group['Group']['name'] . '?', true), $group['Group']['id']), false
			); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
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
