<?php if(empty($parentContainer)):?>
<h2 class="title"><?php echo __('Main Containers', true);?></h2>
	<?php echo $html->link($html->image('admin/icons/add.png', array('title' => __("Add New Container", true))),
	 array('controller' => 'content_containers', 'action' => 'add'), array(), false, false ); ?>
<?php else:?>
<h2 class="title"><?php echo __('Children Container(s) of ') . $parentContainer['ContentContainer']['title'];?></h2>
	<?php echo $this->element('/containers/index_menu', array('cache' => 'true'));?>
<?php endif;?>

<?php if(empty($contentcontainers)): ?>
There are no contents in this list
<?php else: ?>
<table cellpadding="2" cellspacing="2">
<tr>
<th>Move</th>
<th>Title</th>
<th>State</th>
<th>Created</th>
<th>Modified</th>
<th>Access</th>
<th>Actions</th>
</tr>
<?php foreach ($contentcontainers as $content): ?>
<tr>
<td>
	<?php echo $html->link($html->image('admin/icons/down.gif', array('title' => 'Move Down')),
	array('action' => 'movedown', $content['ContentContainer']['title'], 1), array(), false, false ); ?>
	
	<?php echo $html->link($html->image('admin/icons/up.gif', array('title' => 'Move Up')),
	array('action' => 'moveup', $content['ContentContainer']['title'], 1), array(), false, false ); ?>	
</td>
<td>
<?php echo $html->link($content['ContentContainer']['title'], array('action' => 'edit', $content['ContentContainer']['id'])); ?>

</td>
<td>
<?php echo $content['ContentContainer']['state'] ?>
</td>
<td>
<?php echo $time->niceShort($content['ContentContainer']['created'])?>
</td>
<td>
<?php echo $time->niceShort($content['ContentContainer']['modified']) ?>
</td>
<td>
<?php echo $content['Group']['name'] ?>
</td>
<td class="actions">
		<?php echo $html->link($html->image('admin/icons/edit.gif', array('title' => 'Edit ' . $content['ContentContainer']['title'])),
		'/admin/content_containers/edit/' . $content['ContentContainer']['id'], array(), false, false ); ?>
		<?php echo $html->link($html->image('admin/icons/permanent_delete.gif', array('title' => 'Delete ' . $content['ContentContainer']['title'])), '/admin/content_containers/delete/' . $content['ContentContainer']['id'], null, sprintf(__(' \t \t \t WARNING!\n The container ' . $content['ContentContainer']['title'] . ' should be empty before proceeding. \n Do you want to continue?', true), $content['ContentContainer']['id']), false
			); ?>
		<?php echo $html->link($html->image('admin/icons/container.gif', array('title' => 'View Children Container(s)')),
		array('action'=>'admin_index', $content['ContentContainer']['id']), array(), false, false ); ?>
		<?php echo $html->link($html->image('admin/icons/contents.gif', array('title' => 'View Container Content(s)')),
		array('controller' => 'contents', 'action'=>'admin_index', $content['ContentContainer']['id']), array(), false, false ); ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif;?>