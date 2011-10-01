<?php
if(isset($Auth)){
    echo 'Welcome ' . $html->link($Auth['User']['name'], '/users/view/' . $Auth['User']['id']) . ' | '.$html->link('Logout',array('controller'=>'users','action'=>'logout'));
	echo ' | '."<a href=\"". $html->url('/admin/main')."\">Administration</a>";
} else {
	echo $html->link('Login', array('controller'=>'users', 'action'=>'login'));
	echo ' | ' . $html->link('Register', array('controller'=>'users', 'action'=>'register'));
} 


?>