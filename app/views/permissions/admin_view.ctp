<h2 class="title"><?php  echo __('Permission Record: ') . $permission['Permission']['name'];?></h2>
<?php echo $this->element('/permissions/menus/view_menu', array('cache' => 'true'));?>
	<fieldset>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $permission['Permission']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $permission['Permission']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $permission['Permission']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</fieldset>

<div class="effects">
<ul>
<li>
<?php echo $html->link($html->image('/img/admin/icons/groups.gif'.' '.__("+"), array('title' => 'Permission Groups')),'#',array('onclick'=>'Effect.toggle("permission_group", "appear", {duration: 0.5}); return false;'), null, false); ?>
</li>
</ul>
</div>	
<div id="permission_group" style="display:none;">
<h3><?php __("Permission Groups")?></h3>
	<?php if (!empty($permission['Group'])):?>
	<table cellpadding = "2" cellspacing = "2">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($permission['Group'] as $group):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $group['name'];?></td>
			<td><?php echo $time->niceShort($group['created']);?></td>
			<td><?php echo $time->niceShort($group['modified']);?></td>
			<td class="actions">
		<?php echo $html->link($html->image('admin/icons/view.gif', array('title' => 'View ' . $group['name'])),
		'/admin/groups/view/' . $group['id'], array(), false, false ); ?>
		<?php echo $html->link($html->image('admin/icons/edit.gif', array('title' => 'Edit ' . $group['name'])),
		'/admin/groups/edit/' . $group['id'], array(), false, false ); ?>
		<?php echo $html->link($html->image('admin/icons/delete.gif', array('title' => 'Delete ' . $group['name'])),
			'/admin/groups/delete/' . $group['id'], null, sprintf(__('Are you sure you want to delete ' . $group['name'] . '?', true), $group['id']), false
			); ?>
		</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php else: ?>
No permissions assigned
<?php endif;?>
</div>
