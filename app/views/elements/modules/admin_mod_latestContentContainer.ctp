<?php
//latest contentcontainer - module
//ToDo - contentcontainer_controller edit!!! create function(latestitems)
 $contentcontainers = $this->requestAction('/content_containers/getLatestItems/'); ?>

<b>Latest <?php echo $html->link('Content Containers', '/admin/content_containers/index'); ?></b>

<?php echo " - " . $html->link('Add', '/admin/content_containers/add'); 
?>

<?php if (empty($contentcontainers)):?>
	No Items Available
<?php else:?>
	<ul>
		<?php foreach ($contentcontainers as $contentcontainer):?>
	<li>
		<?php echo $html->link($contentcontainer['ContentContainer']['title'], '/admin/content_containers/edit/' . $contentcontainer['ContentContainer']['id']); 
		echo " - "; 
		
		 /*Removed edit icon and link
		echo $html->link($html->image('admin/icons/edit.gif', array('title' => 'Edit ' . 
		$contentcontainer['ContentContainer']['title'])),
		'/admin/content_containers/view/' . $contentcontainer['ContentContainer']['id'], array(), false, false ); 
		*/
		
		echo $html->link($html->image('admin/icons/delete.gif', array('title' => 'Delete ' . $contentcontainer['ContentContainer']['title'])), '/admin/content_containers/delete/' . $contentcontainer['ContentContainer']['id'], null, sprintf(__(' \t \t \t WARNING!\n All Children Containers inside ' . $contentcontainer['ContentContainer']['title'] . ' will also deleted. \n Do you want to continue?', true), $contentcontainer['ContentContainer']['id']), false
			); ?>
	</li>
	
		<?php endforeach;?>
	</ul>
<?php endif;?>