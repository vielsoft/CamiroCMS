<div id="colortab" class="ddcolortabs">
<ul>
<li><a href="<?php echo $html->url('/admin/main/'); ?>"><span>Home</span></a></li>
<?php foreach($admin_menu as $link): ?>
<li><a href="<?php echo $html->url($link['url'])?>" rel="<?php echo $link['rel'];?>"><span><?php echo $link['label']; ?></span></a></li>
<?php endforeach; ?>
</ul>
</div>

<div class="ddcolortabsline">&nbsp;</div>

<!--Recycle Bin down menu -->                                                   
<div id="dropmenu1_a" class="dropmenudiv_a" style="width: 140px;">
<?php foreach($recycle_menu as $link): ?>
<a href="<?php echo $html->url($link['url']);?>"><?php echo $link['label']; ?></a>
<?php endforeach; ?>
</div>


<!--ACL Management drop down menu -->                                                   
<div id="dropmenu2_a" class="dropmenudiv_a" style="width: 140px;">
<?php foreach($acl_menu as $link): ?>
<a href="<?php echo $html->url($link['url']);?>"><?php echo $link['label']; ?></a>
<?php endforeach; ?>
</div>


<!--Contents drop down menu -->                                                
<div id="dropmenu3_a" class="dropmenudiv_a" style="width: 140px;">
<?php foreach($content_menu as $link): ?>
<a href="<?php echo $html->url($link['url']);?>"><?php echo $link['label']; ?></a>
<?php endforeach; ?>
</div>


<!--Menus drop down menu -->                                                
<div id="dropmenu4_a" class="dropmenudiv_a" style="width: 140px;">
<?php foreach($menu_menu as $link): ?>
<a href="<?php echo $html->url($link['url']);?>"><?php echo $link['label']; ?></a>
<?php endforeach; ?>
</div>

<script type="text/javascript">
//SYNTAX: tabdropdown.init("menu_id", [integer OR "auto"])
tabdropdown.init("colortab", 10)
</script>