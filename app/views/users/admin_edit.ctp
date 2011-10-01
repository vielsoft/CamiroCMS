<h2 class="title"><?php __("USER_INFO_EDIT_PAGE")?></h2>
<?php echo $this->element('/users/menus/edit_menu', array('cache' => 'true'));?>
<?php echo $form->create('User');?>
	<?php
		echo $form->input('User.name');
		echo $form->input('User.email_address');
		echo $form->input('active', array(
			'label' => true,
			'legend' => 'Set to Active?',
			'type' => 'radio',
			'options' => array(0 => 'No', 1 => 'Yes'))
			);
		echo $form->input('User.new_passwd', array('label' => 'New Password', 'type' => 'password'));
		echo $form->input('User.confirm_passwd', array('label' => 'Re-type Password', 'type'=>'password'));
		echo $form->input('Group');
	?>
<?php echo $form->end('Submit');?>
</div>
