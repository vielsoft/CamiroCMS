<h2 class="title"><?php __("Add New User")?></h2>
<?php echo $this->element('/users/menus/edit_menu', array('cache' => 'true'));?>
<?php echo $form->create('User');?>
	<?php
		echo $form->input('User.name', array('label' => 'Name'));
		echo $form->input('User.email_address', array('label' => 'Email Address'));
		echo $form->input('User.new_passwd', array('label' => 'Password ( must be between 7-20 characters in length  - case sensitive)', 'type' => 'password'));
		echo $form->input('User.confirm_passwd', array('label' => 'Re-type Password', 'type'=>'password'));
		echo $form->input('Group', array('label' => 'Select A Group Membership'));
	?>
<?php echo $form->end('Submit');?>
</div>
