<?php //echo $this->Element('tiny_mce',array('preset' => 'basic')); ?>
<h2 class="title"><?php __($currentview)?></h2>
<?php 
echo $form->create('MenuContainer');?>
<fieldset>
<legend><?php //__($currentview)?></legend>
<br />
<?php echo $html->link('List All Containers', array('action'=>'admin_index')); ?>
<br />
<br />
<?php
echo $form->input('name');
echo $form->input('state');
echo $form->input('menu_containers', array('label'=>'Parent Container','name' => 'data[MenuContainer][parentid]' ));
echo $form->input('ordering');
echo $form->input('properties');
echo $form->input('Group', array('label'=>'Access','name' => 'data[MenuContainer][access]', ));
?>
<?php echo $form->end('Save');
echo "<br />";
echo "<br />";
?>
<?php echo $html->link('List All Menus', array('action'=>'admin_index')); ?>
</fieldset>