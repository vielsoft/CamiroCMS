<h2 class="title"><?php __('Manage Trash Contents');?></h2>
<?php if(empty($contents)): ?>
There are no deleted contents found.
<?php else: ?>
<table cellpadding="2" cellspacing="2">
<tr>
<th>id</th>
<th>Title</th>
<th>Created</th>
<th>Access</th>
<th>Container</th>
<th>Actions</th>
</tr>
<?php foreach ($contents as $content): ?>
<tr>
<td>
<?php echo $content['Content']['id']; ?>
</td>
<td>
<?php echo $content['Content']['title'];?>
</td>
<td>
<?php echo $time->niceShort($content['Content']['created'])?>
</td>
<td>
<?php echo $content['Group']['name'] ?>
</td>
<td>
<?php echo $content['ContentContainer']['title'];  ?>
</td>
<td class="actions">
		<?php echo $html->link($html->image('admin/icons/restore.gif', array('title' => 'Restore ' . $content['Content']['title'])),
		'/admin/trash/restore_content/' . $content['Content']['id'], array(), false, false ); ?>
		<?php echo $html->link($html->image('admin/icons/permanent_delete.gif', array('title' => 'Delete ' . $content['Content']['title'])),
			'/admin/trash/delete_content/' . $content['Content']['id'], null, sprintf(__('Are you sure you want to delete ' . $content['Content']['title'] . '?', true), $content['Content']['id']), false
			); ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif;?>