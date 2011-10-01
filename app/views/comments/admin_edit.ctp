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
      <legend>Edit Comment</legend>
      <?php
         echo $form->hidden('id');
         echo $form->input('name');
	 echo $form->input('email');
         echo $form->input('comment');
      ?>
   </fieldset>
<?php echo $form->end('Save');
echo "<br/>";
echo "<br/>";
echo $html->link('List All Comments', array('action'=>'index'));
?>