<?php if(empty($contents)): ?>
	There are no contents to display
<?php else: ?>
	<?php foreach ($contents as $content): ?>
			<span class="title">
				<?php echo $html->link($content['Content']['title'], array('action'=>'view',
						$content['Content']['slug'])); ?>
			</span>
			<br/>
			<span class="created">			
				<?php __("CREATED_BY");?>: <?php echo $content['User']['name'] ?> <?php __("ON");?>
				<?php echo $time->niceShort($content['Content']['created']) ?>
			</span>
			<br />
			<p>
			<?php echo $content['Content']['contentbody'] ?>
           	</p>
			<span class="created">
			<?php __("LAST_MODIFIED_ON");?>: <?php echo $time->niceShort($content['Content']['modified']) ?>
			by <?php echo $content['User']['name']?>
			</span>
			
			<span="readmore">
			|
			<?php echo $html->link("Read More", array('action'=>'view',$content['Content']['slug'])); ?> 
			<br /><br />
			<?php endforeach; ?>
			</span>
<?php endif; ?>
