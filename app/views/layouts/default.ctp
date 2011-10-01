<!DOCTYPE html PUBLIC
"-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Camiro Content Management System</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<?php echo $html->css('style', 'stylesheet', array("media"=>"screen" ));?>
<?php echo $html->css('formstyle', 'stylesheet', array("media"=>"screen" ));?>
<?php echo $this->element('title_and_meta'); ?>
<?php echo $this->element('rss'); ?>
<?php
if(isset($javascript)):
echo $javascript->link('prototype.js');
endif;
?>
</head>

<body>
<div id="page">
    <div id="header">
		<a href="./contents/index/front" class="logo"></a>
		<div id="search"><?php echo $this->element('modules/mod_search', array('cache' => 'true'));?></div>
    </div>

    <div id="menulinks">
		<?php echo $this->element('top_menu'); ?>
    </div>
    <div id="mainarea">
        <div id="contentarea">
		<div id="pathway"><?php echo $this->element('path_way'); ?></div>
			<?php 
				if ($session->check('Message.flash')) {
					$session->flash();
				}
				if ($session->check('Message.auth')) {
					$session->flash('auth');
				}
				?>
		<?php echo $content_for_layout?>
		</div>

        <div id="sidebar">
		<?php echo $this->element('side_menu'); ?>
		<?php echo $this->element('modules/mod_latestItems', array('cache' => 'true'));?>
		<?php echo $this->element('modules/mod_userlogin', array('cache' => 'true'));?>		
	</div>
	</div>	
    <div id="footer">
		<p>Copyright &copy; 2008, X - Project Camiro. http://www.xproject.com</p>
			<div id="valid">XHTML | CSS 2.0 </div>
    </div>

</div>
</body>

</html>
