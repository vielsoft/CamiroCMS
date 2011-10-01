<h2 class="title"><?php __('Edit Group');?></h2>
<?php echo $this->element('/groups/menus/edit_menu', array('cache' => 'true'));?>
<?php echo $form->create('Group');?>
	<?php
		echo $form->input('name', array('label'=>'Group Name'));
		echo $form->input('Permission', array('label'=>'Select Group Permissions'));
		echo $form->input('User', array('label'=>'Select Users For This Group'));
	?>
<?php echo $form->end('Submit');?>
