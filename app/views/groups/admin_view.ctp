<h2 class="title"><?php  __('Group Record: ' . $group['Group']['name']);?></h2>
<?php echo $this->element('/groups/menus/view_menu', array('cache' => 'true'));?>
	<fieldset>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
	</fieldset>


<div class="effects">
<ul>
<li>
<?php echo $html->link($html->image('/img/admin/icons/user.gif'.' '.__("+"), array('title' => 'Group Users')),'#',array('onclick'=>'Effect.toggle("group_users", "appear", {duration: 0.5}); return false;'), null, false); ?>
</li>
<li>
<?php echo $html->link($html->image('/img/admin/icons/permissions.gif'.' '.__("+"), array('title' => 'Group Permissions')),'#',array('onclick'=>'Effect.toggle("group_permissions", "appear", {duration: 0.5}); return false;'), null, false); ?>
</li>
</ul>
</div>	

<div id="group_permissions" style="display:none;">
<h3><?php __("Group Permissions")?></h3>
<?php if (!empty($group['Permission'])):?>
	<table cellpadding = "2" cellspacing = "2">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($group['Permission'] as $permission):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $permission['name'];?></td>
			<td><?php echo $time->niceShort($permission['created']);?></td>
			<td><?php echo $time->niceShort($permission['modified']);?></td>
			<td class="actions">
				<?php echo $html->link($html->image('admin/icons/view.gif', array('title' => 'View ' . $permission['name'])),
				'/admin/permissions/view/' . $permission['id'], array(), false, false ); ?>
				<?php echo $html->link($html->image('admin/icons/edit.gif', array('title' => 'Edit ' . $permission['name'])),
				'/admin/permissions/edit/' . $permission['id'], array(), false, false ); ?>
				<?php echo $html->link($html->image('admin/icons/delete.gif', array('title' => 'Delete ' . $permission['name'])),
				'/admin/permissions/delete/' . $permission['id'], null, sprintf(__('Are you sure you want to delete ' . $permission['name'] . '?', true), $permission['id']), false
				); ?>
		</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php else: ?>
No permissions assigned
<?php endif;?>
</div>

<div id="group_users" style="display:none;">
<h3><?php __("Group Users")?></h3>
	<?php if (!empty($group['User'])):?>
	<table cellpadding = "2" cellspacing = "2">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('Email Address'); ?></th>
		<th><?php __('Active'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($group['User'] as $user):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $user['name'];?></td>
			<td><?php echo $user['email_address'];?></td>
			<td><?php echo $user['active'];?></td>
			<td><?php echo $time->niceShort($user['created']);?></td>
			<td><?php echo $time->niceShort($user['modified']);?></td>
			<td class="actions">
				<?php echo $html->link($html->image('admin/icons/view.gif', array('title' => 'View ' . $user['name'])),
				'/admin/users/view/' . $user['id'], array(), false, false ); ?>
				<?php echo $html->link($html->image('admin/icons/edit.gif', array('title' => 'Edit ' . $user['name'])),
				'/admin/users/edit/' . $user['id'], array(), false, false ); ?>
				<?php echo $html->link($html->image('admin/icons/delete.gif', array('title' => 'Delete ' . $user['name'])),
				'/admin/users/delete/' . $user['id'], null, sprintf(__('Are you sure you want to delete ' . $user['name'] . '?', true), $user['id']), false
				); ?>
		</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php else: ?>
No users assigned
<?php endif;?>
</div>