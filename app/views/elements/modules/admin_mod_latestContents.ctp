<?php
//latest contents - module
 $contents = $this->requestAction('/contents/getLatestItems/'); ?>
<b>Latest <?php echo $html->link('Contents', '/admin/contents/index'); ?></b>
<?php echo " - " . $html->link('Add', '/admin/contents/add'); ?>
<?php if (empty($contents)):?>
	No Content Items Available
<?php else:?>
	<ul>
		<?php foreach ($contents as $content):?>
  <li>
		<?php echo $html->link($content['Content']['title'], '/admin/contents/edit/' . $content['Content']['id']);
		echo " - ";
		echo $time->timeAgoInWords($content['Content']['created']);
		echo " - ";
		
		/*Removed edit icon 
		echo $html->link($html->image('admin/icons/edit.gif', array('title' => 'Edit ' . $content['Content']['title'])),
		'/admin/contents/view/' . $content['Content']['id'], array(), false, false ); */
		
		echo $html->link($html->image('admin/icons/delete.gif', array('title' => 'Delete ' . $content['Content']['title'])),
		'/admin/contents/delete/' . $content['Content']['id'], null, sprintf(__('Are you sure you want to delete ' . $content['Content']['title'] . '?', true), $content['Content']['id']), false
		); ?>	</li>
	  <?php endforeach;?>
	</ul>
<?php endif;?>