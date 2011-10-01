<h2 class="title"><?php __($currentview)?></h2>
<?php echo $form->create('Menu');?>
<fieldset>
<legend><?php //__($currentview)?></legend>
<br />
<?php echo $html->link('List All Menus', array('action'=>'admin_index')); ?>
<br />
<br />
<?php
echo $form->input('name');
echo $form->input('link');
echo $form->input('state');
echo $form->input('menu_containers', array('label'=>'Parent Container','name' => 'data[Menu][parentid]' ));
echo $form->input('container');
echo $form->input('ordering');
echo $form->input('Group', array('label'=>'Access','name' => 'data[Menu][access]', ));
echo $form->input('hits');
echo $form->input('properties');
?>
<?php echo $form->end('Save');
echo "<br />";
echo "<br />";
?>
<?php echo $html->link('List All Menus', array('action'=>'admin_index')); ?>
</fieldset>