<h2 class="title"><?php __($currentview)?></h2>
<?php 
echo $form->create('ContentContainer');?>
<fieldset>
<legend><?php //__($currentview)?></legend>
<br />
<?php echo $html->link('List All Containers', array('action'=>'admin_index')); ?>
<br />
<br />
<?php
echo $form->input('title');
echo $form->input('description', array('type'=>'textarea', 'id' => 'Description'));
echo $fck->load ( 'Description');
echo $form->input('state');
if (!empty($parentContainer)) {
            echo $form->label('parent_id', 'Parent category'), 
                '<br />',
                $form->select('parent_id', $parentContainer);
        }
echo $form->input('created_by');
echo $form->input('modified_by');
echo $form->input('ordering');
echo $form->input('properties');
echo $form->input('Group', array('label'=>'Access','name' => 'data[ContentContainer][access]', ));
?>
<?php echo $form->end('Save');
echo "<br />";
echo "<br />";
?>
<?php echo $html->link('List All Contents', array('action'=>'admin_index')); ?>
</fieldset>