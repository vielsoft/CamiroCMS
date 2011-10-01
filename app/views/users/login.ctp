<fieldset>
	<legend><span class="title"><?php __('Login');?></span></legend>
<?php
echo $form->create('User', array('controller' => 'users', 'action' => 'login', 'id' => 'userform'));  
echo $form->input('email_address', array('label' => 'Email Address'));
echo $form->input('passwd', array('label' => 'Password', 'type' => 'password'));
echo $form->input('remember_me', array('label' => 'Remember Me!', 'type' => 'checkbox'));
echo $form->end('Sign In');
?>
</fieldset>
