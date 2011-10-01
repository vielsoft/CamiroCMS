<?php
if (isset($Auth)) {
?>
<div id="context">
	<span class="contexttitle">You are logged in!</span>
</div>
	<ul class="sidemenu">
		<li><?php echo $html->link(__('Edit Profile', true), array('controller' => 'users', 'action'=>'edit', $Auth['User']['id'])); ?> </li>
		<li><?php echo $html->link('Logout',array('controller'=>'users','action'=>'logout'));?></li>	<ul>

<?php } else {?>

<div id="context">
	<span class="contexttitle">Login</span>
</div>
<?php
echo $form->create('User', array('action' => 'login', 'id' => 'login'));  
echo $form->input('email_address', array('label' => 'Email Address'));
echo $form->input('passwd', array('label' => 'Password', 'type' => 'password'));
echo $form->input('remember_me', array('label' => 'Remember Me!', 'type' => 'checkbox'));
echo $form->submit(__('Login', true));
echo $html->link(__('REGISTER', true), array('controller' => 'users', 'action'=>'register')); 
?>	
<?php }?>
