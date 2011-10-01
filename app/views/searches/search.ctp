<?php if ($foundItems):?>
<?php echo $paginator->counter(array(
			'format' => 'Result:<strong>%count%</strong> record(s) found.')
			);
?>
<br/><br/>
<?php
	
	foreach($foundItems as $item){
	
		$content = 	$item['Content']['contentbody'];
		
		echo '<h3>' . $html->link($item['Content']['title'], '/contents/view/' . $item['Content']['slug']) 
		. '</h3> Created by: ' . $item['User']['name'] . '. In - '. $html->link($item['ContentContainer']['title'], '/content_containers/index/' . $item['ContentContainer']['id']) 
		. "<p>" . $text->wlimit($content, 30) . "</p><hr />";		
	}

?>
<br/>

<div id="pagenav" align="center">
	<?php
		echo $paginator->counter(array(
			'format' => 'Showing %current% records out of %count% total.')
			); 	
		echo '<br />' . $paginator->prev() . ' ';
		echo $paginator->numbers(array('separator' => '|', 'modulus' => '20'));
		echo ' ' . $paginator->next();
	?>
</div>

<br/><br/>
<?php else: ?>

	<p style="color:red"><?php echo __("No results found", true);?></p>

<?php endif; ?>