<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--

Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Title      : Colorimetry
Version    : 1.0
Released   : 20080414
Description: A two-column, fixed-width and lightweight template ideal for 1024x768 resolutions. Suitable for blogs and small websites.

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $title_for_layout; ?></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<?php echo $html->css('admin'); ?>
<?php echo $html->css('ddcolortabs');?>

<?php if(!empty($ajax)): ?>
    <?php echo $javascript->link('prototype');?>
<?php endif; ?> 
<?php
if(isset($javascript)):
echo $javascript->link('prototype.js');
echo $javascript->link('scriptaculous.js?load=effects');
echo $javascript->link('dropdowntabs.js');
echo $javascript->link('fckeditor/fckeditor.js');
endif;
?>
</head>
<body>
<!-- start header -->
<div id="login_status"><?php echo $this->element('admin_status'); ?></div>
<div id="header">
	<div id="logo">
		<h1>CamiroCMS Administration</h1>
		<h2>A lightweight, modular and minimalist CMS written in CakePHP</h2>
	</div>

</div>
<!-- end header -->
<!-- start page -->
<?php if ($Auth) { ?>
<div id="adminbar">
<div id="menu">
<? echo $this->element('admin_menu'); ?>
</div>
<?php } else {} ?>
</div>
<!-- for js-errors, i added this <div> -->
<div id='js_errors' class='message' style='display:none'>
</div>
<div id="alert_messages">
<?php 
    if ($session->check('Message.flash')) {
		$session->flash();
	}
	if ($session->check('Message.auth')) {
		$session->flash('auth');
	}
?>
</div>
<div id="page">
	<!-- start content -->
	<div id="content">
		<div class="post">
			<?php echo $content_for_layout; ?>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div style="clear: both;">&nbsp;</div>
	</div>
<!-- end page -->
<!-- start footer -->
	<p id="legal">(c) 2008 YourSite. Design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>.</p>
<!-- end footer -->
</body>
</html>
