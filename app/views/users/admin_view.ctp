<h2 class="title"><?php  echo __('Record of: ') . $user['User']['name'];?></h2>
<?php echo $this->element('/users/menus/view_menu', array('cache' => 'true'));?>
<fieldset>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['email_address']; ?>
			&nbsp;
		</dd>
		<?php if ($user['User']['active'] == 1) {?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			Yes
			&nbsp;
		</dd>
		<?php } else { ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			No
			&nbsp;
		</dd>
		<?php }?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $time->niceShort($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $time->niceShort($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</fieldset>
<div class="effects">
<ul>
<li>
<?php echo $html->link($html->image('/img/admin/icons/groups.gif'.' '.__("+"), array('title' => 'User Groups')),'#',array('onclick'=>'Effect.toggle("user_group", "appear", {duration: 0.5}); return false;'), null, false); ?>
</li>
</ul>
</div>	
<div id="user_group" style="display:none;">
<h3><?php __('GROUP_MEMBER');?></h3>
	<?php if (!empty($user['Group'])):?>
	<table cellpadding = "2" cellspacing = "2">
	<tr>
		<th><?php __('NAME'); ?></th>
		<th><?php __('CREATED_DATE'); ?></th>
		<th><?php __('MODIFY_DATE'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Group'] as $group):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $group['name'];?></td>
			<td><?php echo $time->niceShort($group['created']);?></td>
			<td><?php echo $time->niceShort($group['modified']);?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php else: ?>
No group assigned
<?php endif;?>
</div>