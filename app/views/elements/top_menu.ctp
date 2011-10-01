<?php
$topmenus = $this->requestAction('/menus/view/1'); ?>
<?php if (empty($topmenus)):?>
<?php else:?>
	<div class="menu">
		<?php foreach ($topmenus as $menu):?>
		<?php echo $html->link($menu['Menu']['name'],$menu['Menu']['link']); ?>
		<?php endforeach;?>
	</div>
<?php endif;?>
