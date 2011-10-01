<!--
/*
* PHP versions 4 and 5
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright		Copyright 2008, X-Project Team http://www.x-project.com
 * @version			1.0 Alpha
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */ -->

<!-- Todo, add helper function to extract author names for proper display
here it is guys, i just got it back
 -->
<?php foreach ($contents as $content) : ?>
	
	<span class="title">
		<?php echo $content['Content']['title']; ?>
	</span>
	<br/>
	<span class="created">
		<?php __("CREATED_BY") ; ?> : <?php echo $content ['User']['name'] ?> 
		<?php __("ON") ; ?>
		<?php echo " "; ?>
		<?php echo $time->niceShort($content['Content']['created']) ?>
	</span>
	<p>
		<?php echo $content['Content']['contentbody'] ?>
	</p>
	
	<span class="created">
	<?php __("LAST_MODIFIED_ON");
		echo " ";
		echo $time->niceShort($content['Content']['modified']);

endforeach; ?>
	</span>
<hr/>
<!--for the comments -->
<?php
//
//this is the switch, when the user wants to show the comments for every page
//
if ($content['Content']['comment']==1){
?>
<h2>Comments</h2>
<div id="comments">
<?php if(empty($comments)){
echo "No comments";
//add form
}else{ 
?>
<?php foreach($comments as $comment): ?>
<div class="comment">
<p><b><?php echo $comment['Comment']['name'];?></b>
<br/><?php echo $time->niceShort($comment['Comment']['created']);?></p>
<p><?php echo $comment['Comment']['comment'];?></p>
<br />
<br />
<br />
<br />
<br />
<br />
</div>
<?php endforeach;?>
<?php
//if statement ending bracket(if empty)
}
?>
<hr/>
<?php echo $form->create('Comment', array('controller' => 'comments' , 'action' => 'add'));?>
<p>
<?php
	echo $form->input('Comment.name');
	echo $form->input('Comment.email');
	echo $form->input('Comment.comment');
	echo $form->input('Comment.content_id',array('type'=>'hidden','value'=>$content['Content']['id']));

?>
</p>
<br />
<?php echo $form->end('Submit');?>
<?php
//if statement ending bracket(if comment==1)
}
?>
</div>
