<!--/*
* PHP versions 4 and 5
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright		Copyright 2008, X-Project Team http://www.x-project.com
 * @version		1.0 Alpha
 * @license		http://www.opensource.org/licenses/mit-license.php The MIT License
*/ 
-->
<?php echo $form->create('Comment');?>
   <fieldset>
      <legend>Add New Comment</legend>
      <?php
	echo $form->input('name');
	echo $form->input('email');
	echo $form->input('comment');
	echo $form->input('content_id');
      ?>
   </fieldset>
<?php echo $form->end('Add comment');?>
<?php
echo "<br/>";
echo "<br/>";
echo $html->link('List All Comments', array('action'=>'index'));
 ?>

