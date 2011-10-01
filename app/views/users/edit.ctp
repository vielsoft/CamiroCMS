<div class="users form">
<?php echo $form->create('User', array('action' => 'edit', 'id' => 'userform'));?>
	<fieldset>
 		<legend><span class="title"><?php __('Edit Profile');?></span></legend>
	<?php
		echo $form->input('User.name');
		echo $form->input('User.email_address');
		echo $form->input('User.new_passwd', array('label' => 'New Password', 'type' => 'password'));
		echo $form->input('User.confirm_passwd', array('label' => 'Re-type Password', 'type'=>'password'));
	?>
	<br />
	<?php echo $form->end('Submit');?>
	</fieldset>
</div>
