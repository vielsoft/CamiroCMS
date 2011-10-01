	<fieldset>
 		<legend><span class="title"><?php __("Register a new account")?></span></legend>

<?php echo $form->create('User', array('action' => 'register', 
					'id' => 'userform'));?>
	<?php
		echo $form->input('User.name', array('label' => 'Name'));
		echo $form->input('User.email_address', array(
					'label' => 'Email Address', 
					'error' => 'Email address is in used or Invalid'));
		echo $form->input('User.new_passwd', array(
					'label' => 'Password ( must be between 7-20 characters in length  - case sensitive)', 
					'type'=>'password'));
		echo $form->input('User.confirm_passwd', array(
					'label' => 'Re-type Password', 
					'type'=>'password'));
		echo $form->hidden('User.active', array('value' => '1'));
		echo $form->hidden('Group.group_id', array('value' => '4'));
	?>
<?php echo $form->end('Submit');?>

