<?php

if(isset($Auth)){
    echo 'Welcome ' . $Auth['User']['name'] . ' | '.$html->link('Logout',array('controller'=>'users','action'=>'logout'));
	echo ' | '."<a href=\"". $html->url('/')."\" target=\"_BLANK\">Frontend</a>";
} else {
	echo $html->link('Login', array('controller'=>'users', 'action'=>'login'));
} 


?>