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
<h2 class="title"><?php __('Manage Comments');?></h2>

<?php if(empty($comments)): ?>
   There are no Comments
<br/>
<br/>
<?php else: ?>
   <table>
      <tr>
         <th>Id</th>
         <th>Name</th>
	<th>Email Address</th>
         <th>Comments</th>
	<th>Created</th>
         <th>Content Id</th>
	<th>Actions</th>
      </tr>
      <?php foreach ($comments as $comment): ?>
         <tr>
            <td>
               <?php echo $comment['Comment']['id'] ?>
            </td>
            <td>
                <?php echo $comment['Comment']['name'] ?>
            </td>
            <td>
                <?php echo $comment['Comment']['email'] ?>
            </td>
	    <td>
                <?php echo $comment['Comment']['comment'] ?>
            </td>
	    <td>
                <?php echo $time->niceShort($comment['Comment']['created']) ?>
            </td>
            <td>
                <?php echo $html->link($comment['Content']['title'], array('controller'=>'contents','action'=>'edit', $comment['Content']['id'])); ?>
            </td>
            <td>
		<?php echo $html->link($html->image('admin/icons/edit.gif', array('title' => 'Edit ' . $comment['Comment']['name'])),
		'/admin/comments/edit/' . $comment['Comment']['id'], array(), false, false ); ?>
		<?php echo "    "; ?>
		<?php echo $html->link($html->image('admin/icons/delete.gif', array('title' => 'Delete ' . $comment['Comment']['name'])),'/admin/comments/delete/' . $comment['Comment']['id'], null, sprintf(__('Are you sure you want to delete comments by ' . $comment['Comment']['name'] . '?', true), $comment['Comment']['id']), false
			); ?>
            </td>
         </tr>
      <?php endforeach; ?>
   </table>

<?php endif; ?>
<?php echo $html->link('Add Comment', array('action'=>'add')); ?>