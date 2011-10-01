<div class="permissions form">
<h2 class="title"><?php __('Add Permission');?></h2>
<?php echo $this->element('/permissions/menus/edit_menu', array('cache' => 'true'));?>
<?php echo $form->create('Permission');?>
 		
	<?php
		echo $form->input('name', array('label' => 'Permission Name'));
		echo $form->input('Group', array('label' => 'Select a group for this permission'));
	?>

<?php echo $form->end('Submit');?>
</div>
