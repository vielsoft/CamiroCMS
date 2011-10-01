<?php
$sidemenus = $this->requestAction('/menus/view/2'); ?>
<?php if (empty($sidemenus)):?>
<?php else:?>
	<div id="context">
	<span class="contexttitle">Side Menu</span>
	</div>
	<ul class="sidemenu">
		<?php foreach ($sidemenus as $menu):?>
		<li><?php echo $html->link($menu['Menu']['name'],$menu['Menu']['link']); ?></li>
		<?php endforeach;?>
	</ul>
<?php endif;?>
