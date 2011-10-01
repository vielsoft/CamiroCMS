<h2 class="title"><?php __($currentview)?></h2>
<?php echo $form->create('Content');?>
<fieldset>
<legend><?php //__($currentview)?></legend>
<br />
<?php echo $html->link('List All Contents', array('action'=>'admin_index')); ?>
<br />
<br />
<?php
echo $form->input('title');
echo $form->input('contentbody', array('type'=>'textarea', 'id' => 'Contentbody'));
echo $fck->load ( 'Contentbody');
echo $form->input('metakey');
echo $form->input('metadesc');
echo $form->input('state', array(
			//'label' => true,
			'label' => 'Published',
			'type' => 'select',
			'options' => array(0 => 'No', 1 => 'Yes'))
			);
if (!empty($parentContainer)) {
            echo $form->label('parent_id', 'Parent category'), 
                '<br />',
                $form->select('parent_id', $parentContainer);
        }
echo $form->input('version');
echo $form->input('ordering');
echo $form->input('Group', array('label'=>'Access','name' => 'data[Content][access]', ));
// echo $form->input('comment');
echo $form->input('comment', array(
			'label' => 'Allow Comments',
			//'legend' => 'Comment',
			'type' => 'select',
			'options' => array(0 => 'No', 1 => 'Yes'))
			);
echo $form->input('hits');
echo $form->input('properties');
?>
<?php echo $form->end('Save');
echo "<br />";
echo "<br />";
?>
<?php echo $html->link('List All Contents', array('action'=>'admin_index')); ?>
</fieldset>