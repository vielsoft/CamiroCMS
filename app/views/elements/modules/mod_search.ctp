<?php echo $form->create('Search', array('method' => 'post', 'action' => 'search')); ?>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td><?php echo $form->input("Search.keyword", array(
			"id" => "keywords", 
			"value" => __('Search...', true), 
			"onFocus" =>"if (document.getElementById('keywords').value == '".__('Search...', true)."') {document.getElementById('keywords').value = '';}", 
			"onBlur" => "if (document.getElementById('keywords').value == '') {document.getElementById('keywords').value = '".__('Search...', true)."';}" ,
			"style"=>"padding:0px;margin:0px;",
			"size" => '20',
			"label" => false
		)
	); ?>
	</td>

	<td><?php echo $form->input("exact", array(
			"id" => "exact", 
			"value" => "", 
			"type" => 'checkbox',
			"label" => 'Exact',
		)
	); ?>
	</td>
	<td><?php echo $form->submit(__("Submit", true), array(
			"id" => "exact", 
			"value" => "", 
			"type" => 'checkbox',
			"onclick" =>"if (document.getElementById('exact').checked == true) {document.getElementById('exactflag').value = '1';}", 
		)
	); 
	echo $form->input("exactflag", array(
			"id" => "exactflag", 
			"value" => "", 
			"type" => 'hidden',
			"size" => '1',
			"width" => '0',
			"label" => false
		)
	); ?></td>
</div>
</tr>
</table>

<?php echo $form->end(); ?>
