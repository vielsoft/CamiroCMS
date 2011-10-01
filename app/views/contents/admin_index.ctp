<h2 class="title"><?php __('Manage Content Items');?></h2>
<?php 
if(empty($contents)): ?>
<?php echo $this->element('/contents/index_menu', array('cache' => 'true'));?>
There are no contents in this list
<?php else: ?>
<?php echo $this->element('/contents/index_menu', array('cache' => 'true'));?>
<table cellpadding="2" cellspacing="2">
<tr>
<th>Title</th>
<th>Published</th>
<th>Created</th>
<th>Modified</th>
<th>Access</th>
<th>Comments</th>
<th>Hits</th>
<th>Container</th>
<th>Actions</th>
</tr>
<?php foreach ($contents as $content): ?>
<tr>
<td>
<?php echo $text->climit($html->link($content['Content']['title'], array('action' => 'edit', $content['Content']['id'])), 100); ?>
</td>
<td>

		<?php 
		/*-- Deactivate --*/
			if ($content['Content']['state'] == '1') {
				echo 'YES';
			}
		/*-- Activate --*/
			else {
				echo 'NO';
				} ?>
</td>
<td>
<?php echo $time->niceShort($content['Content']['created'])?>
</td>
<td>
<?php echo $time->niceShort($content['Content']['modified']) ?>
</td>
<td>
<?php echo $content['Group']['name'] ?>
</td>
<td>
<?php 
//ToDo:: place link/switch here to enable/disable comments
		/*-- Enable comments --*/
			if ($content['Content']['comment'] == '1') {
				echo 'Enabled';
			}
		/*-- Disable comments --*/
			else {
				echo 'Disabled';
				} ?></td>
<td>
<?php echo $content['Content']['hits'] ?></td>
<td>
<?php echo $html->link($content['ContentContainer']['title'], array('controller'=>'content_containers','action'=>'edit',
$content['ContentContainer']['id']));  ?>
</td>
<td class="actions">
		<?php echo $html->link($html->image('admin/icons/edit.gif', array('title' => 'Edit ' . $content['Content']['title'])),
		'/admin/contents/edit/' . $content['Content']['id'], array(), false, false ); ?>
		<?php echo $html->link($html->image('admin/icons/delete.gif', array('title' => 'Delete ' . $content['Content']['title'])),
			'/admin/contents/delete/' . $content['Content']['id'], null, sprintf(__('Are you sure you want to delete ' . $content['Content']['title'] . '?', true), $content['Content']['id']), false
			); ?>
		</td>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif;?>
<div id="pagenav">
	<?php
		echo $paginator->counter(array(
			'format' => 'Showing %current% records out of %count% total.')
			); 	
		echo '<br />' . $paginator->prev() . ' ';
		echo $paginator->numbers(array('separator' => '|', 'modulus' => '20'));
		echo ' ' . $paginator->next();
	?>
</div>
<!--
::Whats this???

<script type="text/javascript">

var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"../../../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../../../SpryAssets/SpryMenuBarRightHover.gif"});
</script>
-->