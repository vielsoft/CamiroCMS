<?php $contents = $this->requestAction(array (
								'controller' => 'contents', 
								'action' => 'getLatestItems')); ?>
<div id="context">
<span class="contexttitle">Latest Items</span>
</div>
<?php if (empty($contents)):?>
	No Content Items Available
<?php else:?>
	<ul class="latestnews">
		<?php foreach ($contents as $content):?>
	<li>
		<span class="created"><?php echo $time->niceShort($content['Content']['created']);?></span>
		<br />
		<?php echo $html->link($content['Content']['title'], '/contents/view/' . $content['Content']['slug']); ?>
	</li>
		<?php endforeach;?>
	</ul>
<?php endif;?>