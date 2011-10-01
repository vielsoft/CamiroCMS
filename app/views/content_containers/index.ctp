<h2><?php echo __($currentview); ?></h2>
<?php if(empty($contentcontainers)): ?>
	There are no Containers to display
<?php else: ?>
	<?php foreach ($contentcontainers as $content): ?>
		<h2><?php 
echo $html->link($content['ContentContainer']['title'], array('action'=>'index',
$content['ContentContainer']['id'])); ?> </h2>
		<?php __("CREATED_BY");?>: <?php echo $content['ContentContainer']['created_by'] ?> <?php __("ON");?>
		<?php echo $time->niceShort($content['ContentContainer']['created']) ?>
<br />
		<?php echo $content['ContentContainer']['description'] ?> <br/><br />
           	<?php __("LAST_MODIFIED_ON");?>: <?php echo $time->niceShort($content['ContentContainer']['modified']) ?>
		<br /> 
		<?php echo $html->link("Show Containers Inside", array('action'=>'index',$content['ContentContainer']['id'])); ?> <br />
		<?php echo $html->link("Show Contents Inside", array('controller'=>'contents','action'=>'index',$content['ContentContainer']['id'])); ?> <br /><br /><hr />
		<?php endforeach; ?>

<?php endif; ?>
