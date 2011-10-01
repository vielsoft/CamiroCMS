<div class="groups form">
<h2 class="title"><?php __('Add Group');?></h2>
<?php echo $this->element('/groups/menus/edit_menu', array('cache' => 'true'));?>
<?php echo $form->create('Group');?>
	<?php
		echo $form->input('name');
		echo $form->input('Permission');
		echo $form->input('User');
	?>
<?php echo $form->end('Submit');?>
</div>
